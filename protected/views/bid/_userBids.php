<br/>
<?php
$bids = Bid::getUserBids($userId);
if (count($bids) > 0) {
    echo "<h4>User Bids On Items</h4>";

    $arrayDataProvider = new CArrayDataProvider($bids,
        array(
            'keyField' => 'itemid',         // PRIMARY KEY
            'id' => 'itemsList'                    // ID of the data provider itself
        ));
    $this->widget('zii.widgets.grid.CGridView', array(

        'dataProvider' => $arrayDataProvider,
        'columns' => array(
            array(
                'name' => 'itemtitle',
                'type' => 'raw',
                'value' =>
                    'CHtml::link(CHtml::encode($data["itemtitle"]), array("/../index.php/item/view", "id" => $data["itemid"]))'
            ),
            array(
                'name' => 'value',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["value"])'
            ),
        ),
    ));
}