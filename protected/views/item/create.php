<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs = array(
    'Items' => array('index'),
    'Create',
);
if (Yii::app()->user->checkAccess('Item.Index') || Yii::app()->user->checkAccess('Item.Admin')
) {
    $this->menu = array(
        array(
            'label' => 'List Item',
            'url' => array('index'),
            'visible' => Yii::app()->user->checkAccess('Item.Index')
        ),
        array(
            'label' => 'Manage Item',
            'url' => array('admin'),
            'visible' => Yii::app()->user->checkAccess('Item.Admin')

        )
    );
}
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>