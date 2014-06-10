<?php
$this->breadcrumbs=array(
	'Characters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Character','url'=>array('index')),
	array('label'=>'Create Character','url'=>array('create')),
	array('label'=>'Update Character','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Character','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Character','url'=>array('admin')),
);
?>

<h1>View Character #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fandom_id',
		'name',
		'link',
	),
)); ?>
