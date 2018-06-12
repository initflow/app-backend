<?php

namespace App\Services\Forus\Message\Repositories;

use App\Services\Forus\Message\Models\Message;
use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepo;

class MessageDbRepo implements IMessageRepo
{
    /**
     * Get all stored messages
     * @return array|bool
     */
    public function list()
    {
        return Message::getModel()->orderBy(
            'created_at', 'DESC'
        )->select('name', 'message')->get()->toArray();
    }

    /**
     * Store a message
     * @param array $message
     * @return bool
     */
    public function store($message)
    {
        return !!Message::create($message);
    }
}