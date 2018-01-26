<?php

namespace LaravelEnso\Core\app\Listeners;

use LaravelEnso\Core\app\Models\Login;

class LoginLoggerListener
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

    public function handle()
    {
        $this->login->create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
