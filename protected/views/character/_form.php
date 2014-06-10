<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'character-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>
        <div style="display: block;" class="span12">
            Фандом
        <?php
        $this->widget('ext.select2.ESelect2', array(
        'model' => $model,
	'attribute' => 'fandom_id',
	'data' => Fandom::getList(),
	'htmlOptions' => array(
		//'multiple' => 'multiple',
                'class' => 'span5'
            ),
        ));
        ?>
        </div>
        
        <div style="display: block;" class="span12">
            Персонаж
        <?php
        $this->widget('ext.select2.ESelect2', array(
        'model' => $model,
	'attribute' => 'parent_id',
	'data' => Character::getList($model->fandom_id, $model->id),
	'htmlOptions' => array(
		//'multiple' => 'multiple',
                'class' => 'span5'
            ),
        ));
        ?>
        </div>
        <?php //echo $form->dropDownListRow($model, 'fandom_id', Fandom::getList()); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>100,'readonly'=>true)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
