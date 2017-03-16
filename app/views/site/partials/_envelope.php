<?php
/**
 * Created by PhpStorm.
 * User: Jesus
 * Date: 04/03/2017
 * Time: 10:46
 */
$href = (YII_ENV=='prod') ? '/web/user/register' : '/user/register';
?>
<div id="envelope">
    <a href="<?=$href?>">
        <div id="lid"></div>
        <div id="letter">
            <div class="letter-content">
                <?=Yii::t('app','sobre.escribir')?>
            </div>
        </div>
        <div id="left-corner"></div>
        <div id="right-corner"></div>
    </a>
</div>

