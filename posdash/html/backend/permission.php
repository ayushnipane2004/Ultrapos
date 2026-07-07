<?php

function hasPermission($permission)
{
    global $conn;

    if($_SESSION['role_id']==1)
    {
        return true;
    }

    $role_id=$_SESSION['role_id'];

    $sql="SELECT rp.id
          FROM role_permissions rp
          INNER JOIN permissions p
          ON rp.permission_id=p.id
          WHERE rp.role_id='$role_id'
          AND p.permission_name='$permission'";

    $result=mysqli_query($conn,$sql);

    return mysqli_num_rows($result)>0;
}
?>