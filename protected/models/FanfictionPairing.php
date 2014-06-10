<?php

/**
 * This is the model class for table "{{fanfiction_pairing}}".
 *
 * The followings are the available columns in table '{{fanfiction_pairing}}':
 * @property integer $id
 * @property integer $fanfiction_id
 * @property string $pairing
 *
 * The followings are the available model relations:
 * @property Fanfiction $fanfiction
 */
class FanfictionPairing extends CActiveRecord
{
    public $pairing_array = array();
    public $characters = array();
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{fanfiction_pairing}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fanfiction_id, pairing', 'required'),
            array('fanfiction_id', 'numerical', 'integerOnly' => true),
            array('pairing', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, fanfiction_id, pairing', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fanfiction' => array(self::BELONGS_TO, 'Fanfiction', 'fanfiction_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fanfiction_id' => 'Fanfiction',
            'pairing' => 'Pairing',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fanfiction_id', $this->fanfiction_id);
        $criteria->compare('pairing', $this->pairing, true);

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FanfictionPairing the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    public function getThisModel()
    {
        return $this;
    }
    
    public static function listData()
    {
        $models = FanfictionPairing::model()->findAll();
        $list = array();
        foreach($models as $model) {
            $keys = $model->pairing_array;
            foreach($keys as $id) {
                $list[$id][] = $model;
            }
        }
        return $list;
    }
    
    protected function afterFind()
    {
        $this->pairing_array = CJSON::decode($this->pairing);
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.id', $this->pairing_array);
        $this->characters = Character::model()->findAll($criteria);
        if($this->characters === null) $this->characters = array();
        return parent::afterFind();
    }
    

}
