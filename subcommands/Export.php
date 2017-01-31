<?php

namespace MyCRED\Subcommands;

use MyCRED\Commands\WP_CLI_MyCRED as WP_CLI_MyCRED;
use MyCRED\Helpers\CSV as CSV;
use MyCRED\Helpers\Directory as Directory;
use myCRED_Query_Log;
use WP_CLI;

/**
 * Manage export subcommand
 */
class Export extends WP_CLI_MyCRED {
	/**
	 * @var string Datas to include in export - default from _invoke phpdoc
	 */
	protected static $fields = null;

	/**
	 * @var string The CSV file name - default from _invoke phpdoc
	 */
	protected static $filename = null;

	/**
	 * @var string Number of results to show - default from _invoke phpdoc
	 */
	protected static $number = null;

	/**
	 * @var string Type of order - default from _invoke phpdoc
	 */
	protected static $order = null;

	/**
	 * @var string Sort field - default from _invoke phpdoc
	 */
	protected static $order_by = null;

	/**
	 * @var string The user_id to filter - default from _invoke phpdoc
	 */
	protected static $user_id = null;

	/**
	 * Export myCRED log points in a CSV file inside WP_UPLOAD_DIR/mycred
	 *
	 * ## OPTIONS
	 *
	 * <output-file>
	 * : The CSV file name
	 *
	 * [--user_id=<user_id>]
	 * : The user_id to filter
	 * ---
	 * default: NULL
	 * ---
	 *
	 * [--number=<number>]
	 * : Number of results to show
	 * ---
	 * default: -1
	 * ---
	 *
	 * [--order_by=<order_by>]
	 * : Sort field
	 * see docs here http://codex.mycred.me/classes/mycred_query_log/
	 * ---
	 * default: time
	 * options:
	 *   - id
	 *   - ref
	 *   - ref_id
	 *   - user_id
	 *   - creds
	 *   - ctype
	 *   - time
	 *   - entry
	 *   - data
	 * ---
	 *
	 * [--order=<order>]
	 * : Type of order
	 * ---
	 * default: DESC
	 * options:
	 *   - ASC
	 *   - DESC
	 * ---
	 *
	 * [--fields=<fields>]
	 * : Datas to include in export
	 * see docs here http://codex.mycred.me/classes/mycred_query_log/
	 * ---
	 * default: NULL
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp mycred export points_log --user_id=1 --number=10 --order_by=ref --order=ASC
	 *     wp mycred export points_log --fields=ctype,entry,data
	 *
	 * @when after_wp_load
	 *
	 * @param array $args       The args
	 * @param array $assoc_args The associated args
	 */
	public function __invoke($args, $assoc_args) {
		self::processArgs([], $args, [], $assoc_args);

		$myCREDDir = Directory::create('mycred');
		if ($myCREDDir) {
			$myCREDLogResults = self::myCREDLogResults($args);
			if ($myCREDLogResults) {
				$logs     = self::logsToExport($myCREDLogResults, $this->fields);
				$filePath = $myCREDDir . '/' . $this->filename . '.csv';

				$csvFile = CSV::createFile($filePath, $logs);
				if ($csvFile) {
					$this->state   = 'success';
					$this->message = 'myCRED log exported in ' . $csvFile;
				} else {
					$this->state   = 'error';
					$this->message = 'myCRED log file not created';
				}
			} else {
				$this->state   = 'warning';
				$this->message = 'There\'re no Point Logs to export';
			}
		} else {
			$this->state   = 'error';
			$this->message = 'myCRED uploads directory not created';
		}

		$this->logState();
	}

	/**
	 * Process export command args and run parent function
	 * @return void
	 */
	protected function processArgs($default_args = [], $args = [], $default_assoc_args = [], $assoc_args = []) {
		$assoc_args['fields'] .= ',id';
		$assoc_args['fields'] = explode(',', $assoc_args['fields']);

		$this->filename = $args[0];

		parent::processArgs($default_args, $args, $default_assoc_args, $assoc_args);
	}

	/**
	 * Manage logs with provided options
	 * @param  array   $myCREDLogs Provided logs
	 * @return array
	 */
	private static function logsToExport($myCREDLogs, $fields) {
		foreach ($myCREDLogs as $index => $log) {
			$log->time          = self::manageLogConvertTime($log->time);
			$myCREDLogs[$index] = self::manageLogUnsetData($log, $fields);
		}

		return $myCREDLogs;
	}

	/**
	 * Convert provided time in TZ date
	 * @param  string   $time The time to convert
	 * @return string
	 */
	private static function manageLogConvertTime($time) {
		return gmdate('Y-m-d\TH:i:s\Z', $time);
	}

	/**
	 * Filter properties from data
	 * @param  array|object $data   The data to check and unset
	 * @param  array        $fields Property to not unset
	 * @return array
	 */
	private static function manageLogUnsetData($data, $fields) {
		if (!empty($fields[0])) {
			foreach ($data as $property => $value) {
				if (!in_array($property, $fields, true)) {
					unset($data->{$property});
				}
			}
		}

		return (array) $data;
	}

	/**
	 * Set mycred query logs
	 * @param  array   $args Args to provide to query
	 * @return array
	 */
	private static function myCREDLogResults($args) {
		$myCREDQueryLog = new myCRED_Query_Log($args);

		$results = $myCREDQueryLog->results;
		if (empty($results)) {
			return false;
		}
		return $results;
	}
}

// Add 'mycred export' command
WP_CLI::add_command(WP_CLI_MYCRED_COMMAND . ' export', __NAMESPACE__ . '\\Export');
