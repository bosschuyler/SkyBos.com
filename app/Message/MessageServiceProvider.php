<?php

namespace App\Message;

use Illuminate\Support\ServiceProvider;
use App\Message\Handlers\TwilioHandler;
use Services_Twilio;


class MessageServiceProvider extends ServiceProvider
{
    protected $config = null;

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
        $this->config = $this->app['config'];
        
        $this->registerTwilioHandler();

        $messageConfig = $this->config['message'];

        $this->app->singleton('App\Message\Messenger', function($app) use ($messageConfig) {
            Messenger::addHandler('twilio', $app['twilio.handler']);
            
            return new Messenger($messageConfig['handler']);
        });
        //
    }

    public function registerTwilioHandler() {
        
        $twilioConfigData = $this->config->get('services.twilio', []);

        $this->app->singleton('twilio.client', function($app) use ($twilioConfigData) {
            $twilioClient = new Services_Twilio($twilioConfigData['account'], $twilioConfigData['auth_token']);

            return $twilioClient;
        });

        $this->app->singleton('twilio.handler', function($app) use ($twilioConfigData) {
            $twilioHandler = new TwilioHandler($app['twilio.client'], $twilioConfigData['application_sid']);
            $twilioHandler->setFrom($twilioConfigData['from']);

            return $twilioHandler;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Message\Messenger', 'twilio.client', 'twilio.handler'];
    }

}
