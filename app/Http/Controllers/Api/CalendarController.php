<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarAddRequest;
use App\Http\Requests\CalendarEditRequest;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    protected $taskRepository;
    protected $task;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskRepository->getAll();
        return response()->json($tasks);
    }
    public function store(CalendarAddRequest $request)
    {
        try {
            $id = Auth::user()->id;
            if($request->has('img')) {
                $file = $request->img;
                $fileName = $file->getClientOriginalName();
                $file->move('CalendarImg',$fileName);
                $this->taskRepository->create([
                    'user_id' => $id,
                    'content' => $request->content,
                    'date' => $request->date,
                    'img' => 'http://127.0.0.1:8000/CalendarImg/' . $fileName
                ]);
            }
            else {
                $this->taskRepository->create([
                    'user_id' => $id,
                    'content' => $request->content,
                    'date' => $request->date,
                ]);
            }
            return response()->json(['success' => 'Add successful!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function show($date)
    {
        $tasks = $this->taskRepository->getTaskByDate($date);
        return response()->json($tasks);
    }
    public function update(CalendarEditRequest $request, $id)
    {
        $data = [
            'content' => $request->content
        ];
        try {
            $this->taskRepository->editById($id, $data);
            return response()->json(['success' => 'Edit successful!']);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $this->taskRepository->deleteById($id);
            return response()->json(['success' => 'Delete successful!']);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function getTaskByUser() {
        $id = Auth::user()->id;
        $task = $this->taskRepository->getTaskByUserId($id);
        return response()->json($task);
    }
}
