<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
require_once 'employee.php';
require_once 'client.php';
    class Project{
        var $projectID, $name, $supervisor, $startDate, $endDate,$deadline, $budget, $client;

        function Project($id, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client){
            $this->projectId = $id;
            $this->name = $name;
            $this->supervisor = $supervisor;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->deadline = $deadline;
            $this->budget = $budget;
            $this->client = $client;
        }

        public static function fromRow($row){
            $id = $row['projectId'];
            $name = $row['projectName'];
            $startDate = $row['startDate'];
            $endDate = $row['endDate'];
            $deadline = $row['deadLine'];
            $budget = $row['budget'];
            $row['name'] = $row['clientName'];
            $client = Client::fromRow($row);
            $row['name'] = $row['supervisorName'];
            $supervisor = Employee::fromRow($row);
            return new Project($id, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client);
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT projectId, Project.name as projectName, startDate, endDate, deadLine, budget, sin, Employee.name as supervisorName, title, wage, Client.clientId, Client.name as clientName, businessPhoneNumber, businessAddressId, contactName, contactPhoneNumber, contactAddressId, userName "
                  ."FROM Project, Employee, Client "
                  ."WHERE (Project.clientId = Client.clientId OR Project.clientId is NULL) AND "
                  ."(Project.supervisorSin = Employee.sin OR Project.supervisorSin is NULL);";
            $result = $conn->query($sql);
            $projects = [];
            while ($result && $row = $result->fetch_assoc()) {
                $projects[] = Project::fromRow($row);
            }
            return $projects;
        }

        public static function getProject($id){
            $conn = connect();
            $sql = "SELECT projectId, Project.name as projectName, startDate, endDate, deadLine, budget, sin, Employee.name as supervisorName, title, wage, Client.clientId, Client.name as clientName, businessPhoneNumber, businessAddressId, contactName, contactPhoneNumber, contactAddressId, userName "
                  ."FROM Project, Employee, Client "
                  ."WHERE Project.projectId = ". $id ." AND (Project.clientId = Client.clientId OR Project.clientId is NULL) AND "
                  ."(Project.supervisorSin = Employee.sin OR Project.supervisorSin is NULL);";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return Project::fromRow($row);
        }

        public static function getProjectMock($id){
            // Get project from db
            return new Project($id, "Mock Project", new Employee(), "2017-01-01", null, "2017-10-04", 100000, new Client());
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Project(name, startDate, deadline, budget, clientId, supervisorSin) VALUE('"
                   . $this->name . "', '"
                   . $this->startDate . "', '"
                   . $this->deadline . "', "
                   . $this->budget
                   . ($this->client != 'none' ? ", ". $this->client  : ", NULL")
                   . ($this->supervisor != 'none'? ", ".$this->supervisor : ", NULL")
                   . ");";
            if ($conn->query($sql) == TRUE) {
                echo "New Project created!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }

        function update(){
            $conn = connect();
            $sql = "UPDATE Project"
            ." SET name = '".$this->name."', startDate = '". $this->startDate . "', deadLine = '". $this->deadline . "', budget = " . $this->budget . ", clientId = " . $this->client . ", supervisorSin = ". $this->supervisor . " "
            ." WHERE projectId = ".$this->projectId.";";

            if ($conn->query($sql) == TRUE) {
                echo "Project updated!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }

        function getNumberOfTasks(){
            $conn = connect();
            $sql = "Select COUNT(*) from Task where projectId = ".$this->projectId.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['COUNT(*)'];
        }

        function completeTasks() {
            $conn = connect();
            $sql = "Select * from Task order by phase where endDate is not null and projectID = $projectID;";
            $result = $conn->query($sql);
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = Task::fromRow($row);
            }
            return $tasks;
        }

        function estimatedTimeOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(estimatedTime) from Task having endDate is not null and projectID = $projectID;";
            return (int) $conn->query($sql);
        }

        function estimatedCostOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(estimatedCost) from Task having endDate is not null and projectID = $projectID;";
            return (float) $conn->query($sql);
        }

        function actualCostOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(actualCost) from Task having endDate is not null and projectID = $projectID;";
            return (float) $conn->query($sql);
        }
    }
?>