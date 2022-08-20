CREATE TABLE `notification` (
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `type` INT(11) NULL DEFAULT '0',
                                `user_id` INT(11) NULL DEFAULT '0',
                                `date_created` DATE NULL DEFAULT NULL,
                                PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
CREATE TABLE `users` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `username` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                         `password` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                         `email` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                         `firstname` VARCHAR(50) NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                         `lastname` VARCHAR(50) NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                         `role` INT(1) NULL DEFAULT '2',
                         PRIMARY KEY (`id`) USING BTREE,
                         UNIQUE INDEX `username` (`username`) USING BTREE
)
    COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
