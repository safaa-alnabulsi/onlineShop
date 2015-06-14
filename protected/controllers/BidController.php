<?php

class BidController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view','admin'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','delete'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        if (isset($_POST['itemid']) && isset($_POST['bidvalue'])) {
            //init variables
            $itemId = $_POST['itemid'];
            $userId = Yii::app()->user->id;
            $bidValue = $_POST['bidvalue'];

            //update item model
            $item_model = Item::getItemById($itemId);
            $item_model->last_bid_by = $userId;

            if ($item_model->save(false)) {
                $userBidItemBefore = Bid::userBidItemBefore($userId, $itemId);
                if (!$userBidItemBefore) {
                    //add new Bid
                    $bid_model = new Bid;
                    $bid_model->userid = $userId;
                    $bid_model->itemid = $itemId;
                } else {
                    //update the value or the title if it was changed
                    $bid_model = $this->loadModel($userId, $itemId);
                }

                $bid_model->username = User::getUsernameById($userId);
                $bid_model->itemtitle = $item_model->title;
                $bid_model->value = $bidValue;

                if ($bid_model->save()) {

                    Yii::app()->user->setFlash('success', Yii::t('default', 'Your Bid has been ' . ($userBidItemBefore ? "updated" : "added") . ' successfully.'));
                    echo "<div class='flash-msg'>" . "<br>";
                    $this->widget('application.extensions.bootstrap.widgets.TbAlert');
                    echo "</div>";
                    return;
                } else {
                    Yii::app()->user->setFlash('error', CHtml::errorSummary($bid_model));
                    echo "<div class='flash-msg'>" . "<br>";
                    $this->widget('application.extensions.bootstrap.widgets.TbAlert');
                    echo "</div>";
                    return;
                }


            } else {
                Yii::app()->user->setFlash('error', CHtml::errorSummary($item_model));
                echo "<div class='flash-msg'>" . "<br>";
                $this->widget('application.extensions.bootstrap.widgets.TbAlert');
                echo "</div>";
                return;
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Bid the loaded model
     * @throws CHttpException
     */
    public function loadModel($userId, $itemId)
    {
        $model = Bid::model()->findByPk((array('userid' => $userId, 'itemid' => $itemId)));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Bid $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bid-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
