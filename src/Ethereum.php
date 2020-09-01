<?php
/*
 * This file is a part of "furqansiddiqui/ethereum-php" package.
 * https://github.com/furqansiddiqui/ethereum-php
 *
 * Copyright (c) Furqan A. Siddiqui <hello@furqansiddiqui.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/furqansiddiqui/ethereum-php/blob/master/LICENSE
 */

declare(strict_types=1);

namespace FurqanSiddiqui\Ethereum;

use FurqanSiddiqui\BIP32\ECDSA\Curves;
use FurqanSiddiqui\Ethereum\Accounts\Account;
use FurqanSiddiqui\Ethereum\KeyPair\HDFactory;
use FurqanSiddiqui\Ethereum\KeyPair\KeyPairFactory;

/**
 * Class Ethereum
 * @package FurqanSiddiqui\Ethereum
 */
class Ethereum
{
    /** @var int ECDSA/ECC curve identifier */
    public const ECDSA_CURVE = Curves::SECP256K1;
    /** @var int Fixed length of private keys in bits */
    public const PRIVATE_KEY_BITS = 256;
    /** @var string BIP32 MKD HMAC Key */
    public const HD_MKD_HMAC_KEY = "Bitcoin seed";

    /** @var KeyPairFactory */
    private KeyPairFactory $keyPairFactory;
    /** @var HDFactory */
    private HDFactory $hdFactory;

    /**
     * Ethereum constructor.
     */
    public function __construct()
    {
        $this->keyPairFactory = new KeyPairFactory($this);
        $this->hdFactory = new HDFactory($this);
    }

    /**
     * @return KeyPairFactory
     */
    public function keyPairs(): KeyPairFactory
    {
        return $this->keyPairFactory;
    }

    /**
     * @return HDFactory
     */
    public function hd(): HDFactory
    {
        return $this->hdFactory;
    }

    /**
     * @param $addr
     * @return Account
     * @throws Exception\AccountsException
     */
    public function getAccount($addr): Account
    {
        return new Account($this, $addr);
    }
}
