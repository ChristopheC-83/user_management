<?php


header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once("./Models/pdo.model.php");

function getUserInfo()
{
    $req = "SELECT * 
    FROM userinfo2
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->execute();
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $info;
}

function sendJSON($info)
{
    // ACAO => * pout tlm 
    //  à remplacer par le nom du site autorisé à récupérer les données
    // on remplace * par le site qui sera le seul à pouvoir utiliser l'api
    header("Access-Control-Allow-Origin: *");
    // on indique le format des infos
    header("Content-Type: application/json");
    // pour un affichage plus sympa : JSON_PRETTY_PRINT
    echo json_encode($info, JSON_PRETTY_PRINT);
}

function createUserBD($name, $age, $height, $avatar)
{
    $req = "INSERT INTO userinfo2 (
    name,
    age,
    height,
    avatar
    ) VALUES (
    :name,
    :age,
    :height,
    :avatar
    )
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':age', $age, PDO::PARAM_INT);
    $stmt->bindValue(':height', $height, PDO::PARAM_INT);
    $stmt->bindValue(':avatar', $avatar, PDO::PARAM_STR);
    $stmt->execute();
    $validationOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $validationOk;
}

function deleteUserBD($id){

    $req = "DELETE from userinfo2
    WHERE id = :id
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $validationOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $validationOk;


}

function updateUserNameBD($id, $name){

    $req = "UPDATE userinfo2 SET 
    name = :name
    WHERE id = :id   
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':name',$name, PDO::PARAM_STR);
    $stmt->execute();
    $ModifOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $ModifOK;
}
function updateUserAvatarBD($id,$avatar){

    $req = "UPDATE userinfo2 SET 
    avatar = :avatar
    WHERE id = :id   
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':avatar', $avatar, PDO::PARAM_STR);
    $stmt->execute();
    $ModifOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $ModifOK;
}
function updateUserAgeBD($id,$age){

    $req = "UPDATE userinfo2 SET 
    age = :age
    WHERE id = :id   
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':age', $age, PDO::PARAM_INT);
    $stmt->execute();
    $ModifOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $ModifOK;
}
function updateUserHeightBD($id,$height){

    $req = "UPDATE userinfo2 SET 
    height = :height
    WHERE id = :id   
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':height', $height, PDO::PARAM_INT);
    $stmt->execute();
    $ModifOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $ModifOK;
}

function userToUpdateFromBD($id){
    $req = "SELECT * 
    FROM userinfo2
    WHERE id =:id
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $info;


}
