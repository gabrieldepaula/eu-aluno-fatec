<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    // public static function boot() {
    //     parent::boot();
    //     self::creating(function($model) {
    //         $model->code = $model->subject->code.'-'.Str::random(2);
    //     });
    // }

    protected $fillable = [
        'subject_id',
        'title',
        'notes',
        'delivery_date',
    ];

    protected $dates = [
        'delivery_date',
        'done_at',
        'delivered_at',
    ];

    protected function id(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value ? str_pad($value, 4, '0', STR_PAD_LEFT) : null,
        );
    }

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
