<?php

use app\components\Helpers;
use kartik\icons\Icon;
use kartik\social\TwitterPlugin;
use russ666\widgets\Countdown;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="">
            <?=Yii::t('app','site.index.welcome')?>
        </h1>
    </div>

    <div class="timeline users text-center">
        <div class="wrap-cake">
            <?= Yii::$app->view->render('partials/_cake') ?>
        </div>
    </div>

</div>
<div class="body-content clear">

    <div class="bloque text-center bloque-darker">
        <div class="container">
            <div class="bloque text-center">
                <?=Yii::t('app','site.thanks')?>
                <br>&middot;<br>
                <?=Yii::t('app','site.thanks.2')?>
                <br>&middot;<br>
                <?=Yii::t('app','site.thanks.3')?>
            </div>

            <div class="album">
                <?= Yii::$app->view->render('partials/_album') ?>
            </div>

        </div>
    </div>

    <div class="container">

        <div id="question" class="bloque">
            <h1 class="question">
                <?=Yii::t('app','site.como-funciona.question')?>
            </h1>
            <h3 class="text-grey-light"><?=Yii::t('app','site.como-funciona.question-answer')?></h3>
            <br>
            <ol id="list-steps">
                <li><?=Yii::t('app','site.como-funciona.question-answer.1')?></li>
                <li><?=Yii::t('app','site.como-funciona.question-answer.2')?></li>
                <li><?=Yii::t('app','site.como-funciona.question-answer.3')?></li>
                <li><?=Yii::t('app','site.como-funciona.question-answer.4')?></li>
            </ol>
        </div>

        <div class="bloque ohidden">
            <?= Yii::$app->view->render('partials/_envelope') ?>
        </div>

    </div>


</div>

