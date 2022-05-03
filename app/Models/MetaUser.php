<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id
 * @property integer $fk_user
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $mobile
 * @property string $telephone
 * @property integer $user_type
 * @property boolean $is_admin
 * @property string $drivers_licence
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 */

class MetaUser extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'fk_user', 'first_name', 'middle_name', 'last_name', 'mobile', 'telephone', 'user_type', 'is_admin', 'drivers_licence'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_type', 'is_admin'
    ];
	
	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User', 'fk_user');
	}

}
