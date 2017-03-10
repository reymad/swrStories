<?php

use app\components\Helpers;
use app\components\widgets\FileUploadFormWidget;
use app\components\widgets\PostCardImageWidget;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\ColorInput;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

/*
<select>
    <option style="font-family : Arial">Arial</option>
    <option style="font-family : Courier">Courier</option>
    <option style="font-family : Tahoma">Tahoma</option>
    <option style="font-family : 'Times New Roman'">Times New Roman</option>
    <option style="font-family : Verdana">Verdana</option>
    <option style="font-family : 'Comic Sans MS'">Comic Sans</option>
</select>
*/

?>


<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

        /*
         * All tema de las postcards
         * */
        echo PostCardImageWidget::widget([
            'model' => $model,
            'hiddenField' => 'imagen_portada',
        ]);
    ?>

    <?php
        if($model->color=='') $model->color = 'white';
        echo $form->field($model, 'color')->widget(ColorInput::classname(), [
            // 'value' => '#fff',//($model->color!='') ? $model->color : '#fff',
            'options' => [
                'placeholder' => 'Select color ...',
            ],
            'pluginOptions' => [
                'showInput' => true,
                'showInitial' => true,
                'showPalette' => true,
                'showPaletteOnly' => true,
                'showSelectionPalette' => true,
                'showAlpha' => false,
                'allowEmpty' => false,
                'preferredFormat' => 'name',
                'palette' =>  Helpers::getPaletteColors(),
            ]
        ]);
    ?>

    <?php
    /*
        $title_maxlenght = $model->getAttributeRule('title','maxlenght');
        echo $form->field($model, 'title')->widget(CKEditor::className(), [
            'options' => [
                'rows' => 1,
                'maxlength' => $title_maxlenght,
            ],
            'preset' => 'advance',
        ]);
    */

        echo $form->field($model, 'title')->textInput(['maxlength' => true])

    ?>

    <?= $form->field($model, 'que_es')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consejo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
    ]) ?>

    <?php
        // echo $form->field($model, 'lang')->listBox(['es-ES'=>'Español','en-US'=>'English'])
        // echo Html::activeDropDownList($model, 'lang',['es-ES'=>'Español','en-US'=>'English']);
        if($model->isNewRecord){
            $model->lang = Yii::$app->language;
        }
    /*
        echo $form->field($model, 'lang')->widget(Select2::classname(), [
            'data' => ['es-ES'=>'Español','en-US'=>'English'],
            'language' => Yii::$app->language,
            'options' => [
                'placeholder' => $model->getAttributeLabel('lang'),
                'maxlenght' => true,
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    */

        echo $form->field($model, 'lang')->label(false)->hiddenInput(['value'=>$model->lang]);

    ?>

    <?php
        if($model->isNewRecord){
            $model->publico = 1;
        }
        echo $form->field($model, 'publico')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                // 'size' => 'large',
                'onColor' => 'success',
                'offColor' => 'danger',
                'onText' => 'Si',
                'offText' => 'No',
            ]
        ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        if(!$model->isNewRecord){
            echo FileUploadFormWidget::widget(['modelPadre' => $model]);
        }else{
            echo 'Guarda tu post y podrás proceder a subir las fotos ;)';
        }
    ?>

</div>
