<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Messaging\Sms;
use App\Services\Messaging\Handlers\TwilioHandler;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms', function($app) {
            $config = $this->app['config']->get('services.twilio', []);

            $twilioClient = new Services_Twilio($config['account'], $config['auth_token']);


            $handler = new TwilioHandler($twilioClient);
            // $handler->setApplicationSid($config['application_sid']);
            
            return new Sms($handler);
        });

        //
    }

}
