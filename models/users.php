<?php

require "../config/connection.php";

class Users
{
    public function __construct()
    {
    }
    public function insert($name, $last_name, $username, $email, $password, $image)
    {
        $sql = "INSERT INTO users (name, last_name, username, email, password, image, state) VALUES ('$name', '$last_name', '$username', '$email', '$password', '$image', '1')";
        return executeConsult($sql);
    }
    public function update($id_user, $name, $last_name, $username, $email, $password, $image)
    {
        if (empty($password)) {
            $sql = "UPDATE users SET name='$name', last_name='$last_name', username='$username', email='$email', password='$password', image='$image' WHERE id_user='$id_user'";
        } else {
            $sql = "UPDATE users SET name='$name', last_name='$last_name', username='$username', email='$email', password='$password', image='$image' WHERE id_user='$id_user'";
        }
        return executeConsult($sql);
    }
    public function deactivate ($id_user){
        $sql = "UPDATE users SET state='0' WHERE id_user='$id_user'";
        return executeConsult($sql);
    }
    public function activate ($id_user){
        $sql = "UPDATE users SET state='1' WHERE id_user='$id_user'";
        return executeConsult($sql);
    }
    public function show ($id_user){
        $sql = "SELECT * FROM users WHERE id_user='$id_user'";
        return executeConsultSingleRow($sql);
    }
    public function toList(){
        $sql = "SELECT * FROM users";
        return executeConsult($sql);
    }
    public function usersQuantity(){
        $sql = "SELECT count(*) name FROM users";
        return executeConsult($sql);
    }
    public function verify($username, $password){
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND state='1'";
        return executeConsult($sql);
    }
}
