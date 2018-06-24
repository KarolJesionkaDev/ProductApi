<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'amount'];

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }
}
