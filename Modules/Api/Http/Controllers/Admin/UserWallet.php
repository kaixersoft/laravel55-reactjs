<?php

namespace Modules\Api\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Traits\ApiResponse;
use Modules\Api\Contracts\WalletInterface;
use Modules\Api\Http\Requests\UserWalletRequest;

class UserWallet extends Controller
{
    use ApiResponse;

    public function __invoke(UserWalletRequest $request, WalletInterface $walletSvc)
    {
        $data = $walletSvc->walletDetails($request->email);
        $message = 'User wallet details';
        return $this->success($message, $data);

    }
}
