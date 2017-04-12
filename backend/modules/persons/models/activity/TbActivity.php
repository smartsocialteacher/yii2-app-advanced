<?php

namespace backend\modules\persons\models\activity;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_activity".
 *
 * @property integer $activity_id
 * @property string $activity_title
 * @property string $activity_detail
 * @property string $activity_start
 * @property string $activity_end
 * @property integer $location_id
 * @property integer $activity_cate_id
 * @property integer $activity_status
 *
 * @property TbActivityCategory $activityCate
 * @property TbLocation $location
 * @property TbActivityJoin[] $tbActivityJoins
 */
class TbActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_title','activity_cate_id'], 'required'],
            [['activity_detail'], 'string'],
            [['activity_start', 'activity_end'], 'safe'],
            [['activity_cate_id', 'activity_status'], 'integer'],
            [['activity_title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => Yii::t('person', 'รหัสกิจกรรม'),
            'activity_title' => Yii::t('person', 'ชื่อกิจกรรม'),
            'activity_detail' => Yii::t('person', 'รายละเอียด'),
            'activity_start' => Yii::t('person', 'วันเวลาที่เริ่ม'),
            'activity_end' => Yii::t('person', 'วันเวลาที่สิ้นสุด'),
            'location_id' => Yii::t('person', 'สถานที่'),
            'activity_cate_id' => Yii::t('person', 'ประเภทกิจกรรม'),
            'activity_status' => Yii::t('person', 'สถานะกิจกรรม'),
            'agency_id' => Yii::t('person', 'หน่วยงานที่จัด'),
        ];
    }
    
    public static function itemsAlias($key) {
        $items = [
            'activity_status' => [
                1 => Yii::t('app', 'เปิด'),
                0 => Yii::t('app', 'ปิด')
            ],            
        ];
        return ArrayHelper::getValue($items, $key, []);
    }
    
    public function getActivityStatus() {
        if($this->activity_status)
        return ArrayHelper::getValue($this->getItemStatus(), $this->activity_status);
    }
    
    public function getItemStatus() {
        return self::itemsAlias('activity_status');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityCate()
    {
        return $this->hasOne(TbActivityCategory::className(), ['activity_cate_id' => 'activity_cate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(TbLocation::className(), ['location_id' => 'location_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(TbAgency::className(), ['agency_id' => 'agency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbActivityJoins()
    {
        return $this->hasMany(TbActivityJoin::className(), ['activity_id' => 'activity_id']);
    }
}
