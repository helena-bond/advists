<?php

/**
 * This is the model class for table "{{fanfiction}}".
 *
 * The followings are the available columns in table '{{fanfiction}}':
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
class Fanfiction extends CActiveRecord
{

    public $fandom_name;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{fanfiction}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, link, author, date, content, category, guid, comment_count, old_id, status',
                'required'),
            array('category, old_id', 'numerical', 'integerOnly' => true),
            array('link', 'length', 'max' => 200),
            array('author, comment_count', 'length', 'max' => 20),
            array('guid', 'length', 'max' => 255),
            array('status', 'length', 'max' => 7),
            array('modified, fandom_name', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, link, author, date, content, category, modified, guid, comment_count, old_id, status',
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
            'categories' => array(self::MANY_MANY, 'Category', 'demo_post_category(post_id, category_id)'),
            'tags' => array(self::MANY_MANY, 'Tag', 'demo_post_tag(post_id, tag_id)'),
            'fandoms' => array(self::MANY_MANY, 'Fandom', 'demo_fanfiction_fandom(fanfiction_id, fandom_id)',
                'together' => true),
            'authors' => array(self::MANY_MANY, 'Author', 'demo_fanfiction_author(fanfiction_id, author_id)',
                'together' => true),
            'characters' => array(self::MANY_MANY, 'Character', 'demo_fanfiction_character(fanfiction_id, character_id)',
                'together' => true),
            'genres' => array(self::MANY_MANY, 'Genre', 'demo_fanfiction_genre(fanfiction_id, genre_id)',
                'together' => true),
            'raitings' => array(self::MANY_MANY, 'Raiting', 'demo_fanfiction_raiting(fanfiction_id, raiting_id)',
                'together' => true),
            'sizes' => array(self::MANY_MANY, 'Size', 'demo_fanfiction_size(fanfiction_id, size_id)',
                'together' => true),
            'ftags' => array(self::MANY_MANY, 'Tag', 'demo_fanfiction_tag(fanfiction_id, tag_id)'),
            'pairings' => array(self::HAS_MANY, 'FanfictionPairing', 'fanfiction_id',
                'together' => true),
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
            'link' => 'Link',
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
        $criteria->compare('link', $this->link, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('category', $this->category);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('guid', $this->guid, true);
        $criteria->compare('comment_count', $this->comment_count, true);
        $criteria->compare('old_id', $this->old_id);
        $criteria->compare('status', $this->status, true);
        //$criteria->with = array('fandoms');
        //$criteria->together = true;
        //$criteria->group = ''
        //$criteria->compare('fandoms.name', $this->fandom_name, true);

        $sort = new CSort;
        $sort->attributes = array(
            'fandom_name' => array(
                'asc' => 'fandoms.name',
                'desc' => 'fandoms.name DESC',
            ),
            '*'
        );

        return new CActiveDataProvider($this,
                array(
            'criteria' => $criteria,
                //'sort' => $sort
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Fanfiction the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            array(
                'class' => 'ext.seo.components.SeoRecordBehavior',
                'route' => 'fanfiction/view',
                'params'=>array('link'=>$this->link),
            ),
        );
    }

    protected function beforeSave()
    {
        if ($this->link == '') {
            $this->link = H::t($this->name);
        }
        //format text
        $p = new CHtmlPurifier(); // обертка от Yii
        $htmlpurifier = new GHtmlPurifier();
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath',Yii::app()->getRuntimePath());
        $config->set('Attr.AllowedClasses',array('header')); // или Attr.ForbiddenClasses имеются ввиду CSS классы
        $config->set('AutoFormat.AutoParagraph',true); // авто добавление <p> в тексте при переносе
        $config->set('AutoFormat.RemoveEmpty',true); // удаляет пустые теги, есть исключения*
        $config->set('HTML.Doctype','HTML 4.01 Strict'); // обратите внимание как заменился тег <strike>
        $uri = $config->getDefinition('URI');
        $uri->addFilter(new HTMLPurifier_URIFilter_MakeRedirect(), $config);
        $html = $config->getHTMLDefinition(true); // Получаем ссылку на объект HTMLPurifier_HTMLDefinition
        $html->manager->addModule('TargetBlankAll'); // Добавляем модуль через манажер модулей
        $htmlpurifier->options = $config;
        $text = str_replace('\r\n', '\r\n\r\n', $this->content);
        $this->content = $htmlpurifier->purify($text); 
        return parent::beforeSave();
    }

    protected function afterFind()
    {
        $this->fandom_name = CHtml::listData($this->fandoms, 'id', 'id');
        return parent::afterFind();
    }

    protected function afterSave()
    {
        if (is_array($this->fandom_name)) {
            $curr_fandoms = CHtml::listData($this->fandoms, 'id', 'id');
            $diff_create = array_diff($this->fandom_name, $curr_fandoms);
            foreach ($diff_create as $id) {
                $ff = new FanfictionFandom;
                $ff->fanfiction_id = $this->id;
                $ff->fandom_id = $id;
                $ff->save(false);
            }
            $diff_delete = array_diff($curr_fandoms, $this->fandom_name);
            foreach ($diff_delete as $id) {
                FanfictionFandom::model()->findByAttributes(array(
                    'fanfiction_id' => $this->id,
                    'fandom_id' => $id
                ))->delete();
            }
        }
        return parent::afterSave();
    }
    
    public function getDescription()
    {
        list($description) = explode('<!--more-->', $this->content);
        return H::UTF8_substr(str_replace( array("\n", "\r"), " ", strip_tags($description)), 0, 150);
    }
    
    public function getFormatedContent()
    {
        return str_replace(array('</p><br>','</p><br />'), '</p>', nl2br($this->content));
    }

}
