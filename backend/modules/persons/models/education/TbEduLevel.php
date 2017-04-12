<?php

namespace backend\modules\persons\models\education;

use Yii;

/**
 * This is the model class for table "tb_edu_level".
 *
 * @property integer $edu_level_id
 * @property string $edu_level_title
 *
 * @property TbStudy[] $tbStudies
 */
class TbEduLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_edu_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_level_title'], 'string', 'max' => 100],
            [['edu_level_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'edu_level_id' => Yii::t('person', 'Edu Level ID'),
            'edu_level_title' => Yii::t('person', 'Edu Level Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbStudies()
    {
        return $this->hasMany(TbStudy::className(), ['edu_level_id' => 'edu_level_id']);
    }
}
