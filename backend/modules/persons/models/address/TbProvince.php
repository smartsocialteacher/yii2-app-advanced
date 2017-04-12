<?php

namespace backend\modules\persons\models\address;

use Yii;

/**
 * This is the model class for table "tb_province".
 *
 * @property integer $province_id
 * @property string $province_name
 * @property integer $region_id
 *
 * @property TbAddress[] $tbAddresses
 * @property TbSchool[] $tbSchools
 */
class TbProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'province_name', 'region_id'], 'required'],
            [['province_id', 'region_id'], 'integer'],
            [['province_name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'province_id' => Yii::t('person', 'Province ID'),
            'province_name' => Yii::t('person', 'Province Name'),
            'region_id' => Yii::t('person', 'Region ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAddresses()
    {
        return $this->hasMany(TbAddress::className(), ['province_id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchools()
    {
        return $this->hasMany(TbSchool::className(), ['province_id' => 'province_id']);
    }
}
