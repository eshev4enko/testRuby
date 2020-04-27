<?php

include('db_connect.php');

if (isset($_POST['update'])) {
    foreach($_POST['positions'] as $position) {
        $index = $position[0];
        $newPosition = $position[1];

        $connect->query("UPDATE task_list SET position_order = '$newPosition' WHERE task_list_id ='$index'");
    }

    exit('success');
}