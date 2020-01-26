<?php

namespace OC\DWJ_P4\model\frontend;

class Manager
{
    protected function dbConnect()
    {
        try {
            $db = new \PDO('mysql:host=localhost:8889;dbname=oc_forteroche; charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $db;
        } catch (\Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }
}
