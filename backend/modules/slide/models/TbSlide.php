<?php

namespace backend\modules\slide\models;

use Yii;

/**
 * This is the model class for table "tb_slide".
 *
 * @property integer $slide_id
 * @property integer $slide_cate_id
 * @property string $slide_title
 * @property string $img_id
 * @property string $slide_link
 * @property string $slide_date_create
 * @property string $slide_published
 * @property string $slide_sort
 * @property string $slide_start
 * @property string $slide_end
 * @property integer $user_id
 *
 * @property TbImages $img
 * @property TbSlideCategory $slideCate
 */
class TbSlide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_slide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_cate_id'], 'required'],
            [['slide_cate_id', 'user_id'], 'integer'],
            [['slide_date_create', 'slide_start', 'slide_end'], 'safe'],
            [['slide_published','slide_detail'], 'string'],
            [['slide_title'], 'string', 'max' => 250],
            [['img_id'], 'string', 'max' => 50],
            [['slide_link'], 'string', 'max' => 255],
            [['slide_sort'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slide_id' => 'รหัสสไลด์',
            'slide_cate_id' => 'หมวดหมู่',
            'slide_title' => 'ชื่อสไลด์',
            'img_id' => 'รูปภาพ',
            'slide_link' => 'ลิงค์',
            'slide_date_create' => 'สร้างเมื่อ',
            'slide_published' => 'แสดง',
            'slide_sort' => 'เรียง',
            'slide_start' => 'วันที่เริ่ม',
            'slide_end' => 'วันที่สิ้นสุด',
            'user_id' => 'ชื่อผู้ใช้',
            'slide_detail' => 'เนื้อบนสไลด์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImg()
    {
        return $this->hasOne(TbImages::className(), ['img_id' => 'img_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlideCate()
    {
        return $this->hasOne(TbSlideCategory::className(), ['slide_cate_id' => 'slide_cate_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(\common\models\TbUser::className(), ['user_id' => 'user_id']);
    }
}
