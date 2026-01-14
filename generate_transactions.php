<?php

function generate_transactions($num_records = 100)
{
    $start_date = new DateTime('2009-01-01');
    $end_date = new DateTime('2026-01-14');
    $interval = $start_date->diff($end_date);
    $total_days = $interval->days;

    $file_path = 'db/migrations/20260114_large_transaction_history.sql';
    $handle = fopen($file_path, 'w');

    if (!$handle) {
        die("Unable to open file for writing: $file_path");
    }

    fwrite($handle, "-- Generated Transaction History\n");
    fwrite($handle, "INSERT INTO `transactions` (`account_id`, `amount`, `type`, `description`, `reference_id`, `created_at`) VALUES\n");

    $records = [];
    for ($i = 0; $i < $num_records; $i++) {
        // Date
        $random_days = rand(0, $total_days);
        $date = clone $start_date;
        $date->modify("+$random_days days");
        $date->setTime(rand(0, 23), rand(0, 59), rand(0, 59));
        $created_at = $date->format('Y-m-d H:i:s');

        // Type & Amount
        $trans_type_opts = ['payment', 'transfer', 'deposit', 'fee'];
        $trans_type = $trans_type_opts[array_rand($trans_type_opts)];

        $amount = 0.0;
        $description = "";

        // Weighted random for amount size
        // 10% chance of massive transaction, 90% normal
        if ((rand(0, 100) / 100) < 0.1) {
            $abs_amount = round(rand(5000000, 50000000) / 100, 2); // 50k to 500k
        } else {
            $abs_amount = round(rand(1000, 500000) / 100, 2); // 10 to 5000
        }

        if ($trans_type == 'deposit') {
            $amount = $abs_amount;
            $desc_opts = ['Salary', 'Dividend', 'Refund', 'Deposit', 'Transfer In'];
            $description = $desc_opts[array_rand($desc_opts)] . " - " . $date->format('Y');
        } elseif ($trans_type == 'fee') {
            $amount = -$abs_amount;
            if ($amount < -100)
                $amount = -25.00; // Cap fees usually
            $description = "Service Fee";
        } else { // payment or transfer
            $amount = -$abs_amount;
            $desc_prefixes = ['Walmart', 'Amazon', 'Netflix', 'Rent', 'Car Payment', 'Utilities', 'Transfer Out', 'Coffee', 'Restaurant'];
            $description = $desc_prefixes[array_rand($desc_prefixes)] . " - Ref " . rand(1000, 9999);
        }

        $reference_id = "TX-" . $date->format('Y') . sprintf('%05d', $i);

        $records[] = "(1, $amount, '$trans_type', '$description', '$reference_id', '$created_at')";
    }

    fwrite($handle, implode(",\n", $records) . ";\n");
    fclose($handle);

    echo "Generated $num_records transactions in $file_path\n";
}

generate_transactions(100);
?>