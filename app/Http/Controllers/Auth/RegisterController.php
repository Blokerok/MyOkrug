<?php

namespace App\Http\Controllers\Auth;
use App\Models\District;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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
    protected $redirectTo =  '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $districts = District::all()->sortBy('sort');
        return view('auth.register')->with(['districts'=>$districts]);
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
            'name' => ['required', 'string', 'max:255'],
            'login'=>['required', 'string','max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_district'=>['required','string'],
            'password_confirmation' => ['required', 'string','min:8'],
            'personal' =>  'accepted',
            'recaptcha_response'=>['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        define('SECRET_KEY', '6LcNCUseAAAAABbmhNdx4Mb3RlgYym61QuauxYCD');


        function getCaptcha($SecretKey)
        {
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        }


        if (isset($_POST['recaptcha_response']))
            $Return = getCaptcha($_POST['recaptcha_response']);


 if ( $Return->success && $Return->score > 0.8) {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'login' => $data['login'],
            'id_district' => $data['id_district'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        return $user;
    }
    else
    {
        abort(403);
    }


    }
}
