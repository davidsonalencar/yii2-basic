<?php

use yii\helpers\Html;
use app\modules\main\assets\MainAsset;

/* @var $this \yii\web\View */
/* @var $content string */

MainAsset::register($this);
$this->beginContent('@app/modules/main/views/layouts/_base.php'); ?>

    <?php
        echo $this->render('main/navbar');
        echo $this->render('main/sidenav');
    ?>

    <?=$content?>



<?php $this->endContent();