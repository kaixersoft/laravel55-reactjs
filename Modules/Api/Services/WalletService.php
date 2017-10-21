<?php
namespace Modules\Api\Services;

use Modules\Api\Contracts\WalletInterface;
use Illuminate\Database\QueryException;
use Modules\Api\Entities\Wallet;
use App\User;

class WalletService implements WalletInterface
{
    public function createWallet($email)
    {
        try {
            $admin = User::where('name', 'admin')->first();
            $user = User::where('email', $email)->first();
            Wallet::create([
                'user_id' => $user->id,
                'created_by' => $admin->id
            ]);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function deleteWallet($email)
    {
        $user = User::where('email', $email)
            ->with('wallet')
            ->first();

        try {
            if ( $user->wallet ) {
                $user->wallet->delete();
            } else {
                throw new \Exception();
            }
        } catch (QueryException $e) {
            throw $e;
        }


    }
}