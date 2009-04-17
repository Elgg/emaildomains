<?php
	/**
	 * Elgg email domains
	 * 
	 * @package ElggEmailDomains
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	admin_gatekeeper();
	action_gatekeeper();
	
	global $CONFIG;
	$emaildomains = sanitise_string(get_input('emaildomains'));
	$emaildomains_blocked = sanitise_string(get_input('emaildomains_blocked'));
	
	$site = $CONFIG->site;
	$site->emaildomains = $emaildomains;	
	$site->emaildomains_blocked = $emaildomains_blocked;
	
	system_message(elgg_echo('emaildomains:save:success'));
	
	forward($_SERVER['HTTP_REFERER']);
?>