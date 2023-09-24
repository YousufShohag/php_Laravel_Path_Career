<?php

require_once 'vendor/autoload.php';  //@Connecting Autoload USing PS4 Standard

use src\Classes\Model\Transection;   //!Added For Transection Class
use src\Classes\Model\User;  //!Added For User Class

use src\Classes\Main;   //!Added For Main Class




$app = new Main(); //?Create a Object for Main Class

while (true) {
    echo "Welcome to the Banking App!\n";
    echo "Choose an option:\n";
    echo "1. Login\n";
    echo "2. Register\n";
    echo "3. Quit\n";

    $choice = readline("Enter your choice: "); //!Take Input from CLI

    switch ($choice) {
        case '1':
            $email = readline("Enter your email: ");
            $password = readline("Enter your password: "); 

            $user = $app->login($email, $password); //TODO: Using Main Class Login Function Here

            if ($user !== null) {
                echo "Login successful!\n";
                if ($user->isAdmin()) {
                    echo "Admin menu:\n";
                    // Implement admin menu logic
                } else {
                    echo "Customer menu:\n";
                    while (true) {
                        echo "1. View Balance\n";
                        echo "2. Deposit\n";
                        echo "3. Withdraw\n";
                        echo "4. Transfer\n";
                        echo "5. View Transactions\n";
                        echo "6. Logout\n";

                        $customerChoice = readline("Enter your choice: ");

                        switch ($customerChoice) {
                            case '1':
                                $balance = $app->viewBalance($user);
                                echo "Your current balance: $balance\n";
                                break;
                            case '2':
                                $amount = readline("Enter the amount to deposit: ");
                                $app->deposit($user, $amount);
                                echo "Deposit successful!\n";
                                break;
                            case '3':
                                $amount = readline("Enter the amount to withdraw: ");
                                $app->withdraw($user, $amount);
                                echo "Withdrawal successful!\n";
                                break;
                            case '4':
                                $receiverEmail = readline("Enter the receiver's email: ");
                                $amount = readline("Enter the amount to transfer: ");
                                $app->transfer($user, $receiverEmail, $amount);
                                echo "Transfer successful!\n";
                                break;
                            case '5':
                                $transactions = $app->viewAllTransactions();
                                echo "Transactions:\n";
                                foreach ($transactions as $transaction) {
                                    echo "From: " . $transaction->getSenderEmail() . " To: " . $transaction->getReceiverEmail() . " Amount: " . $transaction->getAmount() . "\n";
                                }
                                break;
                            case '6':
                                echo "Logout successful!\n";
                                exit(0);
                            default:
                                echo "Invalid choice. Please try again.\n";
                        }
                    }
                }
            } else {
                echo "Login failed. Please try again.\n";
            }
            break;

        case '2':
            if ($user === null) {
                $name = readline("Enter your name: ");
                $email = readline("Enter your email: ");
                $password = readline("Enter your password: ");
                $app->register($name, $email, $password);
                echo "Registration successful!\n";
            } else {
                echo "You are already logged in.\n";
            }
            break;

        case '3':
            echo "Goodbye!\n";
            exit(0);

        default:
            echo "Invalid choice. Please try again.\n";
    }
}