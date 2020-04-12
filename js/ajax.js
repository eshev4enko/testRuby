$(function () {
    $(document).on('submit', '#to_do_form', function(event){
        event.preventDefault();

        if($('#task_name').val() == '')
        {
            $('#message').html('<div class="alert alert-danger">Enter Task Details</div>');
            return false;
        }
        else
        {
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
                }
            })
        }
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
    });
});
