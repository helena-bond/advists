<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Raiting','url'=>array('index')),
	array('label'=>'Create Raiting','url'=>array('create')),
	array('label'=>'Update Raiting','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Raiting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Raiting','url'=>array('admin')),
);
?>

<h1>View Raiting #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'link',
	),
)); ?>
