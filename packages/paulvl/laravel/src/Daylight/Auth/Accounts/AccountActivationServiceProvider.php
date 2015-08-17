<?php

namespace Daylight\Auth\Accounts;

use Illuminate\Support\ServiceProvider;
use Daylight\Auth\Accounts\DatabaseTokenRepository as DbRepository;

class AccountActivationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerActivationBroker();

        $this->registerTokenRepository();
    }

    /**
     * Register the password broker instance.
     *
     * @return void
     */
    protected function registerActivationBroker()
    {
        $this->app->singleton('auth.activation', function ($app) {
            // The activation token repository is responsible for storing the email addresses
            // and activation reset tokens. It will be used to verify the tokens are valid
            // for the given e-mail addresses. We will resolve an implementation here.
            $tokens = $app['auth.activation.tokens'];

            $users = $app['auth']->driver()->getProvider();

            $view = $app['config']['auth.activation.email'];

            // The activation broker uses a token repository to validate tokens and send user
            // activation e-mails, as well as validating that account activation process as an
            // aggregate service of sorts providing a convenient interface for resets.
            return new ActivationBroker(
                $tokens, $users, $app['mailer'], $view
            );
        });
    }

    /**
     * Register the token repository implementation.
     *
     * @return void
     */
    protected function registerTokenRepository()
    {
        $this->app->singleton('auth.activation.tokens', function ($app) {
            $connection = $app['db']->connection();

            // The database token repository is an implementation of the token repository
            // interface, and is responsible for the actual storing of auth tokens and
            // their e-mail addresses. We will inject this table and hash key to it.
            $table = $app['config']['auth.activation.table'];

            $key = $app['config']['app.key'];

            $expire = $app['config']->get('auth.activation.expire', 7);

            return new DbRepository($connection, $table, $key, $expire);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['auth.activation', 'auth.activation.tokens'];
    }
}
