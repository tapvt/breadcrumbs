<?php

defined('SYSPATH') or die('No direct script access.');

// The character that separates each breadcrumb
$config['separator'] = "&raquo;";

// Should we display a separator after the last breadcrumb?
$config['after_last'] = FALSE;

// Minimum depth of breadcrumbs to display
$config['min_depth'] = 1;

$config['exclude'] = array('admin', 'edit', 'view', 'add');

$config['exclude_duplicate_urls'] = TRUE;

$config['exclude_numeric'] = TRUE;

return $config;
