<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'item-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <?php $this->widget('bootstrap.widgets.TbAlert'); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'picture'); ?>
        <?php

        $photo_name = yii::app()->user->id;
        $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
            'id' => 'upload_file',
            'css' => '',
            'config' => array(
                'action' => Yii::app()->createUrl('item/uploadPhoto', array('photo_name' => $photo_name)),
                'allowedExtensions' => Yii::app()->params['photo_allowed_extension'], //("jpg", "jpeg", "gif", "bmp", "png", "zip", "doc", "docx", "txt", "xls", "xlxs","pdf"),
                'sizeLimit' => Yii::app()->params['max_photo_size'], // maximum file size in bytes
                'upload_btn_text' => Yii::t('default', 'Upload'),
                'onComplete' => 'js:function(id, fileName, responseJSON){
                                            var url = responseJSON["file_url"];
                                            var path = responseJSON["file_path"];
                                            $("#picturePath").val(path);
                                            $("#img").attr("src","");
                                            $("#img").attr("src",url +"?random="+ Math.round(new Date().getTime() / 1000));
         }',
                'messages' => array(
                    'typeError' => Yii::t('default', "{file} has invalid extension. Only {extensions} are allowed."),
                    'sizeError' => Yii::t('default', "{file} is too large, maximum file size is {sizeLimit}."),
                    'minSizeError' => Yii::t('default', "{file} is too small, minimum file size is {minSizeLimit}."),
                    'emptyError' => Yii::t('default', "{file} is empty, please select files again without it."),
                    'onLeave' => Yii::t('default', "The files are being uploaded, if you leave now the upload will be cancelled.")
                ),
                'showMessage' => "js:function(message){ alert(message); }"
            )
        ));
        if ($model->isNewRecord) {
            echo "<img id='img' src='' style='height:100px; width:100px;'/>";
        } else {
            echo "<img src='" . $this->createAbsoluteUrl("/item/previewPhoto", array('id' => $model->id)) . "' style='height:100px; width:100px;'/>";
        }
        echo CHtml::activeHiddenField($model, "picture", array('id' => 'picturePath'));
        ?>


    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('size' => 60, 'maxlength' => 550)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price'); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php
        if ($model->isNewRecord) {
            $model->status = Item::NOT_SOLD;
        }
        echo $form->radioButtonList($model, 'status', array('0' => 'Not Sold', '1' => 'sold'), array('separator' => ' ',
            'labelOptions' => array('style' => 'display:inline'), // add this code
        ));
        ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->