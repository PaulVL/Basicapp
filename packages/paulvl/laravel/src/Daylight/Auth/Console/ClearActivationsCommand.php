<?php

namespace Daylight\Auth\Console;

use Illuminate\Console\Command;

class ClearActivationsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'auth:clear-activations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush expired account activation tokens';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel['auth.activation.tokens']->deleteExpired();

        $this->info('Expired activation tokens cleared!');
    }
}
