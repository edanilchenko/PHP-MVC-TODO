<script src="js/table-sortable.js"></script>
<script src="js/data.js"></script>
<form action="">
    <input type="hidden" name="controller" value="Tasks">
    <input type="hidden" name="action" value="add">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="text" name="text">
    <input type="submit" value="Create task">
</form>
<div id = "root">
</div>
<script>
    var data = <?=$data; ?>;
    var columns = {
        Name: 'Имя',
        Email: 'Емейл',
        Text: 'Текст',
        Closed: 'Статус'
    };
    var table = $('#root').tableSortable({
        data,
        columns,
        searchField: '#searchField',
        responsive: {
            1100: {
                columns: {
                    formCode: 'Form Code',
                    formName: 'Form Name',
                },
            },
        },
        rowsPerPage: 2,
        pagination: true,
        tableWillMount: () => {
            console.log('table will mount')
        },
        tableDidMount: () => {
            console.log('table did mount')
        },
        onPaginationChange: function(nextPage, setPage) {
            setPage(nextPage);
        }
    });
</script>