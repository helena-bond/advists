<?php
$this->breadcrumbs=array(
	'Fanfictions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fanfiction','url'=>array('index')),
	array('label'=>'Create Fanfiction','url'=>array('create')),
	array('label'=>'View Fanfiction','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Fanfiction','url'=>array('admin')),
);
?>

<h1>Update Fanfiction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>