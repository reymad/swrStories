<?php

namespace app\models;

use app\behaviors\UserBehavior;
use app\models\query\PostQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $post_id
 * @property string $title
 * @property string $nombre_persona
 * @property string $que_es
 * @property string $consejo
 * @property string $description
 * @property string $imagen_portada
 * @property string $lang
 * @property string $color
 * @property string $font
 * @property int $publico
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property User $createdBy
 */
class Post extends MyActiveRecord
{

    /** @inheritdoc */
    /*
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            UserBehavior::className(),
        ];
    }
    */

    public $canvas;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function getId(){
        return (int)$this->post_id;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description','color','imagen_portada','nombre_persona','font'], 'string'],
            [['created_by', 'created_at', 'updated_at', 'status','publico'], 'integer'],
            [['lang','title','que_es','description','consejo'], 'required'],
            [['title'], 'string', 'max' => 60 /*120*/],
            [['que_es','consejo','nombre_persona'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 5],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'nombre_persona' => Yii::t('app', '¿Cómo te llamas? *Queremos que Danielle sepa quién le ha dedicado esta tarjeta'),
            'title' => Yii::t('app', 'Title'),
            'font' => Yii::t('app', 'Font'),
            'que_es' => Yii::t('app', 'Qué es'),
            'consejo' => Yii::t('app', 'Consejo'),
            'description' => Yii::t('app', 'Description'),
            'lang' => Yii::t('app', 'Lang'),
            'color' => Yii::t('app', 'Color'),
            'publico' => Yii::t('app', 'Tarjeta pública'),
            'canvas'  => Yii::t('app', 'Canvas'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public function getFicheros(){

        return $this->hasMany(Fichero::className(), ['tabla_padre_id' => 'post_id'])
            ->andOnCondition(['tabla_padre' => self::tableName(), 'status'=>Fichero::STATUS_ACTIVE])->orderBy('created_at ASC');

    }

}
