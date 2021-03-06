<?php

include "DBConn.php";

$id = $_GET["id"];
$status = $pdo->query("SELECT * FROM `list` WHERE `id` = $id");
$statext = $status->fetch(PDO::FETCH_ASSOC);

function changeStatus($conn, $idd, $statt)
{
    if($statt["status"] == "niet klaar")
    {
        $sql = "UPDATE `list` SET `status` = 'klaar' WHERE `id` = ?";
        $query = $conn->prepare($sql);
        $query->execute(array($idd));
    
        $status = $conn->query("SELECT * FROM `list` WHERE `id` = $idd");
        $conc = $status->fetch(PDO::FETCH_ASSOC);

        return $conc["status"];
    }

    if($statt["status"] == "klaar")
    {
        $sql = "UPDATE `list` SET `status` = 'niet klaar' WHERE `id` = ?";
        $query = $conn->prepare($sql);
        $query->execute(array($idd));
    
        $status = $conn->query("SELECT * FROM `list` WHERE `id` = $idd");
        $conc = $status->fetch(PDO::FETCH_ASSOC);

        return $conc["status"];
    }
    
}

$end = changeStatus($pdo, $id, $statext);

echo $end;
?>