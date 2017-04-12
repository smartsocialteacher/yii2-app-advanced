<?php

namespace backend\modules\slide\models;

use Yii;

/**
 * This is the model class for table "tb_images".
 *
 * @property string $img_id
 * @property string $img_name_file
 * @property string $img_type_file
 * @property string $img_description
 * @property string $img_path_file
 * @property string $img_upload_date
 * @property integer $user_id
 * @property string $img_temp
 *
 * @property TbSlide[] $tbSlides
 */
class TbImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_id', 'img_name_file', 'img_path_file', 'img_upload_date', 'user_id'], 'required'],
            [['img_description', 'img_temp'], 'string'],
            [['img_upload_date'], 'safe'],
            [['user_id'], 'integer'],
            [['img_id'], 'string', 'max' => 50],
            [['img_name_file', 'img_path_file'], 'string', 'max' => 255],
            [['img_type_file'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'img_id' => 'รหัสรูป',
            'img_name_file' => 'ชื่อรูป',
            'img_type_file' => 'ชนิดไฟล์',
            'img_description' => 'รายละเอียด',
            'img_path_file' => 'ตำแหน่ง',
            'img_upload_date' => 'วันที่นำขึ้น',
            'user_id' => 'รหัสผู้ใช้',
            'img_temp' => 'ไฟล์ทดลอง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSlides()
    {
        return $this->hasMany(TbSlide::className(), ['img_id' => 'img_id']);
    }
}
