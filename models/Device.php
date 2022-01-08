<?php


namespace app\models;
use app\core\db\DbModel;

class Device extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public string $avatar = '';
    public string $description = '';
    public  $updated_at =  null;

    public static function tableName(): string
    {
        return 'devices';
    }

    public function attributes(): array
    {
        return ['id','name', 'avatar', 'description', 'updated_at'];
    }


    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
        ];
    }
}
