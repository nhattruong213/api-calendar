<?php
    namespace App\Repositories\Task;

use App\Models\Event;
use App\Models\Task;
    use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

    class TaskRepository extends BaseRepository {
        protected $task;
        protected $event;
        public function __construct(Task $task, Event $event)
        {
            parent::__construct($task);
            $this->task = $task;
            $this->event = $event;
        }
        public function getTaskByDate($date){
            return $this->task->where('date',$date)->where('user_id',Auth::user()->id)->with('events')->get();
        }
        public function getTaskByUserId($id) {
            return $this->task->where('user_id', $id)->with('events')->get();
        }
        public function getEvent() {
            return $this->event->get();
        }
    }
?>