<?php
date_default_timezone_set("Asia/Taipei");

return [
	'today'=> date("Y-m-d"),
	'today_m'=> date("Y-m-d H:i:s"),
    /**
     * Avatar
     */
    'default_avatar'    => '/AdminLTE-2.3.7/dist/img/avatar-default.png',
    'avatar_max_size'   => 10 * 1024, // kb
    'avatar_mime_limit' => 'mimes:jpeg,jpg,png',
];
