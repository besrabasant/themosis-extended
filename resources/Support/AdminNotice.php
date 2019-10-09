<?php

namespace Themosis\ThemosisExtended\Support;

use Themosis\ThemosisExtended\Constants\WpCacheKey;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Themosis\Core\Application;
use Themosis\Support\Facades\Action;
use function array_push;

/**
 * Class AdminNotice
 * @package Themosis\ThemosisExtended\Support
 */
class AdminNotice extends Notice
{
    protected $notice_display_hook = 'admin_notices';

    protected $session_key = WpCacheKey::ADMIN_NOTICES;
}