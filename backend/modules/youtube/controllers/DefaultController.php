<?php

namespace backend\modules\youtube\controllers;

use Yii;
use backend\modules\youtube\models\TbYoutube;
use backend\modules\youtube\models\TbYoutubeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for TbYoutube model.
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
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
     * Lists all TbYoutube models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbYoutubeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbYoutube model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbYoutube model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbYoutube();

        if ($model->load(Yii::$app->request->post())){
           // $model->yt_thumbnailURL
            //echo $model->yt_watchURL;
            $data = Yii::$app->video->getData($model->yt_watchURL);
           
//           echo "<pre>";
//           print_r($data);
//           exit();
            $delimiter='&list=';
            @list($a,$list)=  @explode($delimiter, $model->yt_watchURL);
            
            $model->yt_vid = $data->id.($list?'?list='.$list:'');
            $model->yt_title = $data->snippet->title;
            $model->yt_description = $data->snippet->description;
            $model->yt_author = $data->snippet->channelTitle;
            $model->yt_thumbnailURL = $data->snippet->thumbnails->medium->url;
            
            if($model->save()) {       
            return $this->redirect(['update', 'id' => $model->yt_id]);
            }else{
                print_r($model->getErrors());
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbYoutube model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->yt_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbYoutube model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbYoutube model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbYoutube the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbYoutube::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
