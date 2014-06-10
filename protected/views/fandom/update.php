<?php
$this->breadcrumbs=array(
	'Fandoms'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fandom','url'=>array('index')),
	array('label'=>'Create Fandom','url'=>array('create')),
	array('label'=>'View Fandom','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Fandom','url'=>array('admin')),
);
?>

<h1>Update Fandom <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>