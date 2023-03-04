<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

	protected $guarded = [];

	protected $table = 'carts';

	// ========== RELATIONSHIPS ============

	public function products()
	{
		return $this->belongsToMany(Product::class)
			->withPivot(['slug', 'quantity'])
			->withTimestamps();
	}
}

