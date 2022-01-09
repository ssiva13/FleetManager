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
	 *
	 * @return string[]
	 */
	public function rules(): array
	{
		return [
			'type_name' => 'required|string|unique:lookup_lists|min:2|max:12',
			'data_type' => 'required|required',
			'required' => 'integer|between:0,1',
		];
	}
	/**
	 * Custom message for validation
	 *
	 * @return array
	 */
	public function messages() : array
	{
		return [
			'type_name.required' => 'Lookup type name field is required!',
			'type_name.string' => 'Lookup type name field must be string!',
			'type_name.unique' => 'Lookup type name is already taken!',
			'data_type.required' => 'Lookup data type field is required!',
			'data_type.string' => 'Lookup data type field must be string!',
			'required.integer' => 'Lookup required field must be an integer!',
			'required.between' => 'Lookup required field must be either 0 or 1 !',
		];
	}

    /**
     * @return HasMany
     */
    public function lookupValues(): HasMany
    {
        return $this->hasMany('App\Models\LookupValue', 'fk_lookup_list');
    }
}
