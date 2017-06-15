<?php

namespace App\Api\V1\Controllers;

//use Illuminate\Http\Request;

use App\Api\V1\Models\User;

use App\Api\V1\Transformers\UserTransformer;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use League\Fractal\Manager;

class AuthController extends BaseController
{

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $rules = [
      'name' => 'required',
      'email' => 'unique:users,email',
      'password' => 'required'
    ];

    protected $messages = [
      'message_create' => 'Не удалось создать нового пользователя',
      'message_update' => 'Не удалось обновить данные пользователя',
      'name.required' => 'Введите имя пользователя',
      'email.unique' => 'Пользователь с таким почтовым ящиком уже зарегистрирован',
      'email.required' => 'Введите почту',
      'password.required' => 'Введите пароль пользователя',
    ];

    public function user(){

      $user = app('Dingo\Api\Auth\Auth')->user();

//      return response()->json( $user );
      return $this->response->item( $user, new UserTransformer );
    }

    public function signup(){

        $payload = app('request')->only( $this->fillable );
        $validator = app('validator')->make($payload, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new StoreResourceFailedException( $this->messages['message_create'], $validator->errors());
        }

        $user = new User($payload);
        $user->password = app('hash')->make( app('request')->input('password') );

        $user->save();

        if (User::count() === 1){
          // SYNC ROLES
          $user->roles()->sync( [1] );
        }

        $user['exp_days'] = 1;
        $user['token'] = JWTAuth::fromUser($user, [ 'exp' => Carbon::now()->addDay( $user['exp_days'] )->timestamp ]);

        return response()->json( $user );
    }


    public function signin(){

      $fractal = new Manager();

      $user = User::where( app('request')->only('email') )->first();

      if (Hash::check( app('request')->input('password') , $user->password ))
      {

        $user['exp_days'] = 1;
        $user['token'] = JWTAuth::fromUser($user, [ 'exp' => Carbon::now()->addDay( $user['exp_days'] )->timestamp ]);

        $resource = new \League\Fractal\Resource\Item($user, new UserTransformer);

        return response()->json( $fractal->createData($resource)->toArray()['data'] );

      } else {
          throw new NotFoundHttpException( 'Почта или пароль не верны');
        }
    }

}
