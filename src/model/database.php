<?php

function getDb()
{
    try {
        $db = new PDO("mysql://host=localhost;dbname=security", "root", "");
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

}