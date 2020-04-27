<?php

include('db_connect.php');

$id = $_POST["title_id"];
$title = $_POST["title_text"];

    $query = "INSERT INTO task_title (title_text) VALUES (:title_text) ";

    $statement = $connect->prepare($query);
    $statement->execute(['title_text' => $title]);
if ($id == '') {

    exit();
} else {
    $data = array(
        ':title_id'    => $_POST["title_id"],
        ':title_text'  => $_POST["title_text"]
    );

    $query = "
             UPDATE task_title
             SET title_text = :title_text
             WHERE title_id = :title_id
        ";

    $statement = $connect->prepare($query);
    $statement->execute($data);
}