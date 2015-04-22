<?php

use app\modules\main\assets\MainAsset;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

// Register Default Icon
Icon::map($this);
// Register FI Icon
Icon::map($this, Icon::FI);
// Register Asset
MainAsset::register($this);

$this->beginContent('@app/modules/main/views/layouts/_base.php'); ?>

    <?php
        echo $this->render('main/navbar');
        echo $this->render('main/sidenav');
    ?>
    
    <main>
        <h1 class="page-header">
            <?= Html::encode($this->title) ?>
        </h1>
        <div class="page-content">
            <?=$content?>
        </div>
    </main>

<?php $this->endContent();