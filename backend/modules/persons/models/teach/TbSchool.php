<?php

namespace backend\modules\persons\models\teach;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\persons\models\address\TbTambol;
use backend\modules\persons\models\address\TbAmphur;
use backend\modules\persons\models\address\TbProvince;
use backend\modules\persons\models\education\TbDegree;

/**
 * This is the model class for table "tb_school".
 *
 * @property integer $school_id
 * @property string $school_title
 * @property string $school_no
 * @property string $school_village
 * @property integer $school_mu
 * @property string $school_road
 * @property integer $tambol_id
 * @property integer $amphur_id
 * @property integer $province_id
 * @property string $phone
 * @property string $fax
 * @property integer $degree_id
 * @property integer $school_number_staff
 * @property string $school_size
 * @property string $school_category
 *
 * @property TbPersonnel[] $tbPersonnels
 * @property TbAmphur $amphur
 * @property TbProvince $province
 * @property TbTambol $tambol
 * @property TbSchoolLevelJion[] $tbSchoolLevelJions
 * @property TbSchoolLevel[] $schoolLevels
 */
class TbSchool extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_school';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['school_title'], 'required'],
            [['school_mu', 'tambol_id', 'amphur_id', 'province_id', 'degree_id', 'school_number_staff','school_zip_code','school_type'], 'integer'],
            [['school_size', 'school_category'], 'string'],
            [['school_title'], 'string', 'max' => 250],
            [['school_no'], 'string', 'max' => 5],
            [['school_village', 'school_road'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 44],
            [['fax'], 'string', 'max' => 10],
            [['school_title'], 'unique'],
            [['img_id'], 'string', 'max' => 50],            
            [['school_type'], 'default', 'value' =>'2'],
            [['school_detail'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'school_id' => Yii::t('person', 'รหัสโรงเรียน'),
            'school_title' => Yii::t('person', 'ชื่อโรงเรียน'),
            'school_no' => Yii::t('person', 'บ้านเลขที่'),
            'school_village' => Yii::t('person', 'หมู่บ้าน'),
            'school_mu' => Yii::t('person', 'หมู่ที่'),
            'school_road' => Yii::t('person', 'ถนน'),
            'tambol_id' => Yii::t('person', 'ตำบล'),
            'amphur_id' => Yii::t('person', 'อำเภอ'),
            'province_id' => Yii::t('person', 'จังหวัด'),
            'school_zip_code' => Yii::t('person', 'รหัสไปรษณีย์'),
            'phone' => Yii::t('person', 'โทรศัพท์'),
            'fax' => Yii::t('person', 'แฟกซ์'),
            'degree_id' => Yii::t('person', 'ระดับ'),
            'school_number_staff' => Yii::t('person', 'จำนวนครู'),
            'school_size' => Yii::t('person', 'ขนาดโรงเรียน'),
            'school_category' => Yii::t('person', 'ประเภทโรงเรียน'),
            'school_level_id' => Yii::t('person', 'ระดับชั้นที่เปิดสอน'),
            'img_id' => Yii::t('person', 'ภาพโรงเรียน'),            
            'school_type' => Yii::t('person', 'ประเภท'),
            'address' => Yii::t('person', 'ที่อยู่'),
            'school' => Yii::t('person', 'โรงเรียน'),
            'school_detail' => Yii::t('person', 'รายละเอียด'),
            
            'school_mu_s' => Yii::t('person', 'ม.'),
            'school_road_s' => Yii::t('person', 'ถ.'),
            'tambol_id_s' => Yii::t('person', 'ต.'),
            'amphur_id_s' => Yii::t('person', 'อ.'),
            'province_id_s' => Yii::t('person', 'จ.'),
        ];
    }

    public $img_id_old;

    const PATH_IMG = 'school';

    public $school_level_id;

    #############################

    public static function itemsAlias($key) {
        $items = [
            'school_size' => [
                1 => Yii::t('person', 'ขนาดเล็ก(จำนวนนักเรียนน้อยกว่า 499 คน'),
                2 => Yii::t('person', 'ขนาดกลาง(จำนวนนักเรียน 500 - 1,499 คน'),
                3 => Yii::t('person', 'ขนาดใหญ่(จำนวนนักเรียน 1,500 - 2,499 คน'),
                4 => Yii::t('person', 'ขนาดใหญ่พิเศษ(จำนวนนักเรียนตั้งแต่ 2,500 คนขึ้นไป'),
            ],
            'school_category' => [
                1 => Yii::t('person', 'โรงเรียนรัฐบาล'),
                2 => Yii::t('person', 'โรงเรียนกึ่งรัฐบาล'),
                3 => Yii::t('person', 'โรงเรียนเอกชนสอนศาสนา'),
            ],
            'school_type' => [
                1 => Yii::t('person', 'โรงเรียน'),
                2 => Yii::t('person', 'หน่วยงาน'),               
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getSchoolSize() {
        return ArrayHelper::getValue($this->getItemSchoolSize(), $this->school_size);
    }

    public function getSchoolCategory() {
        return ArrayHelper::getValue($this->getItemSchoolCategory(), $this->school_category);
    }

    public function getItemSchoolSize() {
        return self::itemsAlias('school_size');
    }

    public function getItemSchoolCategory() {
        return self::itemsAlias('school_category');
    }

    #############################
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getTbPersonnels() {
        return $this->hasMany(TbPersonnel::className(), ['school_id' => 'school_id']);
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

    public function getAddress() {
        $address = [];
        $address[] = $this->school_no?$this->getAttributeLabel('school_no')." ".$this->school_no:'';
        $address[] = $this->school_village?$this->getAttributeLabel('school_village')." ".$this->school_village:'';
        $address[] = $this->school_mu?$this->getAttributeLabel('school_mu_s').$this->school_mu:'';
        $address[] = $this->school_road?$this->getAttributeLabel('school_road_s').$this->school_road:'';
        
        $address[] = $this->tambol_id?$this->getAttributeLabel('tambol_id_s').$this->tambol->tambol_name:'';
        $address[] = $this->amphur_id?$this->getAttributeLabel('amphur_id_s').$this->amphur->amphur_name:'';
        $address[] = $this->province_id?$this->getAttributeLabel('province_id_s').$this->province->province_name:'';
        $address[] = $this->school_zip_code?' '.$this->school_zip_code:'';
        
        $address = array_filter($address);
        return implode(' ', $address);
    }    
     
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchoolLevelJions() {
        return $this->hasMany(TbSchoolLevelJion::className(), ['school_id' => 'school_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSchoolLevel() {        
        $lavel_title = [];
        foreach ($this->tbSchoolLevelJions as $level) {
           
            $lavel_title[] = $level->schoolLevel->school_level_title;
        }
        return $this->tbSchoolLevelJions?'<ol style="margin:0px;display: inline-block;"><li>'.implode('</li><li>', $lavel_title)."</li></ol>":null;       
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolLevels() {
        return $this->hasMany(TbSchoolLevel::className(), ['school_level_id' => 'school_level_id'])->viaTable('tb_school_level_jion', ['school_id' => 'school_id']);
    }

}
