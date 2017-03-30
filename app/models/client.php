<?php
require_once './supervisor.php';
require_once './employee.php';
    class Project{
        var $id, $name, $address, $contactNumber, $contact;

        function Project($id, $name, $supervisor, $startDate, $endDate, $deadline, $budget, $client){
            $this->id = $id;
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
            return new Project($id, "Mock Project", )
        }
    }


?>