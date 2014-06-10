<?php

/**
 * This is the model class for table "{{fandom}}".
 *
 * The followings are the available columns in table '{{fandom}}':
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property integer $parent_id
 */
class Fandom extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{fandom}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, link, parent_id', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('name, link', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, link, parent_id', 'safe', 'on' => 'search'),
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
            'type' => array(self::BELONGS_TO, 'FandomType', 'parent_id'),
            'characters' => array(self::HAS_MANY, 'Character', 'fandom_id'),
            'fanfictions' => array(self::MANY_MANY, 'Fanfiction', 'demo_fanfiction_fandom(fandom_id, fanfiction_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'parent_id' => 'Parent',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('parent_id', $this->parent_id);

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Fandom the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        if($this->link == '') {
            $this->link = H::t($this->name);
        }
        return parent::beforeSave();
    }
    
    public function scopes(){
        return array(
            'ordered' => array(
                'order'=>'type.id ASC, t.name ASC',
                'with' => 'type'
            )
        );
    }
    
    public static function getList()
    {
        $list = CHtml::listData(self::model()->with('type')->ordered()->findAll(), 'id', 'name', 'type.name');
        $list[0] = 'Без фандома';
        return $list;
    }

}
