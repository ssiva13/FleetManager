<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $type_name
 * @property string $name_format
 * @property string $data_type
 * @property boolean $required
 * @property string $created_at
 * @property string $updated_at
 * @property LookupValue[] $lookupValues
 */
class LookupList extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['type_name', 'name_format', 'data_type', 'required', 'created_at', 'updated_at'];
	
	/**
	 * @var array
	 */
	public $rules = [
	
	];

    /**
     * @return HasMany
     */
    public function lookupValues(): HasMany
    {
        return $this->hasMany('App\Models\LookupValue', 'fk_lookup_list');
    }
}
