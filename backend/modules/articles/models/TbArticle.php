<?php

namespace  backend\modules\articles\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_article".
 *
 * @property integer $art_id
 * @property integer $art_cate_id
 * @property string $art_title
 * @property integer $art_access
 * @property integer $art_published
 * @property string $art_intro
 * @property string $art_contents
 * @property string $art_images
 * @property string $art_created
 * @property string $art_created_by
 * @property string $art_modified
 * @property string $art_modified_by
 * @property string $language
 * @property string $art_start
 * @property string $art_finish
 * @property string $activity_mode
 *
 * @property TbArticleCategory $artCate
 */
class TbArticle extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_article';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['art_cate_id', 'art_access', 'art_published'], 'integer'],
            [['art_intro', 'art_contents', 'art_images', 'activity_mode'], 'string'],
            //[['art_created'], 'required'],
            [['art_created', 'art_modified', 'art_start', 'art_finish'], 'safe'],
            [['art_title'], 'string', 'max' => 250],
            [['art_created_by', 'art_modified_by'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'art_id' => 'รหัสบทความ',
            'art_cate_id' => 'รหัสหมวดหมู่',
            'art_title' => 'ชื่อเรื่อง',
            'art_access' => 'การเข้าถึง',
            'art_published' => 'การแสดง',
            'art_intro' => 'Art Intro',
            'art_contents' => 'เนื้อหา',
            'art_images' => 'รูปประกอบ',
            'art_created' => 'สร้างเมื่อ',
            'art_created_by' => 'สร้างโดย',
            'art_modified' => 'แก้ไขเมื่อ',
            'art_modified_by' => 'แก้ไขโดย',
            'language' => 'ภาษา',
            'art_start' => 'แสดงเมื่อ',
            'art_finish' => 'สิ้นสุด',
            'activity_mode' => 'Activity Mode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtCate() {
        return $this->hasOne(TbArticleCategory::className(), ['art_cate_id' => 'art_cate_id']);
    }
     
    public function getUser() {
        return $this->hasOne(\common\models\TbUser::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtPublish() {
        return self::itemsAlias('publish');
    }

    /**
     * ดึงข้อมูลออกมาจาก getArtPublish และจาก itemsAlias
     */
    public function getPublish() {
        return ArrayHelper::getValue($this->getArtPublish(), $this->art_published);
    }

    /**
     * 
     * @param ให้ค่าสำหรับตัวแปร $key
     */
    public static function itemsAlias($key) {
        $items = [
            'publish' => [
                1 => 'แสดง',
                0 => 'ซ่อน'
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

}
