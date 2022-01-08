<?php


namespace app\models;
use app\core\db\DbModel;

class Teacher extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public string $avatar = '';
    public string $description = '';
    public string $specialized = '';
    public string $degree = '';
    public  $updated_at =  null;

    public static function tableName(): string
    {
        return 'teachers';
    }

    public function attributes(): array
    {
        return ['id','name', 'avatar', 'description', 'specialized', 'degree', 'updated_at'];
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'specialized' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 30]],
        ];
    }
}
