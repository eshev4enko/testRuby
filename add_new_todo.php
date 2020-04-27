<?php

//add_task.php

include('db_connect.php');

$data = array(
    ':title_text' => $_POST["title_text"]
);

//if ($_POST["title_text"] == '') {
    $query = "INSERT INTO task_title (title_text) VALUES (:title_text) ";

    $statement = $connect->prepare($query);
    if($statement->execute($data))
    {
        $title_id = $connect->lastInsertId();

        echo '
            <div class="todo-list-inner-box" id="'.$title_id.'">
               <form method="post" class="todo-form-main">
                        <header class="header-list col-md-8">
                            <div class="header-title">

                                <input type="text" class="list-title" name="task_list_title" id="'.$title['title_id'].'" value="'.$title['title_text'].'" placeholder="Complete the test task for Ruby Garage" readonly>
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
                                        <button type="submit" name="submit" class="submit">Add Task</button>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </form>
                <section class="body-list-data col-md-8">
                    <ul class="list-sections"></ul>
                </section>
                 <div class="buttons-box">
                    <button type="submit" class="add-todo-list">Add todo list</button>
                </div>
            </div>
        ';
//    }
}

