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
	
	global $CONFIG;
	
	$emaildomains = $CONFIG->site->emaildomains;
	$emaildomains_blocked = $CONFIG->site->emaildomains_blocked;
	
	echo "<div class=\"contentWrapper\">";
	echo elgg_view('output/longtext', array('value' => elgg_echo('emaildomains:description')));
	
	$b1desc = elgg_echo('emaildomains:allow');
	$b2desc = elgg_echo('emaildomains:deny');
	
	$box = elgg_view('input/text', array('value' => $emaildomains, 'internalname' => 'emaildomains'));
	$box2 = elgg_view('input/text', array('value' => $emaildomains_blocked, 'internalname' => 'emaildomains_blocked'));
	$button = elgg_view('input/submit', array('value' => elgg_echo('save')));
	
	$form_body = <<< END
		
			<p><b>$b1desc</b> $box</p> <p><b>$b2desc</b>$box2</p> $button
END;
	echo elgg_view('input/form', array('body' => $form_body, 'action' => $CONFIG->url . "action/emaildomains/edit"));
	echo "</div>";
	
?>