<?php

namespace backend\modules\persons\models\teach;

use Yii;
use backend\modules\persons\models\TbPerson;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_teach".
 *
 * @property integer $teach_id
 * @property string $teach_year
 * @property string $teach_term
 * @property integer $subject_id
 * @property integer $teach_hoursPweek
 * @property integer $person_id
 * @property integer $edu_class_id
 *
 * @property TbEduClass $eduClass
 * @property TbPerson $person
 * @property TbSubject $subject
 */
class TbTeach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_teach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teach_year'], 'safe'],
            [['teach_term'], 'string'],
            [['subject_id', 'edu_class_id'], 'required'],
            //[['subject_id', 'teach_hoursPweek', 'person_id', 'edu_class_id'], 'integer']
            [[ 'teach_hoursPweek', 'person_id'], 'integer']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios['register'] = [];//Scenario Values Only Accepted
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teach_id' => Yii::t('person', 'รหัสการสอน'),
            'teach_year' => Yii::t('person', 'ปีการศึกษา'),
            'teach_term' => Yii::t('person', 'ภาคเรียน'),
            'subject_id' => Yii::t('person', 'รายวิชาที่สอน'),
            'teach_hoursPweek' => Yii::t('person', 'ชั่วโมง/สัปดาห์'),
            'person_id' => Yii::t('person', 'Person ID'),
            'edu_class_id' => Yii::t('person', 'ระดับชั้น'),
        ];
    }
public static function itemsAlias($key) {
        $items = [
            'teach_term' => [
                1 => Yii::t('person', '1'),
                2 => Yii::t('person', '2'),
                3 => Yii::t('person', 'ตลอดปี'),
            ],            
        ];
        return ArrayHelper::getValue($items, $key, []);
    }
    
    public function getActivityTeachTerm() {
        if($this->activity_status)
        return ArrayHelper::getValue($this->getItemTeachTerm(), $this->teach_term);
    }
    public function getItemTeachTerm() {
        return self::itemsAlias('teach_term');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEduClass()
    {
        return $this->hasOne(TbEduClass::className(), ['edu_class_id' => 'edu_class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(TbPerson::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(TbSubject::className(), ['subject_id' => 'subject_id']);
    }
}
