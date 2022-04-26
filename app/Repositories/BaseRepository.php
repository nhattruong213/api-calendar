<?php
    namespace App\Repositories;
    use Illuminate\Database\Eloquent\Model;
    class BaseRepository {
        protected $model;
        public function __construct(Model $model)
        {
            $this->model = $model;
        }
        public function getAll(){
            return $this->model->get();
        }
        public function getTaskByID($id) {
            return $this->model->findOrFail($id);
        }
    }
?>