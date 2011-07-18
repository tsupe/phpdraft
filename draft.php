<?php

require_once("check_login.php");
require_once("models/draft_object.php");

DEFINE("ACTIVE_TAB", "CONTROL_PANEL");

DEFINE('DRAFT_ID', intval($_GET['did']));

$DRAFT = new draft_object();
$load_success = $DRAFT->loadById(DRAFT_ID);

if(!$load_success) {
	define("PAGE_HEADER", "Draft Not Found");
	define("PAGE_CONTENT", "<p class=\"error\">We're sorry, but the draft could not be loaded. Please try again.</p>");
	require_once("/views/generic_result_view.php");
}

switch($_GET['action']) {
	case '':
	default:
		// <editor-fold defaultstate="collapsed" desc="Main Draft Page Logic">
		//TODO: See if we should have a menu on the right side of this page... I think we should.
		require_once("models/manager_object.php");
		
		$MANAGERS = manager_object::getManagersByDraftId(DRAFT_ID, true);
		
		DEFINE('NUMBER_OF_MANAGERS', count($MANAGERS));
		DEFINE('HAS_MANAGERS', NUMBER_OF_MANAGERS > 0);
		DEFINE('LOWEST_ORDER', $MANAGERS[NUMBER_OF_MANAGERS - 1]->draft_order);
		
		require_once('/views/draft/index.php');
		// </editor-fold>
		break;
} ?>