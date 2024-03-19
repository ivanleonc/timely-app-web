<?php
require_once "../models/Employee.php";

$employee = new Employee();

$employee_id = isset($_POST["id_employee"]) ? cleanString($_POST["id_employee"]) :"";
$name = isset($_POST["name_employee"]) ? cleanString($_POST["name_employee"]) :"";
$last_name = isset($_POST["last_name_employee"]) ? cleanString($_POST["last_name_employee"]) :"";
$document_number = isset($_POST["document_employee"]) ? cleanString($_POST["document_employee"]) :"";
$phone = isset($_POST["phone_employee"]) ? cleanString($_POST["phone_employee"]) :"";
$code = isset($_POST["code_employee"]) ? cleanString($_POST["code_employee"]) :"";


switch($_GET["op"]){

    case "SaveAndUpdate":
        if (empty($employee_id)){
            $rspta = $employee->insert($name, $last_name, $document_number, $phone, $code);
            echo $rspta ? "Datos registrados correctamente":"No se pudo registrar los datos";
        }else{
            $rspta = $employee->update($employee_id, $name, $last_name, $document_number, $phone, $code);
            echo $rspta ? "Datos actualizados correctamente":"No se pudo actualizar los datos";
        }
        break;

    case "show":
        $rspta = $employee->show($employee_id);
        echo json_encode($rspta);
        break;

    case "list":
        $rspta = $employee->list();
        $data = array();

        while($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=> '<button class="btn btn-warning btn-xs" onclick="show('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
                '1'=> $reg->name,
                '2'=> $reg->last_name,
                '3'=> $reg->document_number,
                '4'=> $reg->phone,
                '5'=> $reg->code
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        );
        echo json_encode($results);
        break;
    case "select_employee":
        $rspta = $employee->select();
        var_dump(json_encode($rspta));
        while($reg = $rspta->fetch_object()){
            var_dump(json_encode($reg));
            echo '<option value='.$reg->id.'>'.$reg->name.''.$reg->last_name. '</option>';
        }
        break;
    }