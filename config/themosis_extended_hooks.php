<?php

/**
 * Plugin Hooks that extends Hookable class.
 */

use Themosis\ThemosisExtended\Hooks\AdminBodyClass;
use Themosis\ThemosisExtended\Hooks\AdminNotices;
use Themosis\ThemosisExtended\Hooks\PersistSessions;
use Themosis\ThemosisExtended\Hooks\UserNotices;

return [
    PersistSessions::class,
    UserNotices::class,
    AdminNotices::class,
    AdminBodyClass::class,
];