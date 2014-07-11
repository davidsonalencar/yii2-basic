<?php

use yii\helpers\Html;
use app\assets\LoginAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        
        <div class="wrap">
            <?= $content ?>
        </div>

        <footer class="footer">
            <p class="pull-center text-center">&copy; My Company <?= date('Y') ?>. System Named.</p>
        </footer>

        <?php $this->endBody() ?>
        
    </body>
</html>
<?php $this->endPage() ?>
