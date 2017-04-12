<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\TbUser;
use backend\modules\user\models\TbUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\slide\models\TbImages;
use common\traits\AjaxValidationTrait;
use yii\web\UploadedFile;
use backend\modules\user\models\TbUserProfile;

/**
 * DefaultController implements the CRUD actions for TbUser model.
 */
class DefaultController extends Controller {

    use AjaxValidationTrait;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbUser models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $modelUser = new TbUser();

        $this->performAjaxValidation($modelUser);


        if ($modelUser->load(Yii::$app->request->post())) {

            //echo $modelUser->validate();            
            $modelUser->user_timecreate = date("Y-m-d H:i:s");
            $modelUser->timestamp = date("YmdHis");
            $modelUser->setPassword($modelUser->password);
            $modelUser->generateAuthKey();
            $modelUser->user_status = 1;

            if ($modelUser->save()) {

                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->redirect(['view', 'id' => $modelUser->user_id]);
            }
//            if(!$modelUser->validate()){
//                print_r($modelUser->getErrors());  
//            }
        } else {
            
        }
        return $this->render('create', [
                    'model' => $modelUser,
        ]);
    }

    /**
     * Updates an existing TbUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    ##################################
    ##################################

    public function actionImg() {
        // print_r(Yii::$app->request->post())       
        $TbImages = new TbImages();
        $img = UploadedFile::getInstance($TbImages, 'img_name_file');

        if ($img) {
            //print_r($img);
            $pathImg = TbUserProfile::PATH_IMG;
            Yii::$app->img->CreateDir($pathImg);
            $savePath = Yii::$app->img->getUploadPath($pathImg);
            //echo $savePath;
            //exit();
            $FileName = $img->basename . '.' . $img->extension;
            $newFileName = md5($img->basename . time()) . '.' . $img->extension;
            if ($img->saveAs($savePath . $newFileName)) {
                #resize
                $image = Yii::$app->image->load($savePath . '/' . $newFileName);
                $image->resize(440,587);
                $image->save($savePath . '/' . $newFileName);
                #thumbnail
                $image = Yii::$app->image->load($savePath . '/' . $newFileName);
                $image->resize(100,100);
                $image->save($savePath . '/thumbnail/' . $newFileName);
                
                Yii::$app->img->clearTempImg();

                $TbImages->img_id = $newFileName;
                $TbImages->img_name_file = $FileName;
                $TbImages->img_path_file = $pathImg;
                $TbImages->img_upload_date = date("Y-m-d H:i:s");
                $TbImages->user_id = Yii::$app->user->id;
                $TbImages->img_temp = '1';

                if ($TbImages->save()) {
                    $src = Yii::$app->img->getUploadUrl($TbImages->img_path_file) . $TbImages->img_id;
                    echo json_encode(['success' => 'true', 'src' => $src, 'img_id' => $TbImages->img_id]);
                } else {
                    print_r($TbImages->getErrors());
                    echo json_encode(['success' => 'true']);
                }
            } else {
                echo json_encode(['success' => 'false', 'img1' => $img]);
            }
        } else {
            echo json_encode(['success' => 'false', 'img2' => $img]);
        }
    }

}
