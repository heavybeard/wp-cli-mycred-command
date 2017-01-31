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
	public static function debug($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::debug($message);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public static function error($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::error($message);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public static function line($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::line($message);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public static function log($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::log($message);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public static function success($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::success($message);
		}
	}

	/**
	 * @param string  $message The message to show
	 * @param boolean $verbose Set true to enable echos
	 */
	public static function warning($message, $verbose = true) {
		if ($verbose) {
			WP_CLI::warning($message);
		}
	}
}
