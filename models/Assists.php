<?php
require "../config/connection.php";

class Assists{
    public function __construct(){
    }
    public function list(){
        $sql = "SELECT a.*, CONCAT(e.name, '', e.last_name) AS employee, e.code FROM assists a INNER JOIN employees e ON a.employee_id=e.id ORDER BY a.id DESC";
        return executeConsult($sql);
    }
    public function listReport($date_start, $date_end,$employee_id ){
        
        $sql = "SELECT a.*, CONCAT(e.name, '', e.last_name) AS employee, e.code FROM assists a INNER JOIN employees e ON a.employee_id=e.id WHERE DATE(a.date)>='$date_start' AND DATE(a.date)<='$date_end' AND a.employee_id='$employee_id'";
        return executeConsult($sql);
    }

}