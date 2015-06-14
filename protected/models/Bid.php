<?php

/**
 * This is the model class for table "bid".
 *
 * The followings are the available columns in table 'bid':
 * @property integer $itemid
 * @property integer $userid
 * @property double $value
 * @property string $itemtitle
 * @property string $username
 */
class Bid extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bid';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('itemid, userid, itemtitle, username,value', 'required'),
            array('itemid, userid', 'numerical', 'integerOnly' => true),
            array('value', 'numerical'),
            array('itemtitle', 'length', 'max' => 128),
            array('username', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('itemid, userid, value, itemtitle, username', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'itemid' => 'Itemid',
            'userid' => 'Userid',
            'value' => 'Value',
            'itemtitle' => 'Itemtitle',
            'username' => 'Username',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('itemid', $this->itemid);
        $criteria->compare('userid', $this->userid);
        $criteria->compare('value', $this->value);
        $criteria->compare('itemtitle', $this->itemtitle, true);
        $criteria->compare('username', $this->username, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bid the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return array('itemid', 'userid');
    }

    /**
     * @param $userId id of item
     * @param $itemId
     * @return bool
     */
    public static function userBidItemBefore($userId, $itemId)
    {
        $bid = Bid::model()->findByPk(array('userid' => $userId, 'itemid' => $itemId));

        return $bid != null ? true : false;
    }

    /**
     * @param $itemId
     * @return bool
     */
    public static function getHighestBidOfItem($itemId)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(value)';
        $criteria->addColumnCondition(array('itemid' => $itemId));
        $model = Bid::model();
        $value = $model->commandBuilder->createFindCommand(
            $model->tableName(), $criteria)->queryScalar();

        return $value;
    }

    /**
     * @param $itemId
     * @return null
     */
    public static function getHighestBidderId($itemId)
    {
        $bid = Bid::model()->findByAttributes(array('itemid' => $itemId, 'value' => Bid::getHighestBidOfItem($itemId)));

        return $bid != null ? $bid->userid : null;
    }

    /**
     * @param $itemId
     * @return array
     */
    public static function getBiddersOfItem($itemId)
    {
        $bids = Bid::model()->findAllByAttributes(array('itemid' => $itemId));
        $biddersInfo = array();
        foreach ($bids as $bid) {
            $bidderInfo = array();
            $bidderInfo['username'] = $bid->username;
            $bidderInfo['userid'] = $bid->userid;
            $bidderInfo['value'] = $bid->value;
            $biddersInfo[] = $bidderInfo;
        }

        return $biddersInfo;
    }

    /**
     * @param $userId
     * @return array
     */
    public static function getUserBids($userId)
    {
        $bids = Bid::model()->findAllByAttributes(array('userid' => $userId,));
        $bidsInfo = array();
        foreach ($bids as $bid) {
            $bidInfo = array();
            $bidInfo['itemtitle'] = $bid->itemtitle;
            $bidInfo['itemid'] = $bid->itemid;
            $bidInfo['value'] = $bid->value;
            $bidsInfo[] = $bidInfo;
        }

        return $bidsInfo;
    }

    /**
     * @param $itemId
     * @return bool
     */
    public static function itemHasBids($itemId)
    {
        $bids = Bid::model()->findAllByPk(array('itemid' => $itemId, 'userid' => '*'));

        return ($bids != null || count($bids) != 0) ? false : true;
    }
}
