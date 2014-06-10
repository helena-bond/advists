<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Raiting','url'=>array('index')),
	array('label'=>'Create Raiting','url'=>array('create')),
	array('label'=>'View Raiting','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Raiting','url'=>array('admin')),
);
?>

<h1>Update Raiting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>