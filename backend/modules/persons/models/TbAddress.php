<?php

namespace backend\modules\persons\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\address\TbTambol;
use backend\modules\persons\models\address\TbAmphur;
use backend\modules\persons\models\address\TbProvince;

/**
 * This is the model class for table "tb_address".
 *
 * @property integer $address_id
 * @property string $address_no
 * @property string $address_village
 * @property integer $address_mu
 * @property string $address_road
 * @property integer $tambol_id
 * @property integer $amphur_id
 * @property integer $province_id
 * @property integer $address_zip_code
 * @property string $address_on
 * @property integer $person_id
 *
 * @property TbPerson $person
 * @property TbAmphur $amphur
 * @property TbProvince $province
 * @property TbTambol $tambol
 */
class TbAddress extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_address';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['address_mu', 'tambol_id', 'amphur_id', 'province_id', 'address_zip_code', 'person_id'], 'integer'],
            [['address_on'], 'string'],
            [['address_on'], 'default', 'value' => '1'],
            [['address_no'], 'string', 'max' => 5],
            [['address_village', 'address_road'], 'string', 'max' => 100],
            [['person_id','address_on'], 'unique', 'targetAttribute' => ['person_id','address_on'],'message'=>'ที่อยู่ประเภทนี้มีอยู่แล้ว'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'address_id' => Yii::t('person', 'รหัสที่อยู่'),
            'address_no' => Yii::t('person', 'เลขที่'),
            'address_village' => Yii::t('person', 'หมู่บ้าน'),
            'address_mu' => Yii::t('person', 'หมู่ที่'),
            'address_road' => Yii::t('person', 'ถนน'),
            'tambol_id' => Yii::t('person', 'ตำบล'),
            'amphur_id' => Yii::t('person', 'อำเภอ'),
            'province_id' => Yii::t('person', 'จังหวัด'),
            'address_zip_code' => Yii::t('person', 'รหัสไปรษณีย์'),
            'address_on' => Yii::t('person', 'ตามที่อยู่'),
            'person_id' => Yii::t('person', 'บุคคล'),
        ];
    }

    public static function itemsAlias($key) {
        $items = [
            'address_on' => [
                1 => Yii::t('person', 'ที่อยู่ตามทะเบียนบ้าน'),
                2 => Yii::t('person', 'ที่อยู่ปัจจุบัน'),
            ]
        ];
        
        return ArrayHelper::getValue($items, $key,[]);
    }
    
     public function getAddressOn() {
        return ArrayHelper::getValue($this->getItemAddressOn(), $this->address_on);
    }

    public function getItemAddressOn() {
        return self::itemsAlias('address_on');
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson() {
        return $this->hasOne(TbPerson::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmphur() {
        return $this->hasOne(TbAmphur::className(), ['amphur_id' => 'amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince() {
        return $this->hasOne(TbProvince::className(), ['province_id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTambol() {
        return $this->hasOne(TbTambol::className(), ['tambol_id' => 'tambol_id']);
    }

    
    public static function itemAmphurList($id) {
        $datas = [];
        $datas = TbAmphur::find()->where(['province_id' => $id])->all();
        return $datas;
    }    
    
    public static function itemTambolList($id) {
        $datas = [];
        $datas = TbTambol::find()->where(['amphur_id' => $id])->all();
        return $datas;
    }    
      
}
