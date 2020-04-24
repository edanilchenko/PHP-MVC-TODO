<?php require_once('Header.php'); ?>
<script src="js/table-sortable.js"></script>
<script src="js/data.js"></script>
<form action="">
    <input type="hidden" name="action" value="add">
    <input type="text" required name="name">
    <input type="email" required name="email">
    <input type="text" required name="text">
    <input type="submit" value="Create task">
</form>
<div id = "root">
</div>
<script>
    var data = <?=$data; ?>;
    var columns = {
        idTasks: 'ID',
        Name: 'Имя',
        Email: 'Емейл',
        Text: 'Текст',
        Status: 'Статус'
    };
    var table = $('#root').tableSortable({
        data,
        columns,
        rowsPerPage: 3,
        pagination: true,
        tableWillMount: () => {
            console.log('table will mount')
        },
        tableDidMount: () => {
            console.log('table did mount')
        },
        onPaginationChange: function(nextPage, setPage) {
            setPage(nextPage);
        },
        <?php if(isset($_SESSION['admin'])): ?>
        formatCell: function(row, key) {
            if(key === 'idTasks'){
                return '<span class="task_id">'+row[key]+'</span>'
            }
            if (key === 'Text') {
                return '<textarea class="new_text">' + row[key] + '</textarea><a href="#" class="text_edit">Edit</a>';
            }
            if (key === 'Status') {
                return '<select class="status_edit"><option>' + row[key] + '</option><option>Open</option><option>Done</option></select>';
            }
            // Finally return cell for rest of columns;
            return row[key];
        }
        <?php endif; ?>
    });

    $('.text_edit').click(function(e){
        var task_id = $(e.target).parent().parent().find('.task_id')[0].innerText;
        var new_text = $(e.target).parent().find('.new_text')[0].value;

        $.ajax({
            type: "POST",
            url: "index.php",
            data: { 
                action: 'edit_text',
                id: task_id,
                text: new_text
            }
        }).done(function(res){
            console.log(res);
        });
    });

    $('select.status_edit').change(function(e){
        var task_id = $(e.target).parent().parent().find('.task_id')[0].innerText;
        var new_status = $(this).find(":selected").val();
        $.ajax({
            type: "POST",
            url: "index.php",
            data: { 
                action: 'edit_status',
                id: task_id,
                status: new_status
            }
        }).done(function(res){
            console.log(res);
        });
    });
</script>
<?php require_once('Footer.php'); ?>