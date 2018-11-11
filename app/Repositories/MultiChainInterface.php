<?php

namespace App\Repositories;

interface MultiChainInterface
{
	/**
	 * Create Stream
	 * @param  $streamName  
	 * @param  boolean $allowAnyone 
	 * @param  $custom      
	 * @return mixed             
	 */
	public function createStream($streamName, $allowAnyone = false, $custom = null);

	/**
	 * Create Stream Item
	 * @param  $streamName 
	 * @param  $key        
	 * @param  $value      
	 * @return mixed            
	 */
	public function createStreamItem($streamName,$key,$value);

	/**
	 * Subscribe to the stream
	 * @param  $streamName 
	 * @param  boolean $rescan     
	 * @return mixed            
	 */
	public function subscribeStream($streamName, $rescan = true);

	/**
	 * Create new user
	 * @param  array  $data 	
	 * @return mixed       
	 */
	public function createUser(array $data);

	/**
	 * Creates new key pair
	 * @param int $count
	 * @return array 
	 */
	public function createKeyPairs($count=1);
}