-- Add security question columns to users (UI-only fixtures)
ALTER TABLE users
  ADD COLUMN security_question VARCHAR(255) DEFAULT NULL,
  ADD COLUMN security_answer VARCHAR(255) DEFAULT NULL;

-- NOTE: security_answer stored in plain text in fixtures for UI simulation only. Do NOT use for real auth.
