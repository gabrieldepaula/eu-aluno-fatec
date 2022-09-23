<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'delivery_date' => 'date',
        'done_at' => 'date',
        'delivered_at' => 'date',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function getstatusText() {
        return 'status-model';
    }

    public function isDelivered() {
        return $this->delivered_at ? true : false;
    }

    public function isDone() {
        return $this->done_at ? true : false;
    }
}
