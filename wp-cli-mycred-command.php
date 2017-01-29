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
if (defined('WP_CLI_MYCRED_COMMAND') && !defined('WP_CLI') && !class_exists('myCRED_Core')) {
	return;
}

// Define constants
define('WP_CLI_MYCRED_COMMAND', true);
define('WP_CLI_MYCRED_COMMANDS_PATH', '/commands/');
define('WP_CLI_MYCRED_SUBCOMMANDS_PATH', '/subcommands/');

// Require command
require_once __DIR__ . WP_CLI_MYCRED_COMMANDS_PATH . 'mycred.php';

// Require all subcommands
require_once __DIR__ . WP_CLI_MYCRED_SUBCOMMANDS_PATH . 'export.php';
