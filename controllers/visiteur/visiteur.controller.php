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

function imageToJson(){
    $directory = "public/assets/images/profils/profils_site/";
    if (is_dir($directory)) {
        $files = scandir($directory); 
    
        $imageList = array(); // Tableau pour stocker les noms des images
    
        // Parcourir les fichiers
        foreach ($files as $file) {
            // Vérifiez si le fichier est une image (vous pouvez ajouter d'autres vérifications si nécessaire)
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'))) {
                $imageList[] = $file; // Ajoutez le nom de l'image au tableau
            }
        }
    
        // Convertir le tableau en JSON
        sendJSON($imageList);
    
        
    }



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

function json_user_to_update($id){

    $userinfo = userToUpdateFromBD($id);
    sendJSON($userinfo);

}
function updateUser($id, $name, $age, $height, $avatar){
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    if($name!=""){updateUserNameBD($id, $name);};
    if($age!=""){updateUserAgeBD($id, $age);};
    if($height!=""){updateUserHeightBD($id, $height);};
    if($avatar!=""){updateUserAvatarBD($id, $avatar);};

}

 
