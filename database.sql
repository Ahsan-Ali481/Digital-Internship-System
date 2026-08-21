-- Digital Internship System (DIS) - Database Schema
-- Compatible with MySQL / MariaDB via XAMPP

CREATE DATABASE IF NOT EXISTS `digital_internship_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `digital_internship_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_uid` VARCHAR(64) UNIQUE NOT NULL,
  `role` ENUM('student', 'company', 'supervisor', 'admin') NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(30) DEFAULT NULL,
  `status` ENUM('pending', 'approved', 'rejected', 'blocked') DEFAULT 'approved',
  `university` VARCHAR(200) DEFAULT NULL,
  `major` VARCHAR(150) DEFAULT NULL,
  `grad_year` VARCHAR(10) DEFAULT NULL,
  `company_name` VARCHAR(200) DEFAULT NULL,
  `industry` VARCHAR(150) DEFAULT NULL,
  `department` VARCHAR(150) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `internships` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `internship_uid` VARCHAR(64) UNIQUE NOT NULL,
  `company_uid` VARCHAR(64) NOT NULL,
  `company_name` VARCHAR(200) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `location` VARCHAR(150) NOT NULL,
  `stipend` VARCHAR(100) NOT NULL,
  `deadline` DATE NOT NULL,
  `description` TEXT NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `posted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `applications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `application_uid` VARCHAR(64) UNIQUE NOT NULL,
  `internship_uid` VARCHAR(64) NOT NULL,
  `student_uid` VARCHAR(64) NOT NULL,
  `company_uid` VARCHAR(64) NOT NULL,
  `supervisor_uid` VARCHAR(64) DEFAULT NULL,
  `cv_name` VARCHAR(255) NOT NULL,
  `status` ENUM('Pending', 'Shortlisted', 'Selected', 'Rejected') DEFAULT 'Pending',
  `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `interviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `application_uid` VARCHAR(64) NOT NULL,
  `interview_date` DATE NOT NULL,
  `interview_time` TIME NOT NULL,
  `mode` ENUM('Online', 'Onsite') DEFAULT 'Onsite',
  `address` VARCHAR(255) NOT NULL,
  `scheduled_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `task_uid` VARCHAR(64) UNIQUE NOT NULL,
  `student_uid` VARCHAR(64) NOT NULL,
  `supervisor_uid` VARCHAR(64) NOT NULL,
  `company_uid` VARCHAR(64) NOT NULL,
  `title` VARCHAR(250) NOT NULL,
  `description` TEXT NOT NULL,
  `deadline` DATE NOT NULL,
  `status` ENUM('Pending', 'Completed') DEFAULT 'Pending',
  `assigned_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `progress_reports` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `report_uid` VARCHAR(64) UNIQUE NOT NULL,
  `student_uid` VARCHAR(64) NOT NULL,
  `supervisor_uid` VARCHAR(64) NOT NULL,
  `week_number` INT NOT NULL,
  `summary` TEXT NOT NULL,
  `achievements` TEXT NOT NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `rating` INT DEFAULT NULL,
  `feedback` TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Accounts with exact requested credentials
INSERT INTO `users` (`user_uid`, `role`, `name`, `email`, `password`, `status`, `university`, `company_name`, `department`) VALUES
('usr_adm1', 'admin', 'System Administrator', 'admin123@gmail.com', '12345678', 'approved', NULL, NULL, NULL),
('usr_std1', 'student', 'Ahmed Hassan', 'ahmed123@gmail.com', '123456789', 'approved', 'National University of Sciences & Technology', NULL, NULL),
('usr_hr1', 'company', 'Sarah Jenkins', 'hr123@gmail.com', '123456789', 'approved', NULL, 'TechCorp Solutions', NULL),
('usr_sup1', 'supervisor', 'Dr. Robert Chen', 'supervisor123@gmail.com', '123456789', 'approved', NULL, 'TechCorp Solutions', 'Engineering & AI Labs')
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`), `password` = VALUES(`password`);
