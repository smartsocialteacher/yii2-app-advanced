<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_person_type".
 *
 * @property integer $person_type_id
 * @property string $person_type_title
 *
 * @property TbPerson[] $tbPeople
 */
class TbPersonType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_person_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_type_title'], 'required'],
            [['person_type_title'], 'string', 'max' => 200],
            [['person_type_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_type_id' => Yii::t('person', 'Person Type ID'),
            'person_type_title' => Yii::t('person', 'ชื่อประเภท'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['person_type_id' => 'person_type_id']);
    }
}
