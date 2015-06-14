<br>
<?php
$userBidItemBefore = Bid::userBidItemBefore(Yii::app()->user->id, $itemId);
echo "<h4>".($userBidItemBefore ? "Change" : "Add")." your Bid</h4>";
?>

<div id='flash-msg'>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
</div>
<?php echo CHtml::textField('bidvalue', '', array('id' => 'bidvalue','style'=>'display:inline;')); ?>

<?php echo CHtml::ajaxSubmitButton('Bid', Yii::app()->createUrl('bid/create'),
    array(
        'type' => 'POST',
        'data' => 'js:{"itemid": $("#itemid").val(),"bidvalue":$("#bidvalue").val()}',
        'success' => 'js:function(string){ $("#flash-msg").html(string); }'
    ), array('class' => 'btn','style'=>'display:inline;'));
?>