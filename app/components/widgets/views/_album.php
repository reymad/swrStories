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
$totalPages = $lastPage = 4;
if($model->ficheros && count($model->ficheros)>0){
    $totalPages = $lastPage = 5;
    $tieneFicheros=true;
}
?>
<section class="album">
    <!--portada-->
    <div class="pag-1" style="z-index: <?=$lastPage?>;background-color:<?=$model->color;?>" data-zindexclosed="<?=$lastPage?>" data-zindexopen="1">
        <h1><?=$model->title?></h1>
        <?php
            if($model->imagen_portada!=''){
                echo Html::img($model->imagen_portada,['class'=>'img img-responsive']);
            }
        ?>
        <!---->
        <span class="album-pager">1/<?=$totalPages?></span><!--min 2 pages always + last page-->
    </div>

    <!-- ¿Qué es ? -->
    <div class="pag-2" style="z-index: <?=($lastPage-1)?>;" data-zindexclosed="<?=($lastPage-1)?>" data-zindexopen="2">
        <h1><?=Yii::t('app','¿Qué es para mí Danielle?')?></h1>
        <p>
            <?=$model->que_es?>
        </p>
        <!---->
        <span class="album-pager">2/<?=$totalPages?></span>
    </div>

    <!-- Consejo -->
    <div class="pag-3" style="z-index: <?=($lastPage-2)?>;" data-zindexclosed="<?=($lastPage-2)?>" data-zindexopen="3">
        <h4><?=Yii::t('app','¿Un consejo para esta nueva decada?')?></h4>
        <p>
            <?=$model->consejo?>
        </p>
        <!---->
        <span class="album-pager">3/<?=$totalPages?></span>
    </div>

    <!-- felicitacion -->
    <div class="pag-4" style="z-index: <?=($lastPage-3)?>;" data-zindexclosed="<?=($lastPage-3)?>" data-zindexopen="4">
        <h4><?=Yii::t('app','Felicitación')?></h4>
        <p>
            <?=$model->description?>
        </p>
        <!---->
        <span class="album-pager">4/<?=$totalPages?></span>
    </div>

    <?php
        if($tieneFicheros) {
    ?>
            <!-- ver fotos -->
            <div class="" style="z-index:0" >
                <h1><?=ucfirst(Yii::t('app','fotos'))?></h1>
                <p><?= Icon::show('picture-o', ['class'=>'fa-5x'] ); ?></p>
                <p><?php
                    echo  Html::a(Yii::t('app','Ver {total} {foto}',
                        [   'total'=> count($model->ficheros),
                            'foto' =>(count($model->ficheros)>1) ? Yii::t('app','fotos') : Yii::t('app','foto'),
                        ])
                        ,'#',['id'=>'toggleModal','class'=>'btn btn-primary']);// ver js registered en AlbumWidget.php
                ?></p>
                <span class="album-pager">5/<?=$totalPages?></span><?php /*(++$i) ?>/<?= (++$i)/(3 + count($model->ficheros)) */ ?>
            </div>

    <?php
        }else{

            ?>

            <!--last page-->
            <div class="" style="z-index: 0;">
                <h1>Last page no pìcs</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, tenetur.</p>
                <!---->
                <span class="album-pager"><?=$lastPage?>/<?=$totalPages?></span>
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
                'id'=>'modal',
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

