<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'fanfiction-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div style="display: block;" class="span12">
        <?php
        $this->widget('ext.select2.ESelect2', array(
        'model' => $model,
	'attribute' => 'fandom_name',
	'data' => Fandom::getList(),
	'htmlOptions' => array(
		'multiple' => 'multiple',
                'class' => 'span5'
            ),
        ));
        ?>
        </div>
        <?php //echo $form->dropDownListRow($model, 'fandom_name', Fandom::getList(), array('multiple'=>true)); ?>

	<?php echo $form->textAreaRow($model,'title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'author',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'guid',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'comment_count',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'old_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>7)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
