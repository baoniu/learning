<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Image;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth_user', ['only'=>['avatar', 'changeAvatar', 'cropAvatar']]);
    }

    public function register()
    {
        return view('users.register');
    }
    public function login()
    {
        return view('users.login');
    }
    public function store(UserRegisterRequest $request)
    {
        $data = [
            'avatar'=>'/images/default-avatar.png',
            'confirm_code'=> str_random(48)
        ];
        $user = User::create(array_merge($request->all(), $data));

        $subject = 'Confirm You Account Email';
        $view = 'email.register';

        $this->sendTo($user, $subject, $view, $data);
        return redirect('/');
    }
    public function signin(UserLoginRequest $request)
    {
        if(\Auth::attempt([
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'is_confirmed'=>1
        ])) {
            return \Redirect::intended('/');
        }

        \Session::flash('user_login_failed', '密码不正确或邮箱未验证');
        return redirect('/user/login')->withInput();
    }

    public function avatar()
    {
        return view('users.avatar');
    }
    public function changeAvatar(Request $request)
    {
        $file = $request->file('avatar');
        $input = array('image'=>$file);
        $rules = array('image'=>'image');
        $validator = \Validator::make($input, $rules);
        if($validator->fails()) {
            return \Response::json([
                'success'=>false,
                'errors'=>$validator->getMessageBag()->toArray()
            ]);
        }

        $destinationPath = 'uploads/';
        $filename = \Auth::user()->id . '_' . time() .  $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath . $filename)->fit(400)->save();

        return \Response::json([
            'success' => true,
            'avatar'  => asset($destinationPath . $filename),
            'image'   => $destinationPath . $filename
        ]);
    }
    public function cropAvatar(Request $request)
    {
        $photo = $request->get('photo');
        $width =(int) $request->get('w');
        $height=(int) $request->get('h');
        $xAlign=(int) $request->get('x');
        $yAlign=(int) $request->get('y');

        Image::make($photo)->crop($width, $height, $xAlign, $yAlign)->save();
        $user = \Auth::user();
        $user->avatar = asset($photo);
        $user->save();

        return redirect('/user/avatar');
    }
    public function confirmEmail($confirm_code)
    {
        $user = User::where([['confirm_code', '=', $confirm_code],['is_confirmed', '=', 0]])->first();

        if(is_null($user)) {
            return redirect('/');
        }

        $user->confirm_code = str_random(48);
        $user->is_confirmed = 1;
        $user->save();
        \Session::flash('email_confirm', '验证成功');
        return redirect('/user/login');
    }

    private function sendTo($user, $subject, $view, $data = [])
    {
        \Mail::send($view, $data, function($message) use ($user, $subject){
            $message->to($user->email)->subject($subject);
        });
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
