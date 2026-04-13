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