<?php
$this->breadcrumbs=array(
	'Fanfictions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fanfiction','url'=>array('index')),
	array('label'=>'Manage Fanfiction','url'=>array('admin')),
);
?>

<h1>Create Fanfiction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>