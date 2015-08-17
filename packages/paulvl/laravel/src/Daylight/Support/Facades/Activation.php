<?php

namespace Daylight\Support\Facades;

/**
 * @see \Daylight\Auth\Accounts\ActivationBroker
 */
class Activation extends Facade
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
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'auth.activation';
    }
}
