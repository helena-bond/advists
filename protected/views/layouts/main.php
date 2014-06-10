<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
            'httpEquivs'=>array(
                'Content-Type'=>'text/html; charset=utf-8',
                'Content-Language'=>'ru-RU'
            ),
            'defaultDescription'=> $this->metaDescription,
            //'defaultKeywords'=>'these, are, my, default, sample, page, meta, keywords',
        )); ?>
        <?php Yii::app()->bootstrap->register(); ?>
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>


        <?php
        $this->widget('bootstrap.widgets.TbNavbar',
                array(
            'type' => 'inverse', // null or 'inverse'
            'brand' => CHtml::encode(Yii::app()->name),
            'brandUrl' => array('/site/index'),
            'fixed' => 'top',
            'collapse' => true, // requires bootstrap-responsive.css
            'items' => array(
            ),
        ));
        ?>
        
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('bootstrap.widgets.TbBreadcrumbs',
                                array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif ?>
                </div>
            </div>
            <div class="row-fluid">
                <?php echo $content; ?>
            </div>
            <div class="clear"></div>
            <?php $this->beginContent('//layouts/footer'); ?>
            <?php //echo $content;  ?>
            <?php $this->endContent(); ?>
        </div>
    </body>
</html>
