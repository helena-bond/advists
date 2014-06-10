<?php
$this->breadcrumbs=array(
	'Raitings',
);

$this->menu=array(
	array('label'=>'Create Raiting','url'=>array('create')),
	array('label'=>'Manage Raiting','url'=>array('admin')),
);
?>

<h1>Raitings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
