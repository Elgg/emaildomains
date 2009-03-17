<?php
	/**
	 * Elgg emaildomains
	 * 
	 * @package ElggEmailDomains
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	admin_gatekeeper();
	set_context('admin');
	// Set admin user for user block
		set_page_owner($_SESSION['guid']);

	$title = elgg_view_title(elgg_echo('emaildomains:menu:edit'));	
	$body = elgg_view('emaildomains/forms/edit');
	page_draw(elgg_echo('emaildomains:menu:edit'),elgg_view_layout("two_column_left_sidebar", '', $title . $body));
?>