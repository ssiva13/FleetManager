<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MetaUser[] $metaUsers
 */

class User extends AppModel implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'email_verified_at', 'remember_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'password_confirmation', 'email_verified_at'
    ];
	
	public function attributes(): array
	{
		return [
			'first_name' => 'First Name',
			'email' => 'Email',
			'username' => 'UserName',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'mobile' => 'Mobile Number',
			'telephone' => 'Tel No',
			'password' => 'Password',
			'password_confirmation' => 'Confirm Password'
		];
	}
	
	public static function rules(): array
	{
		return [
			'first_name' => 'required|string|max:25',
			'email' => 'required|email|unique:users|max:50',
			'username' => 'required|string|max:25|unique:users',
			'middle_name' => 'string',
			'last_name' => 'required|string|max:25',
			'mobile' => 'required|string|max:15|unique:meta_users',
			'telephone' => 'string|max:15|unique:meta_users',
			'password' => 'min:8|required|string|confirmed|max:150',
			'password_confirmation' => 'required|min:8'
		];
	}
	
	/**
	 * Custom message for validation
	 *
	 * @return array
	 */
	public static function messages() : array
	{
		return [
			'email.email' => 'The :attribute must be a valid email address!',
			'email.unique' => 'User with the :attribute exists!',
			'username.unique' => 'User with the :attribute exists!',
			'telephone.unique' => 'User with the :attribute exists!',
			'mobile.unique' => 'User with the :attribute exists!',
		];
	}
	
	/**
	 * @return HasOne
	 */
	public function metaUsers(): HasOne
	{
		return $this->hasOne('App\Models\MetaUser', 'fk_user');
	}
	
	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}
	
	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims(): array
	{
		return [];
	}
}
