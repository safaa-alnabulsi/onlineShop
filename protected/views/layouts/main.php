<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php echo Yii::app()->bootstrap->init(); ?>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div>
    <!-- header -->

    <div id="mainmenu">

        <?php
        $this->widget('bootstrap.widgets.TbNav', array(
                'type' => TbHtml::NAV_TYPE_TABS,
                'items' => array(
                    array('label' => 'Items',
                        'url' => array('/item'),
                        'visible' => !Yii::app()->user->isGuest &&  Yii::app()->user->checkAccess('Item.Index')
                        ),
                    array('label' => 'Rights',
                        'url' => array('/rights'),
                        'visible' => !Yii::app()->user->isGuest &&  Yii::app()->user->checkAccess('Admin')
                    ),
                    array('url' => Yii::app()->getModule('user')->loginUrl,
                        'label' => Yii::app()->getModule('user')->t("Login"),
                        'visible' => Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->getModule('user')->registrationUrl,
                        'label' => Yii::app()->getModule('user')->t("Register"),
                        'visible' => Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->getModule('user')->profileUrl,
                        'label' => Yii::app()->getModule('user')->t("Profile"),
                        'visible' => !Yii::app()->user->isGuest && Yii::app()->user->checkAccess('User.Admin.View')
                    ),
                    array('url' => Yii::app()->getModule('user')->logoutUrl,
                        'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')',
                        'visible' => !Yii::app()->user->isGuest
                    ),
                )
            )
        ); ?>

    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by Safaa AlNabulsi.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
