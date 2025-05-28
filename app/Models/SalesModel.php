<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    protected $table = 'sales';

    /**
     * Match sale to its brand of coffee
     */
    public function coffee()
    {
        return $this->hasOne(CoffeesModel::class, 'id', 'coffee_id');
    }
}
