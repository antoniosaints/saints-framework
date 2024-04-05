<?php
require_once __DIR__ . "/vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;


$paths = [__DIR__ . "/src/Entities"];
$isDevMode = true;

$dbParams = require_once __DIR__ . "/src/Database/Config.php";

$connection = DriverManager::getConnection($dbParams);
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$entityManager = new EntityManager($connection, $config);