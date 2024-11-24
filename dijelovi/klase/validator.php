<?php

class Validator
{


   

   function __construct(){
    echo('<script src="../funkcionalnost/univerzalna/validationError.js"></script>');
   }

    public function showValidationMsg($FormInputO, $msg)
    {
        /** @var FormInput */
        echo ("<script> document.addEventListener('DOMContentLoaded', () => {");
        echo ("showValidationError('" . $FormInputO->inputId . "', '" . $FormInputO->inputLblId . "', '" . $msg . "', '" . $FormInputO->lblDefaultTxt . "');");
        echo ("}); </script>");
    }

    public function removeValidationMsg($FormInputO)
    {
        /**  @var FormInput */


        /**  @var FormInput */
        echo ("<script> document.addEventListener('DOMContentLoaded', () => {");
        echo ("removeValidationError('" . $FormInputO->inputId . "', '" . $FormInputO->inputLblId . "', '" . $FormInputO->lblDefaultTxt . "');");
        echo ("}); </script>");
    }



}

class FormInput
{
    public $inputId;
    public $inputName;
    public $inputDefaultValue;
    public $inputCssClass;

    public $type;


    public $inputLblId;
    public $lblCssClass;
    public $lblDefaultTxt;



    function __construct($inputId, $inputLblId, $inputName, $inputType, $inputDefaultValue, $lblDefaultTxt, $inputCssClass, $lblCssClass)
    {
        $this->inputId = $inputId;
        $this->inputLblId = $inputLblId;
        $this->inputName = $inputName;
        $this->inputDefaultValue = $inputDefaultValue;
        $this->lblDefaultTxt = $lblDefaultTxt;
        $this->inputCssClass = $inputCssClass;
        $this->lblCssClass = $lblCssClass;
        $this->type = $inputType;
    }


    function generateInput()
    {

        echo ("<label ");
        echo ('id="' . $this->inputLblId . '" ');
        if ($this->lblCssClass != null) {
            echo ('class="' . $this->lblCssClass . '" ');
        }
        echo ('>' . $this->lblDefaultTxt . '</label>');


        echo ("<input ");
        echo ('id="' . $this->inputId . '" ');
        if ($this->inputCssClass != null) {
            echo ('class="' . $this->inputCssClass . '" ');
        }
        echo ('name="' . $this->inputName . '" ');
        echo ('type="' . $this->type . '" ');
        echo ('value="' . $this->inputDefaultValue . '" ');
        echo (">");
    }
}