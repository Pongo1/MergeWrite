<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use App\Rank;
use App\UserRank;
use App\UserBank;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_gender' => 'required'
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::put('username',$data['name']);
        $this->redirectTo = '/home/'.Session::get('username');
        $something =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender' =>$data['user_gender'],
            'profile_picture'=>$data['user_gender'] == 'Female' ? $this->defaultAvatar(0) : $this->defaultAvatar(mt_rand(1,2))
        ]);
        //when the users are created, give them a rank -->looker
        $found = User::where(['name'=>$data['name'],'email'=>$data['email']])->first();
        $beginner = Rank::find(10);
        $newRank = new UserRank();
        $newRank->rank_worth = $beginner->rank_worth;
        $newRank->rank_cost = $beginner->rank_cost;
        $newRank->rank = $beginner->rank;
        $newRank->number = $beginner->id;
        $newRank->user_id = $found->id;
        $newRank->rank_description = '';
        $newRank->save();
        //create a bank account for the user
        $account = new UserBank();
        $account->user_id = $found->id;
        $account->coins = 50;
        $account->save();
        //-----------------------------------------------------------------------------
        return $something;
    }

    public function defaultAvatar($number){
        switch ($number) {
            case 0:
                return 'imgs/avatar-female.png';
                break;
            case 1:
                return 'imgs/ninja-avatar-male.jpeg';
                break;
            case 2:
                return 'imgs/chick-samurai-avatar.png';
                break;
            default:
                # code...
                break;
        }

    }


}
