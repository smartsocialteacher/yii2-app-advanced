<?php

namespace backend\modules\persons\models;

use Yii;

/**
 * This is the model class for table "tb_antecedent".
 *
 * @property integer $antecedent_id
 * @property string $antecedent_title
 * @property string $antecedent_title_sort
 * @property string $antecedent_title_en
 * @property string $antecedent_title_en_sort
 *
 * @property TbPerson[] $tbPeople
 * @property TbUserProfile[] $tbUserProfiles
 * @property TbUserProfilePsu[] $tbUserProfilePsus
 */
class TbAntecedent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_antecedent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['antecedent_title'], 'required'],
            [['antecedent_title', 'antecedent_title_en'], 'string', 'max' => 20],
            [['antecedent_title_sort', 'antecedent_title_en_sort'], 'string', 'max' => 10],
            [['antecedent_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'antecedent_id' => Yii::t('person', 'รหัสคำนำหน้า'),
            'antecedent_title' => Yii::t('person', 'คำนำหน้า'),
            'antecedent_title_sort' => Yii::t('person', 'คำนำหน้า(ย่อ)'),
            'antecedent_title_en' => Yii::t('person', 'คำนำหน้า(อังกฤษ)'),
            'antecedent_title_en_sort' => Yii::t('person', 'คำนำหน้า(อังกฤษย่อ)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPeople()
    {
        return $this->hasMany(TbPerson::className(), ['antecedent_id' => 'antecedent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUserProfiles()
    {
        return $this->hasMany(TbUserProfile::className(), ['antecedent_id' => 'antecedent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUserProfilePsus()
    {
        return $this->hasMany(TbUserProfilePsu::className(), ['antecedent_id' => 'antecedent_id']);
    }
}
