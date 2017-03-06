<?php
/**
 * Created by PhpStorm.
 * User: Jesus
 * Date: 24/02/2017
 * Time: 16:53
 */
use app\components\Helpers;
use kartik\icons\Icon;
use mdm\admin\components\MenuHelper;
use russ666\widgets\Countdown;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

// frontend menu

NavBar::begin([
    'brandLabel' => 'Yii Project :: Frontend',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
        'id' => 'main-header',
    ],
]);

if(Yii::$app->user->isGuest){

    /* menu guest */

    echo Helpers::getGuestMenu();// pasamos el context para Icons api

}else{

    /* menu logado */

    /*
     // ejemplo
    Icon::map($this);
    echo Icon::showStack('square-o', 'twitter', ['class'=>'fa-lg']);
    */

    // si estamos logados por red social pintamos iconito
    $social = Helpers::getSocialConnected();
    $socialIcon = (!$social) ? '' : Icon::show($social, ['class'=>'social-icon'/*'fa-lg'*/] );

    // var_dump($socialIcon); exit;

    // logout va por form, lo excluimos de rbac
    $menu = MenuHelper::getAssignedMenu(Yii::$app->user->id);
    $logoutItem[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . trim($socialIcon) . trim(Yii::$app->user->identity->username) . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';

    if((Yii::$app->language=='en-US')){
        $lang = 'EN';
        $langItem = ['label' => /* Icon::show('es', [], Icon::FI) . */ 'Español', 'url' => Url::to([ '', 'lang' => 'es-ES']) ];
    }else{
        $lang = 'ES';
        $langItem = ['label' => /* Icon::show('us', [], Icon::FI) . */ 'English', 'url' => Url::to([ '', 'lang' => 'en-US']) ];
    }

    $logoutItem[] = ['label' => Icon::show('globe', ['class'=>'social-icon'/*'fa-lg'*/] ) . ' ' . $lang,
                        'items' => [ $langItem ]];
    $menu = \yii\helpers\ArrayHelper::merge($menu, $logoutItem);

    /* conutdown in menu
    $countdown[] = '<li>' . Icon::show('birthday-cake', ['class'=>'fa-x6 text-sunset'] ) .  '&nbsp;&nbsp;' . Countdown::widget([
            'datetime' => date('2017-09-08 00:00:00'),
            'format' => '%-m m %-W w %-d d %-H h %M min %S sec',
            'events' => [
                // 'finish' => 'function(){location.reload()}',
            ],
        ]) . '</li>';
    $menu = \yii\helpers\ArrayHelper::merge($menu, $countdown);
    */

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menu,
        'encodeLabels' => false,
    ]);
}

NavBar::end();

?>
