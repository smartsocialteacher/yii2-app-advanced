<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;
use Yii;
use yii\base\Component;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use backend\modules\slide\models\TbImages;
/**
 * Description of Img
 *
 * @author Madone
 */
class Img extends Component{
    //const UPLOAD_FOLDER = 'albums';
    public $no_img = 'no_img.jpg';

    public function getUploadPath($sub_path=null){
        return Yii::getAlias('@images').'/'.($sub_path?$sub_path.'/':'');
    }

    public function getUploadUrl($sub_path=null){
        $url = Url::base(true);
        $url = str_replace('admin', '', $url);
        return $url.'/images/'.($sub_path?$sub_path.'/':'');
    }
    
    public function getNoImg(){
        return $this->getUploadUrl().$this->no_img;
    }
    
    public function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = $this->getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }else{
            return false;
        }
    }
    
    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }
    
    public function chkImg($filePath=null,$file=null){
            return @is_array(getimagesize($this->getUploadPath($filePath).'/'.$file)) ? true : false;
    }
    
    
    public function deleteImg($position,$model){        
        @unlink($this->getUploadPath($position).'/thumbnail/'.$model->img_id);
        @unlink($this->getUploadPath($position).'/'.$model->img_id);
        return $model->delete();
    }
    
   
    public function clearTempImg($img_id=null,$old_img_id=null){
        
        if($img_id){
            $model =  TbImages::findOne($img_id);
            $model->img_temp = '0';
            $model->save();
            if($img_id!=$old_img_id&&!empty($old_img_id)){
                $model =  TbImages::findOne($old_img_id);
                $model->img_temp = '1';
                $model->save();
            }
        }
        
        if($oldImg=TbImages::find()->where(['user_id'=>Yii::$app->user->id,'img_temp'=>'1'])->all()){
           
            foreach($oldImg as $oImg){ 
                $this->deleteImg($oImg->img_path_file,$oImg);                
            }                   
        }
    }    
    
}
