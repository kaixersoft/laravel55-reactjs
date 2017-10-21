<?php

namespace Modules\Api\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Http\Requests\DeleteWalletRequest;
use Modules\Api\Contracts\WalletInterface;


class DeleteWallet extends Controller
{
    use ApiResponse;

    public function __invoke(DeleteWalletRequest $request, WalletInterface $walletSvc)
    {
        try {
            $walletSvc->deleteWallet($request->email);
            $message = 'Successfully deleted a wallet';
            return $this->success($message);
        } catch (\Exception $e) {
            $message = 'Email address provided does not have a wallet account yet';
            return $this->failed($message);
        }
    }
}
