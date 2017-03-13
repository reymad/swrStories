<?php

/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 11:27
 */
namespace app\components\widgets;

use yii\base\Widget;
use yii\web\View;
use yii\widgets\ListView;

class AlbumWidget extends Widget
{

    public $dataProvider;
    public $linkUpdate=false;

    public function init()
    {

        $js = <<<JS
        $('.toggleModal').on('click', function(){
                var post_id = $(this).attr('data-post_id');
                console.log('toggle data-post_id');
                $('#modal-'+post_id).modal('show');
                return false;
        });
JS;

        \Yii::$app->view->registerJs($js, View::POS_READY, 'modalToggle');


        parent::init();
    }

    public function run()
    {
            $dataProvider = $this->dataProvider;

            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id'    => 'list-wrapper',
                ],
                // 'layout' => "{pager}\n{items}\n{summary}",
                'summary'=>'',
                'itemView' => function ($model, $key, $index, $widget) use ($dataProvider) {

                    return $this->render('_album',[
                        'model'      => $model,
                        'totalCount' => $dataProvider->getTotalCount(),
                        'index'      => $index,
                        'linkUpdate' => $this->linkUpdate,
                    ]);
                    // or just do some echo
                    // return $model->title . ' posted by ' . $model->author;
                },
            ]);
    }
}