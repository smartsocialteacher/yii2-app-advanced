<?php

namespace backend\modules\persons\models\teach;

use Yii;

/**
 * This is the model class for table "tb_school_level_jion".
 *
 * @property integer $school_id
 * @property integer $school_level_id
 *
 * @property TbSchool $school
 * @property TbSchoolLevel $schoolLevel
 */
class TbSchoolLevelJion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_school_level_jion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'school_level_id'], 'required'],
            [['school_id', 'school_level_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'school_id' => Yii::t('person', 'โรงเรียน'),
            'school_level_id' => Yii::t('person', 'ระดับชั้น'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(TbSchool::className(), ['school_id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolLevel()
    {
        return $this->hasOne(TbSchoolLevel::className(), ['school_level_id' => 'school_level_id']);
    }
}
