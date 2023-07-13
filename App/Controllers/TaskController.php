<?php
namespace App\Controllers;
use PDO\DatabaseConnection;

class TaskController{

public function create($data){
        $server= "127.0.0.1";
        $username= "root";
        $password = "";
        $database= "todolist";
    
$db= new DatabaseConnection($server, $username, $password, $database);
$db-> connect();
    
$query= "INSERT INTO tasks(name, description, creationDate)
             VALUES (?,?,?)";
$results= $db-> executeQuery($query, [$data["name"],
                                        $data["description"],
                                        $data["creationDate"]
                                        
                            ]);
print_r($results);

if (!empty($results)){
    echo "se realizo ok";
}else{
     echo "error";
};
        
} 
public function indexTask(){
    $server = '127.0.0.1';
    $username = 'root';
    $password = '';
    $database = 'todolist';
    $db = new DatabaseConnection($server, $username, $password, $database);
    $db->connect();
    $query = "SELECT * FROM tasks";
    $result =$db ->executeQuery($query)->fetchAll(\PDO::FETCH_ASSOC);
    //if (empty($results)){
     //  echo "Ooops something went wrong :/";
    //};
    return $results;
}

//public function edit($data){
   // $server = '127.0.0.1';
    //$username = 'root';
    //$password = '';
    //$database = 'todolist';
    //$db = new DatabaseConnection($server, $username, $password, $database);
    //$db->connect();
    //$query = "UPDATE tasks SET name=:name, description=:description WHERE id=:id";
    //$results= $db-> executeQuery($query, [
        //'name' => $data['name'],
        //'description' => $data['description'],
        //'id' => $data['id'],
    //]);
//print_r($results);
//if ($success) {
   // echo "Tarea actualizada correctamente";
//} else {
    //echo "Error al actualizar la tarea";
//}
//}



public function deleteTask(){
    $server = '127.0.0.1';
    $username = 'root';
    $password = '';
    $database = 'todolist';
    $db = new DatabaseConnection($server, $username, $password, $database);
    $db->connect();
    $query = "DELETE FROM tasks WHERE id = ?";
    $results = $db->executeQuery($query, [$taskId]);

        if ($results) {
            echo "Tarea eliminada correctamente";
        } else {
            echo "Error al eliminar la tarea";
        }
}
}
?>