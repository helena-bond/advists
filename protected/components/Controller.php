<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $model = 'Fanfiction';
    
    public $metaKeywords;
    public $metaDescription;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //array('ext.seo.components.SeoFilter + view'), // apply the filter to the view-action
        );
    }

    public function behaviors()
    {
        return array(
            'seo' => array('class' => 'ext.seo.components.SeoControllerBehavior'),
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $modelName = $this->model;
        $criteria = new CDbCriteria;
        $criteria->compare('link', $id);
        $model = $modelName::model()->find($criteria);
        if ($model === null) {
            $model = $modelName::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, CJSON::encode($_GET));
        }
        $this->metaDescription = $model->getDescription();
        return $model;
    }

}
