-- db/schema.sql

-- Drop tables if they exist to ensure clean slate during dev
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `accounts`;
DROP TABLE IF EXISTS `users`;

-- 1. Users Table
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Accounts Table
CREATE TABLE `accounts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `type` ENUM('Checking', 'Savings') NOT NULL,
    `account_number` VARCHAR(20) NOT NULL UNIQUE,
    `balance` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    `currency` VARCHAR(3) NOT NULL DEFAULT 'USD',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Transactions Table
CREATE TABLE `transactions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT NOT NULL,
    `amount` DECIMAL(15, 2) NOT NULL, -- Negative for debit, Positive for credit
    `type` ENUM('payment', 'transfer', 'deposit', 'fee') NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `reference_id` VARCHAR(50) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- SEED DATA -------------------------------------------------------------------

-- User: username 'user', password 'password'
-- Hash generated via password_hash('password', PASSWORD_DEFAULT)
INSERT INTO `users` (`id`, `username`, `password_hash`, `full_name`) VALUES
(1, 'user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Alex Morgan');

-- Accounts for User 1
-- Note: Balances match dummy data requirements
INSERT INTO `accounts` (`id`, `user_id`, `type`, `account_number`, `balance`) VALUES
(1, 1, 'Checking', '78901234', 12450.50),
(2, 1, 'Savings', '78905678', 50000.00);

-- Transactions for Account 1 (Checking)
INSERT INTO `transactions` (`account_id`, `amount`, `type`, `description`, `reference_id`, `created_at`) VALUES
(1, -145.20, 'payment', 'CARD - Whole Foods Market', 'TX-0001234567', '2026-01-10 14:30:00'),
(1, -85.50, 'payment', 'PAYMENT - Electric Company', 'TX-0001234568', '2026-01-09 09:15:00'),
(1, -1000.00, 'transfer', 'TRANSFER - Alex Morgan -> Savings', 'TX-0001234569', '2026-01-08 10:00:00'),
(1, -15.99, 'payment', 'DD - Netflix Subscription', 'TX-0001234571', '2026-01-05 08:00:00'),
(1, 4500.00, 'deposit', 'PAYMENT - Salary Deposit', 'TX-0001234572', '2026-01-01 09:00:00');

-- Transactions for Account 2 (Savings)
-- Corresponding credit for the internal transfer
INSERT INTO `transactions` (`account_id`, `amount`, `type`, `description`, `reference_id`, `created_at`) VALUES
(2, 1000.00, 'transfer', 'TRANSFER - Checking -> Alex Morgan', 'TX-0001234570', '2026-01-08 10:00:00');
