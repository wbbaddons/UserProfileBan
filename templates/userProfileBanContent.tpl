{if $user->banned == 0}
	<li><a href="#" onclick="banTheUser({$userID})">{lang}wcf.user.profile.userprofileban{/lang}</a></li>
{else}
	<li><a href="index.php?action=UserProfileUnBan&amp;userID={$userID}&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}">{lang}wcf.user.profile.userprofileunban{/lang}</a></li>
{/if}

<script type="text/javascript">
	//<![CDATA[
	var promptResult = prompt(language['wcf.user.profile.userprofilebanreason']);
	function banTheUser (id) {
		if (typeof(promptResult) != 'object' && typeof(promptResult) != 'undefined') {
			document.location.href = fixURL('index.php?action=UserProfileBan&&userID='+userID+'&reason='+encodeURIComponent(promptResult)+'&t='+SECURITY_TOKEN+SID_ARG_2ND);
		}
	}
	//]]>
</script>