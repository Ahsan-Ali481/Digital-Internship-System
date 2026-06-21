-- Digital Internship System (DIS) - Production Database Schema
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
  `avatar` VARCHAR(255) DEFAULT NULL,
  
  `university` VARCHAR(200) DEFAULT NULL,
  `major` VARCHAR(150) DEFAULT NULL,
  `grad_year` VARCHAR(10) DEFAULT NULL,
  `resume_url` VARCHAR(255) DEFAULT NULL,
  
  `company_name` VARCHAR(200) DEFAULT NULL,
  `industry` VARCHAR(150) DEFAULT NULL,
  `website` VARCHAR(255) DEFAULT NULL,
  `certificate_url` VARCHAR(255) DEFAULT NULL,
  
  `company_uid` VARCHAR(64) DEFAULT NULL,
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
  `duration` VARCHAR(100) NOT NULL,
  `stipend` VARCHAR(100) NOT NULL,
  `positions` INT DEFAULT 1,
  `deadline` DATE NOT NULL,
  `description` TEXT NOT NULL,
  `requirements` TEXT NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `posted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`company_uid`) REFERENCES `users`(`user_uid`) ON DELETE CASCADE
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
  `completion_verified` TINYINT(1) DEFAULT 0,
  `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`internship_uid`) REFERENCES `internships`(`internship_uid`) ON DELETE CASCADE,
  FOREIGN KEY (`student_uid`) REFERENCES `users`(`user_uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `interviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `application_uid` VARCHAR(64) NOT NULL,
  `interview_date` DATE NOT NULL,
  `interview_time` TIME NOT NULL,
  `mode` ENUM('Online', 'Onsite') DEFAULT 'Online',
  `meeting_link` VARCHAR(255) DEFAULT NULL,
  `scheduled_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`application_uid`) REFERENCES `applications`(`application_uid`) ON DELETE CASCADE
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
  `assigned_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`student_uid`) REFERENCES `users`(`user_uid`) ON DELETE CASCADE,
  FOREIGN KEY (`supervisor_uid`) REFERENCES `users`(`user_uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `progress_reports` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `report_uid` VARCHAR(64) UNIQUE NOT NULL,
  `student_uid` VARCHAR(64) NOT NULL,
  `supervisor_uid` VARCHAR(64) NOT NULL,
  `week_number` INT NOT NULL,
  `summary` TEXT NOT NULL,
  `achievements` TEXT NOT NULL,
  `attachment_name` VARCHAR(255) NOT NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `rating` INT DEFAULT NULL,
  `feedback_comment` TEXT DEFAULT NULL,
  `feedback_at` DATETIME DEFAULT NULL,
  FOREIGN KEY (`student_uid`) REFERENCES `users`(`user_uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `notifications` (