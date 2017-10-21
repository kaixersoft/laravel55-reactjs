<?php

namespace Modules\Api\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Contracts\WalletInterface;
use Modules\Api\Http\Requests\DebitRequest;


class Debit extends Controller
{
    use ApiResponse;

    public function __invoke(DebitRequest $request, WalletInterface $walletSvc)
    {
        try {
            $walletSvc->debitWallet($request->amount, $request->remarks);
            $message = 'Amount successfully debited';

            return $this->success($message);
        }catch (\Exception $e) {
            $message = 'Something went wrong, transaction failed';
            return $this->failed($message);
        }
    }
}
