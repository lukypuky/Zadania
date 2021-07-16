<?php
    include 'config.php';

    $sql = "SELECT * FROM statistics";
    $stm = $connect->query($sql);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if($result)
    {
        $sql2 = "TRUNCATE TABLE statistics";
        $stm2 = $connect->query($sql2);
    }

    header('location: index.php');
?>