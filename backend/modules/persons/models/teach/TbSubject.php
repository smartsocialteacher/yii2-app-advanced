<?php

namespace backend\modules\persons\models\teach;

use Yii;

/**
 * This is the model class for table "tb_subject".
 *
 * @property integer $subject_id
 * @property string $subject_title
 *
 * @property TbTeach[] $tbTeaches
 */
class TbSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_title'], 'string', 'max' => 200],
            [['subject_title'], 'unique'],
            [['subject_title'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => Yii::t('person', 'รหัสวิชา'),
            'subject_title' => Yii::t('person', 'วิชา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbTeaches()
    {
        return $this->hasMany(TbTeach::className(), ['subject_id' => 'subject_id']);
    }
}
