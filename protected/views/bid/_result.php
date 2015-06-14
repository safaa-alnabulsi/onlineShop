<?php $itemHasBids = Bid::itemHasBids($itemId);

if ($itemHasBids == true) { ?>

    <div style="float: right;">
        <?php
        $highestBid = Bid::getHighestBidOfItem($itemId);
        echo "<h4><font color='#00008b'>" . ($highestBid != "" ? "Highest Bid: ".$highestBid : "") . "</font></h4>";
        ?>
    </div>

    <div style="float: left;">
        <?php
        $highestBidderId = Bid::getHighestBidderId($itemId);
        echo "<h4><font color='red'>" . ($highestBidderId == Yii::app()->user->id ? "You are The Highest Bidder !!" : "") . "</font></h4>";
        ?>
    </div>

<?php } else {
    echo "<h4><font color='#daa520'>No Bids yet on this item.</font></h4>";
} ?>