<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractSecureAction.class.php');
require_once(WCF_DIR.'lib/data/user/group/Group.class.php');
require_once(WCF_DIR.'lib/system/session/Session.class.php');

/**
 * Bans the User 
 * 
 * @author		Martin Schwendowius (Sani9000)
 * @copyright	2010 - 2011 wbbaddons.de
 * @license		Creative Commons Attribution-NoDerivs 3.0 Unported (CC BY-ND 3.0) <http://http://creativecommons.org/licenses/by-nd/3.0/deed.en>
 * @package		com.woltlab.community.profileban
 */
class UserProfileBanAction extends AbstractSecureAction {
	protected $userID;
	protected $banReason;
	
	/**
	 * @see AbstractSecureAction::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		//get user data
		if (isset($_REQUEST['userID']) && isset($_REQUEST['banReason'])) { 
			$this->userID = intval($_REQUEST['userID']);
			$this->banReason = escapeString($_REQUEST['banReason']));
		} else {
			throw new IllegalLinkException();
		}
		
		//check admin permission and protect the admin not to ban himself from the system
		if (!WCF::getUser()->getPermission('admin.user.canBanUser') || WCF::getUser()->userID == $this->userID) {
			throw new PermissionDeniedException();
		}
		
	}
	
	/**
	 * @see AbstractAction::execute()
	 */
	public function execute() {
		parent::execute();
		
		// check accessible group permissions
		$sql = "SELECT	DISTINCT groupID
				FROM	wcf".WCF_N."_user_to_groups
				WHERE	userID = ".$this->userID;
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			if (!Group::isAccessibleGroup($row['groupID'])) {
				throw new PermissionDeniedException();
			}
		}
		
		// ban user
		$sql = "UPDATE	wcf".WCF_N."_user
				SET	banned = 1,
				banReason = '".$this->banReason."'
				WHERE	userID = ".$this->userID;
		WCF::getDB()->sendQuery($sql);
		
		// reset session of the banned user
		Session::resetSessions($this->userID);

		$this->executed();
		
		// redirect to user page
		HeaderUtil::redirect('index.php?page=User&userID='.$this->userID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}