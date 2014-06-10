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
        <div id="content" class="span12">
            <?php echo $content; ?>
        </div>
    </body>
</html>