<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Conversions
 * @package App\Models
 * @version April 16, 2021, 3:42 pm UTC
 *
 * @property \App\Models\Coin $coinConversion
 * @property \App\Models\Coin $coin
 * @property \App\Models\User $user
 * @property integer $coin_id
 * @property integer $coin_conversion_id
 * @property number $value_conversion
 * @property number $price_conversion
 * @property integer $user_id
 * @property string $date_conversion
 */
class Conversions extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'conversions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'coin_id',
        'coin_conversion_id',
        'value_conversion',
        'price_conversion',
        'user_id',
        'date_conversion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'coin_id' => 'integer',
        'coin_conversion_id' => 'integer',
        'value_conversion' => 'float',
        'price_conversion' => 'float',
        'user_id' => 'integer',
        'date_conversion' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'coin_id' => 'required',
        'coin_conversion_id' => 'required',
        'value_conversion' => 'required|string',
        'date_conversion' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coinConversion()
    {
        return $this->belongsTo(\App\Models\Coin::class, 'coin_conversion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coin()
    {
        return $this->belongsTo(\App\Models\Coin::class, 'coin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
