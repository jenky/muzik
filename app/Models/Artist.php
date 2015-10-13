<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id', '_method', '_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Validaction rules.
     * 
     * @var array
     */
    public static $rules = [
        'name'      => 'required|min:2',
        'permalink' => 'required|min:2|unique:artists',
    ];
}
