<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use App\Models\Admin\Admin;

use Auth;
use Validator;
use Storage;
use Cart;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // using after success login or registration
    protected $redirectPath = '/';
    protected $redirectAfterLogout = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    // applyed when make login
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        $redirectPath = $this->redirectPath();

        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        if(Auth::check()){
           // when login by admin account
            if(Admin::where('user_id', Auth::user()->id)->lists('id')->count() == 1){
                $redirectPath = '/admin';
            }

            $input = (object) $request->all();

            // when refered to product to make add-to-cart
            if(isset($input->isReferedToProduct) && $input->isReferedToProduct == 1){
                $redirectPath = $input->refToProduct_value;
            }

        }

        return redirect()->intended($redirectPath);
    }

    // Current laravel fn: Illuminate\Foundation\Auth\RegistersUsers.php
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        $request->session()->flash('flashMessage', [
            "type" => "success",
            "content" => trans2('A500', "Account successfully created")
        ]);

        return redirect("/login");
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     *
     * modification: add clear cart status when log out
     * (note: can change it from main super admin setting)
     */
    public function getLogout()
    {
        $global_setting = json_decode(Storage::get('setting.json'));
        $is_clear_cart_when_logout = $global_setting->is_clear_cart_when_logout;

        if($is_clear_cart_when_logout){
            Cart::clear();
        }

        return $this->logout();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'country_id' => 'numeric',
            'address' => 'string|min:6|max:255',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country_id' => $data['country_id'],
            'address' => $data['address'],
        ]);
    }
}
