<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

	protected $guarded = [
		'_method',
		'_token',
	];


	// =========== METHODS =============

	public function getLabelsDPC() {

		$columns = [
			'id',
			'name'
		];

		$labels = $this
			->select($columns)
			->get();

		return $labels;
	}


	public function getLabelsW() {

		$columns = [
			'id',
			'name'
		];

		$labels = $this
			->select($columns)
			->get();

		return $labels;
	}

	public function getLabelsC() {

		$columns = [
			'id',
			'name'
		];

		$labels = $this
			->select($columns)
			->get();

		return $labels;
	}


	public function getLabelsDPCE() {

		$columns = [
			'id',
			'name'
		];

		$labels = $this
			->select($columns)
			->get();

		return $labels;
	}
}
