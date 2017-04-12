<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_religion".
 *
 * @property integer $religion_id
 * @property string $religion_title
 *
 * @property TbPerson[] $tbPeople
 */
class TbReligion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religion_title'], 'string', 'max' => 200],
            [['religion_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'religion_id' => Yii::t('person', 'รหัสศาสนา'),
            'religion_title' => Yii::t('person', 'ศาสนา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['religion_id' => 'religion_id']);
    }
}
