<?php
/**
 * Loads the MU plugins required to run the platform and add to the admin page
 *
 * @package HowToADHD\Platform
 *
 * Plugin Name: Platform Loader
 * Description: Loads the MU plugins required by the platform
 */

namespace HowToADHD\Platform;

$mu_plugins = [
	's3-uploads/s3-uploads.php',
	'aws-ses-wp-mail/aws-ses-wp-mail.php',
	'cavalcade/plugin.php',
	'aws-config.php',
];

foreach ( $mu_plugins as $file ) {
	require_once PLATFORM_DIR . '/' . $file;
}
unset( $file );

add_action(
	'pre_current_active_plugins', function () use ( $mu_plugins ) {
		global $plugins, $wp_list_table;

		// Add our own mu-plugins to the page.
		foreach ( $mu_plugins as $plugin_file ) {
			$plugin_data = get_plugin_data( PLATFORM_DIR . "/$plugin_file", false, false ); // Do not apply markup/translate as it'll be cached.

			if ( empty( $plugin_data['Name'] ) ) {
				$plugin_data['Name'] = $plugin_file;
			}

			$plugins['mustuse'][ $plugin_file ] = $plugin_data;  // WPCS: override ok.
		}

		// Recount totals.
		$GLOBALS['totals']['mustuse'] = count( $plugins['mustuse'] );  // WPCS: override ok.

		// Only apply the rest if we're actually looking at the page.
		if ( 'mustuse' !== $GLOBALS['status'] ) {
			return;
		}

		// Reset the list table's data.
		$wp_list_table->items = $plugins['mustuse'];
		foreach ( $wp_list_table->items as $plugin_file => $plugin_data ) {
			$wp_list_table->items[ $plugin_file ] = _get_plugin_data_markup_translate( $plugin_file, $plugin_data, false, true );
		}

		$total_this_page = $GLOBALS['totals']['mustuse'];

		if ( $GLOBALS['orderby'] ) {
			uasort( $wp_list_table->items, [ $wp_list_table, '_order_callback' ] );
		}

		// Force showing all plugins.
		$plugins_per_page = $total_this_page;

		$wp_list_table->set_pagination_args(
			[
				'total_items' => $total_this_page,
				'per_page'    => $plugins_per_page,
			]
		);
	}
);

add_filter(
	'plugin_action_links', function ( $actions, $plugin_file, $plugin_data, $context ) use ( $mu_plugins ) {
		if ( 'mustuse' !== $context || ! in_array( $plugin_file, $mu_plugins, true ) ) {
			return $actions;
		}

		$actions[] = sprintf( '<span style="color:#333">File: <code>../platform/%s</code></span>', $plugin_file );
		return $actions;
	}, 10, 4
);
