
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
//JS::customJS();
$this->pageTitle=Yii::app()->name . ' - '.Yii::t("UI", "Login");
?>

<?php if(Yii::app()->user->isGuest):?>
    <div id="index-auth" class="row-fluid">
        <form class="form-inline" action=""<?=CHtml::normalizeUrl(array('site/login'));?>" method="post">
          <span class="label label-important" id="flash-errors"><? echo Yii::app()->user->getFlash('error');?></span>
          <h4>Авторизуйтесь для доступа:</h4>
          <input name="User[username]" id="User_username" type="text" class="input-medium search-query" placeholder="Логин">
          <img src="/images/id.uz_text.png">
          <button type="submit" class="btn btn-info btn-auth">Войти</button>
        </form>
    </div>
<?php endif; ?>
