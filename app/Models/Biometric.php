<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Biometric extends Model
{
    use HasFactory;

    protected $fillable = [ 'employee_id', 'timestamp' ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
