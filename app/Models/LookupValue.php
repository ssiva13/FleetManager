<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $fk_lookup_list
 * @property integer $fk_parent_value
 * @property string $option_key
 * @property string $option_value
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $has_children
 * @property LookupList $lookupList
 * @property LookupValue $lookupValue
 */
class LookupValue extends AppModel
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
    protected $fillable = ['fk_lookup_list', 'fk_parent_value', 'option_key', 'option_value', 'status', 'created_at',
	    'deleted_at', 'updated_at', 'has_children'];
	
	/**
	 *
	 * @return array
	 */
	public static  function rules(): array
	{
		return [
			'fk_lookup_list' => 'required|integer',
			'fk_parent_value' => 'integer',
			'option_key' => 'required|string|max:20',
			'option_value' => 'required|string|max:50',
			'has_children' => 'integer|between:0,1',
			'status' => 'required|integer|between:0,1',
		];
	}
	/**
	 * Custom message for validation
	 *
	 * @return array
	 */
	public static  function messages() : array
	{
		return [
			'has_children.between' => 'The :attribute value must be either 0 or 1 !',
			'status.between' => 'The :attribute value must be either 0 or 1 !',
		];
	}
	
	public function attributes(): array
	{
		return [
			'fk_lookup_list' => 'Lookup Type',
			'fk_parent_value' => 'Lookup Parent Value',
			'option_key' => 'Lookup Option Key',
			'option_value' => 'Lookup Option Value',
			'status'  => 'Lookup Value Status',
			'has_children'  => 'Has Children Values',
			'created_at'  => 'Date Created',
			'updated_at'  => 'Date Modified',
		];
	}
    /**
     * @return BelongsTo
     */
    public function lookupList(): BelongsTo
    {
        return $this->belongsTo('App\Models\LookupList', 'fk_lookup_list');
    }

    /**
     * @return BelongsTo
     */
    public function lookupValue(): BelongsTo
    {
        return $this->belongsTo('App\Models\LookupValue', 'fk_parent_value');
    }
}
