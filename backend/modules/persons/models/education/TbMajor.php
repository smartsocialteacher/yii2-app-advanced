<?php

namespace backend\modules\persons\models\education;

use Yii;

/**
 * This is the model class for table "tb_major".
 *
 * @property integer $major_id
 * @property string $major_title
 *
 * @property TbStudy[] $tbStudies
 */
class TbMajor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_major';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_title'], 'string', 'max' => 100],
            [['major_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'major_id' => Yii::t('person', 'รหัสสาขา'),
            'major_title' => Yii::t('person', 'สาขา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbStudies()
    {
        return $this->hasMany(TbStudy::className(), ['major_id' => 'major_id']);
    }
}
