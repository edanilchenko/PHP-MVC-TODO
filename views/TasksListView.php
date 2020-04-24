<form action="task/add">
    <input type="hidden" name="controller" value="Tasks">
    <input type="hidden" name="action" value="add">
    <input type="text" name="user">
    <input type="email" name="email">
    <input type="text" name="text">
    <input type="submit" value="Create task">
</form>
<?php foreach($data as $task): ?>
<div>
    <?=$task['name']; ?>
    <?=$task['text']; ?>
</div>
<?php endforeach; ?>