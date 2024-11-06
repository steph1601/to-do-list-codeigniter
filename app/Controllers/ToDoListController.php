<?php

namespace App\Controllers;

use App\Models\Status;
use App\Models\ToDoList;
use CodeIgniter\I18n\Time;

class ToDoListController extends BaseController
{
    public $model;
    public $status;

    public function __construct()
    {
        // Instantiate the model
        $this->model = new ToDoList();
        $this->status = new Status();
    }

    //BADGE COLOR
    protected function getBadgeColors()
    {
        return [
            1 => 'text-bg-secondary',
            2 => 'text-bg-primary',
            3 => 'text-bg-success',
            4 => 'text-bg-warning',
            5 => 'text-bg-dark',
        ];
    }

    public function index()
    {
        $tasks = $this->model->getAllTasksWithStatus();

     

        //badge colors
        $badgeColors = $this->getBadgeColors();
        foreach ($tasks as &$task) {
            $task['badge_class'] = isset($badgeColors[$task['status']]) ? $badgeColors[$task['status']] : 'badge-secondary';

            $date_time = $task['updated_at'];
        
            $date = new Time($date_time);

            $formatted_date = $date->format('F d, Y');

            $formatted_time = $date->format('h:i A');

            $task['date'] = $formatted_date;

            $task['time'] = $formatted_time;

        }

        $data = [
            'page_title' => 'My Current Tasks',
            'tasks' => $tasks,
            ];
        echo view('index',$data);
    }


    public function create(){

        return view('to-do-create');
    }


    public function store(){     

        $data = $this->request->getPost();

        if ($this->validate(['task' => 'required',  ]))  {
                $data['user_id'] = 1;

                if (empty($data['description'])) {
                    $data['description'] = null;
                }
        

                if ($this->model->save($data)) {
                    $response = [
                        'success' => true,
                        'status' => 'success',
                        'message' => 'Task Added Successfully',
                    ];
                    return $this->response->setJSON($response);
                } 
                else {
                    $response = [
                        'success' => false,
                        'status' => 'error',
                        'message' => 'A problem occurred',
                    ];
                    return $this->response->setJSON($response);
                }
            }
        else {
            echo "No data Inserted";
        }   
        
       
        
    }

    
    public function show($id){

        $task = $this->model->getTaskWithStatus($id);

        $badgeColors = $this->getBadgeColors();

        $task['badge_class'] = isset($badgeColors[$task['status']]) ? $badgeColors[$task['status']] : 'badge-secondary';
        
        $date_time = $task['updated_at'];
        
        $date = new Time($date_time);

        $formatted_date = $date->toDateString(); 

        $formatted_time = $date->format('h:i A');

        $task['date'] = $formatted_date;

        $task['time'] = $formatted_time;

        if($task['description'] == null){
            $task['description'] = "No description given";
        }

        if ($task) {
            // Pass the task data to the view
            $data = ['task' => $task];
            return view('to-do-show', $data);
        }
        
    }

    
    public function edit($id){

        $task = $this->model->find($id);
        $status = $this->status->findAll();

        $data = [
            'task' => $task,
            'statuses' => $status
            ];

            echo view('to-do-edit',$data);
        
    }

    public function update($id){

      
        $task = $this->model->find($id);
        $data = $this->request->getRawInput();

        if (empty($data['description'])) {
            $data['description'] = null;
        }
        
        $updatedData = [
            'task' => $data['task'],
            'description' => $data['description'],
            'status' => $data['status'],
        ];
        if($this->model->update($id, $updatedData)){
            $response = [
                'success' => true,
                'status' => 'success',
                'message' => 'Task Edited Successfully',
            ];
            return $this->response->setJSON($response);
        } 
        else {
            $response = [
                'success' => false,
                'status' => 'error',
                'message' => 'A problem occurred',
            ];
            return $this->response->setJSON($response);
        }
    
        
    }

    
    public function destroy($id){

        $task = $this->model->find($id);

        if(!$task){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Task not found'
            ]);
        }

        $this->model->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Task deleted successfully'
        ]);
        
    }

    public function getCompleteTask(){
        $tasks = $this->model->getAllCompleteTasksWithStatus();
 
            foreach ($tasks as &$task) {
                $task['badge_class'] = 'text-bg-success';
                $date_time = $task['updated_at'];
        
                $date = new Time($date_time);
    
                $formatted_date = $date->format('F d, Y');
    
                $formatted_time = $date->format('h:i A');
    
                $task['date'] = $formatted_date;
    
                $task['time'] = $formatted_time;
            }

            $data = [
                'page_title' => 'My Completed Tasks',
                'tasks' => $tasks,
                ];
            echo view('to-do-complete',$data);

        
    }


}
