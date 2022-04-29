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
        public function getById($id) {
            return $this->model->findOrFail($id);
        }
        public function deleteById($id) {
            $detele = $this->getById($id);
            $detele->delete(); 
        }
        public function editById($id, $data) {
            $detele = $this->getById($id);
            $detele->update($data); 
        }
        public function create($data) {
            $this->model->create($data); 
        }
    }
?>