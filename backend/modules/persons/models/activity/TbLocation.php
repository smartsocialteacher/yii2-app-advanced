<?php

namespace backend\modules\persons\models\activity;

use Yii;

/**
 * This is the model class for table "tb_location".
 *
 * @property integer $location_id
 * @property string $location_title
 *
 * @property TbActivity[] $tbActivities
 */
class TbLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_title'], 'required'],
            [['location_title'], 'string', 'max' => 250],
            [['location_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => Yii::t('person', 'รหัสสถานที่'),
            'location_title' => Yii::t('person', 'ชื่อสถานที่'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbActivities()
    {
        return $this->hasMany(TbActivity::className(), ['location_id' => 'location_id']);
    }
}
