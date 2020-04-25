<?php require_once('Header.php'); ?>
<div class="container">
    <div class="alert alert-success" id="list_success_alert" role="alert" style="display:none;">
    </div>
    <div class="alert alert-danger" id="list_danger_alert" role="alert" style="display:none;">
    </div>
    <form action="" class="form-inline" id="add_task_form">
        <input type="hidden" name="action" value="add">
        <div class="form-group mb-2">
            <input type="text" class="form-control" placeholder="Имя" required name="name">
        </div>
        <div class="form-group mx-sm-3  mb-2">
            <input type="email" class="form-control" placeholder="Емейл" required name="email">
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" placeholder="Текст" required name="text">
        </div>
        <input type="submit" class="btn btn-primary mx-sm-3 mb-2" value="Добавить задачу">
    </form>
    <script>
        $('#add_task_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php",
                data: $(e.target).serialize()
            }).done(function(res){
                res = JSON.parse(res);
                if(res.success){
                    $('#list_success_alert')[0].innerText = res.message;
                    $('#list_success_alert').show();
                    setTimeout(function(){
                        document.location.href = 'index.php';
                    }, 2000);
                }
                else{
                    $('#list_danger_alert')[0].innerText = res.message;
                    $('#list_danger_alert').show();
                    setTimeout(function(){
                        $('#list_danger_alert').hide();
                    }, 3000);
                }
            });
        });
    </script>
    <div id = "root">
        <table id="task_table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th class="th-sm">ID
                </th>
                <th class="th-sm">Имя
                </th>
                <th class="th-sm">Емейл
                </th>
                <th class="th-sm">Текст
                </th>
                <th class="th-sm">Статус
                </th>
                <th class="th-sm">
                </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tasks = json_decode($data);
                foreach($tasks as $task) : ?>
                <tr>
                    <td><?=$task->idTasks; ?></td>
                    <td><?=$task->Name; ?></td>
                    <td><?=$task->Email; ?></td>
                    <?php if(isset($_SESSION['admin'])) : ?>
                    <td>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control new_text" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?=$task->Text; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary text_edit" type="button" data-item="<?=$task->idTasks; ?>">Сохранить</button>
                            </div>
                        </div>
                    </td>
                    <td>
                    <?php
                        $statuses = ['Открыто', 'Выполнено'];
                        unset($statuses[array_search($task->Status, $statuses)]);
                    ?>
                        <select class="form-control status_edit" data-item="<?=$task->idTasks; ?>">
                            <option><?=$task->Status; ?></option>
                            <?php foreach($statuses as $status) : ?>
                            <option><?=$status;?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <?php else: ?>
                    <td><?=$task->Text; ?></td>
                    <td><?=$task->Status; ?></td>
                    <?php endif; ?>

                    <td><?=$task->Edited; ?></td>
                </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#task_table').DataTable({
        order: [[ 0, "desc" ]],
        lengthMenu: [3]
    });

    $('.text_edit').click(function(e){
        var task_id = $(e.target).attr('data-item');
        var new_text = $(e.target).parent().parent().find('.new_text')[0].value;

        $.ajax({
            type: "POST",
            url: "index.php",
            data: { 
                action: 'edit_text',
                id: task_id,
                text: new_text
            }
        }).done(function(res){
            res = JSON.parse(res);
            if(res.success){
                $('#list_success_alert')[0].innerText = res.message;
                $('#list_success_alert').show();
                setTimeout(function(){
                    $('#list_success_alert').hide();
                }, 3000);
            }
            else{
                $('#list_danger_alert')[0].innerText = res.message;
                $('#list_danger_alert').show();
                setTimeout(function(){
                    $('#list_danger_alert').hide();
                }, 3000);
            }
        });
    });

    $('select.status_edit').change(function(e){
        var task_id = $(e.target).attr('data-item');
        var new_status = $(this).find(":selected").val();

        console.log(task_id);
        console.log(new_status);

        $.ajax({
            type: "POST",
            url: "index.php",
            data: { 
                action: 'edit_status',
                id: task_id,
                status: new_status
            }
        }).done(function(res){
            res = JSON.parse(res);
            if(res.success){
                $('#list_success_alert')[0].innerText = res.message;
                $('#list_success_alert').show();
                setTimeout(function(){
                    $('#list_success_alert').hide();
                }, 3000);
            }
            else{
                $('#list_danger_alert')[0].innerText = res.message;
                $('#list_danger_alert').show();
                setTimeout(function(){
                    $('#list_danger_alert').hide();
                }, 3000);
            }
        });
    });
</script>
<?php require_once('Footer.php'); ?>