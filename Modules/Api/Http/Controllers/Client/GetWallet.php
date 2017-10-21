<?php

namespace Modules\Api\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Contracts\WalletInterface;

class GetWallet extends Controller
{
    use ApiResponse;

    public function __invoke(WalletInterface $walletSvc)
    {
        $data = $walletSvc->walletDetails();
        $message = 'User wallet details';
        return $this->success($message, $data);
    }
}
