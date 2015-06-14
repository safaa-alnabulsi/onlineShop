<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $picture
 * @property double $price
 * @property integer $created_by
 * @property string $created_date
 * @property integer $last_edited_by
 * @property string $last_edited_date
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Item extends CActiveRecord
{
    Const NOT_SOLD = 0;
    Const SOLD = 1;

    public $highestBid;

    /**
     * @return mixed
     */
    public function getHighestBid()
    {
        return $this->highestBid;
    }

    /**
     * @param mixed $highestBid
     */
    public function setHighestBid($highestBid)
    {
        $this->highestBid = $highestBid;
    }

    /**
     * @return mixed
     */
    public function getHighestBidder()
    {
        return $this->highestBidder;
    }

    /**
     * @param mixed $highestBidder
     */
    public function setHighestBidder($highestBidder)
    {
        $this->highestBidder = $highestBidder;
    }

    public $highestBidder;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, description, status', 'required'),
            array('status, created_by, last_edited_by,last_bid_by', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('title', 'length', 'max' => 128),
            array('description', 'length', 'max' => 550),
            array('picture', 'length', 'max' => 250),
            array('created_date, last_edited_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, status, picture, price, last_bid_by, created_by, created_date, last_edited_by, last_edited_date,highestBid,highestBidder', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::MANY_MANY, 'Users', 'bid(itemid, userid)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'picture' => 'Picture',
            'price' => 'Price',
            'last_bid_by' => 'Last Bid By',
            'highestBid' => 'Highest Bid',
            'highestBidder' => 'Highest Bidder',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('last_bid_by', $this->last_bid_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 10),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Item the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Get the item of the given Id
     * @param $id id of the item
     * @return Item
     */
    public static function getItemById($id)
    {
        return Item::model()->findByPk($id);
    }

    /**
     * save image to the uploaded foldermove the photo from temp folder to upload folder
     * @param $imageFullPath
     */
    public function savePhoto($imageOldFullPath)
    {
        $folder = Yii::app()->params['photos_folder_path'];
        $fileInfo = pathinfo($imageOldFullPath);
        $fileName = $this->id . '.' . $fileInfo['extension'];
        $newImagePath = $folder . $fileName;
        $result = copy($imageOldFullPath, $newImagePath);
        if ($result) {
            $this->picture = $newImagePath;
            $this->save();
            unlink($imageOldFullPath);
            return true;
        } else {
            return false;
        }
    }

}
