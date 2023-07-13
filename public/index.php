<?php
use App\Controllers\TaskController;
require __DIR__ . '/../vendor/autoload.php';
// print_r($_POST);
// print_r($_SERVER);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $new_task = new TaskController;
  $new_task-> create([
                "name"=>$_POST["name"],
                "description"=>$_POST["description"],
                "creationDate"=>$_POST["creationDate"]
                
                
                ]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>To-Do List</title>
	<link rel="stylesheet" href="./src/style.css">
</head>

<body>
	<form method="POST" action="">
    <div class="formContainer">
        <h2 id="title">WHAT'S YOUR TASK?</h2>
		<label for="name">Name:</label>
		<br>
		<input name="name" required type="text" id="name" placeholder="Write your task...">
		<br><br>
		<label for="description">Description:</label>
		<br>
		<input name="description" type="text" id="description" placeholder="Write about your task...">
		<br><br>
		<label for="creationDate">Creation Date</label>
		<input name="creationDate" type="datetime" value="" id="creationDate"></input>
		<br><br>
		<br><br><input type="submit" value="SUBMIT"><input type="reset" value="DELETE">
	</div>
    </form>
	<br><br>
	<div>
	<h2>TASKS</h2>
    <div >
        <?php
            $task_controller = new TaskController;
            $task_list = $task_controller-> indexTask();
            echo "<table>";
            echo "<tr><th>Title</th><th>Description</th></tr>";
            foreach ($task_list as $row){
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["creationDate"] . "</td>";
            echo '<td><button onclick="handleButtonClick(' . $row["id"] . ')">Edit</button></td>';
            echo '<td><button onclick="deteteTask(' . $row["id"] . ')">Delete</button></td>';
            echo "</tr>";
            }
            echo "</table>";
      ?>	
	</div>
	
</body>
</html>





