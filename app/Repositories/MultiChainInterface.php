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
	 * Get the list of streams
	 * @param  string  $streamName 
	 * @param  boolean $verbose    
	 * @param  $count      
	 * @return mixed            
	 */
	public function getStreams($streamName = "*", $verbose = false, $count = null);

	/**
	 * Get the list of items by stream id/name
	 * @param  $streamName 
	 * @param  boolean $verbose    
	 * @param  integer $count      
	 * @return mixed            
	 */
	public function getStreamItems($streamName, $verbose = false, $count = 10);

	/**
	 * Get stream item by key
	 * @param  $streamName 
	 * @param  $key        
	 * @param  boolean $verbose    
	 * @param  integer $count      
	 * @return mixed            
	 */
	public function getStreamItemByKey($streamName,$key,$verbose = false,$count = 10);

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

	/**
	 * Get registered users by email
	 * @param  string $email 
	 * @return mixed        
	 */
	public function getUserCredentialByEmail($email);

	/**
	 * Get user stream id by address
	 * @param  string $address 
	 * @return mixed        
	 */
	public function getUserStreamIdByAddress($address);
}