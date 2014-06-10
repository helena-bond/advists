<?php

/**
 * This is the model class for table "{{fanfiction_genre}}".
 *
 * The followings are the available columns in table '{{fanfiction_genre}}':
 * @property integer $id
 * @property integer $fanfiction_id
 * @property integer $genre_id
 *
 * The followings are the available model relations:
 * @property Genre $genre
 * @property Fanfiction $fanfiction
 */
class FanfictionGenre extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fanfiction_genre}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fanfiction_id, genre_id', 'required'),
			array('fanfiction_id, genre_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fanfiction_id, genre_id', 'safe', 'on'=>'search'),
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
			'genre' => array(self::BELONGS_TO, 'Genre', 'genre_id'),
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
			'genre_id' => 'Genre',
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
		$criteria->compare('genre_id',$this->genre_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FanfictionGenre the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
