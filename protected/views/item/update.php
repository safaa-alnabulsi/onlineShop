<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs = array(
    'Items' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);
if (Yii::app()->user->checkAccess('Item.Index') || Yii::app()->user->checkAccess('Item.Admin')
    || Yii::app()->user->checkAccess('Item.Create') || Yii::app()->user->checkAccess('Item.Update')
) {
    $this->menu = array(
        array(
            'label' => 'List Items',
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
            'label' => 'Manage Items',
            'url' => array('admin'),
            'visible' => Yii::app()->user->checkAccess('Item.Admin')
        )
    );
}
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>