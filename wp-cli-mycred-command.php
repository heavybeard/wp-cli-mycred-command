<?php
/*
Plugin Name: myCRED CLI
Version: 1.0
Description: A CLI interface for the myCRED plugin
Author: Heavybeard
Author URI: http://heavybeard.it
Plugin URI: https://github.com/heavybeard/wp-cli-mycred-command
License: MIT
 */

// Load plugin once and check for WP CLI and myCRED plugin
if (defined('WP_CLI_MYCRED_COMMAND') || !class_exists('myCRED_Core') || !defined('WP_CLI')) {
	return;
}

// Define constants
define('WP_CLI_MYCRED_COMMAND', true);
define('WP_CLI_MYCRED_VERBOSE', true);
define('WP_CLI_MYCRED_HELPERS_PATH', '/helpers/');
define('WP_CLI_MYCRED_COMMANDS_PATH', '/commands/');
define('WP_CLI_MYCRED_SUBCOMMANDS_PATH', '/subcommands/');

// Require command
require_once __DIR__ . WP_CLI_MYCRED_HELPERS_PATH . 'Log.php';

// Require command
require_once __DIR__ . WP_CLI_MYCRED_COMMANDS_PATH . 'WP_CLI_MyCRED.php';

// Require all subcommands
require_once __DIR__ . WP_CLI_MYCRED_SUBCOMMANDS_PATH . 'Export.php';
