<?php
//输出普通信息
function log_info($s) {
	log_message("info", "【提示信息】" . $s);
}

function log_error($s) {
	log_message("error", "【错误信息】" . $s);
}

function log_json($s) {
	log_message("error", "【错误信息】" . json_encode($s));
}
?>