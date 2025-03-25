<?php
// file: migrate.php
require_once "env.php";

try {
    $conn = new PDO("mysql:host=" . DBHOST, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tạo DB nếu chưa có
    $conn->exec("CREATE DATABASE IF NOT EXISTS `" . DBNAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->exec("USE `" . DBNAME . "`");

    // majors table (ngành học)
    $conn->exec("
        CREATE TABLE IF NOT EXISTS majors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // courses table (khóa sinh viên)
    $conn->exec("
        CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // students table (học viên, thuộc lớp)
    $conn->exec("
        CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            avatar VARCHAR(255),
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            phone VARCHAR(11) NOT NULL UNIQUE,
            dob DATE NOT NULL,
            gender Boolean NOT NULL,
            address VARCHAR(255) NOT NULL,
            major_id INT NOT NULL,
            course_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
            FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE CASCADE
        )
    ");

    echo "✅ Migration success! Database & table are created.\n";
} catch (PDOException $e) {
    die("❌ Migration failed: " . $e->getMessage() . "\n");
}
