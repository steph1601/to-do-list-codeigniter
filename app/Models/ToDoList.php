<?php

namespace App\Models;

use CodeIgniter\Model;

class ToDoList extends Model
{
    protected $table      = 'tasks_list';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'task', 'description', 'status'];

    // protected bool $allowEmptyInserts = false;
     protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'task' => 'required',
    ];
    protected $validationMessages   = [
        'task' => [
            'required' => 'Task Name is required'],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getAllTasksWithStatus()
    {
        return $this->select('tasks_list.*, status.status_name as status_name') 
                    ->join('status', 'status.id = tasks_list.status', 'left')
                    ->where('tasks_list.status !=', 3)
                    ->findAll();
    }

    public function getAllCompleteTasksWithStatus()
    {
        return $this->select('tasks_list.*, status.status_name as status_name') 
                    ->join('status', 'status.id = tasks_list.status', 'left')
                    ->where('tasks_list.status =', 3)
                    ->findAll();
    }

    public function getTaskWithStatus($taskId)
    {
        // Join the tasks_list table with the status table
        return $this->select('tasks_list.*, status.status_name as status_name')
                    ->join('status', 'status.id = tasks_list.status', 'left')
                    ->where('tasks_list.id', $taskId)
                    ->first();
    }

}