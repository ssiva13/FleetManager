<?php

namespace App\Models;

use App\Helpers\Arr;
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
class LookupList extends AppModel
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
    protected $fillable = ['type_name', 'name_format', 'data_type', 'required', 'created_at', 'updated_at', 'deleted_at'];
	
	/**
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'type_name' => 'required|string|unique:lookup_lists|min:2|max:12',
			'data_type' => 'required|min:2',
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
			'type_name.required' => 'The :attribute value is required!',
			'type_name.string' => 'The :attribute value must be string!',
			'type_name.unique' => 'The :attribute is already taken!',
			'data_type.required' => 'The :attribute value is required!',
			'data_type.string' => 'The :attribute value must be string!',
			'required.integer' => 'The :attribute value must be an integer!',
			'required.between' => 'The :attribute value must be either 0 or 1 !',
		];
	}
	
	public function attributes(): array
	{
		return [
			'type_name' => 'Lookup Key',
			'data_type'  => 'Lookup Type',
			'required'  => 'Lookup Required',
			'name_format'  => 'Lookup Format',
			'created_at'  => 'Date Created',
			'updated_at'  => 'Date Modified',
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
