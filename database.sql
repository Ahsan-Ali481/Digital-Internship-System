-- Digital Internship System (DIS) - Production Database Schema
-- Compatible with MySQL / MariaDB via XAMPP

CREATE DATABASE IF NOT EXISTS `digital_internship_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `digital_internship_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_uid` VARCHAR(64) UNIQUE NOT NULL,
  `role` ENUM('student', 'company', 'supervisor', 'admin') NOT NULL,
  `name` VARCHAR(150) NOT NULL,