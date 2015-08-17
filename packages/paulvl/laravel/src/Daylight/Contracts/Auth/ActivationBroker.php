<?php

namespace Daylight\Contracts\Auth;

use Closure;

interface ActivationBroker
{
    /**
     * Constant representing a successfully sent activation.
     *
     * @var string
     */
    const ACTIVATION_LINK_SENT = 'activations.sent';

    /**
     * Constant representing a successfully account activation.
     *
     * @var string
     */
    const ACCOUNT_ACTIVATION = 'activations.reset';

    /**
     * Constant representing the user not found response.
     *
     * @var string
     */
    const INVALID_USER = 'activations.user';

    /**
     * Constant representing an invalid token.
     *
     * @var string
     */
    const INVALID_TOKEN = 'activations.token';

    /**
     * Send an account activation link to a user.
     *
     * @param  array  $credentials
     * @param  \Closure|null  $callback
     * @return string
     */
    public function sendActivationLink(array $credentials, Closure $callback = null);

    /**
     * Activate the account for the given token.
     *
     * @param  array     $credentials
     * @param  \Closure  $callback
     * @return mixed
     */
    public function activate(array $credentials, Closure $callback);
}
