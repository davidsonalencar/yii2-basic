<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>        
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <div class="wrapper">
        
            <?php $this->beginBody() ?>

            <?= $content ?>

            <footer class="footer">
                <p class="pull-center text-center small">&copy; My Company <?= date('Y') ?>. System Named.</p>
            </footer>

            <?php $this->endBody() ?>
            
        </div>
        
    </body>
</html>
<?php $this->endPage() ?>
