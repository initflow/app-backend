<?php

namespace App\Services\Forus\Message\Repositories;

use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepo;

class MessageIpfsRepo implements IMessageRepo
{
    private $urlIpfs;
    private $apiRequest;

    public function __construct(
        string $urlIpfs = null
    ) {
        $this->urlIpfs = $urlIpfs;
        $this->apiRequest = app()->make('api_request');
    }

    /**
     * Get all stored messages
     * @return array|bool
     */
    public function list()
    {
        if (!$this->urlIpfs) {
            return null;
        }

        try {
            return json_decode($this->apiRequest->get($this->urlIpfs . '/messages')->getBody() . '');
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Store a message
     * @param array $message
     * @return integer
     */
    public function store($message)
    {
        if (!$this->urlIpfs) {
            return null;
        }

        try {
            return !!$this->apiRequest->post($this->urlIpfs . '/messages', $message);
        } catch (\Exception $exception) {
            return false;
        }
    }
}