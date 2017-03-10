<?php

use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tarjetas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--
    <div class="social text-center">
        <?php /* echo Yii::$app->view->render('/site/partials/_social_sharer');*/ ?>
    </div>
    -->

    <?php
        if($dataProvider->getTotalCount()==0){

            // no tiene tarjeta
            ?>
                <p class="info">
                    <?=Yii::t('app','post.info.sin-tarjeta',['username'=>Yii::$app->user->identity->username ])?>
                </p>
                <br>
                <h1 class="text-center"><?=Icon::show('info-circle',[],Icon::FA)?>&nbsp;<?=Yii::t('app','post.sin-tarjeta')?></h1>
                <br>
                <p class="text-center">
                    <?= Html::a(Yii::t('app', 'post.crear.tarjeta'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

            <?php

        }else{
            ?>
                <p class="info">
                    <?=Yii::t('app','post.info.con-tarjeta',['username'=> Yii::$app->user->identity->username ])?>
                </p>
            <?php
                // mostramos la tarjeta, el botón para modificarla se incluiye en la vista del listView con linkUpdate = true
                echo \app\components\widgets\AlbumWidget::widget(['dataProvider'=>$dataProvider,'linkUpdate'=>true]);

        }
    ?>

</div>
