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
    protected $fillable = ['fk_lookup_list', 'fk_parent_value', 'option_key', 'option_value', 'status', 'created_at', 'updated_at', 'has_children'];
	
	/**
	 * @var array
	 */
	public $rules = [
	
	];
	
    /**
     * @return BelongsTo
     */
    public function lookupList()
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
