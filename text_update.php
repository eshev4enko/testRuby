<?php

//update_task.php

include('db_connect.php');

if($_POST["task_list_id"])
{
    $data = array(
        ':task_status'  => 'yes',
        ':task_list_id'  => $_POST["task_list_id"],
        ':task_details'  => $_POST["task_details"]
    );

    $query = "
         UPDATE task_list 
         SET task_status = :task_status, task_details = :task_details
         WHERE task_list_id = :task_list_id
    ";

    $statement = $connect->prepare($query);
    $statement->execute($data);

}