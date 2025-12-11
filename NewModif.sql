
ALTER TABLE `users` ADD `medecin_id` INT UNSIGNED NULL AFTER `is_doctor`;

ALTER TABLE `users`
  ADD KEY `medecin_fk_199740165` (`medecin_id`);

ALTER TABLE `users`
  ADD CONSTRAINT `medecin_fk_199740165` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`);
  
  

CREATE TABLE `application_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `application_modules`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `application_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;