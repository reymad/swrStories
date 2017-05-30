<?php

/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 11:27
 */
namespace app\components\widgets;


use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

class PostCardImageWidget extends Widget
{

    public $provider;
    public $model;
    public $hiddenField;
    private $js;

    public function init()
    {

        $this->provider = include \Yii::getAlias('@app') . '/config/cardImages.php';

        if(\Yii::$app->user->can('permisos_admin')){// jesus y dani solo

            $saltbaeImage = [];

            $saltbaeImage['saltbae'] = [
                'name' => 'saltbae',
                'ruta' => '/assets/dist/images/card/saltbae.png',
                'height' => '225px',
                'width'  => '225px',
            ];

            $this->provider = ArrayHelper::merge($this->provider, $saltbaeImage);
        }


        if($this->model->isNewRecord){
            $isNewRecord = 1;
            $color = '#fff';
        }else{
            $isNewRecord = 0;
            $color = $this->model->color;
        }
        $isNewRecord = ($this->model->isNewRecord) ? 1 : 0;
        $tieneImagen = (isset($this->model->imagen_portada) && $this->model->imagen_portada!='' ) ?  1: 0;
        $rutaImg = (!$isNewRecord && $this->model[$this->hiddenField]) ? $this->model[$this->hiddenField] : '';

        $this->js = <<<JS

            $('.post-card-item').on('click',function(){

                $('#btn-ver-mas').show();
                $('.post-card-item').removeClass('imageSelected').hide();
                $(this).addClass('imageSelected').show();
                var value = $(this).children('img').attr('src');
                $('input#hiddenImageSrc').val(value);


            });

             if($isNewRecord==0 && $tieneImagen==1){
                /* no es nuevo */
                $('img[src="$rutaImg"]').parent('li').css('background-color', '$color' ).click();
                $('#btn-ver-mas').show();
             }

             if($tieneImagen==0){
                $('#btn-ver-mas').hide();
             }


            $('#btn-ver-mas').on('click', function(){

                $('.post-card-item').removeClass('imageSelected').show();
                $('input#hiddenImageSrc').val('');
                $(this).hide();

                return false;

            });

JS;

        \Yii::$app->view->registerJs($this->js, View::POS_LOAD, 'postCardImages');

        parent::init();
    }

    public function run()
    {
            $provider = new ArrayDataProvider([
                'allModels' => $this->provider,
                'sort' => [
                    'attributes' => ['nombre'],
                ],
                'pagination' => false,
                /*
                'pagination' => [
                    'pageSize' => 10,
                ],
                */
            ]);

            Pjax::begin();

            echo ListView::widget([
                'dataProvider' => $provider,
                'options' => [
                    'tag' => 'ul',
                    'class' => 'post-card-wrapper',
                    'id'    => 'post-card-wrapper',
                ],
                'itemOptions' => [
                    'tag' => 'li',
                    'class' => 'post-card-item',
                ],
                'layout' => "\n{items}",
                // 'summary'=>'',
                'itemView' => function ($model, $key, $index, $widget) {

                    return $this->render('_postCardImage',[
                        'model'      => $model,
                        'index'      => $index,
                    ]);
                    // or just do some echo
                    // return $model->title . ' posted by ' . $model->author;
                },
            ]);

            Pjax::end();

            echo Html::activeHiddenInput($this->model, $this->hiddenField,['id'=>'hiddenImageSrc']);
            echo '<br><div>';
            echo Html::a(\Yii::t('app','post.cambiar-portada'), '#', ['id'=>'btn-ver-mas','class'=>'btn btn-primary centered','style'=>'display:none;']);
            echo '</div><br><br>';

    }
}