<?php

namespace backend\modules\persons\models\activity;

use Yii;
use backend\modules\persons\models\TbPerson;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_activity_join".
 *
 * @property integer $activity_id
 * @property integer $person_id
 * @property string $person_mode
 *
 * @property TbPerson $person
 * @property TbActivity $activity
 */
class TbActivityJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_activity_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['activity_id', 'person_id', 'person_mode'], 'required'],
            [['activity_id', 'person_id'], 'integer'],
            [['person_mode'], 'string'],
            [['activity_id', 'person_id', 'person_mode'], 'unique', 'targetAttribute' => ['activity_id', 'person_id', 'person_mode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => Yii::t('person', 'หัวข้อเรื่องอบรม / สัมมนา'),
            'person_id' => Yii::t('person', 'บุคคล'),
            'person_mode' => Yii::t('person', 'เข้าร่วมในฐานะ'),
            'personMode' => Yii::t('person', 'เข้าร่วมในฐานะ'),
        ];
    }
 public function scenarios()
    {
        $scenarios = parent::scenarios();       
        $scenarios['update'] = [];
        return $scenarios;
    }
     public static function itemsAlias($key) {
        $items = [
            'person_mode' => [
                1 => Yii::t('app', 'วิทยากร'),
                2 => Yii::t('app', 'ผู้ร่วมกิจกรรม')
            ],            
        ];
        return ArrayHelper::getValue($items, $key, []);
    }
    public function getPersonMode() {
        if ($this->person_mode) {
            return ArrayHelper::getValue($this->getItemPersonMode(), $this->person_mode);
        }
    }
    public function getItemPersonMode() {
        return self::itemsAlias('person_mode');
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
    public function getActivity()
    {
        return $this->hasOne(TbActivity::className(), ['activity_id' => 'activity_id']);
    }
}
