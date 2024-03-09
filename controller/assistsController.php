<?php
require_once "../models/Assists.php";

$assists = new Assists();

$employee_id = isset($_POST["employee_id"]) ? cleanString($_POST["employee_id"])  :"";

