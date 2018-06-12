<?php

namespace App\Services\Forus\Message\Repositories;

use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepo;

class MessageBlockChainRepo implements IMessageRepo
{
    private $urlBlockChain;
    private $apiRequest;

    public function __construct(
        string $urlBlockChain = null
    ) {
        $this->urlBlockChain = $urlBlockChain;
        $this->apiRequest = app()->make('api_request');
    }

    /**
     * Get all stored messages
     * @return array|bool
     */
    public function list()
    {
        if (!$this->urlBlockChain) {
            return null;
        }

        try {
            return $this->apiRequest->get($this->urlBlockChain . '/messages');
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
        if (!$this->urlBlockChain) {
            return null;
        }

        try {
            return !!$this->apiRequest->post($this->urlBlockChain . '/messages', $message);
        } catch (\Exception $exception) {
            return false;
        }
    }
}