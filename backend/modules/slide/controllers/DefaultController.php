<?php

namespace app\modules\slide\controllers;

use Yii;
use backend\modules\slide\models\TbSlide;
use backend\modules\slide\models\TbSlideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\modules\slide\models\TbImages;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * DefaultController implements the CRUD actions for TbSlide model.
 */
class DefaultController extends Controller {

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
     * Lists all TbSlide models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbSlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbSlide model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbSlide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TbSlide();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->slide_date_create = date("Y-m-d H:i:s");
            if ($model->save()) {
                return $this->redirect(['upload', 'id' => $model->slide_id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbSlide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->img_id, $model->slide_id);
        if ($model->load(Yii::$app->request->post())){            
            if($model->save()) {
                $img=TbImages::findOne($model->img_id);
                $img->img_temp='0';
                $img->save();
                return $this->redirect(['view', 'id' => $model->slide_id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'initialPreview' => $initialPreview,
                        'initialPreviewConfig' => $initialPreviewConfig
            ]);
        }
    }

    public function actionUpload($id) {
        $model = $this->findModel($id);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->img_id, $model->slide_id);

        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false, $model->slide_id);
//            $data=[];
//            $data['img_id']='';
//            if($data=$this->Uploads(false)){ 
//                //print_r($data);
//                if(!empty($data['img_id'])){
//                    $model->img_id=$data['img_id'];
//                    $model->save();
//                }
//            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->slide_id]);
            }
        } else {
            return $this->render('upload', [
                        'model' => $model,
                        'initialPreview' => $initialPreview,
                        'initialPreviewConfig' => $initialPreviewConfig
            ]);
        }
    }

    /**
     * Deletes an existing TbSlide model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbSlide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbSlide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TbSlide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

//    ********************************************************************
//    ********************************************************************

    public function actionUploadajax() {
        $this->Uploads(true, Yii::$app->request->post('slide_id'));
    }

    public function actionLoadImg($id) {
        $model = TbImages::find()->where(['img_id'=>$id])->one();
        if ($model) {
            $src = Yii::$app->img->getUploadUrl($model->img_path_file) . $model->img_id;
            echo json_encode(['src' => $src,'id'=>$model->img_id]);
        }
    }

    public function actionDeletefileajax() {
        $file = Yii::$app->request->post('key');
        $this->deleteImg(true, $file);
    }

    const UPLOAD_FOLDER = 'slide';

    private function Uploads($isAjax = false, $slide_id) {

        if (Yii::$app->request->isPost) {
            $img = Yii::$app->img;
            //$uploadedFile = UploadedFile::getInstancesByName('TbSlide[img_id]');
            //$TbImages = new TbImages();
            $uploadedFile = UploadedFile::getInstancesByName('TbImages[img_name_file]');
            //exit();
            //$data=[];           


            if ($uploadedFile !== null && $uploadedFile) {
                // print_r($uploadedFile);  
                $img->CreateDir(self::UPLOAD_FOLDER);
                $img_id = '';
                
                ########## Delete file temp ############
                $oldImg = TbImages::find()->where(['img_temp' => '1', 'user_id' => Yii::$app->user->identity->id])->all();
                foreach ($oldImg as $img_o) {
                    $this->deleteImg(false, $img_o->img_id);
                }
                #########################################


                foreach ($uploadedFile as $images) {

                    $oldFileName = $images->basename . '.' . $images->extension;
                    $newFileName = md5($images->basename . time()) . '.' . $images->extension;
                    $pathFile = $img->getUploadPath() . self::UPLOAD_FOLDER;
                    if ($images->saveAs($pathFile . '/' . $newFileName)) {
                        $tbSlide=TbSlide::findOne(['slide_id'=>$slide_id]);
                        
                        if($tbSlide->slideCate->slide_cate_width&&$tbSlide->slideCate->slide_cate_height){
                            $slideWidth=$tbSlide->slideCate->slide_cate_width;
                            $slideHieght=$tbSlide->slideCate->slide_cate_height;
                            $image = Yii::$app->image->load($pathFile . '/' . $newFileName);
                            $image->crop($slideWidth, $slideHieght);
                            //$image->resize(Yii::$app->params['slideWidth']);
                            $image->save($pathFile . '/' . $newFileName);
                        }
                        

                        $image = Yii::$app->image->load($pathFile . '/' . $newFileName);
                        $image->resize(100);
                        $image->save($pathFile . '/thumbnail/' . $newFileName);

                        $TbImages = new TbImages();
                        $TbImages->img_id = $newFileName;
                        $TbImages->img_name_file = $oldFileName;
                        $TbImages->img_type_file = $images->extension;
                        $TbImages->img_path_file = self::UPLOAD_FOLDER;
                        $TbImages->img_upload_date = date('Y:m:d H:i:s');
                        $TbImages->img_temp = '1';
                        $TbImages->user_id = Yii::$app->user->identity->id;

                        //$TbImages->img_temp = '1'; 
                        //print_r($TbImages);

                        if ($TbImages->save()) {
//                        $tbSlide=TbSlide::findOne(['slide_id'=>$slide_id]);
//                        $this->deleteImg(false,$tbSlide->img_id);
//                        $tbSlide->img_id=$newFileName;
//                        $tbSlide->save(); 
                            $img_id = $TbImages->img_id;
                        } else {
                            if ($isAjax === true) {
                                echo json_encode(['success' => 'false', 'eror' => $TbImages->getErrors()]);
                            }
                        }

                        if ($isAjax === true) {
                            echo json_encode(['success' => 'true', 'files' => $img_id]);
                        }
                    }
                }
            } else {
                if ($isAjax === true) {
                    echo json_encode(['success' => 'false']);
                }
            }
        }

//            if($isAjax!==true){
//                return $data;
//            }
    }

//upload

    private function getInitialPreview($img_id, $slide_id) {
        $datas = TbImages::find()->where(['img_id' => $img_id])->all();

        $initialPreview = [];
        $initialPreviewConfig = [];
        if ($datas) {
            foreach ($datas as $key => $file) {
                //$nameFicheiro = substr($file, strrpos($file, '\\') + 1);
                $relFile = Yii::$app->img->getUploadUrl() . self::UPLOAD_FOLDER . '/' . $file->img_id;
                //echo $relFile;
                array_push($initialPreview, $this->getTemplatePreview($relFile));
                array_push($initialPreviewConfig, [
                    'caption' => $file->img_name_file,
                    'width' => '120px',
                    'url' => Url::to(['/slide/deletefileajax']),
                    'key' => $file->img_id
                ]);
            }
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    private function getTemplatePreview($img) {
        //$filePath = TbAlbum::getUploadUrl().$model->album_path.'/thumbnail/'.$model->real_filename;
        $filePath = $img;
        //echo $img;
        $isImage = Yii::$app->img->isImage($filePath);
        if ($isImage) {
            $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => 'model->file_name', 'title' => 'model->file_name']);
        } else {
            $file = "<div class='file-preview-other'> " .
                    "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                    "</div>";
        }
        return $file;
    }

    private function deleteImg($isAjax = false, $file) {
        //$file=NULL;
//        if($isAjax===true){
//            $file = Yii::$app->request->post('key');
//            list($slide_id,$file) = explode(':', $file);
//        }
        //echo json_encode(['success'=>true,'data'=>$file]);
        if ($file !== NULL) {
            if (@unlink(Yii::$app->img->getUploadPath() . self::UPLOAD_FOLDER . '/' . $file)) {
                $thumbnail = Yii::$app->img->getUploadPath() . self::UPLOAD_FOLDER . '/thumbnail/' . $file;
                if (@unlink($thumbnail)) {
                    TbImages::findOne($file)->delete();
                    $tbSlide = TbSlide::findOne(['img_id' => $file]);
                    if ($tbSlide) {
                        $tbSlide->img_id = null;
                        $tbSlide->save();
                    }
                    if ($isAjax === true) {
                        echo json_encode(['success' => true, 'data' => $file]);
                    }
                }
            }
        } else {
            if ($isAjax === true) {
                echo json_encode(['success' => false]);
            }
        }
    }

}
