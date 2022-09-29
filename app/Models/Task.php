<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->code = $model->subject->code.'-'.Str::random(2);
        });
    }

    protected $fillable = [
        'subject_id',
        'title',
        'notes',
        'delivery_date',
    ];

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
