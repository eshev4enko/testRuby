<?php

//index.php

include('db_connect.php');

$query = "
 SELECT * FROM task_list 
 WHERE user_id = '" . $_SESSION["user_id"] . "' 
 ORDER BY task_list_id DESC
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
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
            <div class="todo-list-inner-box">
                <form method="post" id="to_do_form" class="todo-form-main">
                    <header class="header-list col-md-8">
                        <div class="header-title">
                            <h1 class="main-title">To-do list</h1>
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
                                    <li class="list-add-data">
                                        <div class="list-check-wrap">
                                            <input type="checkbox" class="list-check" id="list-check-item-'.$row["task_list_id"].'" name="list-name-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$checker.'" '.$checked.'>
                                        </div>
                                        <input type="text" style="'.$style.'" class="list-group-item list-check-txt" id="list-group-item-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'" value="'.$row["task_details"].'" readonly>
                                        <div class="change-data-checker" style="display: none;">
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
            </div>
        </div>
    </div>

<!-- JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/ajax.js"></script>
</body>
</html>