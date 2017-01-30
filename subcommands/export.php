<?php

namespace MyCRED\Subcommands;

use WP_CLI;

/**
 * Manage export subcommand
 */
class Export extends WP_CLI_MyCRED {
}

// Add 'mycred export' command
WP_CLI::add_command('mycred export', __NAMESPACE__ . '\\Export');
