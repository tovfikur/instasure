<?php

namespace App\Services;


trait FirebaseService
{
    private static function get_firebase_db()
    {
        return app('firebase.database');
    }

    /**
     * Store device info after diagnosis
     * @param Strign $table Firebase table name
     * @param Mixed|Array|Object $data
     */

    public static function  create(string $table, array $data)
    {
        ## Get firebase connectoin
        $database =  self::get_firebase_db();
        $new_recode = $database->getReference($table)->push($data);
        if ($new_recode) {
            return $database->getReference($table)->getValue();
        } else {
            return false;
        }
    }

    /**
     * Find by device serial number
     * @param String $table Firebase table name
     * @param Mixed|Array|Object $data
     */
    public static function create_or_update($table, $data)
    {
        ## Get firebase connectoin
        $database =  self::get_firebase_db();
        $values = $database->getReference($table)->getValue();

        ## Find existing device
        $key = null;
        if (is_array($values) && count($values)) {
            foreach ($values as $index => $value) {
                if ($value['serial_number'] == $data['serial_number']) {
                    $key = $index;
                }
            }
        }

        ## Create or update
        if (!empty($key)) {
            $database->getReference($table . '/' . $key)->update($data);
        } else {
            self::create($table, $data);
        }
        return;
    }
}
