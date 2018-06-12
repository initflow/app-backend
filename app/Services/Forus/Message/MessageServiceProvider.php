<?php

namespace App\Services\Forus\Message;

use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepoBlockChain;
use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepoDb;
use App\Services\Forus\Message\Repositories\Interfaces\IMessageRepoIpfs;
use App\Services\Forus\Message\Repositories\MessageIpfsRepo;
use App\Services\Forus\Message\Repositories\MessageDbRepo;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IMessageRepoDb::class, function() {
            return new MessageDbRepo();
        });

        $this->app->bind(IMessageRepoIpfs::class, function() {
            return new MessageIpfsRepo(env('SERVICE_MESSAGES_IPFS_URL'));
        });

        $this->app->bind(IMessageRepoIpfs::class, function() {
            return new MessageIpfsRepo(env('SERVICE_MESSAGES_BLOCK_CHAIN_URL'));
        });



        $this->app->singleton('forus.services.message-db', function () {
            return app(IMessageRepoDb::class);
        });

        $this->app->singleton('forus.services.message-ipfs', function () {
            return app(IMessageRepoIpfs::class);
        });

        $this->app->singleton('forus.services.message-block-chain', function () {
            return app(IMessageRepoBlockChain::class);
        });
    }
}