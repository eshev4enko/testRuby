$(function () {
    $(document)
        .on('submit', '#to_do_form', function(event){
            event.preventDefault();

            $('#submit').attr('disabled', 'disabled');
            $.ajax({
                url:"add_task.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(data)
                {
                    $('#submit').attr('disabled', false);
                    $('#to_do_form')[0].reset();
                    $('.list-sections').prepend(data);

                    console.log(data);
                }
            })
        })
        .on('mouseenter', '.list-add-data', function() {
           $(this)
               .find('.change-data-checker')
               .show();
        })
        .on('mouseleave', '.list-add-data', function() {
            $(this)
                .find('.change-data-checker')
                .hide();
        })
        .on('click', '.list-check', function(){
            let task_list_id = $(this).data('id'),
                checkbox = $(this).is(':checked') ? 1 : 0;

            if (checkbox == 1) {
                $.ajax({
                    url:"update_task.php",
                    method:"POST",
                    data:{
                        task_list_id:task_list_id,
                        checkbox:checkbox
                    },
                    success:function(data)
                    {
                        $('#list-check-item-'+task_list_id)
                            .closest('.list-check-wrap')
                            .next()
                            .css('text-decoration', 'line-through');
                    }

                })
            } else {
                $.ajax({
                    url:"update_task.php",
                    method:"POST",
                    data:{
                        task_list_id:task_list_id,
                        checkbox:checkbox
                    },
                    success:function(data)
                    {
                        $('#list-check-item-'+task_list_id)
                            .removeAttr('checked')
                            .closest('.list-check-wrap')
                            .next()
                            .css('text-decoration', '');
                    }

                })
            }
        })
        .on('click', '.badge', function(){
            let task_list_id    = $(this).data('id'),
                $that           = $(this);

            $.ajax({
                url:"delete_task.php",
                method:"POST",
                data:{task_list_id:task_list_id},
                success:function(data)
                {
                    $($that).closest('.list-add-data').fadeOut('slow');

                }
            })
        })
        .on('click', '.change-data-edit-all', function() {
            let
                $edit           = $(this).closest('.list-add-data').find('input[type="text"]'),
                $redact         = $edit.attr('readonly'),
                task_list_id    = $($edit).data('id'),
                task_details    = $($edit).val();

            if ($redact) {
                $edit.removeAttr('readonly').addClass('redact');
            } else {
                $edit.attr('readonly', 'readonly').removeClass('redact');
            }

            $.ajax({
                url:"text_update.php",
                method:"POST",
                data:{
                    task_list_id: task_list_id,
                    task_details: task_details
                },
                success:function(data)
                {
                    $edit.val(task_details);
                }

            })
        })
        .on('click', '.todo-header-top', function(event) {
            let
                push            = event.target,
                $editHeader     = $(this).closest('.header-title').find('input[type="text"]'),
                $redactHeader   = $editHeader.attr('readonly'),
                title_id        = $($editHeader).attr('id'),
                title_text      = $($editHeader).val();

                $editHeader.toggleClass('active');
                if ($redactHeader) {
                    $editHeader
                        .removeAttr('readonly')
                        .addClass('redact')
                        .closest('.header-title')
                        .find('.todo-header-edit')
                        .hide()
                        .next()
                        .show()
                } else {
                    $editHeader
                        .attr('readonly', 'readonly')
                        .removeClass('redact')
                        .closest('.header-title')
                        .find('.todo-header-edit')
                        .show()
                        .next()
                        .hide()
                }

                if ($(push).hasClass('todo-header-check')) {
                    $.ajax({
                        url:"title.php",
                        method:"POST",
                        data:{
                            title_id: title_id,
                            title_text: title_text
                        },
                        success:function(data)
                        {
                           $editHeader.attr('value', title_text);

                           console.log(data);
                           console.log(title_id);
                           console.log(title_text);
                        }

                    });
                }
        })
        .on('click', '.add-todo-list', function (event) {
            let
                push            = event.target,
                $editTodo       = $(this).closest('.todo-list-inner-box'),
                title_id        = $($editTodo).attr('id'),
                title_text      = $($editTodo).val();

            if ($(push).hasClass('add-todo-list')) {
                $.ajax({
                    url: "add_new_todo.php",
                    method: "POST",
                    data: {
                        title_id: title_id,
                        title_text: title_text
                    },
                    success: function (data) {
                        //$editTodo.attr('value', title_text);
                        console.log($editTodo);
                        console.log(data);
                        $editTodo
                            .parent()
                            .append(data);
                    }

                });
            }
        });

        $('.list-sections').sortable({
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index+1)) {
                        $(this).attr('data-position', (index+1)).addClass('updated');
                    }
                });

                saveNewPositions();
            }
        });

        function saveNewPositions() {
            let positions = [];
            $('.updated').each(function () {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                $(this).removeClass('updated');
            });

            $.ajax({
                url: 'sort.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    update: 1,
                    positions: positions
                }, success: function (response) {
                    console.log(response);
                }
            });
        }
});
