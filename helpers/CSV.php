<?php

namespace MyCRED\Helpers;

use WP_CLI\Utils as WP_CLI_Utils;

/**
 * Manage csv content
 */
class CSV {
	/**
	 * @param $path
	 * @param $content
	 */
	public static function createFile($path, $data) {
		$file_resource = fopen($path, 'w');

		WP_CLI_Utils\write_csv($file_resource, $data, self::generateHeader($data));

		if (file_exists($path)) {
			return $path;
		}
		return false;
	}

	/**
	 * Get array keys for csv headers
	 * @param  array|object $data The array/object to parse
	 * @return array
	 */
	private static function generateHeader($data) {
		$headers = [];

		foreach ($data[0] as $key => $value) {
			$headers[] = $key;
		}

		return $headers;
	}
}
