<?php

namespace App\Models;

use Database\Factories\CakeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cake extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'weight',
		'price',
		'quantity',
		'is_available',
	];

	public function subscribers(): HasMany
	{
		return $this->hasMany(CakeSubscriber::class);
	}

	protected static function newFactory(): CakeFactory
	{
		return CakeFactory::new();
	}

}
