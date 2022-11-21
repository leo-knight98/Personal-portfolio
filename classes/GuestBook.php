<?php
    class GuestBook {
        private $userName;
        private $dateTime;
        private $email;
        private $message;

        public function __construct($user, $email, $message) {
            $this->userName = $user;
            $this->dateTime = date('d m Y, H:i:s');
            $this->email = $email;
            $this->message = $message;
        }
    }
?>