<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 10/25/18
 * Time: 2:07 AM
 */
require('groups_model.php');
require('../../lib/EmailServices.php');

/**
 * @function:       getCurrentGroup
 * @params:         $uid = UID
 * @return:         array
 * @Description:    getter for current group queried from the database
 */
function getCurrentGroup($uid){
    $result = getMyGroup($uid);
    return $result;
}

/**
 * @function:       getCurrentGroupMembers
 * @params:         $uid = UID
 * @return:         array
 * @Description:    getter for current group members queried from the database
 */
function getCurrentGroupMembers($uid){
    $result = getMyGroupMembers($uid);
    return $result;
}

/**
 * @function:       getAllGroups
 * @params:         NA
 * @return:         array
 * @Description:    getter for all groups queried from the database
 */
function getAllGroups(){
    $result = getGroups();
    return $result;
}

/**
 * @function:       getInnerGroups
 * @params:         $uid = UID
 * @return:         array
 * @Description:    getter for current group members in groupp queried from the database
 */
function getInnerGroups($uid){
    $result = getInnerGroupMembers($uid);
    return $result;
}

/**
 * @function:       getUsers
 * @params:         $uid = UID
 * @return:         array
 * @Description:    getter for all users queried from the database
 */
function getUsers(){
    $result = getAllUsers();
    return $result;
}

/**
 * @function:       addNewGroup
 * @params:         $group_name - string of new group
 * @return:         NA
 * @Description:    setter a new group to be added to the database
 */
function addNewGroup($group_Name){
    addGroup($group_Name);
}

/**
 * @function:       addNewUserGroup
 * @params:         $user = UID | $group - group_id | $leader - leader
 * @return:         NA
 * @Description:    setter a new user to be added to a group in the database
 * then sends the user an email that they have been added to a group
 */
function addNewUserGroup($user, $group, $leader){
    $userEmail = addUserToGroup($user,$group,$leader);
    $groupName = getGroup($group);
    $emailService = new EmailServices($userEmail['email']);
    $msg = "You have been added to " . $groupName['name'];
    $msgSent = $emailService->sendNotification($msg);

}

/**
 * @function:       removeUserFromGroup
 * @params:         $user = UID | $group - group_id
 * @return:         NA
 * @Description:    setter to remove a user from its group to the database
 */
function removeUserFromGroup($user, $group){
    removeUser($user,$group);
}

/**
 * @function:       demoteLeader
 * @params:         $uid = UID | $gid - group_id | $isLeader - leader
 * @return:         NA
 * @Description:    setter to demote a user's leader status
 */
function demoteLeader($uid,$gid,$isLeader){
    changeLeader($uid,$gid,$isLeader);
}

/**
 * @function:       promoteLeader
 * @params:         $uid = UID | $gid - group_id | $isLeader - leader
 * @return:         NA
 * @Description:    setter to promote a user's leader status
 */
function promoteLeader($uid,$gid,$isLeader){
    changeLeader($uid,$gid,$isLeader);
}

/**
 * @function:       removetGroup
 * @params:         $gid = group_id
 * @return:         NA
 * @Description:    setter for removing current group in the database
 */
function removeGroup($gid){
    removeCurrentGroup($gid);
}


if(isset($_POST['group_name'])){
    $groupName = $_POST['group_name'];
    addNewGroup($groupName);
}
else if(isset($_POST['user']) && isset($_POST['group']) && isset($_POST['leader'])){
    $user = ($_POST['user']);
    $groupid = ($_POST['group']);
    $isleader = ($_POST['leader']);
    addNewUserGroup($user, $groupid, $isleader);
}
else if(isset($_POST['user_remove']) && isset($_POST['group_remove'])){
    $uidr = $_POST['user_remove'];
    $gidr = $_POST['group_remove'];
    removeUserFromGroup($uidr, $gidr);
}
else if(isset($_POST['user_p_id']) && isset($_POST['group_p_id']) && isset($_POST['is_leader'])){
    $uid = $_POST['user_p_id'];
    $gid = $_POST['group_p_id'];
    $leader = $_POST['is_leader'];
    if($leader == 1){
        demoteLeader($uid, $gid, $leader);
    }else{
        promoteLeader($uid, $gid, $leader);
    }
}
else if(isset($_POST['groupR'])){
    $groupID = $_POST['groupR'];
    removeGroup($groupID);
}
