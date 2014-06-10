<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <?php Yii::app()->bootstrap->register(); ?>
        <link rel="stylesheet" type="text/css" href="/css/main.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>   

        <link href="<?= Yii::app()->baseUrl ?>/css/style.css" rel="stylesheet" />
    </head>

    <body>

        <div class="container" id="page">

            <div id="header" class="row-fluid">

                <div id="logo" class="span3">
                    <a href="<?= CHtml::normalizeUrl(array('site/index')); ?>"></a>
                </div>

                <div id="mainmenu" class="span7">
                    <?php
                    $this->widget('application.components.widgets.Tabs',
                            array(
                        'tabs' => array(
                            array('url' => Yii::app()->getModule('user')->loginUrl,
                                'label' => Yii::app()->getModule('user')->t("Login"),
                                'visible' => Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->registrationUrl,
                                'label' => Yii::app()->getModule('user')->t("Register"),
                                'visible' => Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->profileUrl,
                                'label' => Yii::app()->getModule('user')->t("Profile"),
                                'visible' => !Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->logoutUrl,
                                'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')',
                                'visible' => !Yii::app()->user->isGuest),
                    )));
                    ?>
                </div><!-- mainmenu -->

            </div><!-- header -->

<?php if (isset($this->breadcrumbs)): ?>
    <?php
    $this->widget('zii.widgets.CBreadcrumbs',
            array(
        'links' => $this->breadcrumbs,
    ));
    ?><!-- breadcrumbs -->
<?php endif ?>

<?php echo $content; ?>

            <div class="clearfix"></div>

            <div id="footer">
                Разработано в <a href="http://www.ziyonet.uz">ZiyoNET</a>, 
<?= (date('Y') == '2013' ? '' : '2013-') ?><?php echo date('Y'); ?>.                
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
