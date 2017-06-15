<?php

namespace App\Api\V1\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Role;

use Dingo\Api\Routing\Helpers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;

class RoleController extends Controller
{
    use Helpers;

    protected $fillable = [
        'title'
    ];

    protected $rules = [
      'title' => 'required'
    ];

    protected $messages = [
      'message_create' => 'Не удалось создать новую роль',
      'message_update' => 'Не удалось обновить данные роли',
      'name.required' => 'Введите название роли'
    ];

    public function create(Request $request){

      $role = new Role;

      return response()->json( $role );
    }

    public function index(){

      $roles = Role::all();

      return response()->json( $roles );
//      return $this->response->array($users->toArray());
    }

    public function store(){

        $payload = app('request')->only( $this->fillable );
        $validator = app('validator')->make($payload, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new StoreResourceFailedException( $this->messages['message_create'], $validator->errors());
        }

        $role = new Role($payload);
        $role->save();

        return response()->json( $role );

    }

    public function update($id){

      $payload = app('request')->only( $this->fillable );
      $validator = app('validator')->make($payload, $this->rules, $this->messages);

      if ($validator->fails()) {
          throw new UpdateResourceFailedException( $this->messages['message_update'], $validator->errors());
      }

      $role = Role::findOrFail($id)->fill( $payload );
      $role->save();

      return response()->json( $role );
    }

    public function destroy($id){

      $role = Role::findOrFail($id);
      $role->delete();

      return response()->json( $role );
    }
}
