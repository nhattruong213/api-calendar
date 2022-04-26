<?php
    namespace App\Repositories\Task;
    use App\Models\Task;
    use App\Repositories\BaseRepository;

    class TaskRepository extends BaseRepository {
        protected $task;
        public function __construct(Task $task)
        {
            parent::__construct($task);
            $this->task = $task;
        }
        public function getTaskByDate($id){
            return $this->task->where('date',$id)->get();
        }
    }
?>