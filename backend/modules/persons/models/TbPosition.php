<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_position".
 *
 * @property integer $position_id
 * @property string $position_title
 *
 * @property TbPerson[] $tbPeople
 */
class TbPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_title'], 'required'],
            [['position_title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => Yii::t('person', 'รหัสตำแหน่ง'),
            'position_title' => Yii::t('person', 'ชื่อตำแหน่ง'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['position_id' => 'position_id']);
    }
}
