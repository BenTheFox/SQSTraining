<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 10/9/18
 * Time: 12:39 AM
 */

require_once ("../../lib/Connector.php");

session_start();

function newUser($data){

    try{
        $base = Connector::getDatabase();

        $first = $data['first_name'];
        $last = $data['last_name'];
        $email = $data['email'];
        $pass = $data['password'];

        $sql = "INSERT INTO user (
                    first_name, 
                    last_name, 
                    email, 
                    password
                    ) VALUES (
                    '$first', 
                    '$last', 
                    '$email', 
                    '$pass');";
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $sql = "SELECT UID FROM user WHERE email = '$email';";
        $stmt = $base->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['UID'];
    }catch(Exception $e){
        return $e;
    }
}

function addInfo($data){
    try{
        $base = Connector::getDatabase();

        $gender = $data['gender'];
        $dateofbirth = $data['dateofbirth'];
        $phone_number = $data['phone_number'];
        $street_number = $data['street_number'];
        $street_name = $data['street_name'];
        $city = $data['city'];
        $state = $data['state'];
        $zip = $data['zip'];
        $uid = $_SESSION['uid'];

        $sql = "UPDATE user SET
                    gender = '$gender',
                    dateofbirth = '$dateofbirth',
                    phone_number = '$phone_number',
                    street_number = '$street_number',
                    street_name = '$street_name',
                    city = '$city',
                    state = '$state',
                    zip = '$zip'
                    WHERE UID = '$uid';";
        $stmt = $base->prepare($sql);
        $stmt->execute();
        return true;
    }catch(Exception $e){
        return $e;
    }
}