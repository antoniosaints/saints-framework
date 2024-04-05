<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/vendor/autoload.php";

$paths = [__DIR__ . "/src/Entities"];
$isDevMode = true;

$dbParams = require_once __DIR__ . "/src/Database/Config.php";

$connection = DriverManager::getConnection($dbParams);
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$entityManager = new EntityManager($connection, $config);