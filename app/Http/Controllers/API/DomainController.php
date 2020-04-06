<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


class DomainController extends Controller
{

    public function doSearch(Request $request)
    {
        $validatedData = $request->validate([

            'search' => 'required',

        ]);


        try {


            $http = new Client;


            $response = $http->post(config('services.resell.url').'/api/domains/v5/suggest-names.json',

                [
                    'form_params' => [

                        'auth-userid' => config('services.resell.auth-userid'),

                        'api-key' => config('services.resell.api-key'),

                        'keyword' => $validatedData['search'],

                        'tlds' => ['com', 'net'],

                        'no-of-results' => 10,

                        'hyphen-allowed' => true,

                        'add-related'=>true
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
