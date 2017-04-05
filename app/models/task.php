<?php
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

        public static function fromRow($row){
            $this->id = $row[''];
            $this->name = $row['']; 
            $this->estTime = $$row['']; 
            $this->estCost = $row['']; 
            $this->description =  $row[''];
            $this->startDate = $row['']; 
            $this->endDate = $row['']; 
            $this->projectId = $row['']; 
            $this->employees = $row['']; 
            $this->predecessorTasks = $row['']; 
            $this->successorTasks = $row[''];
        }

        public static function getEmployeesForTask($id){

        }
    }


?>