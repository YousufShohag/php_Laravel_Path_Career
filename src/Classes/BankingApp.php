<?php

namespace src\Classes;

use src\Classes\Model\Transaction;
use src\Classes\Model\User;


class BankingApp {
    private $users = [];
    private $transactions = [];

    public function register($name, $email, $password) {
        //* Only customers can register
        $user = new User($name, $email, $password);
        $this->users[] = $user;
        return $user;
    }

    public function createAdmin($name, $email, $password) {
        //* Create admin user
        $admin = new User($name, $email, $password, true);
        $this->users[] = $admin;
        return $admin;
    }

    //TODO:  Login Function Here
    public function login($email, $password) {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email && $user->getPassword() === $password) {
                return $user;
            }
        }
        return null; // !Login failed
    }

    public function deposit(User $user, $amount) {
        //TODO: Implement deposit logic
        //TODO: Record the transaction
        $transaction = new Transaction($user->getEmail(), 'Bank', $amount);
        $this->transactions[] = $transaction;
    }

    public function withdraw(User $user, $amount) {
        // Implement withdraw logic
        // Record the transaction
        $transaction = new Transaction('Bank', $user->getEmail(), -$amount);
        $this->transactions[] = $transaction;
    }

    public function transfer(User $sender, $receiverEmail, $amount) {
        // Implement transfer logic
        // Record the transaction
        $transaction = new Transaction($sender->getEmail(), $receiverEmail, -$amount);
        $this->transactions[] = $transaction;
    }

    public function viewBalance(User $user) {
        // Implement balance calculation logic
        $balance = 0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->getSenderEmail() === $user->getEmail()) {
                $balance -= $transaction->getAmount();
            } elseif ($transaction->getReceiverEmail() === $user->getEmail()) {
                $balance += $transaction->getAmount();
            }
        }
        return $balance;
    }

    public function viewAllTransactions() {
        return $this->transactions;
    }
}