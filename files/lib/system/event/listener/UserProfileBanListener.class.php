<?php
//wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * provides an option to ban a user in his profile
 * 
 * @author	Martin Schwendowius (Sani9000)
 * @copyright	2010 - 2011 wbbaddons.de
 * @license		Creative Commons Attribution-NoDerivs 3.0 Unported (CC BY-ND 3.0) <http://http://creativecommons.org/licenses/by-nd/3.0/deed.en>
 * @package	com.woltlab.community.profileban
 */
class UserProfileBanListener implements EventListener {
	protected $userID;

	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName){
		
		//get userID
		if (isset($_REQUEST['userID'])) $this->userID = intval($_REQUEST['userID']);
		
		//checks admin permission and aborts at own profile
		if (!WCF::getUser()->getPermission('admin.user.canBanUser') || WCF::getUser()->userID == $this->userID) return;
		
		//assign variable
		WCF::getTPL()->assign(array('userID' => $this->userID));
		
		//fetch template
		WCF::getTPL()->append(array('additionalAdminOptions' => WCF::getTPL()->fetch('userProfileBanContent')));
		
	}
}