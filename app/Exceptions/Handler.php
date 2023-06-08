<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * exception: 錯誤訊息的類別是什麼： get_class
     * 這是內建 Exception 套件報錯回傳的地方
     * 
     * @return void
     */
    public function register()
    {
        $this->reportable(function (\Throwable $exception) {
            $user = auth()->user();
            LogError::create([
                'user_id'    => $user ? $user->id : 0,
                'message'   => $exception->getMessage(),
                'exception' => get_class($exception),
                'line'      => $exception->getLine(),
                'trace'     => array_map(
                    function ($trace) {
                        unset($trace['args']);
                        return $trace;
                    },
                    $exception->getTrace()
                ),
                'method'      => request()->getMethod(),
                'params'      => request()->all(),
                'uri'         => request()->getPathInfo(),
                'user_agent'  => request()->userAgent(),
                'header'      => request()->headers->all()
            ]);
        });

        // 直接製作錯誤畫面，並且導過去
        // $this->renderable(function (\Exception $e) {
        //     return response()->view('error', [], 500);
        // });

        // $this->reportable(function (Throwable $e) {
        //     //
        // });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json('Unauthenticated 失敗Ler', 401);
    }
}
