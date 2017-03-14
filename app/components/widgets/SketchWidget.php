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

/* info */
// http://intridea.github.io/sketch.js/

class SketchWidget extends Widget
{

    public $dataProvider;
    public $linkUpdate=false;

    public function init()
    {

        $js = <<<JS

        $(function() {
            $.each(['#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#000', '#fff'], function() {
              $('#colors_demo .tools').append("<a href='#colors_sketch' data-color='" + this + "' style='width: 10px; background: " + this + ";'></a> ");
            });
            $.each([3, 5, 10, 15], function() {
              $('#colors_demo .tools').append("<a href='#colors_sketch' data-size='" + this + "' style='background: #ccc'>" + this + "</a> ");
            });
            $('#colors_sketch').sketch();
          });


JS;

        \Yii::$app->view->registerJs($js, View::POS_READY, 'sketch');


        parent::init();
    }

    public function run()
    {
            echo $this->render('_sketch');
    }
}