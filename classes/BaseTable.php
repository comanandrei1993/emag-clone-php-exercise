<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 15-Aug-20
 * Time: 4:44 PM
 */
class BaseTable {
    static function findBy($filters) {
        global $mysqli;

        $table = static::getTable();

        $criterias = [];
        foreach ($filters as $column => $value) {
            $criterias[] = "`".$column."`='".mysqli_real_escape_string($mysqli, $value)."'";
        }

        $query = mysqli_query($mysqli, "SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));
//        var_dump("SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));

        if ($query == false) {
            die('SQL error:'.mysqli_error($mysqli));
        }

        $dbData = $query->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($dbData as $data) {
            $class = static::class;
            $result[] = new $class($data);
        }

        return $result;
    }

    static function findByLike($filters) {
        global $mysqli;

        $table = static::getTable();

        $criterias = [];
        foreach ($filters as $column => $value) {
            $criterias[] = "`".$column."` LIKE '".mysqli_real_escape_string($mysqli, $value)."'";
        }

        $query = mysqli_query($mysqli, "SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));
//        var_dump($mysqli, "SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));

        $dbData = $query->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($dbData as $data) {
            $class = static::class;
            $result[] = new $class($data);
        }

        return $result;
    }

    static function findOneBy($filters) {
        $result = self::findBy($filters);

        if (count($result) > 0) {
            return $result[0];
        }

        return false;
    }

    static function find($id) {
        $result = self::findOneBy(['id' => $id]);

        if (isset($result)) {
            return $result;
        }

        return false;
    }
}