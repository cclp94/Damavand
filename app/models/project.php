<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
require_once 'employee.php';
require_once 'client.php';
    class Project{
        var $projectId, $name, $supervisor, $startDate, $endDate,$deadline, $budget, $client;

        function Project($id, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client) {
            $this->projectId = $id;
            $this->name = $name;
            $this->supervisor = $supervisor;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->deadline = $deadline;
            $this->budget = $budget;
            $this->client = $client;
        }

        public static function fromRow($row) {
            $id = (int) $row['projectId'];
            $name = $row['name'];
            $startDate = $row['startDate'];
            $endDate = $row['endDate'];
            $deadline = $row['deadLine'];
            $budget = $row['budget'];
            $client = ($row['clientId'] ? Client::getClient($row['clientId']) : null);
            $supervisor = ($row['supervisorSin'] ? Employee::get($row['supervisorSin']) : null);
            return new Project($id, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client);
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT * from Project;";
            $result = $conn->query($sql);
            $projects = [];
            while ($result && $row = $result->fetch_assoc()) {
                $projects[] = Project::fromRow($row);
            }
            return $projects;
        }

        public static function getProjectsForUser($user){
            if($user->isAdmin())
                return Project::getAll();

            $conn = connect();
            $sql = "SELECT Project.* "
                  ."FROM Project, Employee, Client, (SELECT clientId FROM Client, Users WHERE Client.userName = '$user->userName' AND Client.userName = Users.userName) as userClient "
                  ."WHERE (userClient.clientId = Project.clientId) AND (Project.clientId = Client.clientId OR Project.clientId is NULL) AND "
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
            $sql = "SELECT * "
                  ."FROM Project "
                  ."WHERE Project.projectId = ". $id .";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return Project::fromRow($row);
        }

        public static function getProjectMock($id){
            // Get project from db
            return new Project($id, "Mock Project", new Employee(), "2017-01-01", null, "2017-10-04", 100000, new Client());
        }

        function put() {
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
            ." SET name = '".$this->name."', startDate = '". $this->startDate . "', deadLine = '". $this->deadline . "', budget = " . $this->budget . ", clientId = " . ($this->client == 'none' ? "NULL" :  $this->client) . ", supervisorSin = ".($this->supervisor == 'none' ? "NULL" :   $this->supervisor). " "
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
            $sql = "Select * from Task order by phase where endDate is not null and projectID = $this->projectId;";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error " . $sql . ": ". $conn->error;
            }
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = Task::fromRow($row);
            }
            return $tasks;
        }

        function estimatedTimeOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(estimatedTime) from Task group by endDate, projectID having endDate is not null and projectID = $this->projectId;";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error " . $sql . ": ". $conn->error;
            }
            return (int) $result;
        }

        function estimatedCostOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(estimatedCost) from Task group by endDate, projectID having endDate is not null and projectID = $this->projectId;";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error " . $sql . ": ". $conn->error;
            }
            return (float) $result;
        }

        function actualCostOfCompleteTasks() {
            $conn = connect();
            $sql = "Select sum(actualCost) from Task group by endDate, projectID having endDate is not null and projectID = $this->projectId;";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error " . $sql . ": ". $conn->error;
            }
            return (float) $result;
        }

        function latestPhase() {
            $conn = connect();
            $sql = "SELECT MAX(phase) ".
                "FROM Task ".
                "GROUP BY projectID, endDate ".
                "HAVING projectID = $this->projectId ".
                "AND endDate IS NOT NULL;";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error " . $sql . ": ". $conn->error;
            }
            return (int) $result;
        }
    }
?>