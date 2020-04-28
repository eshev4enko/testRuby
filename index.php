<?php

//index.php

include('db_connect.php');

$query = "
     SELECT * FROM task_list 
     WHERE user_id = '" . $_SESSION["user_id"] . "' 
     ORDER BY position_order
    ";

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);


$queryTitle = "
     SELECT * FROM task_title 
     WHERE 1
     ORDER BY title_id
    ";

    $statement = $connect->prepare($queryTitle);
    $statement->execute();
    $resultTitle = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <title>Test Task Ruby</title>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <? if($resultTitle != ''): ?>
                <div class="todo-list-inner-box" id="<?=$resultTitle[0]['title_id']?>">
                    <form method="post" id="to_do_form" class="todo-form-main">
                        <header class="header-list col-md-8">
                            <div class="header-title">
                                <input type="text" class="list-title" name="task_list_title" id="<?=$resultTitle[0]['title_id']?>" value="<?=$resultTitle[0]['title_text']?>" placeholder="Complete the test task for Ruby Garage" readonly>
                                <div class="header-list-edit">
                                    <div class="header-list-edit-inner">
                                        <i class="fa fa-pencil todo-header-top todo-header-edit" aria-hidden="true"></i>
                                        <i class="fa fa-check todo-header-top todo-header-check" aria-hidden="true"></i>
                                    </div>
                                    <i class="fa fa-trash todo-header-clear" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="header-add-task">
                                <div class="enter-data-list">
                                    <div class="input-list-data">
                                        <input type="text" name="task_name" id="task_name" autocomplete="off" placeholder="Start typing here to create a task">
                                        <button type="submit" name="submit" id="submit">Add Task</button>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </form>
                    <section class="body-list-data col-md-8">
                        <ul class="list-sections">
                            <?php
                            foreach($result as $row) {
                                $checker = $row['checkbox'];
                                if($checker == 1) {
                                    $style = 'text-decoration: line-through';
                                    $checked = 'checked';
                                } else {
                                    $style = '';
                                    $checked = '';
                                }

                                echo '
                                            <li class="list-add-data" data-title="'.$title['title_id'].'" data-index="'.$row["task_list_id"].'" data-position="'.$row["position_order"].'">
                                                <div class="list-check-wrap">
                                                    <input type="checkbox" class="list-check" id="list-check-item-'.$row["task_list_id"].'" name="list-name-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$checker.'" '.$checked.'>
                                                </div>
                                                <input type="text" style="'.$style.'" class="list-group-item list-check-txt" id="list-group-item-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$row["task_details"].'" readonly>
                                                <div class="change-data-checker" style="display: none;">
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                                        <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-pencil change-data-checker-edit change-data-edit-all" aria-hidden="true"></i>
                                                        <i class="fa fa-check change-data-checker-cross change-data-edit-all" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-trash badge" aria-hidden="true" data-id="'.$row["task_list_id"].'"></i>
                                                    </div>
                                                </div>
                                            </li>';
                            }
                            ?>
                        </ul>
                    </section>
                    <div class="buttons-box">
                        <button type="submit" class="add-todo-list">Add todo list</button>
                    </div>
                </div>
            <? else: ?>
            <? foreach($resultTitle as $title) :?>
                <div class="todo-list-inner-box" id="'.$title['title_id'].'">
                    <form method="post" id="to_do_form" class="todo-form-main">
                        <header class="header-list col-md-8">
                            <div class="header-title">
                                    <input type="text" class="list-title" name="task_list_title" id="12" value="<?=$title['title_text']?>" placeholder="Complete the test task for Ruby Garage" readonly>
                                    <div class="header-list-edit">
                                        <div class="header-list-edit-inner">
                                            <i class="fa fa-pencil todo-header-top todo-header-edit" aria-hidden="true"></i>
                                            <i class="fa fa-check todo-header-top todo-header-check" aria-hidden="true"></i>
                                        </div>
                                        <i class="fa fa-trash todo-header-clear" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="header-add-task">
                                    <div class="enter-data-list">
                                        <div class="input-list-data">
                                            <input type="text" name="task_name" id="task_name" autocomplete="off" placeholder="Start typing here to create a task">
                                            <button type="submit" name="submit" id="submit">Add Task</button>
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </form>
                        <section class="body-list-data col-md-8">
                            <ul class="list-sections">
                                <?php
                                    foreach($result as $row) {
                                        $checker = $row['checkbox'];
                                        if($checker == 1) {
                                            $style = 'text-decoration: line-through';
                                            $checked = 'checked';
                                        } else {
                                            $style = '';
                                            $checked = '';
                                        }

                                        echo '
                                            <li class="list-add-data" data-title="'.$title['title_id'].'" data-index="'.$row["task_list_id"].'" data-position="'.$row["position_order"].'">
                                                <div class="list-check-wrap">
                                                    <input type="checkbox" class="list-check" id="list-check-item-'.$row["task_list_id"].'" name="list-name-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$checker.'" '.$checked.'>
                                                </div>
                                                <input type="text" style="'.$style.'" class="list-group-item list-check-txt" id="list-group-item-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$row["task_details"].'" readonly>
                                                <div class="change-data-checker" style="display: none;">
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                                        <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-pencil change-data-checker-edit change-data-edit-all" aria-hidden="true"></i>
                                                        <i class="fa fa-check change-data-checker-cross change-data-edit-all" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="change-data-checker-inner">
                                                        <i class="fa fa-trash badge" aria-hidden="true" data-id="'.$row["task_list_id"].'"></i>
                                                    </div>
                                                </div>
                                            </li>';
                                    }
                                ?>
                            </ul>
                        </section>
                        <div class="buttons-box">
                            <button type="submit" class="add-todo-list">Add todo list</button>
                        </div>
                    </div>
            <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>

<!-- JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/ajax.js"></script>
</body>
</html>