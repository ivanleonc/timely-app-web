<?php

require "../config/connection.php";

class Employee{
    public function __construct(){
    }
    public function insert($name, $last_name, $document_number,$phone,$code){
        $sql = "INSERT INTO employees (name, last_name, document_number,phone,code) VALUES ('$name', '$last_name', '$document_number','$phone','$code')";
        return executeConsult($sql);
    }
    public function update($employee_id, $name, $last_name, $document_number, $phone,$code){
        $sql = "UPDATE employees SET name='$name', last_name='$last_name', document_number='$document_number',phone='$phone', code='$code' WHERE id='$employee_id'";
        return executeConsult($sql);
    }
    public function show($employee_id){
        $sql = "SELECT * FROM employees WHERE id='$employee_id'";
        executeConsultSingleRow($sql);
    }
    public function list(){
        $sql = "SELECT * FROM employees";
        return executeConsult($sql);
    }
    public function select(){
        $sql = "SELECT * FROM employees";
        return executeConsult($sql);
    }
}