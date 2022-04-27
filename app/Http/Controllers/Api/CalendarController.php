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
        $dates = $this->taskRepository->getAll();
        return response()->json($dates);
    }
   
    public function store(CalendarAddRequest $request)
    {
       
        try {
            $id = Auth::user()->id;
            if($request->has('img')) {
                $file = $request->img;
                $file_name = $file->getClientOriginalName();
                $file->move('Calendar_img',$file_name);
                $addTask = Task::create([
                    'user_id' => $id,
                    'content' => $request->content,
                    'date' => $request->date,
                    'img' => 'http://127.0.0.1:8000/Calendar_img/' . $file_name
                ]);
            }
            else {
                $addTask = Task::create([
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

    public function show($id)
    {
        $dates = $this->taskRepository->getTaskByDate($id);
        return response()->json($dates);
    }
    public function update(CalendarEditRequest $request, $id)
    {
        $contentUpdate = $this->taskRepository->getTaskByID($id);
        try {
            $contentUpdate->update([
                'content' => $request->content,
            ]);
            return response()->json(['success' => 'Edit successful!']);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        $content = $this->taskRepository->getTaskByID($id);
        try {
            $content->delete();
            return response()->json(['success' => 'Delete successful!']);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
