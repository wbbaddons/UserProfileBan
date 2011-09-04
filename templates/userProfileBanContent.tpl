{if $user->banned == 0}
	<li><a href="index.php?action=UserProfileBan&amp;userID={$userID}&amp;banReason=&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}" id="userBan">{lang}wcf.user.profile.userprofileban{/lang}</a></li>
{else}
	<li><a href="index.php?action=UserProfileUnBan&amp;userID={$userID}&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}">{lang}wcf.user.profile.userprofileunban{/lang}</a></li>
{/if}

<script type="text/javascript">
	//<![CDATA[
		$('userBan').observe('click', function (e) {
			e.stop();
			var userBanReason = prompt('{lang}wcf.user.profile.userprofilebanreason{/lang}');
			if (typeof(userBanReason) != 'object' && typeof(userBanReason) != 'undefined') {
				document.location.href = fixURL('index.php?action=UserProfileBan&userID={$userID}&banReason='+encodeURIComponent(userBanReason)+'&t='+SECURITY_TOKEN+SID_ARG_2ND);
			}
			return false;
		});
	//]]>
</script>