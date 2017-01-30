<?php

namespace MyCRED\Helpers;

use WP_CLI;

/**
 * Show message on console
 */
class Log {
	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public function line($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::line($msg);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public function log($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::log($msg);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public function success($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::success($msg);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public function warning($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::warning($msg);
		}
	}
}
