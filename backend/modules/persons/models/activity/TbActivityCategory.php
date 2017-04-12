<?php

namespace backend\modules\persons\models\activity;

use Yii;

/**
 * This is the model class for table "tb_activity_category".
 *
 * @property integer $activity_cate_id
 * @property string $activity_cate_title
 *
 * @property TbActivity[] $tbActivities
 */
class TbActivityCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_activity_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_cate_title'], 'required'],
            [['activity_cate_title'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_cate_id' => Yii::t('person', 'Activity Cate ID'),
            'activity_cate_title' => Yii::t('person', 'Activity Cate Tite'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbActivities()
    {
        return $this->hasMany(TbActivity::className(), ['activity_cate_id' => 'activity_cate_id']);
    }
}
