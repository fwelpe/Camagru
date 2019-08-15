<?php
require "database.php";

$pdo = new PDO($DB_DSN_ONCE, $DB_USER, $DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE DATABASE IF NOT EXISTS `gru`");
$pdo = null;
$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(32),
	`email` VARCHAR(100)
	`confirmed` BOOLEAN DEFAULT 0,
	`hash` VARCHAR(255)
  )");
$pdo = null;
