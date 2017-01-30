<?php

namespace MyCRED\Commands;

use WP_CLI;
use WP_CLI_Command;

/**
 *
 */
class WP_CLI_MyCRED extends WP_CLI_Command {
	/**
	 * Hold arguments
	 * @var array
	 */
	protected $args;

	/**
	 * Hold associated arguments
	 * @var array
	 */
	protected $assoc_args;

	/**
	 * Process the provided arguments
	 * @param array $default_args       Default args
	 * @param array $args               Provided args
	 * @param array $default_assoc_args Default associated args
	 * @param array $assoc_args         Associated args
	 */
	protected function process_args($default_args = [], $args = [], $default_assoc_args = [], $assoc_args = []) {
		$this->args       = $args + $default_args;
		$this->assoc_args = wp_parse_args($assoc_args, $default_args);
	}
}

// Add 'mycred' command
WP_CLI::add_command('mycred', __NAMESPACE__ . '\\WP_CLI_MyCRED');
