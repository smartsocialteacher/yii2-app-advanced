<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_race".
 *
 * @property integer $race_id
 * @property string $race_title
 *
 * @property TbPerson[] $tbPeople
 */
class TbRace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_race';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_title'], 'required'],
            [['race_title'], 'string', 'max' => 255],
            [['race_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'race_id' => Yii::t('person', 'รหัสเชื้อชาติ'),
            'race_title' => Yii::t('person', 'เชื้อชาติ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['race_id' => 'race_id']);
    }
}
