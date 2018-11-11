<?php

namespace App\Repositories;

use App\Repositories\MultiChainInterface;
use MultiChain;

class MultiChainRepository implements MultiChainInterface
{
    /**
     * @var string
     */
    protected $userTable = 'tblUser';

    /**
     * @var string
     */
    protected $generalTable = 'tblGeneral';

	/**
     * {@inheritdoc}
     */
	public function createStream($streamName, $allowAnyone = false, $custom = null)
	{
		return MultiChain::create($streamName, $allowAnyone, $custom);
	}

    /**
     * {@inheritdoc}
     */
    public function createStreamItem($streamName,$key,$value)
    {
        return MultiChain::publish($streamName, $key, bin2hex($value));
    }

    /**
     * {@inheritdoc}
     */
    public function subscribeStream($streamName, $rescan = true)
    {
        return MultiChain::subscribe($streamName, $rescan);
    }

    /**
     * {@inheritdoc}
     */
    public function createUser(array $data)
    {
        //Create a key pair for the registered user
        $keyPairs = $this->createKeyPairs();
        $address = $keyPairs[0]['address'];
        $hashedAddress = md5($address);

        //Add the newly generated pair to the tblGeneral
        $this->createStreamItem($this->generalTable,$address,$hashedAddress);

        //Add the registered user to the tblUser
        $this->createStreamItem($this->userTable,$data['email'],aes_encrypt($data['password'],$address));

        //Create stream for the registered user
        $this->createStream($hashedAddress,true);
        $this->subscribeStream($hashedAddress);
        $this->createStreamItem($hashedAddress,'email',$data['email']);
        $this->createStreamItem($hashedAddress,'name',$data['name']);

        return $keyPairs;
    }

    /**
     * {@inheritdoc}
     */
    public function createKeyPairs($count=1)
    {
        return MultiChain::createKeypairs($count);
    }
}