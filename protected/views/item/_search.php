<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>550)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
        <?php echo $form->radioButtonList(
            $model,
            'status',
            array('0'=>'Not Sold','1'=>'sold'),
            array('separator'=>' ', 'labelOptions'=>array('style'=>'
            display: inline !important;
            width: auto !important;
            margin-right: 10px;
            padding-left: 1em;
                '),)
        );?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->