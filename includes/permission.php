<?php

function checkPermission($permissionData, $module, $role = 'list')
{
  if (!empty($permissionData[$module])) {
    $roleArr = $permissionData[$module];
    if (!empty($roleArr && in_array($role, $roleArr))) {
      return true;
    }
  }
  return false;
}

function getGroupID()
{
  $user_id = isLogin()['user_id'];

  $groupRow = firstRaw("SELECT `group_id` FROM `users` WHERE `id`='$user_id'");

  if (!empty($groupRow)) {
    $groupID = $groupRow['group_id'];

    return $groupID;
  }
  return false;
}

function getPermissionData()
{
  $group_id = getGroupID();

  $groupRow = firstRaw("SELECT `permission` FROM `groups` WHERE `id` = '$group_id'");

  if (!empty($groupRow)) {
    $permissionData = json_decode($groupRow['permission'], true);
    return $permissionData;
  }
  return false;
}


function checkCurrentPermission($role = '', $module = '')
{
  $groupId = getGroupId();

  $permissionsData = getPermissionData($groupId);

  $currentModule = null;

  $body = getBody('get');

  if (!empty($body['module'])) {
    $currentModule = $body['module'];
  }

  $action = !empty($body['action']) ? $body['action'] : 'list';

  if (!empty($role)) {
    $action = $role;
  }

  if (!empty($module)) {
    $currentModule = $module;
  }

  if (!empty($action)) {
    $checkPermission = checkPermission($permissionsData, $currentModule, $action);

    return $checkPermission;
  }


  return false;
}

function redirectPermission($path = 'dashboarh')
{
  setFlashData('msg', 'Bạn không có quyền truy cập trang này');
  setFlashData('msg_type', 'danger');
  redirect(getLinkAdmin($path));
}
