<?php
session_start();
require_once "env.php"; // Load config & hàm helper

require_once "vendor/autoload.php"; // Autoload PSR-4 của Composer

require_once "routes/web.php"; // Load router chính