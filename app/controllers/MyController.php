<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 10:59
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;


class MyController extends Controller
{


    /*
     * hay que cerar y modificar este en dektrium
     *
     * dektrium/messages/user/es
     * 'Your account has been created and a message with further instructions has been sent to your email' =>
        'Tu cuenta ha sido creada y se te ha enviado un email a tu cuenta de correo para que confirmes y finalices el registro. <br>Si no ves el email, mira en tu carpeta de spam.
        <br><br><small>*Si sigues sin recibirlo o no lo encuentras por ningún lado :/ puedes volver a solicitar otro aquí » <a href="/user/resend">Solicitar otro email de confirmación</a></small>.'
     *
     // mine
    'Thank you, registration is now complete.' => 'Gracias , el registro ha finalizado y ya estás logado en la aplicación. Puedes crear tu tarjeta aquí » <a href="/post/create">Crear tarjeta</a>.',
     *
     * */

    // public $imagesUrl = '/assets/dist/images/';

    public $container = true;

    /*
    public function afterAction($action, $result)
    {
       $result = parent::afterAction($action, $result);
       // custom code here
       return $result;
    }
    */

    public function init()
    {
        parent::init();// only oringin
    }

    /*
     * Devuelve un array con las imagenes
     * de portada de las tarjetas
     * */
    public function getCardImages(){
        return include Yii::getAlias('@app') . '/config/cardImages.php';
    }

    // INFO::SUBO LAS FUNCIONES AL PARENT


    /* SUBIR A CONTROLLER

    const YIIJS = 'YIIJS';// console.log(YII)


    public  $_translations = [];

    public function init()
    {
        parent::init();

        // inicializamos estas variables js SIEMPRE!
        $globalJsVar  = "\n var " . self::YIIJS . " = {}; ";

        $globalHead   = [
            'url'=>[
                'current_url' => Url::base(true) . Yii::$app->request->url,
                // add here
            ],
            'usuario'=>[
                'guest' => Yii::$app->user->isGuest,
                // add here
            ],
            'entorno'=>[
                'env' => YII_ENV,
            ],
            // add here
        ];
        $json          = Json::encode($globalHead);
        $globalJsVar  .= "\n " . self::YIIJS . " = " . $json . ";";
        $this->view->registerJs($globalJsVar, View::POS_HEAD, 'js-global');

        #add your logic: read the cookie and then set the language
        $this->setLanguage();
        // registro las traudcciones que necesitamos desde el layout
        $this->registerLayoutTranslations();
    }


    public function registerJsTranslations()
    {
        if(is_array($this->_translations) && !empty($this->_translations)){
            $objeto = [ 't'=>[] ];
            foreach($this->_translations as $message => $translation){
                $objeto['t'][$message] = $translation;
            }
            $json    = Json::encode($objeto);
            // Merge array/object en javascript Object.assign(obj1,obj2,etc);
            $script  = "\nObject.assign(".self::YIIJS.", ".$json.");";
            $this->view->registerJs($script, View::POS_HEAD, 'js-translations');
        }
    }

    private function registerLayoutTranslations(){

        // add as many as you need
        $this->_translations['app.hola-mundo']               = Yii::t('app','hola-mundo');
        $this->_translations['app.adios-mundo']              = Yii::t('app','adios-mundo');
        $this->_translations['app.general.cargando']         = Yii::t('app','general-cargando');
        $this->_translations['app.general.politica-cookies'] = Yii::t('app','general-politica-cookies');
        $this->_translations['app.general.bienvenido']       = Yii::t('app','general-bienvenido');
        $this->_translations['app.general.aceptar']          = Yii::t('app','general-aceptar');

        $this->registerJsTranslations();

    }

    private function setLanguage(){

        if( ($lang = Yii::$app->request->get('lang')) && (ArrayHelper::isIn(Yii::$app->request->get('lang'), Yii::$app->params['idiomas']) ) )
        {
            $this->setCookie([
                'name' => 'lang',
                'value' => $lang,
                'expire' => time() + 86400 * 365,
            ]);
            $this->setLang($lang);
        }
        else if($lang = $this->getCookie('lang'))
        {
            $this->setLang($lang);
        }
        else
        {
            $this->setLang(Yii::$app->params['idioma_default']);
        }

    }

    public function getCookie($cookieName){
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has($cookieName))
            return $cookies->getValue($cookieName);
        return false;
    }

    public function setCookie($params=[]){
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie($params));
    }


    public function getLang(){
        return Yii::$app->language;
    }

    public function setLang($lang){
        Yii::$app->language = $lang;
    }

     */

}