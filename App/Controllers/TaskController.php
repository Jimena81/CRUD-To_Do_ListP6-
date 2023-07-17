<?php
namespace App\Controllers;
use PDO\DatabaseConnection;


class TaskController {

    private $db;

    public function __construct() {
        $server = '127.0.0.1';
        $username = 'root';
        $password = '';
        $database = 'todolist';

        $this->db = new DatabaseConnection($server, $username, $password, $database);
        $this->db->connect();
    }

    // CREATE

    public function createTask($data) {
        $query = "INSERT INTO tasks (name, description) VALUES (?, ?)";

        $results = $this->db->execute_query($query, [
            $data['name'],
            $data['description']
        ]);
    }

    //READ

    public function indexTask() {
        $query = "SELECT * FROM tasks";
        $results = $this->db->execute_query($query)->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    //UPDATE

    public function editTask($id, $data) {
        $query = "UPDATE tasks SET name = ?, description = ? WHERE id = ?";
        $this->db->execute_query($query, [
            $data['name'],
            $data['description'],
            $id
           
        ]);   
    }


    //DELETE

    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = ?";
        $this->db->execute_query($query, [$id]);
    }   
    
}
?>