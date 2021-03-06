<?php
/**
 * Elgg email domains
 * 
 * @package ElggEmailDomains
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Curverider Ltd
 * @copyright Curverider Ltd 2008-2010
 * @link http://elgg.com/
 */

/**
 * Initialise the emaildomains tool
 *
 */
function emaildomains_init(){
	global $CONFIG;
	
	// Register a page handler, so we can have nice URLs
	register_page_handler('emaildomains','emaildomains_page_handler');
	
	// Register some actions
	register_action("emaildomains/edit",false, $CONFIG->pluginspath . "emaildomains/actions/edit.php");
	
	// Register a hook to validate email for new users
	register_plugin_hook('registeruser:validate:email', 'all', 'emaildomains_validate_email', 999);
	
	elgg_add_admin_submenu_item('emaildomains', elgg_echo('emaildomains:menu:edit'), 'users');
}


/**
 * Validate email address against email domains.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function emaildomains_validate_email($hook, $entity_type, $returnvalue, $params){
	global $CONFIG;
	
	$site = $CONFIG->site;
	$email = $params['email'];
	
	if (($site) && (($site->emaildomains) || ($site->emaildomains_blocked))){
		// Check whether an address is banned
		if ($site->emaildomains_blocked) {
			
			$domains_blocked = explode(',', $site->emaildomains_blocked);
			
			foreach ($domains_blocked as $domain){
				$domain = trim($domain);
				
				if (stripos($email, $domain)!== false)
					return false;
			}
		}
		
		// Check whether an address is permitted
		if ($site->emaildomains) {
			
			$domains = explode(',', $site->emaildomains);
			
			foreach ($domains as $domain){
				$domain = trim($domain);
				
				if (stripos($email, $domain)!== false)
					return true;
			}
		}
		
		// We got here so we need to check the logic
			// If no emaildomains have been provided, then we actually want to return true - since we want to allow for
			// allow from all except denied domains
		if (strcmp(trim($site->emaildomains),"")==0)
			return true;
		
		
		return false;
	}
}

/**
 * Email domains page.
 *
 * @param array $page Array of page elements, forwarded by the page handling mechanism
 */
function emaildomains_page_handler($page) {
	global $CONFIG;
	
	// only interested in one page for now
	include($CONFIG->pluginspath . "emaildomains/index.php"); 
}

// Initialise log browser
register_elgg_event_handler('init','system','emaildomains_init');
register_elgg_event_handler('pagesetup','system','emaildomains_pagesetup');
?>