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
	
	global $CONFIG;
	
	$emaildomains = $CONFIG->site->emaildomains;
	
	$box = elgg_view('input/text', array('value' => $emaildomains, 'internalname' => 'emaildomains'));
	$button = elgg_view('input/submit', array('value' => elgg_echo('save')));
	
	$form_body = <<< END
		
			$box $button
END;
	echo elgg_view('input/form', array('body' => $form_body, 'action' => $CONFIG->url . "action/emaildomains/edit"));
?>