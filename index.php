<?php


require_once 'vendor/autoload.php';


use src\Classes\BankingApp;




$app = new BankingApp();

while (true) {
    echo "Welcome to the Banking App!\n";
    echo "Choose an option:\n";
    echo "1. Login\n";
    echo "2. Register\n";
    echo "3. Quit\n";

    $user_input = readline("Enter your choice: ");

    switch ($user_input) {
        case '1':
            $email = readline("Enter your email: ");
            $password = readline("Enter your password: ");

            $user = $app->login($email, $password);

            if ($user !== null) {
                 echo "Login successful!\n";
                 echo "1. Admin\n";
                 echo "2. Customer\n";
                 $user_input_choose = readline("Enter your choice: ");
                 switch ( $user_input_choose){
                    case '1';
                    echo "Admin menu:\n";
                    while (true) {
                        echo "1. See all transactions by all users\n";
                        echo "2. See transactions by a specific user\n";
                        echo "3. See the list of all customers\n";
                        echo "4. Logout\n";
                
                        $adminChoice = readline("Enter your choice: ");
                
                        switch ($adminChoice) {
                            case '1':
                                $transactions = $app->viewAllTransactions();
                                echo "All Transactions:\n";
                                foreach ($transactions as $transaction) {
                                    echo "From: " . $transaction->getSenderEmail() . " To: " . $transaction->getReceiverEmail() . " Amount: " . $transaction->getAmount() . "\n";
                                }
                                break;
                
                            case '2':
                                $emailToSearch = readline("Enter the user's email to view transactions: ");
                                $userTransactions = $app->viewTransactionsByUser($emailToSearch);
                                if (empty($userTransactions)) {
                                    echo "No transactions found for this user.\n";
                                } else {
                                    echo "Transactions for $emailToSearch:\n";
                                    foreach ($userTransactions as $transaction) {
                                        echo "From: " . $transaction->getSenderEmail() . " To: " . $transaction->getReceiverEmail() . " Amount: " . $transaction->getAmount() . "\n";
                                    }
                                }
                                break;
                
                            case '3':
                                $customers = $app->getAllCustomers();
                                echo "List of all customers:\n";
                                foreach ($customers as $customer) {
                                    echo "Name: " . $customer->getName() . " Email: " . $customer->getEmail() . "\n";
                                }
                                break;
                
                            case '4':
                                echo "Logout successful!\n";
                                exit(0);
                
                            default:
                                echo "Invalid choice. Please try again.\n";
                        }
                    }
                    break;
                    case '2';
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
