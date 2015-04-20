<?php 
use app\modules\main\assets\LoginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

LoginAsset::register($this);
$this->beginContent('@app/modules/main/views/layouts/_base.php'); ?>
    <?=$content?>
<?php $this->endContent();
