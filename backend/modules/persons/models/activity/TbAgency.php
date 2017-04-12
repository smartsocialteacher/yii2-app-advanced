<?php

namespace backend\modules\persons\models\activity;

use Yii;

/**
 * This is the model class for table "tb_agency".
 *
 * @property integer $agency_id
 * @property string $agency_title
 *
 * @property TbActivity[] $tbActivities
 */
class TbAgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agency_title'], 'required'],
            [['agency_title'], 'string', 'max' => 255],
            [['agency_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agency_id' => Yii::t('person', 'รหัสหน่วยงาน'),
            'agency_title' => Yii::t('person', 'ชื่อหน่วยงาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbActivities()
    {
        return $this->hasMany(TbActivity::className(), ['agency_id' => 'agency_id']);
    }
}
