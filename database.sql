CREATE DATABASE IF NOT EXISTS smartlink CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smartlink;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','publisher','user') NOT NULL DEFAULT 'user',
  status TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE smart_links (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NULL,
  title VARCHAR(190) NOT NULL,
  code VARCHAR(32) NOT NULL UNIQUE,
  destination_url TEXT NOT NULL,
  status ENUM('active','expired','disabled') NOT NULL DEFAULT 'active',
  expires_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(user_id),
  INDEX(status)
);

CREATE TABLE routing_rules (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  smart_link_id BIGINT UNSIGNED NOT NULL,
  country_code CHAR(2) NULL,
  device_type VARCHAR(30) NULL,
  destination_url TEXT NOT NULL,
  priority INT NOT NULL DEFAULT 0,
  active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(smart_link_id)
);

CREATE TABLE clicks (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  smart_link_id BIGINT UNSIGNED NOT NULL,
  click_id CHAR(36) NOT NULL,
  ip_hash CHAR(64) NULL,
  country_code CHAR(2) NULL,
  device_type VARCHAR(30) NULL,
  browser VARCHAR(80) NULL,
  os VARCHAR(80) NULL,
  referrer VARCHAR(500) NULL,
  is_unique TINYINT(1) NOT NULL DEFAULT 1,
  is_fraud TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(smart_link_id),
  INDEX(created_at),
  INDEX(is_fraud)
);

CREATE TABLE conversions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  click_id CHAR(36) NULL,
  smart_link_id BIGINT UNSIGNED NULL,
  offer_id BIGINT UNSIGNED NULL,
  conversion_value DECIMAL(12,2) NOT NULL DEFAULT 0,
  status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(created_at)
);

CREATE TABLE offers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(190) NOT NULL,
  payout DECIMAL(12,2) NOT NULL DEFAULT 0,
  currency CHAR(3) NOT NULL DEFAULT 'USD',
  status ENUM('active','paused') NOT NULL DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NULL,
  action VARCHAR(190) NOT NULL,
  ip_hash CHAR(64) NULL,
  details JSON NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(created_at)
);

CREATE TABLE security_alerts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  severity ENUM('low','medium','high','critical') NOT NULL DEFAULT 'low',
  title VARCHAR(190) NOT NULL,
  details TEXT NULL,
  resolved TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create a real admin password with PHP password_hash() before production use.
