<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Property extends Model
{
    protected $dates = [
    	'created_at',
	    'updated_at'
    ];

    protected $guarded = [
    	'id'
    ];

    public static function resolveStatus($value)
    {
    	if ($value === 'Venta') {
    		return 'sell';
	    }
	    return 'rent';
    }

    public static function resolveType($value)
	{
		if ($value === 'Casa') {
			return 'house';
		}

		if ($value === 'Piso') {
			return 'flat';
		}

		if ($value === 'Local') {
			return 'flat';
		}

		if ($value === 'Solar') {
			return 'flat';
		}

		if ($value === 'Olivar') {
			return 'olive-grove';
		}

		if ($value === 'Finca') {
			return 'estate';
		}

		if ($value === 'Huerto') {
			return 'orchard';
		}

		Log::warning('Resolve Type error. Cannot resolve the value ' . $value);
		return 'not-defined';
	}

	public static function resolveBoolean($value)
	{
		if ($value === 'Si') {
			return true;
		}
		return false;
	}

	public static function resolveSquareMeters($value)
	{
		$value = str_replace(' ', '', $value);
		$value = str_replace('m2', '', $value);
		$value = str_replace('.', '', $value);

		return floatval($value);
	}

	public static function resolvePrice($value)
	{
		$value = str_replace(' ', '', $value);
		$value = str_replace('€', '', $value);
		$value = str_replace('.', '', $value);

		return floatval($value);
	}
}
