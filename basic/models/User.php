<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $uid
 * @property string $nickname
 * @property string $mobile
 * @property string $email
 * @property integer $sex
 * @property string $avatar
 * @property string $login_name
 * @property string $login_pwd
 * @property string $login_salt
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    //生成加密密码  密码加密算法 = md5(login_pwd+md5(login_salt))
    public function getSaltPassword($password)
    {
        return md5($password.md5($this->login_salt));
    }
    public function SetSalt($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        $salt = '';
        for($i=0;$i<$length;$i++){
            $salt .=$chars[mt_rand(0,strlen($chars)-1)];
        }
        $this->login_salt=$salt;
    }
    //设置密码
    public function setPassword($password)
    {
        $this->login_pwd = $this->getSaltPassword($password);
    }

    //校验密码是否正确
    public function verifyPassword($password)
    {
        if($this->getSaltPassword($password) == $this->login_pwd){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['nickname', 'email'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 15],
            [['avatar'], 'string', 'max' => 64],
            [['login_name'], 'string', 'max' => 20],
            [['login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['login_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'nickname' => 'Nickname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'sex' => 'Sex',
            'avatar' => 'Avatar',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'status' => 'Status',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}
