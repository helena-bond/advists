<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Size','url'=>array('index')),
	array('label'=>'Manage Size','url'=>array('admin')),
);
?>

<h1>Create Size</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>