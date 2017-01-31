<?php

namespace MyCRED\Helpers;

/**
 * Manage directory
 */
class Directory {
	/**
	 * Create the basedir rirectory
	 * @return boolean Return true if is created
	 */
	public static function create($path) {
		$fullPath = wp_upload_dir()['basedir'] . '/' . $path;
		if (wp_mkdir_p($fullPath)) {
			return $fullPath;
		}
		return false;
	}
}
