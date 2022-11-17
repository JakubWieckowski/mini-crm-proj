<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];
   public function employee(): HasMany
    {
       //return $this->hasMany(Employer::class, 'comp', 'name');
       return $this->hasMany(Employer::class, 'company_id', 'id');
    }
   //protected $casts = [
   //     'created_at' => 'datetime',
   //     'updated_at' => 'datetime',
    //];
}
