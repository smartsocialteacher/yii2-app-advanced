<?php

namespace backend\modules\slide\models;

use Yii;

/**
 * This is the model class for table "tb_slide_category".
 *
 * @property integer $slide_cate_id
 * @property string $slide_cate_title
 * @property integer $user_id
 *
 * @property TbSlide[] $tbSlides
 */
class TbSlideCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_slide_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_cate_title'], 'required'],
            [['user_id'], 'integer'],
            [['slide_cate_title'], 'string', 'max' => 45],
            [['slide_cate_width','slide_cate_height'], 'integer', 'max' => 9999]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slide_cate_id' => 'รหัสหมวด',
            'slide_cate_title' => 'ชื่อหมวดหมู่',
            'user_id' => 'บันทึกโดย',
            'slide_cate_width' => 'ความกว้าง (pixel)',
            'slide_cate_height' => 'ความสูง (pixel)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSlides()
    {
        return $this->hasMany(TbSlide::className(), ['slide_cate_id' => 'slide_cate_id']);
    }
    
    
    public function getUser()
    {
        return $this->hasOne(\common\models\TbUser::className(), ['user_id' => 'user_id']);
    }
}
