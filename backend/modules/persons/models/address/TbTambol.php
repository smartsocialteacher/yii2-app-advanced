<?php

namespace backend\modules\persons\models\address;

use Yii;

/**
 * This is the model class for table "tb_tambol".
 *
 * @property integer $tambol_id
 * @property string $tambol_name
 * @property integer $tambol_peaple
 * @property integer $tambol_post
 * @property integer $amphur_id
 *
 * @property TbAddress[] $tbAddresses
 * @property TbSchool[] $tbSchools
 */
class TbTambol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_tambol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tambol_id', 'tambol_name', 'tambol_peaple', 'tambol_post', 'amphur_id'], 'required'],
            [['tambol_id', 'tambol_peaple', 'tambol_post', 'amphur_id'], 'integer'],
            [['tambol_name'], 'string'],
            [['tambol_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tambol_id' => Yii::t('person', 'Tambol ID'),
            'tambol_name' => Yii::t('person', 'Tambol Name'),
            'tambol_peaple' => Yii::t('person', 'Tambol Peaple'),
            'tambol_post' => Yii::t('person', 'Tambol Post'),
            'amphur_id' => Yii::t('person', 'Amphur ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAddresses()
    {
        return $this->hasMany(TbAddress::className(), ['tambol_id' => 'tambol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchools()
    {
        return $this->hasMany(TbSchool::className(), ['tambol_id' => 'tambol_id']);
    }
}
