<?php

namespace backend\modules\album\controllers;

use Yii;
use backend\modules\album\models\TbAlbum;
use backend\modules\album\models\TbAlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\web\Response;

use backend\modules\album\models\TbAlbumCategory;

/**
 * DefaultController implements the CRUD actions for TbAlbum model.
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
     * Lists all TbAlbum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbAlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbAlbum model.
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
     * Creates a new TbAlbum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbAlbum();

        if ($model->load(Yii::$app->request->post())){
            
            $this->CreateDir($model->album_path);
            if($model->save()) {
                return $this->redirect(['upload', 'id' => $model->album_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUpload($id)
    {
        $model = $this->findModel($id);
        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->album_path);
  
     if ($model->load(Yii::$app->request->post())) {
         //echo $model->error;
         $this->Uploads(false);
         if($model->save()){
              return $this->redirect(['view', 'id' => $model->album_id]);
         }
     }

     return $this->render('upload', [
         'model' => $model,
          'initialPreview'=>$initialPreview,
          'initialPreviewConfig'=>$initialPreviewConfig
     ]);
    }
    

    /**
     * Updates an existing TbAlbum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            //$model->album_path = $model->albumCate->album_cate_folder.'/'.$model->album_date_create;
            if($model->save()){
                return $this->redirect(['upload', 'id' => $model->album_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbAlbum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionCatetitle($cate_id)
    {
        $medel = TbAlbumCategory::find()->where(['album_cate_id'=>$cate_id])->one();
         Yii::$app->response->format = Response::FORMAT_JSON;
        return $medel;
    }

    /**
     * Finds the TbAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbAlbum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*|*********************************************************************************|
  |================================ Upload Ajax ====================================|
  |*********************************************************************************|*/

    public function actionUploadajax(){
           $this->Uploads(true);
     }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = TbAlbum::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }
    private function findFiles($folderName){
        if($folderName != NULL){  
             $basePath = Yii::$app->img->getUploadPath(TbAlbum::UPLOAD_FOLDER."/".$folderName);
            //$basePath=$basePath.$folderName;
            
            if(!is_dir($basePath)){
                $this->CreateDir($folderName);
            }
            
            $data = BaseFileHelper::findFiles($basePath);
            $img=[];
             foreach ($data as $key => $file) {
                 if(!strpos($file,'thumbnail')){
                //$file= substr($file, strrpos($file, '\\') + 1);
                list($server,$file)=  explode($basePath, $file);
                $img[$file] = $file;
                 }
             }
             return $img;           
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Yii::$app->img->getUploadPath($dir));
    }

    private function Uploads($isAjax=false) {
             if (Yii::$app->request->isPost) {
                $images = UploadedFile::getInstancesByName('upload_ajax');
                if ($images) {
                    
                    if($isAjax===true){
                        $album_path =Yii::$app->request->post('album_path');
                    }else{
                        $TbAlbum = Yii::$app->request->post('TbAlbum');
                        $album_path = $TbAlbum['album_path'];
                    }
                    //print_r(Yii::$app->request->post()); 
                    //echo "+".$album_path."+";
                    //exit();
                    //print_r($album_path);
                    $this->CreateDir($album_path);
                    //print_r($images);
                    
                    if ($images) {
                    foreach ($images as $file) {
                        $fileName = $file->baseName . '.' . $file->extension;
                        $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                        $savePath = Yii::$app->img->getUploadPath('albums/'.$album_path);
                        //echo $savePath . $realFileName;
                        //exit();
                        if ($file->saveAs($savePath . $realFileName)) {
                              $file = Yii::$app->image->load($savePath . $realFileName);
                              $file->resize(800);
                              $file->save($savePath . $realFileName);
                            if ($this->isImage($savePath . $realFileName)) {                                
                                $this->createThumbnail($album_path, $realFileName);
                            }

                            if ($isAjax === true) {
                                echo json_encode(['success' => 'true', 'data1' => Yii::$app->img->getUploadUrl($album_path).$realFileName]);
                            }
                        } else {
                            if ($isAjax === true) {
                                echo json_encode(['success' => 'false', 'eror' => $file->error]);
                            }
                        }
                    }
                }
            }
            }
    }

    private function getInitialPreview($album_path) {
           // $datas = TbAlbum::find()->where(['album_path'=>$album_path])->all();
            $datas = $this->findFiles($album_path);
            //print_r($datas);
            $initialPreview = [];
            $initialPreviewConfig = [];
            if ($datas) {
            foreach ($datas as $key => $file) {
                //$nameFicheiro = substr($file, strrpos($file, '\\') + 1);
                $relFile = Yii::$app->img->getUploadUrl(TbAlbum::UPLOAD_FOLDER.'/'.$album_path) . $file;
                //echo $relFile."<br />";
                array_push($initialPreview, $this->getTemplatePreview($relFile));
                array_push($initialPreviewConfig, [
                    'caption' => 'value->file_name',
                    'width' => '120px',
                    'url' => Url::to(['/album/default/deletefileajax']),
                    'key' => $album_path . ':' . $file
                ]);
            }
        }
        return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview($img){
            //$filePath = TbAlbum::getUploadUrl().$model->album_path.'/thumbnail/'.$model->real_filename;
             $filePath =$img;
             //echo $img;
            $isImage  = $this->isImage($filePath);
            if($isImage){
                $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>'model->file_name', 'title'=>'model->file_name']);
            }else{
                $file =  "<div class='file-preview-other'> " .
                         "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                         "</div>";
            }
            return $file;
    }

    private function createThumbnail($folderName,$fileName,$width=250){
      $uploadPath   = TbAlbum::getUploadPath().$folderName;
      $file         = $uploadPath.'/'.$fileName;
      //echo $file;
      $image        = Yii::$app->image->load($file);
      $image->resize($width);
      $image->save($uploadPath.'/thumbnail/'.$fileName);
      return;
    }

    public function actionDeletefileajax(){
        $file = Yii::$app->request->post('key');
        list($album_path,$file) = explode(':', $file);
        
       if($file!==NULL){
            if(@unlink(TbAlbum::getUploadPath().$album_path.'/'.$file)){
            $thumbnail = TbAlbum::getUploadPath().$album_path.'/thumbnail/'.$file;
                if(@unlink($thumbnail))
                echo json_encode(['success'=>true,'data'=>$album_path]);
            }
       }else{
          echo json_encode(['success'=>false]);  
        }
    }
    
}
