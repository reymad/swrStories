<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 06/03/2017
 * Time: 16:03
 */
use yii\helpers\Html;

$i=0;
?>
<section class="album">
    <!--portada-->
    <div class="pag-1" style="z-index: 4;background-color:<?=$model->color;?>" data-zindexclosed="4" data-zindexopen="1">
        <h1>page1</h1>
        <?php
            if($model->imagen_portada!=''){
                echo Html::img($model->imagen_portada,['class'=>'img img-responsive']);
            }
        ?>
        <span class="album-pager"><?=(++$i)?>/<?=(3+count($model->ficheros))?></span><!--min 2 pages always + last page-->
    </div>
    <!--next pages-->
    <div class="pag-2" style="z-index: 3;" data-zindexclosed="3" data-zindexopen="2">
        <h1>page2</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, tenetur.</p>
        <span class="album-pager"><?=(++$i)?>/<?=(3+count($model->ficheros))?></span>
    </div>
    <div class="pag-3" style="z-index: 2;" data-zindexclosed="2" data-zindexopen="3">
        <h1>page3</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, tenetur.</p>
        <span class="album-pager"><?=(++$i)?>/<?=(3+count($model->ficheros))?></span>
    </div>

    <!--last page-->
    <div class="" style="z-index: 0;">
        <h1>page4</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, tenetur.</p>
        <span class="album-pager"><?=(++$i)?>/<?=(3+count($model->ficheros))?></span>
    </div>
</section>
