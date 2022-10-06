<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request) {

        $student = $this->getStudent();

        $data = [
            'tasks' => [
                'total' => $student->tasks->count(),
                'pending' => 0,
                'delivered' => 0,
                'late' => 0,
            ]
        ];

        $now = Carbon::now();
        foreach($student->tasks as $task) {

            $isDone = $task->isDone();
            $isDelivered = $task->isDelivered();
            $deliveryDate = $task->delivery_date;

            if($isDelivered) {
                $data['tasks']['delivered']++;
            } else {
                if(!$isDone && !$isDelivered && $now->lessThanOrEqualTo($deliveryDate)) {
                    $data['tasks']['pending']++;
                }

                if(!$isDelivered && $now->greaterThanOrEqualTo($deliveryDate)) {
                    $data['tasks']['late']++;
                }
            }
        }

        return view('student.home.index', compact('data'));
    }
}
