<?php

namespace App\Console\Commands;

use App\Traits\Auth;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AuthCommand extends Command
{
    use Auth;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Authorize user and return token';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $username = $this->ask("Enter username");
        $password = $this->secret("Enter password");


        if (!$this->attempt(compact("username", "password"))) {
            $this->components->error("Credentials not found");
            return CommandAlias::FAILURE;
        }

        $token = $this->generateToken();
        $this->components->info("Authorized successfully");
        $this->components->warn("Your token expires in 5 minutes");
        $this->info(sprintf("Token: %s", $token));

        return CommandAlias::SUCCESS;
    }
}
