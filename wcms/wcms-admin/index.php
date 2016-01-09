<?php 

ob_start();


$action = strip_tags(filter_input(INPUT_GET,'action'));

include('../bootstrap.php');

include(WCMS_ADMIN_DIR . '/pages/login/check_login.php');



include(WCMS_ADMIN_DIR . '/pages/header.php');



	switch ($action) {
		case 'posts':
			include( WCMS_ADMIN_DIR . '/pages/post/post.php');
			break;
		
		default:
			include( WCMS_ADMIN_DIR . '/pages/index/index.php');
			break;
	}


include(WCMS_ADMIN_DIR . '/pages/footer.php');


ob_end_flush();