<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Raiting','url'=>array('index')),
	array('label'=>'Manage Raiting','url'=>array('admin')),
);
?>

<h1>Create Raiting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>