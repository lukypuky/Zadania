<?php
    include 'config.php';

    $sql = "SELECT * FROM statistics";
    $stm = $connect->query($sql);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if($result)
    {
        $sql2 = "UPDATE statistics SET country='Congo' WHERE country = 'Congo (Brazzaville)' ";
        $stm2 = $connect->query($sql2);

        $sql3 = "UPDATE statistics SET country='DR Congo' WHERE country = 'Congo (Kinshasa)'";
        $stm3 = $connect->query($sql3);

        $sql4 = "UPDATE statistics SET country='Czech Republic (Czechia)' WHERE country = 'Czech Republic' ";
        $stm4 = $connect->query($sql4);

        $sql5 = "UPDATE statistics SET country='Iran' WHERE country = 'Iran (Islamic Republic of)' ";
        $stm5 = $connect->query($sql5);

        $sql6 = "UPDATE statistics SET country='South Korea' WHERE country = 'Korea, South' ";
        $stm6 = $connect->query($sql6);

        $sql7 = "UPDATE statistics SET country='Macao' WHERE country = 'Macao SAR'";
        $stm7 = $connect->query($sql7);

        $sql8 = "UPDATE statistics SET country='Macao' WHERE country = 'Macau'";
        $stm8 = $connect->query($sql8);

        $sql9 = "UPDATE statistics SET country='China' WHERE country = 'Mainland China'";
        $stm9 = $connect->query($sql9);

        $sql10 = "UPDATE statistics SET country='Cruise Ship' WHERE country = 'Others'";
        $stm10 = $connect->query($sql10);

        $sql11 = "UPDATE statistics SET country='Ireland' WHERE country = 'Republic of Ireland'";
        $stm11 = $connect->query($sql11);

        $sql12 = "UPDATE statistics SET country='South Korea' WHERE country = 'Republic of Korea'";
        $stm12 = $connect->query($sql12);

        $sql13 = "UPDATE statistics SET country='Taiwan' WHERE country = 'Taiwan*'";
        $stm13 = $connect->query($sql13);

        $sql14 = "UPDATE statistics SET country='United Kingdom' WHERE country = 'UK'";
        $stm14 = $connect->query($sql14);

        $sql15 = "UPDATE statistics SET country='United States' WHERE country = 'US'";
        $stm15 = $connect->query($sql15);

        $sql16 = "UPDATE statistics SET country='Vietnam' WHERE country = 'Viet Nam'";
        $stm16 = $connect->query($sql16);

        $sql17 = "UPDATE statistics SET country='Russia' WHERE country = 'Russian Federation'";
        $stm17 = $connect->query($sql17);

        $sql18 = "UPDATE statistics SET country='Moldova' WHERE country = 'Republic of Moldova'";
        $stm18 = $connect->query($sql18);

        $sql19 = "UPDATE statistics SET country='Bahamas' WHERE country = 'The Bahamas'";
        $stm19 = $connect->query($sql19);
    }
    
    header('location: index.php');
?>