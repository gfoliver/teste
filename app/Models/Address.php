<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $street
 * @property int $number
 * @property string $neighborhood
 * @property string $complement
 * @property string $zip_code
 */
class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'complement',
        'zip_code'
    ];
}
