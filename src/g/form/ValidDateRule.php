<?php

namespace g\form;

use Simplon\Form\Data\FormField;
use Simplon\Form\Data\Rule;
use Simplon\Form\Data\RuleException;

/**
 * Class ValidDateRule
 * @package Simplon\Form\Data\Rules
 */
class ValidDateRule extends Rule
{
    /**
     * @var string
     */
    protected $errorMessage = 'Field Date is not valid';

    /**
     * @param FormField $field
     *
     * @throws RuleException
     */
    public function apply(FormField $field)
    {
        if ( !$this->check_date ($field->getValue() )) 
        {
            throw new RuleException(
                $this->getErrorMessage()
            );
        }
    }


    private function check_date($date) {
        if (preg_match("/^[0-9]{1,4}(\/|\.|-)[0-9]{1,4}(\/|\.|-)[0-9]{1,4}$/", $date)) {
            $pattern = '/\.|\/|-/i';    // "." or "/" or "-"
            preg_match($pattern, $date, $char);

            $array = preg_split($pattern, $date, -1, PREG_SPLIT_NO_EMPTY);

            if (strlen($array[2]) == 4) {
                // dd.mm.yyyy || dd-mm-yyyy
                if ($char[0] == "."|| $char[0] == "-") {
                    $month = $array[1];
                    $day = $array[0];
                    $year = $array[2];
                }
                // mm/dd/yyyy    # Common U.S. writing
                if ($char[0] == "/") {
                    $month = $array[0];
                    $day = $array[1];
                    $year = $array[2];
                }
            }
            // yyyy-mm-dd    # iso 8601
            if (strlen($array[0]) == 4 && ($char[0] == "-" || $char[0] == ".")) {
                $month = $array[1];
                $day = $array[2];
                $year = $array[0];
            }
            if (isset($month)&& isset($day) && isset($year) && checkdate($month, $day, $year)) {    //Validate Gregorian date
                return true;
            } else {
                return false;
            }
        } else {
            return false;    // more or less 10 chars
        }
    }
}