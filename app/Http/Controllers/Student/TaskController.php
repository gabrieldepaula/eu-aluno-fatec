<?php

namespace App\Http\Controllers\Student;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request) {

        if($request->ajax()) {
            return $this->table();
        } else {
            $student = $this->getStudent();
            $subjects = [];
            foreach($student->subjects as $subject) {
                $subjects[] = [
                    'id' => $subject->id,
                    'title' => $subject->title,
                ];
            }
            return view('student.task.index', compact('subjects'));
        }
        // return $request->ajax() ? $this->table() : view('student.task.index');
    }

    private function table() {
        $student = $this->getStudent();

        $dtData = [];
        foreach($student->tasks as $task) {

            $isDone = $task->isDone();
            $isDelivered = $task->isDelivered();

            $actions = '';
            if(!$isDone) $actions .= '<button type="button" class="btn btn-outline-primary btn-block btn-xs" data-action="mark-as-done" data-id="'.$task->id.'"><i class="fas fa-check"></i> Feito</button>';
            if(!$isDelivered) {
                $actions .= '<button type="button" class="btn btn-outline-success btn-block btn-xs" data-action="mark-as-delivered" data-id="'.$task->id.'"><i class="fas fa-check"></i> Entregue</button>';
                $actions .= '<button type="button" class="btn btn-outline-danger btn-block btn-xs" data-action="delete" data-id="'.$task->id.'"><i class="fas fa-trash"></i> Apagar</button>';
            }

            $dtData[] = [
                'title' => '<a href="'.route('student.task.edit', ['task' => $task]).'">'.$task->title.'</a>',
                'subject' => '<span class="d-none">subject-'.$task->subject->id.'</span>'.$task->subject->title,
                'delivery_date' => '<span class="d-none">'.$task->delivery_date->format('Y-m-d H:i:s').'</span>'.$task->delivery_date->format('d/m/Y H:i'),
                'done_at' => $isDone ? '<span class="d-none">'.$task->done_at->format('Y-m-d H:i:s').'</span>'.$task->done_at->format('d/m/Y H:i') : '',
                'delivered_at' => $isDelivered ? '<span class="d-none">'.$task->delivered_at->format('Y-m-d H:i:s').'</span>'.$task->delivered_at->format('d/m/Y H:i') : '',
                'status' => $task->getstatusText(),
                'actions' => $actions,
            ];
        }

        return datatables($dtData)->rawColumns(['title', 'subject', 'delivery_date', 'done_at', 'delivered_at', 'status', 'actions'])->toJson();
    }

    public function actions(Request $request) {

        if(!$request->ajax()) {
            return response()->json(['error' => true]);
        } else {
            switch($request->input('action')) {
                case 'mark-as-done':
                    $task = Task::find($request->input('id'));
                    $task->done_at = now();
                    $task->save();
                    return response()->json(['error' => false]);
                    break;
                case 'mark-as-delivered':
                    $task = Task::find($request->input('id'));
                    $task->delivered_at = now();
                    if(!$task->done_at) $task->done_at = now();
                    $task->save();
                    return response()->json(['error' => false]);
                    break;

                case 'delete':
                    $item = Task::find($request->input('id'));
                    $item->delete();
                    return response()->json(['error' => false]);
                break;

                default:
                    return response()->json(['error' => true]);
                break;
            }
        }
    }

    public function form(Request $request, Task $task) {
        return view('student.task.save', compact('task'));
    }

    public function save(SaveTaskRequest $request, Task $task) {

        $data = $request->safe()->only([
            'subject_id',
            'title',
            'notes',
            'delivery_date',
        ]);

        $message = 'Tarefa '.($task->exists ? 'atualizada' : 'cadastrada').' com sucesso.';

        $deliveryDate = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $data['delivery_date']);

        $task->subject_id       = $data['subject_id'];
        $task->title            = $data['title'];
        $task->notes            = $data['notes'];
        $task->delivery_date    = $deliveryDate->format('Y-m-d H:i:s');

        $student = $this->getStudent();
        $student->tasks()->save($task);

        return redirect()->route('student.task.index')->with('message', $message);
    }
}
