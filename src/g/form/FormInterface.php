<?php

namespace g\form;

use Simplon\Form\Data\FormFields;


interface FormInterface 
{
    
    public function build():self;
    public function validate($data):bool;
    public function getErrors():array;
}