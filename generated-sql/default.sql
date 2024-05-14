
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- quiz
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz`;

CREATE TABLE `quiz`
(
    `quiz_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `description` TEXT,
    `is_published` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`quiz_id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `quiz_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_answer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_answer`;

CREATE TABLE `quiz_answer`
(
    `quiz_answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `quiz_question_id` int(10) unsigned NOT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `answer_content` TEXT NOT NULL,
    PRIMARY KEY (`quiz_answer_id`),
    INDEX `quiz_question_id` (`quiz_question_id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `quiz_answer_ibfk_1`
        FOREIGN KEY (`quiz_question_id`)
        REFERENCES `quiz_questions` (`question_id`),
    CONSTRAINT `quiz_answer_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_questions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_questions`;

CREATE TABLE `quiz_questions`
(
    `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `quiz_id` int(10) unsigned NOT NULL,
    `quiz_type_id` int(10) unsigned NOT NULL,
    `question_content` TEXT NOT NULL,
    `question_answer` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`question_id`),
    INDEX `quiz_id` (`quiz_id`),
    INDEX `quiz_type_id` (`quiz_type_id`),
    CONSTRAINT `quiz_questions_ibfk_1`
        FOREIGN KEY (`quiz_id`)
        REFERENCES `quiz` (`quiz_id`),
    CONSTRAINT `quiz_questions_ibfk_2`
        FOREIGN KEY (`quiz_type_id`)
        REFERENCES `quiz_type` (`quiz_type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_results
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_results`;

CREATE TABLE `quiz_results`
(
    `result_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `quiz_id` int(10) unsigned NOT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `score` int(10) unsigned NOT NULL,
    `is_complete` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`result_id`),
    INDEX `quiz_id` (`quiz_id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `quiz_results_ibfk_1`
        FOREIGN KEY (`quiz_id`)
        REFERENCES `quiz` (`quiz_id`),
    CONSTRAINT `quiz_results_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_type`;

CREATE TABLE `quiz_type`
(
    `quiz_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`quiz_type_id`),
    UNIQUE INDEX `name` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `username` VARCHAR(25) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX `username` (`username`),
    UNIQUE INDEX `email` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
