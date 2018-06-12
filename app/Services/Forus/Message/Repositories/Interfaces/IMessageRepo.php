<?php

namespace App\Services\Forus\Message\Repositories\Interfaces;

interface IMessageRepo {
    /**
     * Get all stored messages
     * @return array|bool
     */
    public function list();

    /**
     * Store a message
     * @param array $message
     * @return bool
     */
    public function store($message);
}
