<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Header\Headers;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        //send email when confirmation
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        // Mail::send([], [], function ($message) use ($name, $email) {

        //     $body = 'Bạn vừa xác nhận mật khẩu thành công';

        //     $message->to($email)
        //         ->subject('Xác nhận mật khẩu thành công')
        //         ->setBody('Xác nhận mật khẩu thành công', 'text/plain'); // for HTML rich messages
        // });


        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Mật khẩu không được để trống.',
            'password.current_password' => 'Mật khẩu không chính xác, vui lòng nhập lại.',
        ];
    }
}
