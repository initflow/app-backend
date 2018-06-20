<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Messages\StoreMessageRequest;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    private $messageDb;
    private $messageIpfs;
    private $messageBlockChain;

    public function __construct()
    {

        $this->messageDb = app()->make('forus.services.message-db');
        $this->messageIpfs = app()->make('forus.services.message-ipfs');
        $this->messageBlockChain = app()->make('forus.services.message-block-chain');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db = $this->messageDb->list();
        $ipfs = $this->messageIpfs->list();
        $blockChain = $this->messageBlockChain->list();

        return compact('db', 'ipfs', 'blockChain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $message = $request->only(['name', 'message']);

        $db = $this->messageDb->store($message);
        $ipfs = $this->messageIpfs->store($message);
        $blockChain = $this->messageBlockChain->store($message);

        return compact('db', 'ipfs', 'blockChain');
    }
}
