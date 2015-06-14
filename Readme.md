Online Shop Installation
===========================
This is a Bid System does the following:

Narrative:
------------
As a potential buyer in an online auction
I want to be able to bid on an item
So that I can participate in the auction
Scenario 1: displaying information about the current item
Given I am in the auction room
Then I see the current item picture, description and name
And I see the current highest bid with a button to place a new bid


Scenario 2:
------------
single user bidding on an item
Given I am in the auction room
When I place a bid on an item
And I am the only bidder
Then I am the highest bidder


Scenario 3:
------------
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


Scenario 4:
------------
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
1- Put the project in the public folder in your server.
2- Import the database in the folder /data/online_shop.sql
3- Go to your browser : http://localhost/onlineShop/index.php
4- Login with one of these three credentials:

        admin/admin
        itemsmanager/itemsmanager
        bidder/bidder

5- Congrats! you are logged in!


What's Now?
------------------

 You can add/update/change/delete/list new items
         add/change/list bids on items
         login/logout/register/change Password as a user
         play with roles/permissions in Rights, you can handle every single task and operation in your system.


Used Extension
---------------------
1- user: http://www.yiiframework.com/extension/yii-user/
2- rights: http://www.yiiframework.com/extension/rights/
3- eajaxupload: http://www.yiiframework.com/extension/eajaxupload/
4- bootstrap: http://getbootstrap.com/
5- yiistrap: http://www.getyiistrap.com/