<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    protected $attributes = [
        'title' => ''
    ];

    public function users()
    {
        return $this->belongsToMany('App\Api\V1\Models\User', 'user_role', 'role_id', 'user_id');
    }

}
