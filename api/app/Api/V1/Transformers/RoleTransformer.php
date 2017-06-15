<?php

namespace App\Api\V1\Transformers;

use App\Role;

class RoleTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(Role $role)
    {

        return [
            'id' => $role->id,
            'title' => $role->title,
        ];

    }
}
