<?php

session_start();

require 'vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__)->load();

require 'routes/index.php';
