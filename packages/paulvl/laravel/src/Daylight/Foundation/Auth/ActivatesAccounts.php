<?php

namespace Daylight\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Daylight\Support\Facades\Activation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ActivatesAccounts
{
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view('auth.activation');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Activation::sendActivationLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Activation::ACTIVATION_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Activation::INVALID_TOKEN:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Account Activation Link';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getActivate($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $credentials = ['token' => $token];

        $response = Activation::activate($credentials, function ($user) {
            $this->activateAccount($user);
        });

        switch ($response) {
            case Activation::ACCOUNT_ACTIVATION:
                return redirect($this->redirectPath());

            default:
                return redirect()->back()
                            ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Daylight\Contracts\Auth\CanActivateAccunt  $user
     * @return void
     */
    protected function activateAccount($user)
    {
        $user->active = true;

        $user->save();

        Auth::login($user);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }
}
