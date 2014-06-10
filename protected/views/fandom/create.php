<?php
$this->breadcrumbs=array(
	'Fandoms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fandom','url'=>array('index')),
	array('label'=>'Manage Fandom','url'=>array('admin')),
);
?>

<h1>Create Fandom</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>