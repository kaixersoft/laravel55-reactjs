<?php

namespace Modules\Api\Contracts;

interface WalletInterface
{
    public function createWallet($email);

    public function deleteWallet($email);

    public function creditWallet($amount , $remarks = null);

    public function debitWallet($amount , $remarks = null);

    public function walletDetails($email);

}