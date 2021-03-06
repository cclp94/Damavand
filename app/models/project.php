<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
require_once 'employee.php';
require_once 'client.php';
require_once 'task.php';
require_once 'assigned.php';

class Project {
    var $projectId, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client;

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

    public static function getAll() {
        $conn = connect();
        $sql = "SELECT * from Project;";
        $result = $conn->query($sql);
        $projects = [];
        while ($result && $row = $result->fetch_assoc()) {
            $projects[] = Project::fromRow($row);
        }
        return $projects;
    }

    public static function getProjectsForUser($user) {
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

    public static function getProject($id) {
        $conn = connect();
        $sql = "SELECT * "
                ."FROM Project "
                ."WHERE Project.projectId = ". $id .";";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return Project::fromRow($row);
    }

    public static function getProjectMock($id) {
        // Get project from db
        return new Project($id, "Mock Project", new Employee(), "2017-01-01", null, "2017-10-04", 100000, new Client());
    }

    function put() {
        $client = $this->client != 'none' ? $this->client : "NULL";
        $supervisor = $this->supervisor != 'none' ? $this->supervisor : "NULL";
        $sql = "INSERT INTO Project(name, startDate, deadline, budget, clientId, supervisorSin)
                VALUE('$this->name', '$this->startDate', '$this->deadline', $this->budget, $client, $supervisor);";
        $result = query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">New Project created!</div>';
        }
    }

    function update() {
        $client = $this->client == 'none' ? "NULL" : $this->client;
        $supervisor = $this->supervisor == 'none' ? "NULL" : $this->supervisor;
        $sql = "UPDATE Project
                SET name = '$this->name',
                    startDate = '$this->startDate',
                    deadLine = '$this->deadline',
                    budget = $this->budget,
                    clientId = $client,
                    supervisorSin = $supervisor
                WHERE projectId = $this->projectId;";
        $result = query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">Project updated!</div>';
        }
    }

    function tasks() {
        return Task::getAll($this->projectId);
    }

    function completeTasks() {
        $tasks = [];
        foreach($this->tasks() as $task) {
            if ($task->isComplete()) {
                $tasks[] = $task;
            }
        }
        return $tasks;
    }

    function purchases() {
        $purchases = [];
        foreach ($this->tasks() as $task) {
            foreach ($task->purchases() as $purchase) {
                $purchases[] = $purchase;
            }
        }
        return $purchases;
    }

    function totalOwed() {
        $total = 0;
       foreach($this->purchases() as $purchase) {
            $total += $purchase->amountOwed;
       }
       return $total;
    }

    function getNumberOfTasks() {
        return count($this->tasks());
    }

    function estimatedTimeOfCompleteTasks() {
        $total = 0;
        foreach ($this->completeTasks() as $task) {
            $total += $task->estTime;
        }
        return $total;
    }

    function totalWages() {
        $total = 0;
        foreach ($this->completeTasks() as $task) {
            $total += $task->totalWages();
        }
        return $total;
    }

    function totalPurchases() {
        $total = 0;
        foreach ($this->completeTasks() as $task) {
            $total += $task->totalPurchases();
        }
        return $total;
    }

    function totalPermits() {
        $total = 0;
        foreach ($this->completeTasks() as $task) {
            $total += $task->totalPermits();
        }
        return $total;
    }

    function estimatedTimeRemaining() {
        $conn = connect();
        $sql = "Select SUM(estimatedTime) from Task group by endDate, projectID having endDate is null and projectID = $this->projectId;";
        $result = $conn->query($sql);
        if (!$result) {
           echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
        }
        $row = $result->fetch_assoc();
        return (int) $row['SUM(estimatedTime)'];
    }

    function estimatedCostOfCompleteTasks() {
        $conn = connect();
        $sql = "select SUM(estimatedCost) from Task where endDate is not null group by projectId having projectId = $this->projectId;";
        $result = $conn->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
        }
        $row = $result->fetch_assoc();
        return (float) $row['SUM(estimatedCost)'];
    }

    function actualCostOfCompleteTasks() {
        $conn = connect();
        $sql = "Select SUM(actualCost) from Task group by endDate, projectID having endDate is not null and projectID = $this->projectId;";
        $result = $conn->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
        }
        $row = $result->fetch_assoc();
        return (float) $row['SUM(actualCost)'];
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
            echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
        }
        $row = $result->fetch_assoc();
        return (int) $row['MAX(phase)'];
    }

    function finalPhase() {
        $conn = connect();
        $sql = "SELECT MAX(phase) ".
            "FROM Task ".
            "GROUP BY projectID, endDate ".
            "HAVING projectID = $this->projectId;";
        $result = $conn->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
        }
        $row = $result->fetch_assoc();
        return (int) $row['MAX(phase)'];
    }

    function complete() {
        return $this->endDate != NULL;
    }

    public static function totalBudgetedCost($user){
        $conn = connect();
        if($user->isAdmin())
            $sql = "SELECT SUM(budget) FROM Project;";
        else
            $sql = "SELECT SUM(budget) FROM Project WHERE clientId = ".Client::getClientFromUser($user->userName)->id.";";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return (float) $row['SUM(budget)'];
    }
}
?>