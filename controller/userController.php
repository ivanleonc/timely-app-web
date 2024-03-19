<?php

session_start();

require_once("../models/Users.php");

$user = new Users();

$id_user = isset($_POST["id_user"]) ? $_POST["id_user"] : "";
$name = isset($_POST["name_user"]) ? $_POST["name_user"] : "";
$last_name = isset($_POST["last_name_user"]) ? $_POST["last_name_user"] : "";
$username = isset($_POST["username_user"]) ? $_POST["username_user"] : "";
$email = isset($_POST["email_user"]) ? $_POST["email_user"] : "";
$password = isset($_POST["password_user"]) ? $_POST["password_user"] : "";
$image = isset($_FILES["image_user"]) ? $_FILES["image_user"]["name"] : "";

switch ($_GET["op"]) {
    case "SaveAndUpdate":
        $key = '';

        if (!empty($_FILES["image_user"]["name"])) {
            $image = $_FILES["image_user"]["name"];
            $temp_file = $_FILES["image_user"]["tmp_name"];
            $image_folder = "../files/users/";
            move_uploaded_file($temp_file, $image_folder . $image);
        }

        if (!empty($password)) {
            $key = hash("SHA256", $password);
        }

        if (!empty($id_user)) {
            $rspta = $user->update($id_user, $name, $last_name, $username, $email, $key, $image);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        } else {
            $rspta = $user->insert($name, $last_name, $username, $email, $key, $image);
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
        }
        break;
    case "deactivate":
        $rspta = $user->deactivate($id_user);
        echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
        break;
    case "activate":
        $rspta = $user->activate($id_user);
        echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
        break;
    case "show":
        $rspta = $user->show($id_user);
        echo json_encode($rspta);
        break;
    case "list":
        $rspta = $user->toList();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->state) ? '<button class="btn btn-warning btn-xs" onclick="show(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . '' .
                    '<button class="btn btn-danger btn-xs" onclick="deactivate(' . $reg->id . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning btn-xs" onclick="show(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . '' .
                    '<button class="btn btn-primary btn-xs" onclick="activate(' . $reg->id . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->name,
                "2" => $reg->last_name,
                "3" => $reg->username,
                "4" => $reg->email,
                "5" => "<img src='../files/users/" . $reg->image . "' height='50px' width='50px'>",
                "6" => ($reg->state) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">desactivado</span>'
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
    case 'verify':
        $logina = isset($_POST['logina']) ? $_POST['logina'] : "";
        $clavea = isset($_POST['clavea']) ? $_POST['clavea'] : "";
        $key = hash("SHA256", $clavea);

        $rspta = $user->verify($logina, $key);
        
        $fetch = $rspta->fetch_object();

        if (isset($fetch)) {
            $_SESSION['iduser'] = $fetch->iduser;
            $_SESSION['name'] = $fetch->name;
            $_SESSION['image_user'] = $fetch->image;
            $_SESSION['username'] = $fetch->username;
        }
        echo json_encode($fetch);
        
        break;
    case 'exit':
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        break;
}
?>
