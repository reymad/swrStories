<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 07/03/2017
 * Time: 18:14
 */
use kartik\icons\Icon;
use kartik\social\FacebookPlugin;
use kartik\social\TwitterPlugin;
use yii\helpers\Url;

?>
<div class="widget-wrap ohidden"
         style="
                width: 10%;
                min-width: 160px;
                border: 1px solid #ddd;
                margin: .5em auto;
                padding: 20px 15px 10px 15px;
                ">

    <div class="users centered"
         style="margin-bottom: 10px;">
        <?php
           Icon::show('users',['class'=>'fa-4x'],Icon::FA);
        ?>
    </div>

    <div class="fb fleft">
        <?php
        echo FacebookPlugin::widget(['type'=>FacebookPlugin::SHARE, 'settings' => [
            'layout' => 'button',
            'href' => Url::home(true),
        ]
        ]);
        ?>
    </div>
    <div class="tw fright"
         style="padding-top: 2px;">
        <?php
        echo TwitterPlugin::widget(['type'=>TwitterPlugin::SHARE, 'settings' => [
            'size'=>'medium',
            'text'=> 'Hello World',
            'url'=> Url::home(true),
        ]
        ]);
        ?>
    </div>
</div>
