<?php

/**
 * This is the model class for table "{{character}}".
 *
 * The followings are the available columns in table '{{character}}':
 * @property integer $id
 * @property integer $fandom_id
 * @property string $name
 * @property string $link
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Fandom $fandom
 * @property FanfictionCharacter[] $fanfictionCharacters
 */
class Character extends CActiveRecord
{
    public $fandom_name;
    public $count;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{character}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fandom_id, name', 'required'),
            array('fandom_id, parent_id', 'numerical', 'integerOnly' => true),
            array('name, link', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, fandom_id, name, link, fandom_name', 'safe', 'on' => 'search'),
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
            'fandom' => array(self::BELONGS_TO, 'Fandom', 'fandom_id'),
            'fanfictionCharacters' => array(self::HAS_MANY, 'FanfictionCharacter', 'character_id'),
            'parent' => array(self::BELONGS_TO, 'Character', 'parent_id', 'together' => true),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fandom_id' => 'Fandom',
            'name' => 'Name',
            'link' => 'Link',
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

        //$criteria->compare('parent_id', null);
        $criteria->condition = '(t.parent_id IS NULL) or (t.parent_id = 0)';
        $criteria->compare('id', $this->id);
        $criteria->compare('fandom_id', $this->fandom_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('link', $this->link, true);
        $criteria->with = array('fandom', 'fanfictionCharacters');
        $criteria->together = true;
        $criteria->compare('fandom_id', $this->fandom_name, true);
        $criteria->order = 't.name ASC';
        $criteria->select = '*, count(fanfictionCharacters.id) as count';
        $criteria->group = 'fanfictionCharacters.character_id';
        
        $sort = new CSort;
        $sort->attributes = array(
            'fandom_name' => array(
                'asc' => 'fandom.name',
                'desc' => 'fandom.name DESC',
            ),
            '*'
        );

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Character the static model class
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
                'order'=>'t.name ASC'
            )
        );
    }
    
    public function getThisModel()
    {
        return $this;
    }
    
    public static function getList($fandom = null, $current = null) {
        $criteria = new CDbCriteria;
        $criteria->condition = '(t.parent_id IS NULL) or (t.parent_id = 0)';
        if($fandom !== null)
        {
            $criteria->compare('t.fandom_id', $fandom);
            $criteria->addCondition('t.id != :id');
            $criteria->params[':id'] = $current;
        }
        $criteria->order = 't.name';
        $list = CHtml::listData(self::model()->findAll($criteria), 'id', 'name');
        //$list = array_merge(array(0=>'Нет'), $list);
        $list[0] = 0;
        //ksort($list);
        return $list;
    }
    
    public function getName()
    {
        if($this->parent_id > 0) {
            return $this->parent->name;
        }
    }
    
    public function getLink()
    {
        if($this->parent_id > 0) {
            return $this->parent->link;
        }
    }
}
