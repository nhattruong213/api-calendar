<?php
    namespace App\Repositories\Task;
    use App\Models\Task;
    use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

    class TaskRepository extends BaseRepository {
        protected $task;
        public function __construct(Task $task)
        {
            parent::__construct($task);
            $this->task = $task;
        }
        public function getTaskByDate($date){
            return $this->task->where('date',$date)->where('user_id',Auth::user()->id)->get();
        }
        public function getTaskByUserId($id) {
            return $this->task->where('user_id', $id)->get();
        }
    }
?>