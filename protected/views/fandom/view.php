<?php
$this->breadcrumbs=array(
	'Fandoms'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Fandom','url'=>array('index')),
	array('label'=>'Create Fandom','url'=>array('create')),
	array('label'=>'Update Fandom','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Fandom','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fandom','url'=>array('admin')),
);
?>

<h1>View Fandom #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'link',
		'parent_id',
	),
)); ?>
