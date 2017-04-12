<?php

namespace backend\modules\album\models;

use Yii;
use yii\helpers\Url;

use yii\helpers\BaseFileHelper;
/**
 * This is the model class for table "tb_album".
 *
 * @property integer $album_id
 * @property integer $album_cate_id
 * @property string $album_title
 * @property string $album_detail
 * @property string $album_path
 * @property string $album_image_intro
 * @property string $album_date_create
 * @property string $album_published
 *
 * @property TbAlbumType $albumCate
 */
class TbAlbum extends \yii\db\ActiveRecord
{
    
    const PATH_IMG='albums';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_title','album_cate_id','album_path','album_date_create'], 'required'],
            [['album_cate_id'], 'integer'],
            [['album_detail', 'album_published'], 'string'],
            [['album_date_create'], 'safe'],
            [['album_title', 'album_image_intro'], 'string', 'max' => 250],
            [['album_path'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'album_id' => 'รหัสอัลบั้ม',
            'album_cate_id' => 'หมวด',
            'album_title' => 'ชื่ออัลบั้ม',
            'album_detail' => 'รายละเอียด',
            'album_path' => 'ตำแหน่ง',
            'album_image_intro' => 'รูปปก',
            'album_date_create' => 'สร้างเมื่อ',
            'album_published' => 'แสดง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumCate()
    {
        return $this->hasOne(TbAlbumCategory::className(), ['album_cate_id' => 'album_cate_id']);
    }
    
    const UPLOAD_FOLDER = 'albums';

    public static function getUploadPath(){
        return Yii::getAlias('@images').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/../images/'.self::UPLOAD_FOLDER.'/';
    }
    
    public function getThumbnails($folderName,$event_name){
     $uploadFiles   = self::findFiles($folderName);
     $preview = [];
     $folderName = Yii::$app->img->getUploadUrl(self::UPLOAD_FOLDER."/".$folderName);
    foreach ($uploadFiles as $file) {
        //$nameFicheiro = substr($file, strrpos($file, '\\') + 1);
        //echo $file."<br />";
        if(!strpos($file,'thumbnail')){
        $preview[] = [
            'url'=>$folderName.$file,
            'src'=>$folderName.'thumbnail/'.$file,
            'options' => ['title' => $event_name,'class'=>'img-thumbnail','style'=>'margin:0 0 8px 0;overflow:hidden;max-height:176px']
        ];
        }
    }
    return $preview;
    }
    
     private function findFiles($folderName){
        if($folderName != NULL){
            $basePath = Yii::$app->img->getUploadPath(self::UPLOAD_FOLDER."/".$folderName);
            //exit();
            //$basePath=$basePath.$folderName;
            $data = BaseFileHelper::findFiles($basePath);
            $img=[];
             foreach ($data as $key => $file) {
                $file= substr($file, strrpos($file, '/') + 1);
                $img[$file] = $file;
             }
             return $img;
        }
        return;
    }
}
