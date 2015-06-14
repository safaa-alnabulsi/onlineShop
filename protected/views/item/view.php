<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs = array(
    'Items' => array('index'),
    $model->title,
    'view'
);
if (Yii::app()->user->checkAccess('Item.Index') || Yii::app()->user->checkAccess('Item.Admin')
    || Yii::app()->user->checkAccess('Item.Create') || Yii::app()->user->checkAccess('Item.Update')
    || Yii::app()->user->checkAccess('Item.Delete')
) {
    $this->menu = array(
        array(
            'label' => 'List Item',
            'url' => array('index'),
            'visible' => Yii::app()->user->checkAccess('Item.Index')
        ),
        array(
            'label' => 'Create Item',
            'url' => array('create'),
            'visible' => Yii::app()->user->checkAccess('Item.Create')
        ),
        array(
            'label' => 'Update Item',
            'url' => array('update', 'id' => $model->id),
            'visible' => Yii::app()->user->checkAccess('Item.Update')
        ),
        array(
            'label' => 'Delete Item',
            'url' => '#',
            'linkOptions' => array(
                'submit' => array('delete', 'id' => $model->id),
                'confirm' => 'Are you sure you want to delete this item?'
            ),
            'visible' => Yii::app()->user->checkAccess('Item.Delete')
        ),
        array(
            'label' => 'Manage Item',
            'url' => array('admin'),
            'visible' => Yii::app()->user->checkAccess('Item.Admin')
        )
    );
}
?>

<?php $this->widget('application.extensions.bootstrap.widgets.TbAlert'); ?>

<?php echo Yii::app()->bootstrap->init(); ?>

<?php Yii::app()->controller->renderPartial('/bid/_result', array('itemId' => $model->id)); ?>
    <br/><br/>
    <b><?php echo 'picture'; ?>:</b>
    <br/>
<?php echo "<img src='" . $this->createAbsoluteUrl("/item/previewPhoto",
        array('id' => $model->id)) . "' style='height:100px; width:100px;'/>"; ?>
    <br/>
    <br/>

<?php
$highestBidderOfItem = Bid::getHighestBidderId($model->id);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        'description',
        array(
            'name' => 'status',
            'value' => ($model->status == Item::SOLD) ? Yii::t("default", "SOLD") : Yii::t("default", "NOT SOLD"),
        ),
        'price',
        array(
            'name' => 'last_bid_by',
            'type' => 'raw',
            'value' => ($model->last_bid_by == null) ? "No Bidder yet" : CHtml::link(CHtml::encode(User::getUsernameById($model->last_bid_by)),
                array('user/user/view', 'id' => $model->last_bid_by)),
        ),
        array(
            'name' => 'highestBid',
            'value' => Bid::getHighestBidOfItem($model->id)
        ),
        array(
            'name' => 'highestBidder',
            'type' => 'raw',
            'value' => ($highestBidderOfItem == null) ? "No Bidder yet" : CHtml::encode(User::getUsernameById($highestBidderOfItem)),

        ),
    ),
)); ?>

<?php echo CHtml::activeHiddenField($model, "id", array("value" => $model->id, 'id' => 'itemid')); ?>

<?php
if (Yii::app()->user->checkAccess('Bid.Create')) {
    if ($model->status == Item::NOT_SOLD) {
        Yii::app()->bootstrap->register();
        Yii::app()->controller->renderPartial('/bid/_form', array('itemId' => $model->id));
    } else {
        echo "<h4><font color='green'>This item has been sold!</font></h4>";
    }
}
?>

<?php

if (Yii::app()->user->checkAccess('ItemBids')) {
    Yii::app()->controller->renderPartial('/bid/_itemBidders', array('itemId' => $model->id));
}
?>