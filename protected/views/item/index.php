<?php
/* @var $this ItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Items',
);

if (Yii::app()->user->checkAccess('Item.Create') || Yii::app()->user->checkAccess('Item.Admin')
) {
    $this->menu = array(
        array(
            'label' => 'Create Item',
            'url' => array('create'),
            'visible' => Yii::app()->user->checkAccess('Item.Create')
        ),
        array(
            'label' => 'Manage Items',
            'url' => array('admin'),
            'visible' => Yii::app()->user->checkAccess('Item.Admin')
        )
    );
}
?>

<h3>Items</h3>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
