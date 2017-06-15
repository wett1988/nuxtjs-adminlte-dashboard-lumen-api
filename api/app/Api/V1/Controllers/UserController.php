<?php

namespace App\Api\V1\Controllers;

use Illuminate\Routing\Controller;
//use Illuminate\Http\Request;

use App\Api\V1\Models\User;

use App\Api\V1\Transformers\UserTransformer;

use Dingo\Api\Routing\Helpers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;

use Illuminate\Support\Facades\Mail;

use League\Fractal\Manager;

class UserController extends Controller
{
    use Helpers;

    protected $fillable = [
        'name', 'email'
    ];

    protected $rules = [
      'name' => 'required',
      'email' => 'required|email',

      'roles_ids' => 'array',
//      'password' => 'required'
    ];

    protected $messages = [
      'message_create' => 'Не удалось создать нового пользователя',
      'message_update' => 'Не удалось обновить данные пользователя',
      'name.required' => 'Введите имя пользователя',
      'email.unique' => 'Пользователь с таким почтовым ящиком уже зарегистрирован',
      'email.required' => 'Введите почту',
//      'password.required' => 'Введите пароль пользователя',
    ];

    public function create(Request $request){

      $user = new User;

      return response()->json( $user );
    }

    public function index(){

      $fractal = new Manager();

      $users = User::all();

      $resource = new \League\Fractal\Resource\Collection($users, new UserTransformer);

      return response()->json( $fractal->createData($resource)->toArray()['data'] );

    }

    public function store(){

        $payload = app('request')->only( $this->fillable );
        $validator = app('validator')->make($payload, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new StoreResourceFailedException( $this->messages['message_create'], $validator->errors());
        }

        $user = new User($payload);

        $payload['password'] = uniqid();

        $user->password = app('hash')->make( $payload['password'] );
        $user->save();

        $recipients = [ $payload['email'] ];



        // Отправка данных для входа новому пользователю
        app('mailer')->raw('', function ($message) use ($recipients, $payload) {
            $message->subject('Регистрация на сайте');
            $message->to($recipients);
            $message->setBody('У вас теперь есть доступ на сайт.'. '<br>Ваш логин: '. $payload['email']. '<br>' . '<br>Ваш пароль: '. $payload['password'], 'text/html');
        });

        // SYNC ROLES
        $user->roles()->sync( app('request')->input('roles_ids') );

        return response()->json( $user );

    }

    public function show($id){

      $fractal = new Manager();

      $user = User::findOrFail($id);

      $resource = new \League\Fractal\Resource\Item($user, new UserTransformer);

      return response()->json( $fractal->createData($resource)->toArray()['data'] );

//      return $this->response->item( $user, new UserTransformer );
    }

    public function update($id){

      $fractal = new Manager();

      $payload = app('request')->only( $this->fillable );
      $validator = app('validator')->make($payload, $this->rules, $this->messages);

      if ($validator->fails()) {
          throw new UpdateResourceFailedException( $this->messages['message_update'], $validator->errors());
      }

      $user = User::findOrFail($id)->fill( $payload );
      $user->save();

      // SYNC ROLES
      $user->roles()->sync( app('request')->input('roles_ids') );

      $resource = new \League\Fractal\Resource\Item($user, new UserTransformer);

//      return response()->json( $user );
      return response()->json( $fractal->createData($resource)->toArray()['data'] );
    }

    public function destroy($id){

      $user = User::findOrFail($id);
      $user->delete();

      return response()->json( $user );
    }
}
