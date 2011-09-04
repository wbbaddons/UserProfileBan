{if $user->banned == 0}
	<li><a href="javascript: void(0)" onclick="banTheUser('{$userID}');">{lang}wcf.user.profile.userprofileban{/lang}</a></li>
{else}
	<li><a href="index.php?action=UserProfileUnBan&amp;userID={$userID}&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}">{lang}wcf.user.profile.userprofileunban{/lang}</a></li>
{/if}

<script type="text/javascript">
	//<![CDATA[
		function banTheUser (id) {
			var userBanReason = prompt('{lang}wcf.user.profile.userprofilebanreason{/lang}');
			if (typeof(userBanReason) != 'object' && typeof(userBanReason) != 'undefined') {
				document.location.href = fixURL('index.php?action=UserProfileBan&userID='+id+'&banReason='+encodeURIComponent(userBanReason)+'&t='+SECURITY_TOKEN+SID_ARG_2ND);
			}
		}
	//]]>
</script>