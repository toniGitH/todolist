<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// The class TaskModel file doesn't need to be imported due to the autoloader
//require_once "../app/models/TaskModel.php";

class ApplicationController extends Controller 
{
    public function getAllTasksAction()
    {
    
        $allTasks = [];

        $dataJson = new TaskModel();

        $this->view->allTasks = $dataJson->getAllTasks();

        //return $allTasks;
    }	

	public function getViewInsertFormAction()
    {   
    }

    public function createTaskAction()
    {
        if (isset($_POST) && !empty($_POST)) {
            // Starting data not greater than Deadline validation
            if ($_POST["task_deadline"] < $_POST["task_startDate"]) {
                $this->view->message = "Start date cannot be greater than the Deadline!!";
                $this->view->txtColor = "text-red-500";
            }
            else{
                // Array where store data collected from the new task creation form
                $newTaskData = array(
                "task_id"=> uniqid(),
                "task_name" => $_POST["task_name"],
                "task_details" => $_POST["task_details"],
                "task_created_by" => $_POST["task_created_by"],
                "task_creation_date" => $_POST["task_startDate"],
                "task_deadline" => $_POST["task_deadline"],
                "task_assigned_to" => $_POST["task_assigned_to"],
                "task_status" => "Pending"
                );
                // Model call to insert the newTaskData into the json file
                $taskModel = new TaskModel();
                $taskModel->createTask($newTaskData);
                // Success message;
                $this->view->message = "New task created successfully!!";
                $this->view->txtColor = "text-green-500";
            }
        }
        else{
            // Error message;
            $this->view->message = "Error: new task could not be created";
            $this->view->txtColor = "text-red-500";
        }
    }

    public function getViewPreDeleteAction()
    {
        // Getting the task_id
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        // Model call to get the taskData array that will be deleted from the json file
        $taskModel = new TaskModel();
        $task = $taskModel->getTaskById($task_id);
        // Definition of getViewPreDelete.phtml script parameters
        if (isset($task) && is_array($task)) {
            $this->view->task_id = $task["task_id"];
            $this->view->message = "You are about to delete the task: " . $task["task_name"];
            $this->view->buttonText="No way!!";
            $this->view->txtColor = "text-lime-600";
        } else {
            $this->view->message = "$task";
            $this->view->buttonText="Show all tasks";
            $this->view->txtColor = "text-red-600";
        }
    }

    public function deleteTaskAction()
    {
        // Getting the task_id
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        // Model call to execute the deletion of the task from the json file
        $taskModel = new TaskModel();
        $isDeleted = $taskModel->deleteTask($task_id);
        // Definition of deleteTask.phtml script parameters
        if ($isDeleted!=true) {
            $this->view->message = "Task not found";
            $this->view->buttonText="Create a new task";
            $this->view->txtColor = "text-red-600";
        } else {
            $this->view->message = "The task has been deleted successfully";
            $this->view->buttonText="Show all tasks";
            $this->view->txtColor = "text-lime-600";
        }
       
    }

    public function getViewUpdateFormAction()
    {
        // Getting the task_id
        $parameters = $this->_namedParameters;
        $task_id = $parameters["id"];
        // Model call to get the selected task to update from the json file
        $taskModel = new TaskModel();
        $taskData = $taskModel->getTaskById($task_id);
        // If task to update exists, update the json file
        if (isset($taskData) && is_array($taskData)) {
            // Use the magic method __set to assign values to _data property (protected class View property)
            foreach ($taskData as $key => $value) {
                $this->view->$key = $value;
            }
        }
        else{
            header('Location: /developeredit/');
            exit();
        }
    }

    public function updateTaskAction()
    {
        if (isset($_POST) && !empty($_POST)) {
            // Starting data not greater than Deadline validation
            if ($_POST["task_deadline"] < $_POST["task_startDate"]) {
                $this->view->message = "Start date cannot be greater than the Deadline!!";
                $this->view->txtColor = "text-red-500";
            }
            else{
                // Array where store data collected from the new task creation form
                $updatedTaskData = array(
                "task_id"=> $_POST["task_id"],
                "task_name" => $_POST["task_name"],
                "task_details" => $_POST["task_details"],
                "task_created_by" => $_POST["task_created_by"],
                "task_creation_date" => $_POST["task_startDate"],
                "task_deadline" => $_POST["task_deadline"],
                "task_assigned_to" => $_POST["task_assigned_to"],
                "task_status" => $_POST["task_status"]
                );
                // Model call to insert the newTaskData into the json file
                $taskModel = new TaskModel();
                $taskModel->updateTask($_POST["task_id"], $updatedTaskData);
                // Success message;
                $this->view->message = "Task updated successfully!!";
                $this->view->txtColor = "text-green-500";
            }
        }
        else{
            // Error message;
            $this->view->message = "Error: task could not be updated";
            $this->view->txtColor = "text-red-500";
        }
    } 

    public function getViewSearchFormAction()
    {
    }

    public function getSearchResultsAction()
    {
        // Set taskFilter array to search tasks acording to this conditions
        if (isset($_POST) && !empty($_POST)) {
            $taskFilter = [];
            if (isset($_POST["task_name"]) && !empty($_POST["task_name"])) {
                $taskFilter["task_name"] = $_POST["task_name"];
            }
            if (isset($_POST["task_created_by"]) && !empty($_POST["task_created_by"])) {
                $taskFilter["task_created_by"] = $_POST["task_created_by"];
            }
            if (isset($_POST["task_assigned_to"]) && !empty($_POST["task_assigned_to"])) {
                $taskFilter["task_assigned_to"] = $_POST["task_assigned_to"];
            }
            if (isset($_POST["task_status"]) && !empty($_POST["task_status"]) && $_POST["task_status"]!="All statuses") {
                $taskFilter["task_status"] = $_POST["task_status"];
            }
        
            $taskModel = new TaskModel();
            $tasksFounded = $taskModel->searchTasks($taskFilter);

            if (isset($tasksFounded) && !empty($tasksFounded)) {
                $this->view->results = $tasksFounded;
            }
            else{
                $this->view->message = "No results found";
                $this->view->txtColor = "text-red-500";
            }  
        }
        else{
            $this->view->message = "No results found";
            $this->view->txtColor = "text-red-500";
        }
    }

}
