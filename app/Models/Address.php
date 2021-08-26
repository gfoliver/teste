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
        'user_id',
        'street',
        'number',
        'neighborhood',
        'complement',
        'zip_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
