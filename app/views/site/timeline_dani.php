<?php
/**
 * Created by PhpStorm.
 * User: Jesus
 * Date: 04/03/2017
 * Time: 10:27
 */
use app\models\Post;
use yii\data\ActiveDataProvider;

?>
<div class="din-wrap">

    <div class="timeline users text-center">
        <div class="wrap-cake">
            <?= Yii::$app->view->render('partials/_cake',['showTimeLeft'=>false]) ?>
        </div>
    </div>

    <h1 class="text-center"><?=Yii::t('dani','timeline.title',['username'=>'Danielle'])?></h1>

    <!--albums-->

    <div class="album">
        <?php
        // Yii::$app->view->render('partials/_album');

        // de momento hay que maquetar el listview para $model

            echo \app\components\widgets\AlbumWidget::widget(['dataProvider'=>$dataProvider]);

        ?>
        <noscript><?=Yii::t('app','noscript.message')?></noscript>
    </div>

</div>