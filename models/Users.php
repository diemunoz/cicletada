<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property integer $activate
 * @property integer $activateAdmin
 * @property integer $role
 *
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public static function getDb()
     {
       return Yii::$app->db;
     }

     public static function tableName()
     {
       return 'TB_Users';
     }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authKey', 'accessToken'], 'required'],
            [['activate', 'activateAdmin', 'role'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'activate' => 'Activate',
            'activateAdmin' => 'Activate Admin',
            'role' => 'Role',
            'codproductor' => 'CodProductor',
        ];
    }

}
