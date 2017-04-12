<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_nationality".
 *
 * @property integer $nationality_id
 * @property string $nationality_title
 *
 * @property TbPerson[] $tbPeople
 */
class TbNationality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_nationality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nationality_title'], 'required'],
            [['nationality_title'], 'string', 'max' => 100],
            [['nationality_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nationality_id' => Yii::t('person', 'รหัสสัญชาติ'),
            'nationality_title' => Yii::t('person', 'สัญชาติ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['nationality_id' => 'nationality_id']);
    }
}
