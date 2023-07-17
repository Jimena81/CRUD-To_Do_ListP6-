<?php
use App\Controllers\TaskController;
require __DIR__ . '/../vendor/autoload.php';

// Crear una nueva tarea
if (isset($_POST["submit"])) {
    $new_task = new TaskController;
    $new_task->createTask([
        "name" => $_POST["name"],
        "description" => $_POST["description"]
    ]);
    header("Location: index.php");
    exit();
}

// Obtener la lista de tareas
$task_controller = new TaskController;
$task_list = $task_controller->indexTask();

// Eliminar una tarea
if (isset($_GET['id'])) {
    $delete_task = new TaskController;
    $delete_task->deleteTask($_GET['id']);
    header("Location: index.php");
    exit();
}

// Editar una tarea
if (isset($_POST["edit_submit"])) {
    $edit_task = new TaskController;
    $edit_task->editTask($_POST["edit_id"], [
        "name" => $_POST["edit_name"],
        "description" => $_POST["edit_description"]
    ]);
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style.css">
    <title>ToDo Php</title>
</head>
<body>
    <h1>What's your task?</h1>
    <form action="./index.php" method="POST">
        <fieldset>
            <legend>Tasks</legend>
            <label for="name">Name</label>
            <input type="text" name="name" required>
            <label for="description">Description</label>
            <input type="text" name="description" required>
            <input type="submit" name="submit" value="SUBMIT">
        </fieldset>
    </form>
    <h2>TASKS</h2>
    <div id="list-container">
        <table>
            <tr>
                <th>name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($task_list as $row): ?>
            <tr>
                <td><?= $row["name"] ?></td>
                <td><?= $row["description"] ?></td>
                <td>
                    <button onclick="handleEditButtonClick(<?= $row["id"] ?>, '<?= $row["name"] ?>', '<?= $row["description"] ?>')">Edit</button>
                </td>
                <td><a href='index.php?id=<?= $row["id"] ?>'><button>Delete</button></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php if (isset($_POST["edit_id"])): ?>
    <!-- Formulario de edición -->
    <h2>Edit Task</h2>
    <form action="./index.php" method="POST">
        <fieldset>
            <input type="hidden" name="edit_id" value="<?= $_POST["edit_id"] ?>">
            <label for="edit_name">Title</label>
            <input type="text" name="edit_name" value="<?= $_POST["edit_name"] ?>" required>
            <label for="edit_description">Description</label>
            <input type="text" name="edit_description" value="<?= $_POST["edit_description"] ?>" required>
            <input type="submit" name="edit_submit" value="Save">
        </fieldset>
    </form>
    <?php endif; ?>

    <script>
    function handleEditButtonClick(id, name, description) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "./index.php";

        const editIdField = document.createElement("input");
        editIdField.type = "hidden";
        editIdField.name = "edit_id";
        editIdField.value = id;
        form.appendChild(editIdField);

        const editNameLabel = document.createElement("label");
        editTitleLabel.innerHTML = "name";
        form.appendChild(editTitleLabel);

        const editNameField = document.createElement("input");
        editNameField.type = "text";
        editNameField.name = "edit_name";
        editNameField.value = name;
        editNameField.required = true;
        form.appendChild(editNameField);

        const editDescriptionLabel = document.createElement("label");
        editDescriptionLabel.innerHTML = "Description";
        form.appendChild(editDescriptionLabel);

        const editDescriptionField = document.createElement("input");
        editDescriptionField.type = "text";
        editDescriptionField.name = "edit_description";
        editDescriptionField.value = description;
        editDescriptionField.required = true;
        form.appendChild(editDescriptionField);

        const editSubmitButton = document.createElement("input");
        editSubmitButton.type = "submit";
        editSubmitButton.name = "edit_submit";
        editSubmitButton.value = "Save";
        form.appendChild(editSubmitButton);

        document.body.appendChild(form);
        form.submit();
    }
    </script>
</body>
</html>



