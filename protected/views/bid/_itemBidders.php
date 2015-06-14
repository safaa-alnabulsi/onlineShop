<br/>
<?php
$bidders = Bid::getBiddersOfItem($itemId);
if (count($bidders) > 0) {
    echo "<h4>Bidders On The Item</h4>";

    $arrayDataProvider = new CArrayDataProvider($bidders,
        array(
            'keyField' => 'userid',         // PRIMARY KEY
            'id' => 'biddersList'                    // ID of the data provider itself
        ));
    $this->widget('zii.widgets.grid.CGridView', array(

        'dataProvider' => $arrayDataProvider,
        'columns' => array(
            array(
                'name' => 'username',
                'type' => 'raw',
                'value' =>
                    'CHtml::link(CHtml::encode($data["username"]), array("user/user/view", "id" => $data["userid"]))'
            ),
            array(
                'name' => 'value',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["value"])'
            ),
        ),
    ));
}