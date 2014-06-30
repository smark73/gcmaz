<?php
if (is_page_template('template-splash.php')){
    dynamic_sidebar('sidebar-splash');
}elseif($post->post_title == 'Home'){
    dynamic_sidebar('sidebar-homepage');
} elseif($post->post_type == 'concert'){
    dynamic_sidebar('sidebar-concert');
} elseif($post->post_type == 'whats-happening'){
    dynamic_sidebar('sidebar-whats');
} elseif($post->post_type == 'community-info'){
    dynamic_sidebar('sidebar-community');
} elseif($post->post_title == 'On Air Shows'){
    dynamic_sidebar('sidebar-onair');
} elseif($post->post_title == 'Area Weather'){
    dynamic_sidebar('sidebar-weather');
} else {
    dynamic_sidebar('sidebar-primary');
}
?>