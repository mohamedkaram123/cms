<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use App\Mail\EmailManager;
use Auth;
use App\User;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public $username;
    public function __construct($name)
    {
        $this->username = $name;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    public function overWriteEnvFile($type, $val)
    {
        if (env('DEMO_MODE') != 'On') {

            $path = base_path('.env');

            if (file_exists($path)) {


                $val = '"' . trim($val) . '"';

                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    ));

                    $env_val = env($type);
                    if ($env_val != $val) {
                        file_put_contents($path, str_replace(
                            $type . '=' . env($type),
                            $type . '=' . $val,
                            file_get_contents($path)
                        ));
                    }
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        }
    }
    public function toMail($notifiable)
    {



        if (env("MAIL_DRIVER") != "smtp") {
            $this->overWriteEnvFile("MAIL_HOST", get_setting("smtp_host"));
            $this->overWriteEnvFile("MAIL_PORT", get_setting("smtp_port"));
            $this->overWriteEnvFile("MAIL_USERNAME", get_setting("smtp_username"));
            $this->overWriteEnvFile("MAIL_PASSWORD", get_setting("smtp_password"));
            $this->overWriteEnvFile("MAIL_ENCRYPTION", get_setting("smtp_encryption"));
        }


        $notifiable->verification_code = encrypt($notifiable->id);
        $notifiable->save();

        $array['view'] = 'emails.verification';
        $array['subject'] = translate('Email Verification');
        $array['content'] = translate('Please click the button below to verify your email address.');
        $array['link'] = route('email.verification.confirmation', $notifiable->verification_code);
        $array['user_name'] = $this->username;

        return (new MailMessage)
            ->view('emails.mail_design.welcome', ['array' => $array])
            ->subject(translate('Email Verification - ') . env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
