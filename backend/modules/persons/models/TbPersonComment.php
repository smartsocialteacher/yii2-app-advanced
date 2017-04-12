<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_person_comment".
 *
 * @property integer $person_id
 * @property string $person_comment_datetime
 * @property string $person_comment
 *
 * @property TbPerson $person
 */
class TbPersonComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_person_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'person_comment_datetime'], 'required'],
            [['person_id'], 'integer'],
            [['person_comment_datetime'], 'safe'],
            [['person_comment'], 'string'],
            [['person_comment_highlight'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => Yii::t('person', 'บุคคล'),
            'person_comment_datetime' => Yii::t('person', 'วันที่'),
            'person_comment_highlight' => Yii::t('person', 'ข้อความสั้นๆ'),
            'person_comment' => Yii::t('person', 'ความคิดเห็น'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(TbPerson::className(), ['person_id' => 'person_id']);
    }
}
