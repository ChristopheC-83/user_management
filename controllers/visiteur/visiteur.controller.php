<?php


header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');


require_once("./controllers/functionController.controller.php");
require_once("./models/visiteur/visiteur.model.php");
require_once("./controllers/functionController.controller.php");




function pageAccueil()
{
    if (isset($_SESSION['profil']['login'])) {
        $datas = getUserInformation($_SESSION['profil']['login']);
    } else {
        $datas = "";
    }

    $userinfo = getUserInfo();

    $data_page = [
        "page_description" => "Description accueil",
        "page_title" => "titre accueil",
        "view" => "views/pages/visiteur/accueil.view.php",
        "template" => "views/commons/template.php",
        "css" => "accueilContainer",
        "utilisateur" => $datas,
        "userinfo" => $userinfo,
    ];
    genererPage($data_page);
}

function pageErreur($msg)
{
    $data_page = [
        "page_description" => "Erreur !",
        "page_title" => "Erreur !",
        "view" => "views/pages/visiteur/erreur.view.php",
        "template" => "views/commons/template.php",
        "msg" => $msg,

    ];
    genererPage($data_page);
}

function pageJsonUserInfo()
{
    $userinfo = getUserInfo();
    sendJSON($userinfo);
}

function createUser($name, $age, $height ,$avatar)
{

    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    
    createUserBD($name, $age, $height ,$avatar);
}

function deleteUser($id){
    deleteUserBD($id);
}
function updateUser($id, $name, $age, $height, $avatar){
    updateUserBD($id, $name, $age, $height, $avatar);
}
