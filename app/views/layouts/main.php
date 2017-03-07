<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\FrontAsset;
use app\models\Post;
use kartik\icons\Icon;
use kartik\widgets\Growl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

FrontAsset::register($this);
// mapeamos Font-awesome
Icon::map($this,Icon::FA);
// Icon::map($this,Icon::FI);

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
        'type' => (!empty($message['type'])) ? $message['type'] : 'success',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-smile-o',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : '',
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

    <div class="collage">
        <?php /* echo Html::img($this->context->imagesUrl.'collage1.jpg',['class'=>'img img-responsive']); */ ?>
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
