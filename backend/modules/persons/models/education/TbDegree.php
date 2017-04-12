<?php

namespace backend\modules\persons\models\education;

use Yii;

/**
 * This is the model class for table "tb_degree".
 *
 * @property integer $degree_id
 * @property string $degree_title
 *
 * @property TbStudy[] $tbStudies
 */
class TbDegree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_degree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['degree_title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'degree_id' => Yii::t('person', 'รหัสวุฒิการศึกษา'),
            'degree_title' => Yii::t('person', 'วุฒิการศึกษา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbStudies()
    {
        return $this->hasMany(TbStudy::className(), ['degree_id' => 'degree_id']);
    }
}
