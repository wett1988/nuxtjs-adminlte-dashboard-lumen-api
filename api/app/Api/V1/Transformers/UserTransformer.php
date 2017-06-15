<?php

namespace App\Api\V1\Transformers;

use App\Api\V1\Models\User;

use App\Api\V1\Transformers\RoleTransformer;

class UserTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(User $user)
    {

        $roles = $user->roles()->get();

        $tmp = [];

        foreach ($roles as $role) {
          $tmp[] = $role->slug;
        }


        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles_ids' => $user->roles_ids(),
            'roles' => $tmp,
            'exp_days' => $user['exp_days'],
            'token' => $user['token']
        ];

    }

}
