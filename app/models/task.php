<?php
    require_once 'employee.php';
    class Task{
        var $id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $predecessorTasks, $successorTasks;

        function Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $predecessorTasks, $successorTasks){
            $this->id = $id; 
            $this->name = $name; 
            $this->estTime = $estTime; 
            $this->estCost = $estCost; 
            $this->description =  $description;
            $this->startDate = $startDate; 
            $this->endDate = $endDate; 
            $this->projectId = $projectId; 
            $this->employees = $employees; 
            $this->predecessorTasks = $predecessorTasks; 
            $this->successorTasks = $successorTasks;
        }

        public static function getAll(){
            $conn = connect();
            $sql = "Select * from Task;";
            $result = $conn->query($sql);
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = Task::fromRow($row);
            }
            return $tasks;
        }

        public static function fromRow($row){
            $id = $row['taskId'];
            $name = $row['name']; 
            $estTime = $$row['estimatedTime']; 
            $estCost = $row['estimatedCost']; 
            $description =  $row['description'];
            $startDate = $row['startDate']; 
            $endDate = $row['endDate']; 
            $projectId = $row['projectId'];
            $employees = Task::getEmployeesForTask($id); 
            $predecessorTasks = Task::getPredecessorTasks($id); 
            $successorTasks = Task::getSuccessorTasks($id);
            return new Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $predecessorTasks, $successorTasks);
        }

        public static function getEmployeesForTask($id){
            $conn = connect();
            $sql = "Select * from Assigned where taskId = ".$id.";";
            $result = $conn->query($sql);
            $employees = [];
            while ($result && $row = $result->fetch_assoc()) {
                $employees[] = Employee::get($row['employeeSin']);
            }
            return $employees;
        }

        public static function getPredecessorTasks($id){
            $conn = connect();
            $sql = "SELECT * FROM PreReq WHERE taskSuccessorId = ".$id.";";
            $conn->query($sql);
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = $row['taskPredecessorId'];
            }
            return $tasks;
        }

        public static function getSuccessorTasks($id){
            $conn = connect();
            $sql = "SELECT * FROM PreReq WHERE taskPredecessorId = ".$id.";";
            $conn->query($sql);
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = $row['taskSuccessorId'];
            }
            return $tasks;
        }

        public static function getTaskById($id){
            $conn = connect();
            $sql = "Select * from Task WHERE taskId = ".$id.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return Task::fromRow($row);
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Task(name, startDate, endDate, estimatedTime, estimatedCost, description, projectId) VALUE('"
                   . $this->name . "', "
                   . ($this->startDate ? "'".$this->startDate."', " : "NULL, ")
                   . ($this->endDate ? "'".$this->endDate."', ": "NULL, ")
                   . $this->estTime . ", "
                   . $this->estCost . ", '"
                   . $this->description . "', "
                   . $this->projectId
                   . ");";
            if ($conn->query($sql) == TRUE) {
                echo "New Task created!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
            // INSERT PreReq ENTRY WITH PREDECESSORS AND SUCCESSORS
            foreach($this->predecessorTasks as $pre){
                $sql = "INSERT INTO PreReq VALUE(".$pre.", ".$this->id.");";
                $conn->query($sql);
            }
            foreach($this->successorTasks as $suc){
                $sql = "INSERT INTO PreReq VALUE(".$this->id.", ".$suc.");";
                $conn->query($sql);
            }
        }

        function assignEmployee($SIN, $hours){
            $conn = connect();
            $sql = "INSERT INTO Assigned VALUE(".$this->id.", ".$SIN.", ".$hours.");";
            $conn->query($sql);
        }
    }


?>