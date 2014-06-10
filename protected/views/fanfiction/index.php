<?php
$this->breadcrumbs=array(
	'Fanfictions',
);

$this->menu=array(
	array('label'=>'Create Fanfiction','url'=>array('create')),
	array('label'=>'Manage Fanfiction','url'=>array('admin')),
);
?>

<h1>Fanfictions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
