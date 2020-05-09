<?php

namespace ThomasInckx\PodioLogger;

use Podio;
use Exception;
use PodioItem;
use PodioBadRequestError;

class PodioLogger
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $level;

    /**
     * @var string
     */
    protected $keys_level;
    
    /**
     * @var string
     */
    protected $keys_message;

    /**
     * @var string
     */
    protected $keys_app_name;

    // Log levels
    const LEVEL_INFO  = 'info';
    const LEVEL_DEBUG = 'debug';
    const LEVEL_ERROR = 'error';

    /**
     * PodioLogger constructor.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->auth($config);
    }

    /**
     * Sets the log level.
     *
     * @param  string $level
     * @return self
     */
    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Sets the log message.
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Quickly log a message.
     *
     * @param string $message
     * @param string $level
     * @return self
     */
    public static function log(string $message, string $level): self
    {
        return app('podio-logger')
            ->setMessage($message)
            ->setLevel($level);
    }

    /**
     * Dispatch a log message.
     *
     * @return bool
     */
    public function send(): bool
    {
        $data = [
            'fields'    =>  [
                $this->config['keys']['level']     =>  $this->level ?? "Unknown",
                $this->config['keys']['message']   =>  $this->message ?? "Unknown",
                $this->config['keys']['app_name']  =>  $this->config['app_name']
            ]
        ];

        try {
            PodioItem::create($this->config['app_id'], $data);
        } catch (PodioBadRequestError $e) {
            throw $e;
        }

        return true;
    }

    /** 
     * Authenticate with Podio
     **/
    private function auth($config)
    {
        $client_id = $config['client_id'];
        $client_secret = $config['client_secret'];
        $app_id = $config['app_id'] ?? '';
        $app_token = $config['app_token'] ?? '';

        try {
            Podio::setup(config('podio.client_id'), config('podio.client_secret'));
            Podio::authenticate_with_app($app_id, $app_token);
        } catch (PodioBadRequestError $e) {
            throw new Exception('Error while authenticating.');
        }
    }
}