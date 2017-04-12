<?php

namespace backend\modules\album\models;

use Yii;
use backend\modules\album\models\TbAlbum;
use yii\helpers\BaseFileHelper;
/**
 * This is the model class for table "tb_album_category".
 *
 * @property integer $album_cate_id
 * @property string $album_cate_title
 * @property string $album_cate_folder
 * @property integer $album_cate_parent_id
 *
 * @property TbAlbumCategory $albumCateParent 
 * @property TbAlbumCategory[] $tbAlbumCategories 
 */
class TbAlbumCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_album_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_cate_title','album_cate_folder'], 'required'],
            [['album_cate_parent_id'], 'integer'],
            [['album_cate_title'], 'string', 'max' => 200],
            [['album_cate_folder'], 'string', 'max' => 50],
            ['album_cate_folder', 'chk_dir'],
            ['album_cate_title', function($attribute){
                    $cate=TbAlbumCategory::find()->where([$attribute =>$this->$attribute])
                            ->andFilterWhere(['!=', 'album_cate_id', $this->album_cate_id])
                            ->one();
                    if($cate){
                        $this->addError($attribute, $this->getAttributeLabel($attribute).' '.$this->$attribute.' ซ้ำ');
                    }
            }],
        ];
    }

    public function chk_dir($attribute){
        $parent=TbAlbumCategory::find()->where(['album_cate_id' =>$this->album_cate_parent_id])->one();
        $path=($parent!==null)?$parent->album_cate_folder."/".$this->album_cate_folder:$this->album_cate_folder;
         if(is_dir(TbAlbum::getUploadPath().$path)) {
            $this->addError($attribute, 'ชื่อโฟลเดอร์ '.$path.' ซ้ำ');
         }
         //$this->$attribute=$path;
         //return ;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'album_cate_id' => 'รหัสหมวด',
            'album_cate_title' => 'ชื่อหมวด',
            'album_cate_folder' => 'โฟลเดอร์หมวด',
            'album_cate_parent_id' => 'ภายใต้หมวด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAlbums()
    {
        return $this->hasMany(TbAlbum::className(), ['album_cate_id' => 'album_cate_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumCateParent()
    {
        return ($this->album_cate_parent_id!==NULL)?$this->hasOne(TbAlbumCategory::className(), ['album_cate_id' => 'album_cate_parent_id']):null;
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
   public function getTbAlbumCategories()
   {
       return $this->hasMany(TbAlbumCategory::className(), ['album_cate_parent_id' => 'album_cate_id']);
   }
   
   public function getParent()
   {
       return $this->hasOne(TbAlbumCategory::className(), ['album_cate_id' => 'album_cate_parent_id']);
   }
   
   
    public function cateParent($id)
    {
        return (!empty($id))?TbAlbumCategory::find()->where( ['album_cate_id' => $id])->one():NULL;
    }
        
}
