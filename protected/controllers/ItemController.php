<?php

class ItemController extends Controller
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
            array(
                'allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view','admin'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'uploadPhoto','delete', 'previewPhoto'),
                'users' => array('@'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Item;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Item'])) {
            $model->attributes = $_POST['Item'];
            $model->status = Item::NOT_SOLD;
            if ($model->save()) {
                if ($model->picture) {
                    if ($model->savePhoto($model->picture)) {
                        Yii::app()->user->setFlash('success', Yii::t('default', 'Item has been added successfully.'));
                        $this->redirect(array('view', 'id' => $model->id));
                    } else {
                        Yii::app()->user->setFlash('error', 'Could not save the picture.');
                    }
                }
                Yii::app()->user->setFlash('success', Yii::t('default', 'Item has been updated successfully.'));
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', CHtml::errorSummary($model));
            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Item'])) {
            $model->attributes = $_POST['Item'];
            if ($model->save()) {
                if (isset($model->picture)) {
                    if ($model->savePhoto($model->picture)) {
                        Yii::app()->user->setFlash('success', Yii::t('default', 'Item has been updated successfully.'));
                        $this->redirect(array('view', 'id' => $model->id));
                    } else {
                        Yii::app()->user->setFlash('error', 'Could not save the picture.');
                    }
                }
                Yii::app()->user->setFlash('success', Yii::t('default', 'Item has been updated successfully.'));
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', CHtml::errorSummary($model));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        unlink($model->picture);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
            $dataProvider = new CActiveDataProvider('Item');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Item('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Item'])) {
            $model->attributes = $_GET['Item'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Item the loaded model
     * @throws CHttpException
     */
    public
    function loadModel(
        $id
    ) {
        $model = Item::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Item $model the model to be validated
     */
    protected
    function performAjaxValidation(
        $model
    ) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Get the uploaded photo from user and move it to temp folder after changing its name to the entered parameter
     *
     * @param string $photo_name photo name
     * @param boolean $other if it's insurance or pricing request, other extensions are allowed
     *
     * @return array array of filename and extension
     */
    public
    function actionUploadPhoto(
        $photo_name
    ) {
        $allowedExtensions = array();
        $folder = Yii::app()->basePath . '//temp//'; // folder for uploaded files
        //check if there's uploaded image to temp or not
        $path_without_extension = $folder . $photo_name;
        $results = glob($path_without_extension . ".*");
        if ($results) {
            $path_with_filename_and_extension = $results[0];
            unlink($path_with_filename_and_extension);
        }
        //the extension
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $allowedExtensions = Yii::app()->params['photo_allowed_extension'];
        $sizeLimit = Yii::app()->params['max_photo_size'];
        // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        //it's needed for the linux server
        $return = htmlspecialchars($result['filename'], ENT_NOQUOTES);
        //path to temp folder where we keep the photo after uploading
        $url = Yii::app()->request->baseUrl . "/protected/temp/";
        //path of uploaded photo
        $path_without_extension = $folder . $return;
        //get the extension
        $file_extension = pathinfo($result['filename'], PATHINFO_EXTENSION);
        //the path of the uploaded photo with photo extension
        $path_with_filename_and_extension = $folder . $photo_name . '.' . $file_extension;
        //we need to get rid of the original photo name to avoid dots and strange characters
        rename($path_without_extension, $path_with_filename_and_extension);
        //we need to extract extension of photo and also the fileName without extension
        $info = pathinfo($path_with_filename_and_extension);
        //here we keep the file name
        $file_name = basename($path_with_filename_and_extension, '.' . $info['extension']);
        //photo to display in browser
        $file = $file_name . '.' . $file_extension;
        $output = array(
            "file_url" => $url . $file,
            'file_path' => $folder . $file,
            'extension' => $info['extension'],
            'Success' => 'true'
        );
        echo json_encode($output);
    }

    /**
     * Preview photo
     * @param integer $id id of the image
     */
    public
    function actionPreviewPhoto(
        $id
    ) {
        $item = Item::getItemById($id);
        $full_path = $item->picture;
        if (file_exists($full_path)) {
            $extension = pathinfo($full_path, PATHINFO_EXTENSION);
            // Determine Content Type
            switch ($extension) {
                case "gif":
                    $ctype = "photo/gif";
                    break;
                case "png":
                    $ctype = "photo/png";
                    break;
                case "jpeg":
                case "jpg":
                    $ctype = "photo/jpg";
                    break;
                default:
                    $ctype = "application/force-download";
            }

            header("Pragma: public"); // required
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false); // required for certain browsers
            header("Content-Type: $ctype");
//            header('Content-Type:' . $extension);
            header('Content-Length: ' . filesize($full_path));
            readfile($full_path);
        }
    }
}
