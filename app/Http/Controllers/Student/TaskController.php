<?php

namespace App\Http\Controllers\Student;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request) {
        return $request->ajax() ? $this->table() : view('student.task.index');
    }

    private function table() {
        $student = $this->getStudent();

        $dtData = [];
        foreach($student->tasks as $task) {

            $actions = '';
            $actions .= '<button type="button" class="btn btn-outline-primary btn-block btn-xs" data-action="mark-as-done" data-id="'.$task->id.'"><i class="fas fa-check"></i> Feito</button>';
            $actions .= '<button type="button" class="btn btn-outline-success btn-block btn-xs" data-action="mark-as-delivered" data-id="'.$task->id.'"><i class="fas fa-check"></i> Entregue</button>';

            $dtData[] = [
                'code' => $task->code,
                'title' => '<a href="'.route('student.task.edit', ['task' => $task]).'">'.$task->title.'</a>',
                'subject' => $task->subject->title,
                'delivery_date' => '<span class="d-none">'.$task->delivery_date->format('Y-m-d H:i').'</span>'.$task->delivery_date->format('d/m/Y'),
                'status' => $task->getstatusText(),
                'actions' => $actions,
            ];
        }

        return datatables($dtData)->rawColumns(['title', 'delivery_date', 'status', 'actions'])->toJson();
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

        $validated = $request->safe()->only([
            'subject_id',
            'title',
            'notes',
            'delivery_date',
        ]);

        $message = 'Tarefa '.($task->exists ? 'atualizada' : 'cadastrada').' com sucesso.';

        $task->fill($validated);

        $student = $this->getStudent();
        $student->tasks()->save($task);

        return redirect()->route('student.task.index')->with('message', $message);
    }
}
