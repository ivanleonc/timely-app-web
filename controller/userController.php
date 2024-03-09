<?php

session_start();

require_once("..models/Users.php");

$user = new Users();

$iduser = isset($_POST["iduser"]) ? cleanString($_POST["iduser"]) :"";
$name = isset($_POST["name"]) ? cleanString($_POST["name"]) :"";
$last_name = isset($_POST["last_name"]) ? cleanString($_POST["last_name"]) :"";
$username = isset($_POST["username"]) ? cleanString($_POST["username"]):"";
$email = isset($_POST["email"]) ? cleanString($_POST["email"]) :"";
$password = isset($_POST["password"]) ? cleanString($_POST["password"]) :"";
$image = isset($_POST["image"]) ? cleanString($_POST["image"]) :"";

switch ($_GET["op"]) {
    case "SaveAndUpdate":
        $key = '';

        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
            $image = $_POST['current-image'];
        }else{
            $ext = explode('.', $_FILES['image']['name']);
            if($_FILES['image']['type']== "image/jpg" || $_FILES[("image")]["type"]== "image/jpeg" || $_FILES['image']['type'] == "image/png") {
                $image = round(microtime(true)).'.'. end($ext);
				move_uploaded_file($_FILES["image"]["tmp_name"], "../files/users/" . $image); 
        }
    }
    if(!empty($password)){
        $key = hash("SHA256", $password);
    }
    if(!empty($iduser)) {
        $rspta = $user->insert($name, $last_name, $username, $email, $key, $image);
        echo $rspta ? "Datos registrados correctamente": "No se pudo registrar todos los datos del usuario";
    } else {
        $rspta = $user->update($iduser, $name, $last_name, $username, $email, $key, $image);
        echo $rspta ? "Datos actualizados correctamente":"No se pudo actualizar los datos";
    }
    break;
    case "deactivate":
        $rspta = $user->deactivate($iduser);
        echo $rspta ? "Datos desactivados correctamente":"No se pudo desactivar los datos";
        break;
    case "activate":
        $rspta = $user->activate($iduser);
        echo $rspta ? "Datos activados correctamente":"No se pudo activar los datos";
        break;
    case "show":
        $rspta = $user->show($iduser);
        echo json_encode($rspta);
        break;
    case "list":
        $rspta = $user->toList();
        $data = array();

        while($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" =>($reg->state) ? '<button class="btn btn-warning btn-xs" onclick="show('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.''.
                                      '<button class="btn btn-danger btn-xs" onclick="deactivate('.$reg->iduser.')"><i class="fa fa-close"></i></button>':
                                      '<button class="btn btn-warning btn-xs" onclick="show('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.''.
                                      '<button class="btn btn-primary btn-xs" onclick="activate('.$reg->iduser.')"><i class="fa fa-check"></i></button>',
                                      "1" => $reg->name,
                                      "2" => $reg->last_name,
                                      "3"=> $reg->username,
                                      "4"=> $reg->email,
                                      "5"=> "<img src='../files/users/".$reg->image."'height='50px' width='50px'>",
                                      "6" => ($reg->state) ? '<span class="label bg-green">Activado</span>':'<span class="label bg-red">desactivado</span>'
            );
        }
        $results=array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        ); 
        echo json_encode($results);
        break;
    case 'verificar':
            
        $logina=$_POST['logina'];
        $clavea=$_POST['clavea'];
    
            
        $key=hash("SHA256", $clavea);
        
        $rspta=$usuario->verificar($logina, $clavehash);
    
        $fetch=$rspta->fetch_object();

        if (isset($fetch)) {
            $_SESSION['iduser']=$fetch->iduser;
            $_SESSION['name']=$fetch->name;
            $_SESSION['image']=$fetch->image;
            $_SESSION['username']=$fetch->username;
        }
        echo json_encode($fetch);
        break;
    case 'exit':
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        break;
}