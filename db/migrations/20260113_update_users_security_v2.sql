-- Update users table to use security_question_id
-- We add the column and the foreign key constraint.
-- If security_question text column exists, we can drop it after migration or keep it for now.
-- In this demo context, we usually prefer clean schema.

ALTER TABLE `users` 
ADD COLUMN `security_question_id` INT DEFAULT NULL,
ADD COLUMN `security_answer` VARCHAR(255) DEFAULT NULL,
ADD CONSTRAINT `fk_user_security_question` 
FOREIGN KEY (`security_question_id`) REFERENCES `security_questions`(`id`) ON DELETE SET NULL;

-- Remove the old text-based security_question column if it was added by a previous (failed/unfinished) attempt
-- Looking at schema.sql it wasn't there yet, but 20260113_add_security_question_to_users.sql might have been run.
-- To be safe, we check if it exists before dropping, but ALTER TABLE DROP COLUMN will fail if it's not there.
-- Let's check the schema first or just use a conditional if possible (though MySQL ALTER doesn't support IF EXISTS for columns easily).
-- I will assume 20260113_add_security_question_to_users.sql might have been run based on list_dir.
