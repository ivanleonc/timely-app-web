<?php
require_once "../models/Assists.php";

$assists = new Assists();

$employee_id = isset($_POST["employee_id"]) ? cleanString($_POST["employee_id"])  :"";

switch($_GET["op"]){
    case "list":
        $rspta = $assists->list();
        $data = array();

        $item = 0;
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0"=> $item,
                "1"=> $reg->code,
                "2"=> $reg->employee,
                "3"=> $reg->date,
                "4"=> $reg->hour,
                "5"=> ($reg->type == "Entrada") ? '<span class="label bg-green">'.$reg->type.'</span>': '<span class="label bg-orange">'.$reg->type.'</span>',

            );
            $item++;
        }

        $results = array(
            'sEcho'=> 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords'=> count($data),
            'aaData'=> $data
        );
        echo json_encode($results);
        break;
    case 'list_assist':
        $date_start = $_REQUEST["date_start"];
        $date_end = $_REQUEST["date_end"];
        $employee_id = $_REQUEST["employee_id"];
        $rspta = $assists->listReport($date_start, $date_end, $employee_id);
        $data = array();
        $item = 0;

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0"=> $item,
                "1"=> $reg->code,
                "2"=> $reg->employee,
                "3"=> $reg->date,
                "4"=> $reg->hour,
                "5"=> ($reg->type == "Entrada") ? '<span class="label bg-green">'.$reg->type.'</span>':'<span class="label bg-orange">'.$reg->type.'</span>'
            );
            $item++;
        }
        $results = array(
            'sEcho'=> 1,
            'iTotalRecords'=> count($data),
            'iTotalDisaplayRecords'=> count($data),
            'aaData'=> $data
        );
        echo json_encode($results);
        break;
}