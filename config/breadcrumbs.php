<?php

defined('SYSPATH') or die('No direct script access.');

// The character that separates each breadcrumb
$config['separator'] = "&raquo;";

// Should we display a separator after the last breadcrumb?
$config['after_last'] = FALSE;

// Minimum depth of breadcrumbs to display
$config['min_depth'] = 1;

//Segments to exclude from crumbs
$config['exclude'] = array('admin', 'edit', 'view', 'add');

//Reason to exclude same urls
$config['exclude_duplicate_urls'] = TRUE;

//Reason to exclude numeric segments
$config['exclude_numeric'] = TRUE;

//Reason to excude crumbs that part of some subrequest and not initial
$config['only_initial'] = TRUE;

return $config;
