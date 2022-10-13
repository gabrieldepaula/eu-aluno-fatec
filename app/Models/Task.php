<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

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

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function getstatusText() {

        $now = Carbon::now();
        $isDone = $this->isDone();
        $isDelivered = $this->isDelivered();
        $deliveryDate = $this->delivery_date;

        if($isDelivered) {
            return '<span class="d-none">status-3</span>Entregue';
        } else {
            if(!$isDone && !$isDelivered && $now->lessThanOrEqualTo($deliveryDate)) {
                return '<span class="d-none">status-1</span>Pendente';
            }

            if($isDone && !$isDelivered && $now->lessThanOrEqualTo($deliveryDate)) {
                return '<span class="d-none">status-2</span>Feita';
            }

            if(!$isDelivered && $now->greaterThanOrEqualTo($deliveryDate)) {
                return '<span class="d-none">status-4</span>Atrasada';
            }
        }
        return '';
    }

    public function isDelivered() {
        return $this->delivered_at ? true : false;
    }

    public function isDone() {
        return $this->done_at ? true : false;
    }
}
