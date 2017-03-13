<?php

namespace app\models;

use app\rbac\RbacConf;
use mdm\admin\components\DbManager;
use Yii;

use \dektrium\user\models\User as BaseUser;// extendemos de la api

class User extends BaseUser {

    /*
     * to add
     * */
    public $status;
    public $password_reset_token;

    public $random = 'KJADSFASF7WAELA';

    public $soccialClient;


    // rbac check for rules and accesses
    // \Yii::$app->user->can('createPost')

    public function getIsAdmin(){
        return ($this->getRoleName()=='admin');
    }

    public function getIsDanielle(){
        return ($this->getRoleName()=='danielle');
    }

    /*
     * Devuelve nombre del role del user
     * */
    public function getRoleName()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->name;
    }

    /** @inheritdoc */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // INSERTAMOS ROL USUARIO POR DEFECTO CUANDO UN USUARIO SE REGISTRA
        $auth = new DbManager;
        $auth->init();
        $role = $auth->getRole(RbacConf::ROLE_USUARIO);
        $auth->assign($role, $this->id);

    }

    public function setSoccialClient($client){
        $this->soccialClient = $client;
    }

    /*
     * Relations
     * */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['created_by' => 'id']);
    }


}
