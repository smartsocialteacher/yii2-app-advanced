<?php

namespace backend\modules\persons\models\teach;

use Yii;

/**
 * This is the model class for table "tb_personnel".
 *
 * @property string $personnel_start
 * @property string $personnel_end
 * @property integer $person_id
 * @property integer $school_id
 * @property integer $position_id
 *
 * @property TbPerson $position
 * @property TbSchool $school
 */
class TbPersonnel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_personnel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['personnel_start', 'personnel_end', 'person_id', 'school_id', 'position_id'], 'required'],
            [[ 'school_id' , 'position_id'], 'required'],
            [['personnel_start', 'personnel_end'], 'safe'],
            //[['person_id', 'school_id', 'position_id'], 'integer']
            [['person_id', 'position_id'], 'integer'],
            [['position_id'], 'default', 'value' =>'6'],
             [[ 'school_id' , 'position_id','person_id'], 'unique', 'targetAttribute' => [ 'school_id' , 'position_id','person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'personnel_start' => Yii::t('person', 'วันที่เริ่ม'),
            'personnel_end' => Yii::t('person', 'วันที่สิ้นสุด'),
            'person_id' => Yii::t('person', 'บุคคล'),
            'school_id' => Yii::t('person', 'โรงเรียน'),
            'position_id' => Yii::t('person', 'ตำแหน่ง'),
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios['register'] = ['school_id','position_id'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        if($this->position_id){
        return $this->hasOne(\backend\modules\persons\models\TbPosition::className(), ['position_id' => 'position_id']);
        }else{
            return [];
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(TbSchool::className(), ['school_id' => 'school_id']);
    }
}
