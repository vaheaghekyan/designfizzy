<?php
/* The file contains all of the functions which make changes to the WordPress tables */


function EWD_UFAQ_UpdateOptions() {
	$Custom_CSS = $_POST['custom_css'];
	$FAQ_Accordion = $_POST['faq_accordion'];
	$Hide_Categories = $_POST['hide_categories'];
	$Hide_Tags = $_POST['hide_tags'];
	$Reveal_Effect = $_POST['reveal_effect'];
	$Group_By_Category = $_POST['group_by_category'];
	$Group_By_Order_By = $_POST['group_by_order_by'];
	$Group_By_Order = $_POST['group_by_order'];
	$Order_By_Setting = $_POST['order_by_setting'];
	$Order_Setting = $_POST['order_setting'];
	$Include_Permalink = $_POST['include_permalink'];
	$Pretty_Permalinks = $_POST['pretty_permalinks'];
	$Display_All_Answers = $_POST['display_all_answers'];
    $Social_Media_Array = $_POST['Socialmedia'];
    if (is_array($Social_Media_Array)) {$Social_Media = implode(",", $Social_Media_Array);}
	
	$Custom_CSS = stripslashes_deep($Custom_CSS);
	
	update_option('EWD_UFAQ_Custom_CSS', $Custom_CSS);
	update_option('EWD_UFAQ_FAQ_Accordion', $FAQ_Accordion);
	update_option('EWD_UFAQ_Hide_Categories', $Hide_Categories);
	update_option('EWD_UFAQ_Hide_Tags', $Hide_Tags);
	update_option('EWD_UFAQ_Reveal_Effect', $Reveal_Effect);
	update_option('EWD_UFAQ_Group_By_Category', $Group_By_Category);
	update_option('EWD_UFAQ_Group_By_Order_By', $Group_By_Order_By);
	update_option('EWD_UFAQ_Group_By_Order', $Group_By_Order);
	update_option('EWD_UFAQ_Order_By', $Order_By_Setting);
	update_option('EWD_UFAQ_Order', $Order_Setting);
	update_option('EWD_UFAQ_Include_Permalink', $Include_Permalink);
	update_option('EWD_UFAQ_Pretty_Permalinks', $Pretty_Permalinks);
	update_option('EWD_UFAQ_Display_All_Answers', $Display_All_Answers);
    update_option('EWD_UFAQ_Social_Media',  $Social_Media);

    if ($_POST['Pretty_Permalinks'] == "Yes") {
		 update_option("EWD_UFAQ_Rewrite_Rules", "Yes");
	}
}

?>