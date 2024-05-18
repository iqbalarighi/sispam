<?php

namespace App\Exceptions;

use App\Http\Controllers\HomeController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Session;
// Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
                $this->renderable(function (Throwable $e) {
                    // dd($e);
// $text = "SQLSTATE[HY000] [1130] Host 'localhost' is not allowed to connect to this MariaDB server (SQL: select * from `users` where `id` = 1 limit 1)";
                

		      if ($e->getCode() === 1130) {
                    // dd($e);
                    // header("Location: https://www.sispam.id");
                // return redirect()->action([HomeController::class, 'index']);
                $response = Http::timeout(1)->post(url()->current(), [
                            'key1' => 'value1',
                            'key2' => 'value2',
                        ]);
                    // dd($response);
                   return response()->json(compact('response'));
                }

                if($e->getMessage() === "Unauthenticated."){
                    return redirect('login');
                } 

                if ($e->getMessage() === "CSRF token mismatch."){
                        return to_route('login');
                }

                if ($e->getMessage() === 'These credentials do not match our records.'){
                        // $errors = $e->getMessage();
                        return back()->withErrors(['msg' => 'Email atau password yang anda masukkan salah !']);
                    }
		
                // dd($e->getStatusCode());
                

            if(Auth::check()){

                // dd($e);
                // if ($e->getStatusCode() === 500){
                //         $response = Http::timeout(1)->post(url()->current());
                //     dd($response);
                //    return response()->json(compact('response'));
                //     } 
                    
                if ($e->getCode() === 1130) {
                    // return to_route(url()->current());
                    // return redirect()->action([HomeController::class, 'index']);
                    $response = Http::timeout(1)->post(url()->current(), [
                            'key1' => 'value1',
                            'key2' => 'value2',
                        ]);
                    // dd($response);
                   return response()->json(compact('response'));
                }
                 
                if ($e->getStatusCode() === 401){
                        return redirect('dashboard')->with('forbidden', 'Akses ditolak');
                    }
                
                if ($e->getMessage() === "CSRF token mismatch."){
                        return to_route('login');
                    }

                if ($e->getStatusCode() === 404){
                        return back();
                    // return Http::post(url()->current());
                    }

            }

            // if ($e->getStatusCode() === 500){
            //             $response = Http::timeout(1)->post(url()->current());
            //         // dd($response);
            //        return response()->json(compact('response'));
            //         } 
            
            if ($e->getStatusCode() === 404){
                        return redirect()->action([HomeController::class, 'index']);
                    }
            
        });
    }
}