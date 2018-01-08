<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Redirect;
use App\UrlHash;
use Webpatser\Uuid\Uuid;

class UrlHashController extends Controller
{
    public function createUrlHash(Request $request)
    {
        try {
# Define validation rules.
            $rules = array(
                'url' => 'required|url'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails() === true) {
# Todo : Make the error messsage class.
                $message = '{"Error": }';
                $statusCode = 400;

            } else {
# Check exist
                $url = UrlHash::where('url','=', $request->input('url'))
                                ->first();

                if ($url === null) {
                    $newHash = Uuid::generate()->string;

# Insert
                    $urlhash = UrlHash::create(array('url' => $request->input('url'), 'hash' => $newHash));
                }

                $message = $urlhash;
                $statusCode = 201;
            }

        } catch (Exception $e) {
            $message = '';
            $statusCode = 500;

        } finally {
            return response()->json($message, $statusCode);
        }
    }

    public function redirectUrlHash($hash)
    {
# Select row.
        $urlhash = UrlHash::where('hash', '=', $hash)->first();

        if ($urlhash) {
            echo $urlhash->url;
            #return redirect($link-url);

        }

        return response('Not Found', 404);
    }

}

