<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    /*Get all employees associated with the company*/
    public function employees() {
        return $this->hasMany('App\Models\Employee', 'company_id', 'id');
    }
}
