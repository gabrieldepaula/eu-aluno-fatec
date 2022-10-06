<?php

namespace App\Http\Controllers\Student;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request) {

        // $item = Task::find(4);
        // dd($item->delivery_date->format('d/m/Y H:i:s'));

        // $value = '31/12/2022 11:22:33';
        // $date = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value);
        // dd($date->format('Y-m-d H:i:s'));

        // $item = new Task();
        // $item->delivery_date = $value;
        // $item->delivery_date = $date->format('Y-m-d H:i:s');
        // dd($item->delivery_date->format('d/m/Y H:i:s'));
        // dd($item->delivery_date->format('Y-m-d H:i:s'));

        return $request->ajax() ? $this->table() : view('student.task.index');
    }

    private function table() {
        $student = $this->getStudent();

        $dtData = [];
        foreach($student->tasks as $task) {

            $actions = '';
            $actions .= '<button type="button" class="btn btn-outline-primary btn-block btn-xs" data-action="mark-as-done" data-id="'.$task->id.'"><i class="fas fa-check"></i> Feito</button>';
            $actions .= '<button type="button" class="btn btn-outline-success btn-block btn-xs" data-action="mark-as-delivered" data-id="'.$task->id.'"><i class="fas fa-check"></i> Entregue</button>';
            $actions .= '<button type="button" class="btn btn-outline-danger btn-block btn-xs" data-action="delete" data-id="'.$task->id.'"><i class="fas fa-trash"></i> Apagar</button>';

            $dtData[] = [
                'code' => $task->id,
                'title' => '<a href="'.route('student.task.edit', ['task' => $task]).'">'.$task->title.'</a>',
                'subject' => $task->subject->title,
                'delivery_date' => '<span class="d-none">'.$task->delivery_date->format('Y-m-d H:i:s').'</span>'.$task->delivery_date->format('d/m/Y H:i'),
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
