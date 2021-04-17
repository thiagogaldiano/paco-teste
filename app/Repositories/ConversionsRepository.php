<?php

namespace App\Repositories;

use App\Models\Conversions;
use App\Repositories\BaseRepository;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ConversionsRepository
 * @package App\Repositories
 * @version April 16, 2021, 3:42 pm UTC
*/

class ConversionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coin_id',
        'coin_conversion_id',
        'value_conversion',
        'price_conversion',
        'user_id',
        'date_conversion'
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
        return Conversions::class;
    }

    public static function requestConversion(
        $coin,
        $coin_conversion,
        $value_conversion,
        $date_conversion
    )
    {
       
        try {
            //Executing API.

            $endpoint = 'latest';
            $access_key = '4e139f2e755fbcf07625b7199849137f';

            // Initialize CURL:
            $ch = curl_init('http://api.exchangeratesapi.io/v1/latest?date='.$date_conversion.'base='.$coin.'&access_key='.$access_key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $exchangeRates = json_decode($json, true);

            // Access the exchange rate values, e.g. GBP:
            return $exchangeRates['rates'][$coin_conversion] * (float)$value_conversion;          
           
        } catch (\Throwable $th) {

            return false;

        }

        return false;

    }
}
