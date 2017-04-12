<?php

namespace backend\modules\persons\models\teach;

use Yii;

/**
 * This is the model class for table "tb_school_level".
 *
 * @property integer $school_level_id
 * @property string $school_level_title
 *
 * @property TbSchoolLevelJion[] $tbSchoolLevelJions
 * @property TbSchool[] $schools
 */
class TbSchoolLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_school_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_level_title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'school_level_id' => Yii::t('person', 'รหัสระดับชั้น'),
            'school_level_title' => Yii::t('person', 'ระดับชั้น'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchoolLevelJions()
    {
        return $this->hasMany(TbSchoolLevelJion::className(), ['school_level_id' => 'school_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(TbSchool::className(), ['school_id' => 'school_id'])->viaTable('tb_school_level_jion', ['school_level_id' => 'school_level_id']);
    }
}
