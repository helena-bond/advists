<?php
$this->breadcrumbs=array(
	'Characters',
);

$this->menu=array(
	array('label'=>'Create Character','url'=>array('create')),
	array('label'=>'Manage Character','url'=>array('admin')),
);
?>

<h1>Characters</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
