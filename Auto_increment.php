<?php

// ເຮັດ Auto_increment ດວ້ຍ PHP PDO  ແບບ ບໍ່ຕ້ອງ ໃສ່ Auto_increment ໃນ SQL ສາມາດປະຍູກໃຊ້ກັບລະບົບ CRUD

$servername = "mysql:host=localhost;dbname=pdo_crud";
$username = "root";
$password = "";

try{
    $conn = new PDO($servername, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $sql_select = "SELECT MAX(id) as id FROM tbl_sample";
    $sql_select = $conn->query($sql_select);
    $result = $sql_select->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as  $number){
        echo $id_number=$number['id'];
    }
    
    if($id_number == 0){
        
        $id_number = 1;
    }else{
        
        $id_number = ($id_number + 1);
        
    }
    
    $sql_insert = "INSERT INTO tbl_sample (id)values(:id)";
    $sql_insert = $conn->prepare($sql_insert);
    $sql_insert->bindParam(":id", $id_number,PDO::PARAM_INT);
    $sql_insert->execute();
    
    
    }catch(PDOException $e){
        
    echo die($e->getMessage());
}




?>