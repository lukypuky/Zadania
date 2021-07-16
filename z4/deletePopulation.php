<?php
    include 'config.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    libxml_use_internal_errors(true);
    libxml_clear_errors();

    $sql = "SELECT * FROM world_population";
    $stm = $connect->query($sql);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if($result)
    {
        $sql2 = "TRUNCATE TABLE world_population";
        $stm2 = $connect->query($sql2);
    }

    header('location: population.php');
?>