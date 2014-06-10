<?php
$this->breadcrumbs = array(
    'Fanfictions' => array('index'),
    $model->title,
);

$this->menu=array(
	array('label'=>'List Fanfiction','url'=>array('index')),
	array('label'=>'Create Fanfiction','url'=>array('create')),
	array('label'=>'View Fanfiction','url'=>$model->getUrl()),
	array('label'=>'Manage Fanfiction','url'=>array('admin')),
);

$this->canonical = $model->getAbsoluteUrl(); // canonical URLs should always be absolute
$this->metaDescription = $this->metaDescription;
?>

<h1><?php echo $model->title; ?></h1>

<?= $model->getFormatedContent(); ?>

<?php
/*$this->widget('bootstrap.widgets.TbDetailView',
        array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'link',
        'author',
        'date',
        'content',
        'category',
        'modified',
        'guid',
        'comment_count',
        'old_id',
        'status',
    ),
));*/
/*
foreach($model->fandoms as $a) {
    echo $a->name.'<br>';
}
foreach($model->authors as $a) {
    echo $a->name.'<br>';
}
foreach($model->characters as $a) {
    echo $a->name.'<br>';
}
foreach($model->genres as $a) {
    echo $a->name.'<br>';
}
foreach($model->raitings as $a) {
    echo $a->name.'<br>';
}
foreach($model->sizes as $a) {
    echo $a->name.'<br>';
}
foreach($model->pairings as $a) {
    echo $a->pairing.'<br>';
}*/