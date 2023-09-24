<?php


namespace src\Classes\Model;


class Transaction {
    private $senderEmail;
    private $receiverEmail;
    private $amount;

    public function __construct($senderEmail, $receiverEmail, $amount) {
        $this->senderEmail = $senderEmail;
        $this->receiverEmail = $receiverEmail;
        $this->amount = $amount;
    }

    public function getSenderEmail() {
        return $this->senderEmail;
    }

    public function getReceiverEmail() {
        return $this->receiverEmail;
    }

    public function getAmount() {
        return $this->amount;
    }
}