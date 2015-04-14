<?php 
use app\modules\main\assets\LoginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

LoginAsset::register($this);
$this->params['class-css-footer'] = 'footer-login';
$this->beginContent('@app/modules/main/views/layouts/_base.php'); ?>
    <div class="container">
        <?=$content?>
    </div>
<?php $this->endContent();
