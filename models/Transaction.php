<?php


namespace app\models;

use app\core\db\DbModel;

class Transaction extends DbModel
{
    public int $id = 0;
    public string $comment = '';
    public string $avatar = '';
    public string $description = '';
    public  $start_transaction_plan =  null;
    public  $end_transaction_plan =  null;
    public  $returned_date =  null;
    public int $device_id =  0;
    public int $teacher_id =  0;
    public int $classroom_id =  0;

    public static function tableName(): string
    {
        return 'device_transactions';
    }

    public function attributes(): array
    {
        return ['id', 'comment', 'start_transaction_plan', 'end_transaction_plan', 'returned_date', 'device_id', 'teacher_id', 'classroom_id'];
    }


    public function rules()
    {
        return [
            'device_id' => [self::RULE_REQUIRED],
            'teacher_id' => [self::RULE_REQUIRED],
            'classroom_id' => [self::RULE_REQUIRED],
            'end_transaction_plan' => [self::RULE_REQUIRED],
            'start_transaction_plan' => [self::RULE_REQUIRED],
        ];
    }
}
