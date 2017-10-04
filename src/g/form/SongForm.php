<?php

namespace g\form;

use Simplon\Form\FormFields;
use Simplon\Form\Data\FormField;
use Simplon\Form\FormValidator;

use Simplon\Form\Data\Rules\RequiredRule;
use Simplon\Form\Data\Rules\MinLengthRule;
use Simplon\Form\Data\Rules\MaxLengthRule;

use g\form\FormInterface;
use g\form\ValidDateRule;

class SongForm implements FormInterface 
{
	
	private  $formFields;
	private  $validator;
	private  $errors =[];

	private $valid;
	private $validated;

    public function build():FormInterface{

    	$formFields = new FormFields();

		$nameField        = (new FormField('name'))
								->addRule(new RequiredRule())	
								//->addRule(new MinLengthRule(1))	
								//->addRule(new MaxLengthRule(30))	
								;
		
		$publishDateField = (new FormField('publishDate'))
								->addRule(new RequiredRule())
								->addRule(new ValidDateRule() )
								;

		$formFields->add($nameField)
		           	->add($publishDateField);

		$this->formFields = $formFields;
		
		return $this;           						
	}
    
    public function validate($data):bool{

    	$validator = new FormValidator($data);
    	$validator->addFields($this->formFields);

    	if($validator->hasBeenSubmitted()) // any request data?
		{
 		   if($validator->validate()->isValid())
    		{
	    		// all validated field data as array
    			//var_dump($this->formFields->getAllData());
    			$this->valid = true;
    		}
    		else
    		{
			    // array of error messages
		    	//var_dump($validator->getErrorMessages());
		    	$this->errors = $validator->getErrorMessages();
		    	$this->valid = false;
    		}
		}

		$this->validated = true;
		return $this->valid;
    } 

	
	public function getErrors():array{
		return $this->errors;
	} 
}