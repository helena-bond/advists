<?php

/**
 * This is the model class for table "wp_terms".
 *
 * The followings are the available columns in table 'wp_terms':
 * @property string $term_id
 * @property string $name
 * @property string $slug
 * @property string $term_group
 * @property integer $term_order
 */
class WPTerms extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'wp_terms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('term_order', 'numerical', 'integerOnly' => true),
            array('name, slug', 'length', 'max' => 200),
            array('term_group', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('term_id, name, slug, term_group, term_order', 'safe', 'on' => 'search'),
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
            'type' => array(self::HAS_ONE, 'WpTermTaxonomy', 'term_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'term_id' => 'Term',
            'name' => 'Name',
            'slug' => 'Slug',
            'term_group' => 'Term Group',
            'term_order' => 'Term Order',
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

        $criteria->compare('term_id', $this->term_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('term_group', $this->term_group, true);
        $criteria->compare('term_order', $this->term_order);

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return WPTerms the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
