<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:superadmin {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $password = $this->secret('What is the password?');
        User::create([
            'name' => $this->argument('name'),
            'password' => bcrypt($password),
            'role' => User::USER_ROLE_SUPER_ADMIN
        ]);

        $this->info('superadmin created');
    }
}
