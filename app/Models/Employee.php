<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        //comp,
        'company_id',
        'email',
        'phone',        
    ];
    public function company(): BelongsTo
    {
        //return $this->belongsTo(Company::class,'comp', 'name');
        //return $this->belongsTo('App\Models\Company', 'name');
        return $this->belongsTo(Company::class,'company_id', 'id');
    }
}
