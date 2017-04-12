<?php

namespace backend\modules\persons\models\education;

use Yii;

/**
 * This is the model class for table "tb_edu_local".
 *
 * @property integer $edu_local_id
 * @property string $edu_local_title
 *
 * @property TbStudy[] $tbStudies
 */
class TbEduLocal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_edu_local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_local_title'], 'string', 'max' => 200],
            [['edu_local_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'edu_local_id' => Yii::t('person', 'รหัสสถานศึกษา'),
            'edu_local_title' => Yii::t('person', 'สถานศึกษา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbStudies()
    {
        return $this->hasMany(TbStudy::className(), ['edu_local_id' => 'edu_local_id']);
    }
}
