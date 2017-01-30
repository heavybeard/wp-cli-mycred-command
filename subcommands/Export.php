<?php

namespace MyCRED\Subcommands;

use MyCRED\Commands\WP_CLI_MyCRED as WP_CLI_MyCRED;
use WP_CLI;

/**
 * Manage export subcommand
 */
class Export extends WP_CLI_MyCRED {
	/**
	 * @param $args
	 */
	public function __invoke($args) {
		// Do stuff
	}
}

// Add 'mycred export' command
WP_CLI::add_command('mycred export', __NAMESPACE__ . '\\Export');
