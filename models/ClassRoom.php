<?php


namespace app\models;
use app\core\db\DbModel;

class ClassRoom extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public string $avatar = '';
    public string $description = '';
    public string $building = '';
    public  $updated_at =  null;

    public static function tableName(): string
    {
        return 'classrooms';
    }

    public function attributes(): array
    {
        return ['id','name', 'avatar', 'description', 'building', 'updated_at'];
    }


    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'building' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 1], [self::RULE_MAX, 'max' => 10]],
        ];
    }
}
