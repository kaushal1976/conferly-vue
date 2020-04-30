<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('email', 'password');
        try {
            Auth::attempt($credentials);
            $http = new Client;
            $response = $http->post(
                config('services.passport.url'),
                [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => config('services.passport.client_id'),
                        'client_secret' => config('services.passport.client_secret'),
                        'username' => $request['email'],
                        'password' => $request['password'],
                        'scope' => '',
                    ]
                ]
            );
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
    public function register(Request $request)
    {
    }
    public function logout()
    {
    }

}