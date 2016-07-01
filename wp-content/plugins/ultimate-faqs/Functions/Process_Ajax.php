<?php
/* Processes the ajax requests being put out in the admin area and the front-end
*  of the UPCP plugin */

// Returns the FAQs that are found for a specific search
function UFAQ_Search() {
    $Path = ABSPATH . 'wp-load.php';
    include_once($Path);

    echo do_shortcode("[ultimate-faqs search_string='" . strtolower($_POST['Q']) . "' include_category='" . $_POST['include_category'] . "' exclude_category='" . $_POST['exclude_category'] . "' orderby='" . $_POST['orderby'] . "' order='" . $_POST['order'] . "' post_count='" . $_POST['post_count'] . "' ajax='Yes']") ;
}
add_action('wp_ajax_ufaq_search', 'UFAQ_Search');
add_action( 'wp_ajax_nopriv_ufaq_search', 'UFAQ_Search');

// Records the number of time an FAQ post is opened
function UFAQ_Record_View() {
    $Path = ABSPATH . 'wp-load.php';
    include_once($Path);

    global $wpdb;
    $wpdb->show_errors();
    $post_id = $_POST['post_id'];
    $Meta_ID = $wpdb->get_var($wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id=%d AND meta_key='ufaq_view_count'", $post_id));
    if ($Meta_ID != "" and $Meta_ID != 0) {$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=meta_value+1 WHERE post_id=%d AND meta_key='ufaq_view_count'", $post_id));}
    else {$wpdb->query($wpdb->prepare("INSERT INTO $wpdb->postmeta (post_id,meta_key,meta_value) VALUES (%d,'ufaq_view_count','1')", $post_id));}

}
add_action('wp_ajax_ufaq_record_view', 'UFAQ_Record_View');
add_action( 'wp_ajax_nopriv_ufaq_record_view', 'UFAQ_Record_View');