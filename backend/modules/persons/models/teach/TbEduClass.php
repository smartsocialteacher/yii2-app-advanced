<?php

namespace backend\modules\persons\models\teach;

use Yii;

/**
 * This is the model class for table "tb_edu_class".
 *
 * @property integer $edu_class_id
 * @property string $edu_class_title
 *
 * @property TbClassTeacher[] $tbClassTeachers
 * @property TbTeach[] $tbTeaches
 */
class TbEduClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_edu_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_class_title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'edu_class_id' => Yii::t('person', 'รหัสระบดับชั้น'),
            'edu_class_title' => Yii::t('person', 'ระดับชั่น'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbClassTeachers()
    {
        return $this->hasMany(TbClassTeacher::className(), ['edu_class_id' => 'edu_class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbTeaches()
    {
        return $this->hasMany(TbTeach::className(), ['edu_class_id' => 'edu_class_id']);
    }
}
