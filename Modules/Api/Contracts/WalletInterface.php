<?php

namespace Modules\Api\Contracts;

interface WalletInterface
{
    public function createWallet($email);

    public function deleteWallet($email);
}