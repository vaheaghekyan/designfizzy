<?php
function EWD_UFAQ_Rewrite_Rules() { 
	global $wp_rewrite;

	$frontpage_id = get_option('page_on_front');
		
    add_rewrite_tag('%single_faq%','([^&]+)');
	add_rewrite_rule("single-faq/([^&]*)/?$", "index.php?page_id=". $frontpage_id . "&single_faq=\$matches[1]", 'top');
	add_rewrite_rule("(.?.+?)/single-faq/([^&]*)/?$", "index.php?pagename=\$matches[1]&single_faq=\$matches[2]", 'top');
	flush_rewrite_rules();
}

function EWD_UFAQ_add_query_vars_filter( $vars ){
	$vars[] = "single_faq";
	return $vars;
}


?>