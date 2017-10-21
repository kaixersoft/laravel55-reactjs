<?php

namespace Modules\Api\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Modules\Api\Http\Requests\MakeWalletRequest;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Contracts\WalletInterface;


class MakeWallet extends Controller
{
    use ApiResponse;

    public function __invoke(MakeWalletRequest $request, WalletInterface $walletSvc)
    {
        try {
            $walletSvc->createWallet($request->email);
            $message = 'Successfully created a wallet';
            return $this->success($message);
        } catch (QueryException $e) {
            $message = 'Email address has a an existing wallet already';
            return $this->failed($message);
        }
    }
}
