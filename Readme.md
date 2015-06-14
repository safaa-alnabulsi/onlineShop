Online Shop Installation
===========================
This is a Bid System does the following:

Narrative:
------------
As a potential buyer in an online auction I want to be able to bid on an item So that I can participate in the auction.

**Scenario 1:**
displaying information about the current item
Given I am in the auction room
Then I see the current item picture, description and name
And I see the current highest bid with a button to place a new bid

**Scenario 2:**
single user bidding on an item
Given I am in the auction room
When I place a bid on an item
And I am the only bidder
Then I am the highest bidder

**Scenario 3:**
multiple users bidding on an item - you are first
Given I am in the auction room
Pair Programming Session
We do a session of pair programming while we both ask questions
about the solution and try to implement a little piece of extra
functionality together to see how the work flows.
When I place a bid on an item
And I am not the only bidder
And my bid was placed first
Then I am the highest bidder

**Scenario 4:**
multiple users bidding on an item - you are not first
Given I am in the auction room
When I place a bid on an item
And I am not the only bidder
And my bid was not placed first
Then I am not the highest bidder


Download
--------

Download or checkout (SVN/Git) from https://github.com/safaa-alnablsi/onlineShop and unpack file in your server public folder

Git clone
---------

    clone git git@github.com:safaa-alnablsi/onlineShop.git


Configure && Run
------------------
1. Download [Yii Framework](https://github.com/yiisoft/yii/releases/download/1.1.16/yii-1.1.16.bca042.zip), unpack it to your server, if you are using WAMP server for example, you put it: `C:\wamp\www\yii` and you change the folder name to `yii`.
2. Put the project in the public folder in your server  `C:\wamp\www\onlineShop`.
3. Import the database in the folder `/data/online_shop.sql`
4. Go to your browser : `http://localhost/onlineShop/index.php`
5. Login with one of these three credentials:

        admin/admin
        itemsmanager/itemsmanager
        bidder/bidder

6. Congrats! you are logged in!

What's Now?
------------------

 You can add/update/change/delete/list new items
         add/change/list bids on items
         login/logout/change/update Profile Password as a user
         play with roles/permissions in Rights, you can handle every single task and operation in your system.


Used Technologies
---------------------
1. Yii Framework: http://www.yiiframework.com/
2. user: http://www.yiiframework.com/extension/yii-user/
3. rights: http://www.yiiframework.com/extension/rights/
4. eajaxupload: http://www.yiiframework.com/extension/eajaxupload/
5. bootstrap: http://getbootstrap.com/
6. yiistrap: http://www.getyiistrap.com/
