<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property string $id
 * @property string $title
 * @property string $link
 * @property string $author
 * @property string $date
 * @property string $content
 * @property integer $category
 * @property string $modified
 * @property string $guid
 * @property string $comment_count
 * @property integer $old_id
 * @property string $status
 */
class Post extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{post}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, author, date, content, category, guid, comment_count, old_id, status',
                'required'),
            array('category, old_id', 'numerical', 'integerOnly' => true),
            array('author, comment_count', 'length', 'max' => 20),
            array('guid', 'length', 'max' => 255),
            array('status', 'length', 'max' => 7),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, author, date, content, category, modified, guid, comment_count, old_id, status',
                'safe', 'on' => 'search'),
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
            'wppost' => array(self::BELONGS_TO, 'WPPosts', 'old_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'date' => 'Date',
            'content' => 'Content',
            'category' => 'Category',
            'modified' => 'Modified',
            'guid' => 'Guid',
            'comment_count' => 'Comment Count',
            'old_id' => 'Old',
            'status' => 'Status',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('category', $this->category);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('guid', $this->guid, true);
        $criteria->compare('comment_count', $this->comment_count, true);
        $criteria->compare('old_id', $this->old_id);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
