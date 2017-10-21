<?php

return [
    'name' => 'Api',
    'bindings' => [
        \Modules\Api\Contracts\WalletInterface::class => \Modules\Api\Services\WalletService::class
    ]
];
