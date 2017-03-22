<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 06/03/2017
 * Time: 16:03
 */
use kartik\icons\Icon;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$i=0;
$tieneFicheros=false;
$totalPages = $lastPage = 5;
if($model->ficheros && count($model->ficheros)>0){
    $totalPages = $lastPage = 5;
    $tieneFicheros=true;
}

$createdBy = (isset($model->nombre_persona)) ? $model->nombre_persona : $model->createdBy->username ;
$font = (isset($model->font) && $model->font!='') ? "font-family: " . $model->font . " !important;" : '' ;

?>
<section class="album" style="<?=$font?>">
    <!--portada-->
    <?php
    /*
    if($model->imagen_portada!=''){
       echo Html::img($model->imagen_portada,['class'=>'img img-responsive']);
    }
    */
    $backgroundImage = ($model->imagen_portada!='') ?
        'background-image: url('.$model->imagen_portada.'); background-repeat:no-repeat; background-position: center 75%;' : '';
    ?>
    <div class="pag-1" style="<?=$backgroundImage?>z-index: <?=$lastPage?>;background-color:<?=$model->color;?>" data-zindexclosed="<?=$lastPage?>" data-zindexopen="1">
        <h1><?=$model->title?></h1>
        <!---->
        <span class="album-pager">1/<?=$totalPages?></span><!--min 2 pages always + last page-->
    </div>

    <!-- ¿Qué es ? -->
    <div class="pag-2" style="z-index: <?=($lastPage-1)?>;" data-zindexclosed="<?=($lastPage-1)?>" data-zindexopen="2">
        <h4><?=Yii::t('app','¿Qué es para mí Danielle?')?></h4>
        <p>&middot;</p>
        <p>
            <?=$model->que_es?>
        </p>
        <!---->
        <span class="album-pager">2/<?=$totalPages?></span>
    </div>

    <!-- Consejo -->
    <div class="pag-3" style="z-index: <?=($lastPage-2)?>;" data-zindexclosed="<?=($lastPage-2)?>" data-zindexopen="3">
        <h4><?=Yii::t('app','¿Un consejo para esta nueva decada?')?></h4>
        <p>&middot;</p>
        <p>
            <?=$model->consejo?>
        </p>
        <!---->
        <span class="album-pager">3/<?=$totalPages?></span>
    </div>

    <!-- felicitacion -->
    <div class="pag-4" style="z-index: <?=($lastPage-3)?>; overflow-y: auto;" data-zindexclosed="<?=($lastPage-3)?>" data-zindexopen="4">
        <!--<h4><?=Yii::t('app','Felicitación')?></h4>-->
        <p>
            <?=$model->description?>

        </p>
        <!---->
        <span class="album-pager" style="top: 12px;">4/<?=$totalPages?></span>

    </div>

    <?php
        if($tieneFicheros) {
    ?>
            <!-- ver fotos -->
            <div class="" style="z-index:0; background-color:<?=$model->color;?>" >
                <h1><?=ucfirst(Yii::t('app','fotos'))?></h1>
                <p><?= Icon::show('picture-o', ['class'=>'fa-5x'] ); ?></p>
                <p><?php
                    echo  Html::a(Yii::t('app','Ver {total} {foto}',
                        [   'total'=> count($model->ficheros),
                            'foto' =>(count($model->ficheros)>1) ? Yii::t('app','fotos') : Yii::t('app','foto'),
                        ])
                        ,'#',['class'=>'toggleModal btn btn-primary','data-post_id'=>$model->post_id]);// ver js registered en AlbumWidget.php
                ?></p>
                <span class="album-pager"><?=Yii::t('app','By {username}', ['username' => $createdBy])?> &middot; 5/<?=$totalPages?></span><?php /*(++$i) ?>/<?= (++$i)/(3 + count($model->ficheros)) */ ?>
            </div>

    <?php
        }else{

            ?>

            <!--last page-->
            <div class="" style="z-index: 0; background-color:<?=$model->color;?>">
                <h1>&nbsp;</h1>
                <p><?= Icon::show('birthday-cake', ['class'=>'fa-5x'] ); ?></p>
                <h1><?=Yii::t('app','happy.birthday')?></h1>
                <!---->
                <span class="album-pager"><?=Yii::t('app','By {username}', ['username' => $createdBy ])?> &middot; <?=$lastPage?>/<?=$totalPages?></span>
            </div>

            <?php

        }
    ?>


</section>

<?php
    // para vista /post/index-user, widget property
    if($linkUpdate){
        ?>
            <div class="text-center">
                <?= Html::a(Yii::t('app', 'post.modificar.tarjeta'), ['/post/update','id'=>$model->post_id], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php
    }

    if($tieneFicheros){

            Modal::begin([
                // 'header'=>'<h4>Modal</h4>',
                'id'=>'modal-'.$model->post_id,
                'size'=>'modal-lg',
                'options' => [
                    //'style' => 'z-index:9999',
                ]
            ]);

            echo "<div id='modalContent text-center'><ul class='ul-foto'>";

                foreach($model->ficheros as $foto){
                    echo '<li class="li-foto">' . Html::img($foto->ruta_completa,['class'=>'img img-responsive']) . '</li>';
                }

            echo "</div></ul>";

            Modal::end();

    }

?>

