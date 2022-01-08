<?php


namespace app\models;
use app\core\db\DbModel;

class User extends DbModel
{
    public int $id = 0;
    public string $login_id = '';
    public string $active_flag = '';
    public $updated_at = '';
    public string $lastname = '';
    public string $firstname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstname','login_id', 'lastname', 'email', 'password'];
    }

 
    public function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'login_id' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4] ],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}