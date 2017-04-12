<?php

namespace backend\modules\persons\models\education;

use Yii;

/**
 * This is the model class for table "tb_study".
 *
 * @property integer $study_id
 * @property integer $person_id
 * @property string $study_year_finish
 * @property integer $edu_level_id
 * @property string $study_toplevel
 * @property integer $edu_local_id
 * @property integer $major_id
 * @property integer $degree_id
 *
 * @property TbDegree $degree
 * @property TbEduLevel $eduLevel
 * @property TbEduLocal $eduLocal
 * @property TbMajor $major
 * @property TbPerson $person
 */
class TbStudy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_study';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['study_year_finish','edu_level_id', 'edu_local_id', 'major_id'], 'required'],
            //[['person_id', 'edu_level_id', 'edu_local_id', 'major_id', 'degree_id'], 'integer'],
            [['person_id'], 'integer'],
            ['study_year_finish', 'string', 'max' => 5],
            [['degree_id'], 'safe'],
            [['study_toplevel'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'study_id' => Yii::t('person', 'รหัสการศึกษา'),
            'person_id' => Yii::t('person', 'บุคลากร'),
            'study_year_finish' => Yii::t('person', 'ปีที่จบการศึกษา'),
            'edu_level_id' => Yii::t('person', 'ระดับการศึกษา'),
            'study_toplevel' => Yii::t('person', 'ระดับสูงสุด'),
            'edu_local_id' => Yii::t('person', 'สถานศึกษา'),
            'major_id' => Yii::t('person', 'สาขา'),
            'degree_id' => Yii::t('person', 'วุฒิการศึกษา'),
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios['register'] = [];//Scenario Values Only Accepted
        return $scenarios;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegree()
    {
        return $this->hasOne(TbDegree::className(), ['degree_id' => 'degree_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEduLevel()
    {
        return $this->hasOne(TbEduLevel::className(), ['edu_level_id' => 'edu_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEduLocal()
    {
        return $this->hasOne(TbEduLocal::className(), ['edu_local_id' => 'edu_local_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajor()
    {
        return $this->hasOne(TbMajor::className(), ['major_id' => 'major_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(TbPerson::className(), ['person_id' => 'person_id']);
    }
}
