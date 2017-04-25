<?php

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tarjetas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'post.crear.tarjeta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            // 'description:ntext',
            [
                'attribute' => 'description',
                'format'=>'raw',
                'value' => function ($model) {
                    return "<div style=\"max-height: 50px; overflow: auto;\">{$model->description}</div>";
                },
            ],

            'lang',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->createdBy->username . ' [#'.$model->createdBy->id.']';
                },
            ],

            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return $model->formatDateI18n('created_at',Yii::$app->language);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    // return $model->formatDate('updated_at',Yii::$app->language);
                    return $model->formatDateI18n('created_at',Yii::$app->language);
                },
            ],
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model){

                    $ret = '';
                    if($model->status==$model::STATUS_ACTIVE){
                        $ret = Html::a(Yii::t('app','Borrar'),['delete','id'=>$model->post_id],
                            ['class'=>'btn btn-xs btn-danger btn-block',
                                'data'=>[
                                        'method' => 'post',
                                        'confirm' => 'Are you sure?',
                                        /*'params'=>['id'=>$model->post_id],*/
                                ]
                            ]
                        );
                    }
                    if($model->status==$model::STATUS_DELETED){
                        $ret = Html::a(Yii::t('app','Activar'),['activate','id'=>$model->post_id],
                            ['class'=>'btn btn-xs btn-primary btn-block',
                                'data'=>[
                                    'method' => 'post',
                                    'confirm' => 'Are you sure?',
                                    /*'params'=>['id'=>$model->post_id],*/
                                ]
                            ]
                        );
                    }
                    return $ret;

                }
            ],
            [
                'label' => 'photos',
                'format'=>'raw',
                'value' => function($model){

                    if(isset($model->ficheros) && is_array($model->ficheros)){
                        return count($model->ficheros);
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

<hr>
    <h3>Usuarios sin tarjeta</h3>
    <?php Pjax::begin(); ?>
    <?php

        /* sacamos users sin tarjetas aún */
        $dataProvider2 = new ActiveDataProvider([
            /*
                'query' => Post::find()
                    ->select('u.*')
                    ->rightJoin('user u', 'post.created_by = u.id')
                    ->where('post.post_id is NULL'),
            */
            'query' => User::find()
                    //->select('*')
                    ->leftJoin('post p', 'p.created_by = user.id')
                    ->where('p.post_id is NULL'),
            'pagination' => false,
        ]);

         echo GridView::widget([
            'dataProvider' => $dataProvider2,
            // 'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'header' => 'User sin Tarjeta',
                    'format'=>'raw',
                    'value' => function ($model) {
                        return $model->username . ' [#'.$model->id.']';;
                    },
                ],
                [
                    'attribute' => 'email',
                    'format'=>'raw',
                    'value' => function ($model) {
                        return $model->email;
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'format'=>'raw',
                    'value' => function ($model) {
                        return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                    },
                ],
                [
                    'attribute' => 'updated_at',
                    'format'=>'raw',
                    'value' => function ($model) {
                        return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->updated_at]);
                    },
                ],
                [
                    'attribute' => 'last_login_at',
                    'format'=>'raw',
                    'value' => function ($model) {
                        return ($model->last_login_at) ? Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->last_login_at]) : 'NEVER';
                    },
                ],
            ]
        ]);

    ?>
    <?php Pjax::end(); ?>

</div>


