<?php
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}
if (isset($_POST['add'])) {
    $taskDescription = $_POST['task'];
    $_SESSION['tasks'][] = $taskDescription;
}
if (isset($_POST['complete'])) {
    $completedTaskIndex = $_POST['completedTaskIndex'];
    if ($completedTaskIndex >= 0 && $completedTaskIndex < count($_SESSION['tasks'])) {
        $_SESSION['tasks'][$completedTaskIndex] = "[Completed] " . $_SESSION['tasks'][$completedTaskIndex];
    }
}
if (isset($_POST['delete'])) {
    $taskIndexToDelete = $_POST['taskIndexToDelete'];
    if ($taskIndexToDelete >= 0 && $taskIndexToDelete < count($_SESSION['tasks'])) {
        array_splice($_SESSION['tasks'], $taskIndexToDelete, 1);
    }
}
foreach ($_SESSION['tasks'] as $index => $task) {
    echo "<li>$task";
    echo "<form action='tasks.php' method='post'>";
    echo "<input type='hidden' name='completedTaskIndex' value='$index'>";
    echo "<button type='submit' name='complete'>Complete</button>";
    echo "<input type='hidden' name='taskIndexToDelete' value='$index'>";
    echo "<button type='submit' name='delete'>Delete</button>";
    echo "</form>";
    echo "</li>";
}
