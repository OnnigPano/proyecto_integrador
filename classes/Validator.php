<?php 

    abstract class Validator 
    {
        protected $errors;

        public function __construct()
        {
            $this->errors = [];
        }

        public function setError(string $field, string $text)
        {
            $this->errors[$field] = $text;
        }

        public function getError(string $field)
        {
            return $this->errors[$field];
        }

        public function hasError(string $field)
        {
            return isset($this->errors[$field]);
        }

        public function getAllErrors()
        {   
            return $this->errors;
        }

        abstract public function isValid();
    }
    