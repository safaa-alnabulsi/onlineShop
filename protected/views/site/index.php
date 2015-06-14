<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

Click <?php echo CHtml::link(CHtml::encode('Here'), array('/item')); ?> to see Items.