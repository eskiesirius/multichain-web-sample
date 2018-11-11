<?php

namespace App\Http\Validations;

use App\Repositories\MultiChainRepository;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Validator;

class UserValidation extends Validator
{
	/**
     * @var \App\Repositories\MultiChainRepository
     */
    protected $multichain;

    /**
     * Create a new Validator instance.
     *
     * @param  \Illuminate\Contracts\Translation\Translator  $translator
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return void
     */
    public function __construct(Translator $translator, array $data, array $rules,
                                array $messages = [], array $customAttributes = [])
    {
        $this->initialRules = $rules;
        $this->translator = $translator;
        $this->customMessages = $messages;
        $this->data = $this->parseData($data);
        $this->customAttributes = $customAttributes;
        $this->multichain = new MultiChainRepository;

        $this->setRules($rules);
    }

	/**
	 * Validate if the same with the old password
	 * @param  string $attribute 
	 * @param  string $value     
	 * @return boolean            
	 */
	function validateOldPassword($attribute, $value)
	{
		//TODO: this will be used in the near future
	}

	/**
	 * Check if email is already exist
	 * @param  string $attribute 
	 * @param  string $value     
	 * @return boolean            
	 */
	public function validateEmailExist($attribute, $value)
	{
		return !count($this->multichain->getUserCredentialByEmail($value));
	}
}