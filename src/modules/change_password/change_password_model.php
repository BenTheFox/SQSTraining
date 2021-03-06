<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 10/25/18
 * Time: 3:03 AM
 */

require_once ("../../lib/Connector.php");

/**
 * updates password after it has been verified
 * @param  $pass, new password
 * @param $uid, users uid
 * @return true or false based on execution
 */

function updatePass($pass, $uid){
    $base = Connector::getDatabase();

    $sql = "UPDATE user SET password = '$pass' WHERE UID = '$uid';";

    $stmt = $base->prepare($sql);

    return $stmt->execute();
}

/**
 * gets old password from DB
 * @param $uid, users uid
 * @return old password
 */

function getOldPassword($uid){

    $base = Connector::getDatabase();

    $sql = "SELECT * FROM user WHERE UId = '$uid';";

    $stmt = $base->prepare($sql);

    $stmt->execute();

    return $stmt->fetch()['password'];
}