<?php
namespace Modules\Api\Services;

use Mockery\Exception;
use Modules\Api\Contracts\WalletInterface;
use Illuminate\Database\QueryException;
use Modules\Api\Entities\Transaction;
use Modules\Api\Entities\Wallet;
use App\User;
use Modules\Api\Tools\TransactionCodeGenerator;

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

    public function creditWallet($amount , $remarks = null)
    {
        try {
            $userWallet = $this->getUserWallet();
            $transaction = new Transaction();
            $transaction->wallet_id = $userWallet->id;
            $transaction->transaction_type_id = Transaction::CREDIT;
            $transaction->exchange_rate_id = 1;
            $transaction->transaction_code = (new TransactionCodeGenerator())->generate();
            $transaction->amount = $amount;
            $transaction->remarks = $remarks;
            $transaction->save();
        }catch (QueryException $e) {
            throw $e;
        }
    }

    public function debitWallet($amount , $remarks = null)
    {
        try {
            $userWallet = $this->getUserWallet();
            $transaction = new Transaction();
            $transaction->wallet_id = $userWallet->id;
            $transaction->transaction_type_id = Transaction::DEBIT;
            $transaction->exchange_rate_id = 1;
            $transaction->transaction_code = (new TransactionCodeGenerator())->generate();
            $transaction->amount = bcmul($amount, -1,2);
            $transaction->remarks = $remarks;
            $transaction->save();
        }catch (QueryException $e) {
            throw $e;
        }
    }

    public function walletDetails($email = 'john@wallet.io')
    {
        $user = User::where('email', $email)
            ->with('wallet')
            ->with(['wallet.transactions' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->first();

        if ($user->wallet) {
            $transactions = $this->getWalletTransactions($user->wallet->transactions);

            $data = [
                'email' => $user->email,
                'balance' => $user->wallet->balance,
                'transactions' => $transactions
            ];


        } else {
            $data = [
                'email' => $user->email,
                'balance' => 0.00,
                'transactions' => []
            ];
        }

        return $data;
    }

    protected function getWalletTransactions($transactions)
    {
        $data = [];
        foreach($transactions as $transaction)
        {
            $data[] = [
              'transaction_code' => $transaction->transaction_code,
              'transaction' => $transaction->transtype->name,
              'amount' => $transaction->amount,
              'currency' => $transaction->currency->currency,
              'transaction_date' => $transaction->created_at->toDateTimeString(),
              'remarks' => $transaction->remarks
            ];
        }

        return $data;
    }


    protected function getUserWallet($email = 'john@wallet.io')
    {
        $user = User::where('email', $email)->first();
        if ($user->wallet) {
            return $user->wallet;
        } else {
            throw new Exception();
        }
    }



}