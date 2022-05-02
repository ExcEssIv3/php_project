<?php

    abstract class Datatype {
        protected $data;
        // false if data is valid, or a string containing the error
        protected $invalid;

        function __construct($data) {
            $this->data = $data;
            $this->validate();
        }

        function get_data() {
            return $this->data;
        }

        // sets data, updates $invalid
        function set_data($data) {
            $this->data = $data;
            $this->validate();
        }

        function get_invalid() {
            return $this->invalid;
        }

        // updates $invalid     
        protected abstract function validate();
    }

    class Dropdown extends Datatype {
        function validate() {
            if ($this->data == 0) {
                $this->invalid = 'Please select an option';
            } else {
                $this->invalid = false;
            }
        }
    }

    class Name extends Datatype {
        function validate() {
            if (strlen($this->data) == 0) {
                $this->invalid = 'Please enter your name';
            } else if (!preg_match('/^[a-zA-Z]+$/', $this->data)) {
                if (preg_match('/\d/', $this->data)) {
                    $this->invalid = 'Names cannot contain numbers';
                } else {
                    $this->invalid = 'Names cannot contain special characters';
                }
            } else {
                $this->invalid = false;
            }
        }
    }

    class Email extends Datatype {
        function validate() {
            if (strlen($this->data) == 0) {
                $this->invalid = 'Please enter your email';
            } else if (!filter_var($this->data, FILTER_VALIDATE_EMAIL)) {
                $this->invalid = 'Please enter a valid email address';
            } else {
                $this->invalid = false;
            }
        }
    }

    class Date extends Datatype {
        
        // could do with checking date and time separately
        function validate() {
            if (strlen(trim($this->data)) == 0) {
                $this->invalid = 'Please enter a date';
            } else if (date_create_from_format('Y-m-d H:i', $this->data)) {
                $this->invalid = false;
            } else {
                $this->invalid = 'Date sent not valid';
            }
        }
    }

    // used for cases with no invalid data possibilities and also basic instantiation
    class Valid extends Datatype {
        function validate() {
            $this->invalid = false;
        }
    }

?>