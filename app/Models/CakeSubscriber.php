<?php

namespace App\Models;

use Database\Factories\CakeSubscribeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CakeSubscriber extends Model
{
    use HasFactory;

	protected $fillable = [
		'cake_id',
		'email',
	];

	public function cake(): HasOne
	{
		return $this->hasOne(Cake::class);
	}

	protected static function newFactory(): CakeSubscribeFactory
	{
		return CakeSubscribeFactory::new();
	}
}
