<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $login_id = '';
    public string $password = '';

    public function rules()
    {
        return [
            'login_id' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            'password' => [self::RULE_REQUIRED,  [self::RULE_MIN, 'min' => 6]],
        ];
    }
    
    public function login()
    {
        $user = User::findOne(['login_id' => $this->login_id]);
        if (!$user) {
            $this->addError('login_id', 'User does not exist with this login_id');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}
