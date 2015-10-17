<?php

namespace Styde;

class Application
{

    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider)
        {
            $provider = new $provider($this->container);
            $provider->register();
        }
    }

    public function register()
    {
        $this->registerSessionManager();
        $this->registerAuthenticator();
        $this->registerAccessHandler();
    }

    protected function registerSessionManager()
    {
        $this->container->singleton('session', function ($app) {
            $data = array(
                'user_data' => array(
                    'name' => 'Duilio',
                    'role' => 'teacher'
                )
            );

            $driver = new SessionArrayDriver($data);

            return new SessionManager($driver);
        });
    }

    protected function registerAuthenticator()
    {
        $this->container->singleton(AuthenticatorInterface::class, function ($app) {
            return new Authenticator($app->make('session'));
        });
    }

    protected function registerAccessHandler()
    {
        $this->container->singleton('access', function ($app) {
            return $app->build(AccessHandler::class);
        });
    }

}



