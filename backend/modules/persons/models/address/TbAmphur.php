<?php

namespace backend\modules\persons\models\address;

use Yii;

/**
 * This is the model class for table "tb_amphur".
 *
 * @property integer $amphur_id
 * @property string $amphur_name
 * @property integer $province_id
 *
 * @property TbAddress[] $tbAddresses
 * @property TbSchool[] $tbSchools
 */
class TbAmphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amphur_id', 'amphur_name', 'province_id'], 'required'],
            [['amphur_id', 'province_id'], 'integer'],
            [['amphur_name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'amphur_id' => Yii::t('person', 'Amphur ID'),
            'amphur_name' => Yii::t('person', 'Amphur Name'),
            'province_id' => Yii::t('person', 'Province ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAddresses()
    {
        return $this->hasMany(TbAddress::className(), ['amphur_id' => 'amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchools()
    {
        return $this->hasMany(TbSchool::className(), ['amphur_id' => 'amphur_id']);
    }
}
