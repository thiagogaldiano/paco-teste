<?php

namespace App\Repositories;

use App\Models\Coins;
use App\Repositories\BaseRepository;

/**
 * Class CoinsRepository
 * @package App\Repositories
 * @version April 16, 2021, 3:42 pm UTC
*/

class CoinsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coins::class;
    }
}
