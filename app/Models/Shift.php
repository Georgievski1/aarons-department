<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = ['shift_date', 'user_id', 'hours', 'hour_rate', 'taxable', 'status', 'shift_type', 'paid', 'total'];

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'user_id');
    }
}
