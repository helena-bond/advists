<?php

/**
 * This is the model class for table "{{fanfiction_size}}".
 *
 * The followings are the available columns in table '{{fanfiction_size}}':
 * @property integer $id
 * @property integer $fanfiction_id
 * @property integer $size_id
 *
 * The followings are the available model relations:
 * @property Size $size
 * @property Fanfiction $fanfiction
 */
class FanfictionSize extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fanfiction_size}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fanfiction_id, size_id', 'required'),
			array('fanfiction_id, size_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fanfiction_id, size_id', 'safe', 'on'=>'search'),
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
			'size' => array(self::BELONGS_TO, 'Size', 'size_id'),
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
			'size_id' => 'Size',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fanfiction_id',$this->fanfiction_id);
		$criteria->compare('size_id',$this->size_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FanfictionSize the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
