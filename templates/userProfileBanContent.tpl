{if $user->banned == 0}
	<li><a href="index.php?action=UserProfileBan&amp;userID={@$userID}&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}">{lang}wcf.user.profile.userprofileban{/lang}</a></li>
{else}
	<li><a href="index.php?action=UserProfileUnBan&amp;userID={@$userID}&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}">{lang}wcf.user.profile.userprofileunban{/lang}</a></li>
{/if}