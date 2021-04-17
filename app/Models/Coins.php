<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coins
 * @package App\Models
 * @version April 16, 2021, 3:42 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $conversions
 * @property \Illuminate\Database\Eloquent\Collection $conversion1s
 * @property string $name
 * @property string $code
 */
class Coins extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'coins';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function conversions()
    {
        return $this->hasMany(\App\Models\Conversion::class, 'coin_conversion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function conversion1s()
    {
        return $this->hasMany(\App\Models\Conversion::class, 'coin_id');
    }
}
