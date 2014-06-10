<?php
$this->breadcrumbs=array(
	'Fandoms',
);

$this->menu=array(
	array('label'=>'Create Fandom','url'=>array('create')),
	array('label'=>'Manage Fandom','url'=>array('admin')),
);
?>

<h1>Fandoms</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
