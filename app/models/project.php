<?php
require_once './supervisor.php';
require_once './employee.php';
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

        public static function getProject($id){
            // Get project from db
        }

        public static function getProjectMock($id){
            // Get project from db
            return new Project($id, "Mock Project", new Employee(), "2017-01-01", null, "2017-10-04", 100000, new Client());
        }
    }


?>