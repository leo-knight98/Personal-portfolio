<?php
    load('models/GuestBookModel');
    class GuestBook {
        private $userName;
        private $dateTime;
        private $email;
        private $message;
        private $model;

        public function __construct($user, $email, $message) {
            $this->userName = $user;
            $this->dateTime = date('d/m/Y, H:i:s');
            $this->email = $email;
            $this->message = $message;
            $this->model = new GuestBookModel;
        }

        public function create() {
            $this->model->create($this);
        }

        public function read() {
            $comments = $this->model->read();
            return $comments;
        }

        public function getName() {
            return $this->userName;
        }

        public function getMail() {
            return $this->email;
        }

        public function getMsg() {
            return $this->message;
        }

        public function getDate() {
            return strval($this->dateTime);
        }
    }
?> 