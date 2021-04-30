<?php 

date_default_timezone_set("Asia/Makassar");

function hasMessage($message = ''){
	if (!empty($message)) {
		echo '<article class="message is-warning"
			<div class="message-body">
			'.$message.'
			</div>
		</article>
		';
	}
}

function old($var,$val = ''){
	return $_POST[$var] ?? $val;
}


?>