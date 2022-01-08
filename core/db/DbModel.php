<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDO;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    public static ?string $sql = null;
    public static ?array $where = null;
    public static ?array $whereLike = null;
    public static ?int $offset = null;
    public static ?int $limit = null;
    public static ?string $orderType = null;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    private static function reset()
    {
        self::$sql = null;
        self::$where = null;
        self::$whereLike = null;
        self::$offset = null;
        self::$limit = null;
        self::$orderType = null;
    }


    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");


        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => "$attr = :$attr", $attributes);

        $sql = "UPDATE $tableName SET " . implode(",", $params) . " WHERE id = :id";
        // $sql = "UPDATE classrooms SET id = :id,name = :name,avatar = :avatar,description = :description,building = :building,updated_at = :updated_at WHERE id = :id";

        $statement = self::prepare($sql);
        $data = [];
        foreach ($attributes as $attribute) {
            $data[$attribute] = $this->{$attribute};
        }
        $statement->execute($data);
        return true;
    }


    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function where($where = [])
    {
        if (count($where) === 0) return new static();
        $attributes = array_keys($where);
        self::$where = $where;
        self::$sql = implode(" AND", array_map(fn ($attr) => " $attr = :$attr", $attributes));
        return new static();
    }


    public static function whereLike($whereLike = [])
    {
        if (count($whereLike) === 0) return new static();
        $attributes = array_keys($whereLike);
        // $par = array_map(fn ($attr) => " $attr like :$attr", $attributes);
        // echo '<pre>';
        // print_r($par);
        // echo '</pre>';
        self::$whereLike = $whereLike;
        self::$sql = implode(" OR", array_map(fn ($attr) => " $attr like :$attr", $attributes));
        // echo self::$sql;
        return new static();
    }


    public static function orderBy($type)
    {
        self::$orderType = $type;
        return new static();
    }



    public static function offset($offset)
    {
        self::$offset = $offset;
        return new static();
    }

    public static function limit($limit)
    {
        self::$limit = $limit;
        return new static();
    }

    public static function get($fields = [])
    {
        $sql = self::$sql;
        $where = self::$where;
        $whereLike = self::$whereLike;
        $offset = self::$offset;
        $limit = self::$limit;
        $orderType = self::$orderType;
        $tableName = static::tableName();

        if (count($fields) > 0) {
            $fields = implode(",", $fields);
            $cmd = "SELECT $fields FROM $tableName";
        } else {
            $cmd = "SELECT * FROM $tableName";
        }


        if ($where) {
            $cmd .=  " WHERE " . $sql;
        }

        if ($whereLike) {
            $cmd .=  " WHERE " . $sql;
        }

        if ($limit) {
            $cmd .= " LIMIT $limit";
        }

        if ($offset) {
            $cmd .= " OFFSET $offset";
        }

        if($orderType){
            $cmd .= " ORDER BY " . $orderType;
        }


        $statement = self::prepare($cmd);

        if ($where) {
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }

        if ($whereLike) {
            foreach ($whereLike as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }

        self::reset();
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function destroy($id)
    {
        $tableName = static::tableName();
        $sql = "DELETE FROM $tableName
                WHERE id = :id";

        $statement = self::prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        }
        return false;
    }
}
