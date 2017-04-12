<?php

namespace backend\modules\persons\models\teacher;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\teach\TbEduClass;
/**
 * This is the model class for table "tb_class_teacher".
 *
 * @property integer $class_id
 * @property string $class_year
 * @property string $class_term
 * @property string $class_room
 * @property string $class_note
 * @property integer $person_id
 * @property integer $edu_class_id
 *
 * @property TbEduClass $eduClass
 * @property TbPerson $person
 */
class TbClassTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_class_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_year'], 'safe'],
            [['class_term'], 'string'],
            [['person_id', 'edu_class_id'], 'integer'],
            [['class_room'], 'string', 'max' => 10],
            [['class_note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'class_id' => Yii::t('person', 'รหัสครูประจำชั้น'),
            'class_year' => Yii::t('person', 'ปีการศึกษา'),
            'class_term' => Yii::t('person', 'ภาคเรียน'),
            'class_room' => Yii::t('person', 'ห้อง'),
            'class_note' => Yii::t('person', 'หมายเหตุ'),
            'person_id' => Yii::t('person', 'Person ID'),
            'edu_class_id' => Yii::t('person', 'ระดับชั้น'),
        ];
    }
    public static function itemsAlias($key) {
        $items = [
            'class_term' => [
                1 => Yii::t('person', '1'),
                2 => Yii::t('person', '2'),
                3 => Yii::t('person', 'ตลอดปี'),
            ],            
        ];
        return ArrayHelper::getValue($items, $key, []);
    }
    
    public function getActivityClassTerm() {
        if($this->activity_status)
        return ArrayHelper::getValue($this->getItemClassTerm(), $this->class_term);
    }
    
    public function getItemClassTerm() {
        return self::itemsAlias('class_term');
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
}
