<?php
/**
 * Page to output on DB error
 *
 * @package   HowToADHD/DB
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Prevent caching.
status_header( 500 ); // Error.
nocache_headers();    // No cache.

// Set content type & charset to be generic & friendly.
header( 'Content-Type: text/html; charset=utf-8' );

/** Start Editing */

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Database Error</title>
</head>
<body>
	<h1>Error establishing a database connection</h1>
</body>
</html>
<?php
// Prevent additional output.
die();
