<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3><?php echo CHtml::encode(Yii::app()->name); ?></h3>

<?php /**
<p>Здесь вы можете:</p>
<ul>
	<li>Просмотреть вашу посещаемость за любой период;</li>
	<li>Просмотреть ваши пропуски, недоработанные и сверхурочные часы, выходы на работу по выходным;</li>
        <li>Предложить ваше фактическое время прихода/ухода, в случае уважительной причины.</li>
</ul>

<p>Для просмотра деталей, выберите соответствующий отчет в верхнем меню.</p>
 * 
 */
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array(
            'name' => 'fullName',
            'header' => 'Сотрудник',
            'value' => "CHtml::tag('span', array('class'=>((\$data->present)?'badge badge-success':((\$data->isDayOff)?'badge badge-warning':'badge badge-important'))), '&nbsp;').' '.\$data->fullName",
            'type' => 'raw'
        ),
        array(
            'name' => 'came',
            'header' => 'Время прихода',
        ),
        array(
            'name' => 'presentText',
            'header' => 'Статус',
        ),
    ),
)); ?>