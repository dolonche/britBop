<?php
defined( '_JEXEC' ) or die;
function renderMessage( $msgList )
{
	// Build the return string
	$buffer = '';
	$buffer .= "\n<div id=\"system-message-container\">";
 
	// If messages exist render them
	if ( is_array( $msgList ) ) {
		$buffer .= "\n<div id=\"system-message\">";
		foreach ( $msgList as $type => $msgs ) {
			$buffer .= "\n<div class=\"alert alert-" . $type . "\">";
 
			// This requires JS so we should add it trough JS. Progressive enhancement and stuff.
			$buffer .= "<a class=\"close\" data-dismiss=\"alert\">&#215;</a>";
 
			if ( count( $msgs ) ) {
				$buffer .= "\n<h4 class=\"alert-heading\">" . JText::_( $type ). "</h4>";
				$buffer .= "\n<div>";
				foreach ( $msgs as $msg ) {
					$buffer .= "\n\t\t<p>" . $msg . "</p>";
				}
				$buffer .= "\n</div>";
			}
			$buffer .= "\n</div>";
		}
		$buffer .= "\n</div>";
	}
 
	$buffer .= "\n</div>";
 
	return $buffer;
}