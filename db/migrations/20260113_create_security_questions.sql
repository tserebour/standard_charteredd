-- Create security_questions table
CREATE TABLE IF NOT EXISTS `security_questions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `question` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed default questions
INSERT INTO `security_questions` (`question`) VALUES
('What was the name of your first pet?'),
('In what city were you born?'),
('What is your mother''s maiden name?'),
('What was the name of your first school?'),
('What is your favorite book?'),
('What was the make and model of your first car?');
