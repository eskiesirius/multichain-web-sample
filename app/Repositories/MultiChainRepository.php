<?php

namespace App\Repositories;

use App\Repositories\MultiChainInterface;
use MultiChain;

class MultiChainRepository implements MultiChainInterface
{
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
    public function createUser(array $data)
    {
        $keyPair = $this->createKeyPairs();

        dd($keyPair[0]);

        return $keyPair;
    }

    /**
     * {@inheritdoc}
     */
    public function createKeyPairs($count=1)
    {
        return MultiChain::createKeypairs($count);
    }
}