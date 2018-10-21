<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    /**
     * Get the company the employee belongs to.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
