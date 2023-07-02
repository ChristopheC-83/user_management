<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https"  : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER["PHP_SELF"]));

require_once("./controllers/visiteur/visiteur.controller.php");
require_once("./controllers/administrateur/administrateur.controller.php");
require_once("./controllers/utilisateur/utilisateur.controller.php");
require_once("./controllers/functionController.controller.php");
require_once("./controllers/security.controller.php");
require_once("./controllers/images.controller.php");

try {
    if (empty($_GET['page'])) {
        $url[0] = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($url[0]) {
        case "accueil":
            pageAccueil();
            break;

        case "json_user_info":
            pageJsonUserInfo();
            break;
        case "imageToJson":
            imageToJson();
            break;

        case "create_user":

            if (!empty($_POST)) {
                $name = secureHTML($_POST['name']);
                $age = secureHTML($_POST['age']);
                $height = secureHTML($_POST['height']);
                $avatar = secureHTML($_POST['avatar']);
                createUser($name, $age, $height, $avatar);
            }
            break;

        case "delete_user":

            if (!empty($_POST)) {
                $id = secureHTML($_POST['id']);
                deleteUser($id);
            }
            break;

        case "update_user":
                
                $id = secureHTML($_POST['id']);
                $name = secureHTML($_POST['name']);
                $age = secureHTML($_POST['age']);
                $height = secureHTML($_POST['height']);
                $avatar = secureHTML($_POST['avatar']);
                updateUser($id, $name, $age, $height, $avatar);
            
            break;

        case "json_user_to_update":
            json_user_to_update($url[1]);
            break;


        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    pageErreur($e->getMessage());
}
 