<?php

//add_task.php

include('db_connect.php');

if($_POST["task_name"])
{
    $data = array(
        ':user_id'        => $_SESSION['user_id'],
        ':task_details'   => trim($_POST["task_name"]),
        ':task_status'    => 'yes',
        ':position_order' => 0,
        ':title_id'       => $_POST["title_id"]
    );

    $query = "
         INSERT INTO task_list 
         (user_id, task_details, task_status, position_order, title_id) 
         VALUES (:user_id, :task_details, :task_status, :position_order, :title_id)
     ";

    $statement = $connect->prepare($query);

    if($statement->execute($data))
    {
        $task_list_id = $connect->lastInsertId();

        echo '
            <li class="list-add-data" data-index="'.$task_list_id.'" data-position="0">
                <div class="list-check-wrap">
                    <input type="checkbox" class="list-check" id="list-check-item-'.$task_list_id.'" data-id="'.$task_list_id.'">
                </div>
                <input type="text" class="list-group-item list-check-txt" id="list-group-item-'.$task_list_id.'" data-id="'.$task_list_id.'" value="'.$_POST["task_name"].'" readonly="">
                <div class="change-data-checker" style="display: none;">
                    <div class="change-data-checker-inner">
                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                        <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                    <div class="change-data-checker-inner">
                          <i class="fa fa-pencil change-data-checker-edit change-data-edit-all" aria-hidden="true"></i>
                          <i class="fa fa-times change-data-checker-cross change-data-edit-all" aria-hidden="true"></i>
                    </div>
                    <div class="change-data-checker-inner">
                        <i class="fa fa-trash badge" aria-hidden="true" data-id="'.$task_list_id.'"></i>
                    </div>
                </div>
            </li>
        ';
    }
}

