<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">
    <?php if (Yii::app()->user->checkAccess('createBid', array('bid' => new Bid()))) {
        Yii::app()->controller->renderPartial('/bid/_result', array('itemId' => $data->id));
    } ?>
    <br/>
    <br/>
    <b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b> <br/>
    <?php echo "<img src='" . $this->createAbsoluteUrl("/item/previewPhoto", array('id' => $data->id)) . "' style='height:100px; width:100px;'/>"; ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('last_bid_by')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode(User::getUsernameById($data->last_bid_by)), array('user/user/view', 'id' => $data->last_bid_by)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('highestBid')); ?>:</b>
    <?php echo CHtml::encode(Bid::getHighestBidOfItem($data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('highestBidder')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode(User::getUsernameById(Bid::getHighestBidderId($data->id))), array('user/user/view', 'id' => Bid::getHighestBidderId($data->id))); ?>


    <?php if (Yii::app()->user->checkAccess('createBid', array('bid' => new Bid()))) { ?>
        <div style="float: right;margin-top: -9px;">
            <?php if ($data->status == Item::NOT_SOLD) {
                echo CHtml::link(CHtml::encode('Bid'), array('view', 'id' => $data->id), array('class' => 'btn'));
            } else {
                echo "<h4><font color='green'>This item has been sold!</font></h4>";
            }
            ?>
        </div>
    <?php } ?>
</div>