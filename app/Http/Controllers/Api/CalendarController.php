<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarAddRequest;
use App\Http\Requests\CalendarEditRequest;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
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
            
            if($request->has('img')) {
                $file = $request->img;
                $file_name = $file->getClientOriginalName();
                $file->move('Calendar_img',$file_name);
                $addTask = Task::create([
                    'content' => $request->content,
                    'date' => $request->date,
                    'img' => 'Calendar_img/' . $file_name
                ]);
            }
            else {
                $addTask = Task::create([
                    'content' => $request->content,
                    'date' => $request->date,
                ]);
            }
            return response()->json($addTask);
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
            return response()->json($contentUpdate);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        $content = $this->taskRepository->getTaskByID($id);
        try {
            $content->delete();
            if($content->delete()) 
            {
                Storage::delete('274722658_2164756607014895_1166081168313812392_n.jpg');
            }
            return response()->json(['success' => 'Delete successful!']);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
