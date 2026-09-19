<?php
declare(strict_types=1);

/**
 * Backward compatibility shim for root config.php
 * Delegates to config/db.php
 */
require_once __DIR__ . '/config/db.php';