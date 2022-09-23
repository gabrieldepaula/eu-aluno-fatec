<?php

namespace App\Http\Controllers\Student;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index(Request $request) {
        return $request->ajax() ? $this->table() : view('student.task.index');
    }

    private function table() {
        $student = $this->getStudent();

        $dtData = [];
        foreach($student->tasks as $item) {

            $actions = '';
            $actions .= '<button type="button" class="btn btn-outline-primary btn-block btn-xs" data-action="mark-as-done" data-id="'.$item->id.'"><i class="fas fa-check"></i> Feito</button>';
            $actions .= '<button type="button" class="btn btn-outline-success btn-block btn-xs" data-action="mark-as-delivered" data-id="'.$item->id.'"><i class="fas fa-check"></i> Entregue</button>';

            $dtData[] = [
                'code' => $item->code,
                'title' => '<a href="'.route('student.task.edit', ['id' => $item->id]).'">'.$item->title.'</a>',
                'subject' => $item->subject->name,
                'delivery_date' => '<span class="d-none">'.$item->delivery_date->format('Y-m-d H:i').'</span>'.$item->delivery_date->format('d/m/Y'),
                'status' => $item->getstatusText(),
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
                    $item = Task::find($request->input('id'));
                    $item->done_at = now();
                    $item->save();
                    return response()->json(['error' => false]);
                    break;
                case 'mark-as-delivered':
                    $item = Task::find($request->input('id'));
                    $item->delivered_at = now();
                    $item->save();
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

    public function save(Request $request, $id = null) {
        $item = $id ? Task::findOrFail($id) : new Task();
        return view('student.task.save', compact('item'));
    }
}
