<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command example that send an email to specified user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user_id = $this->argument('user');
        $user = User::find($user_id)->toArray();;
        $email = $user['email'];
        Mail::send('emails.correo', $user, function (Message $message) use ($email){
            $message->to($email)->subject('Correo de prueba');
        });
        Log::info('El email se enviará al usuario con id '.$user_id);
    }
}
