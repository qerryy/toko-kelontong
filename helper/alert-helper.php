<?php

function setAlert($message, $url) {
	return "
		<script>
				alert('". $message ."');
				document.location.href = '". $url ."';
		</script>
	";
}