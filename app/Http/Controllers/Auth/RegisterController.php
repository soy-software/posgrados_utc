<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cohorte;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $data = array(
            'cohortes' => Cohorte::where('estado','Postulación e inscripción')->get(),
        );
        return view('auth.register',$data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rg_tipo_identificacion='';
        switch ($this->input('tipo_identificacion')) {
            case 'Cédula':
                $rg_tipo_identificacion='ecuador:ci|unique:users';
                break;
            case 'Ruc persona Natural':
                $rg_tipo_identificacion='ecuador:ruc|unique:users';
                break;
            case 'Ruc Sociedad Pública':
                $rg_tipo_identificacion='ecuador:ruc_spub|unique:users';
                break;
            case 'Ruc Sociedad Privada':
                $rg_tipo_identificacion='ecuador:ruc_spriv|unique:users';
                break;
            case 'Pasaporte':
                $rg_tipo_identificacion='unique:users';
                break;
        }


        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            'primer_nombre'=>'required|string|max:255', 
            'segundo_nombre'=>'required|string|max:255', 
            'primer_apellido'=>'required|string|max:255',
            'segundo_apellido'=>'required|string|max:255',

            'tipo_identificacion'=>'required|in:Cédula,Ruc persona Natural,Ruc Sociedad Pública,Ruc Sociedad Privada,Pasaporte',
            'identificacion'=>'required|string|'.$rg_tipo_identificacion,
            'telefono'=>'required|numeric|digits_between:1,15',
            'celular'=>'required|numeric|digits_between:1,15',
            'lat'=>'required|max:255|string',
            'lng'=>'required|max:255|string', 
            'direccion'=>'required|max:255|string', 
            
            'lat'=>'required|max:255|string',
            'lng'=>'required|max:255|string', 
            'direccion'=>'required|max:255|string', 

            'lat'=>'nullable|max:255|string',
            'lng'=>'nullable|max:255|string', 
            'direccion'=>'nullable|max:255|string', 

            'titulo'=>'required|max:255|string',
            'especialidad'=>'required|max:255|string', 
            'institucion'=>'required|max:255|string', 
            

            'cohorte'=>['required','exists:cohortes,id']
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
        try {
            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $cohorte=Cohorte::findOrFail($data['cohorte']);

            
        } catch (\Throwable $th) {

            return redirect()->route('register')->withInput();
        }
        

    }
}
