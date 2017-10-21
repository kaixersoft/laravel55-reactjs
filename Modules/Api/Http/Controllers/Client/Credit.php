<?php

namespace Modules\Api\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Contracts\WalletInterface;
use Modules\Api\Http\Requests\CreditRequest;

class Credit extends Controller
{
    use ApiResponse;

    public function __invoke(CreditRequest $request, WalletInterface $walletSvc)
    {
        try {
            $walletSvc->creditWallet($request->amount, $request->remarks);
            $message = 'Amount successfully credited';
            return $this->success($message);
        }catch (\Exception $e) {
            logger($e->getMessage());
            $message = 'Something went wrong, transaction failed';
            return $this->failed($message);
        }
    }
}
