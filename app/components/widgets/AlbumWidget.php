<?php

/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 11:27
 */
namespace app\components\widgets;

use yii\base\Widget;
use yii\widgets\ListView;

class AlbumWidget extends Widget
{

    public $dataProvider;

    public function init()
    {
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
                    ]);
                    // or just do some echo
                    // return $model->title . ' posted by ' . $model->author;
                },
            ]);
    }
}