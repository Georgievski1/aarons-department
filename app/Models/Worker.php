<?php

namespace App\Models;
use App\Models\Shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company'];
    
    public function shifts()
    {
    return $this->hasMany(Shift::class, 'user_id');
    }
}
