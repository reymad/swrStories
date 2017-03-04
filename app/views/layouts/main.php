<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\FrontAsset;
use kartik\icons\Icon;
use kartik\widgets\Growl;
use russ666\widgets\Countdown;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

FrontAsset::register($this);
// mapeamos Font-awesome
Icon::map($this,Icon::FA);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="site front">
<?php $this->beginBody() ?>


<?php foreach (Yii::$app->session->getAllFlashes() as $message){ ?>
    <?php
    echo Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php } ?>

<div class="wrap">
    <?php
        echo $this->render('_menu');
    ?>
    <!--
    <div class="container pic-container">
        <?php /*echo Html::img($this->context->imagesUrl.'forest.jpg',[])*/ ?>
    </div>
    -->

    <div class="container">

        <div class="countdown fright">
            <?php
                // echo Icon::show('birthday-cake', ['class'=>'fa-6x text-sunset'] );
                // echo '&nbsp;&nbsp;';
            ?>
        </div>
    </div>
    <div class="content <?php if( isset($this->context->container) && $this->context->container===false ) echo ''; else echo 'container'; ?>">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Jesús Rey <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::t('yii', 'Powered by {yii}',['yii' => Icon::show('heart', ['class'=>'text-sunset'] )]) ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
