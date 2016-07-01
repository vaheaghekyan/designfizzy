<?php
/* The function that creates the HTML on the front-end, based on the parameters
* supplied in the product-catalog shortcode */
function Display_Select_FAQs($atts) {
	$Custom_CSS = get_option("EWD_UFAQ_Custom_CSS");
	$FAQ_Accordion = get_option("EWD_UFAQ_FAQ_Accordion");
	$Reveal_Effect = get_option("EWD_UFAQ_Reveal_Effect");
	$Display_All_Answers = get_option("EWD_UFAQ_Display_All_Answers");

	$Include_Permalink = get_option("EWD_UFAQ_Include_Permalink");

	$ReturnString = "";

	// Get the attributes passed by the shortcode, and store them in new variables for processing
	extract( shortcode_atts( array(
									'faq_name' => "",
									'faq_slug' => "",
									'faq_id' => ""),
									$atts
		)
	);

	$name_array = explode(",", $faq_name);
	$slug_array = explode(",", $faq_slug);
	$id_array = explode(",", $faq_id);

	foreach ($name_array as $post_name) {
		$single_post = get_page_by_title($post_name, "OBJECT", "ufaq");
		$post_id_array[] = $single_post->ID;
	}

	foreach ($slug_array as $post_slug) {
		$single_post = get_page_by_path($post_slug, "OBJECT", "ufaq");
		$post_id_array[] = $single_post->ID;
	}

	foreach ($id_array as $post_id) {
		$post_id_array[] = $post_id;
	}

	$params = array(
					'posts_per_page' => -1,
					'post_type' => 'ufaq',
					'include' => $post_id_array
				);
	$faqs = get_posts($params);

	if ($Custom_CSS != "") {$ReturnString .= "<style>" . $Custom_CSS . "</style>";}

	$ReturnString .= "<script language='JavaScript' type='text/javascript'>";
	if ($FAQ_Accordion == "Yes") {$ReturnString .= "var faq_accordion = true;";}
	else {$ReturnString .= "var faq_accordion = false;";}
	$ReturnString .= "var reveal_effect = '" . $Reveal_Effect . "';";
	$ReturnString .= "</script>";

	$ReturnString .= "<div class='ufaq-faq-list' id='ufaq-faq-list'>";
	foreach ($faqs as $faq) {
		$Category_Terms = wp_get_post_terms($faq->ID, 'ufaq-category');
		$Tag_Terms = wp_get_post_terms($faq->ID, 'ufaq-tag');

		$ReturnString .= "<div class='ufaq-faq-div'>";

		$ReturnString .= "<div class='ufaq-faq-title' id='ufaq-title-" . $faq->ID . "' data-postid='" . $faq->ID . "'>";
		$ReturnString .= "<h4 ><a class='ewd-ufaq-post-margin-symbol'  href='" . get_permalink($faq->ID) . "'>+ </a><a class='ewd-ufaq-post-margin'  href='" . get_permalink($faq->ID) . "'>" .$faq->post_title . " </a></h4>";
		$ReturnString .= "</div>";

		if (strlen($faq->post_excerpt) > 0) {$ReturnString .= "<div class='ufaq-faq-excerpt' id='ufaq-excerpt-" . $faq->ID . "'>" . $faq->post_excerpt . "</div>";}
		$ReturnString .= "<div class='ufaq-faq-body ";
		if ($Display_All_Answers != "Yes") {$ReturnString .= "ewd-ufaq-hidden";}
		$ReturnString .= "' id='ufaq-body-" . $faq->ID . "'>";
		$ReturnString .= "<div class='ufaq-faq-post' id='ufaq-post-" . $faq->ID . "'>" . $faq->post_content . "</div>";

		if ($Hide_Categories == "No") {
			$ReturnString .= "<div class='ufaq-faq-categories' id='ufaq-categories-" . $faq->ID . "'>";
			if (sizeOf($Category_Terms) > 1) {$ReturnString .= "Categories: ";}
			else {$ReturnString .= "Category: ";}
			foreach ($Category_Terms as $Category_Term) {$ReturnString .= "<a  href='" . $current_url . "?include_category=" . $Category_Term->slug . "'>" .$Category_Term->name . "</a>, ";}
			if (sizeOf($Category_Terms) > 0) {$ReturnString = substr($ReturnString, 0, strlen($ReturnString)-2);}
			$ReturnString .= "</div>";
		}

		if ($Hide_Tags == "No") {
			$ReturnString .= "<div class='ufaq-faq-tags' id='ufaq-tags-" . $faq->ID . "'>";
			if (sizeOf($Tag_Terms) > 1) {$ReturnString .= "Tags: ";}
			else {$ReturnString .= "Tag: ";}
			foreach ($Tag_Terms as $Tag_Term) {$ReturnString .= "<a  href='" . $current_url . "?include_tag=" . $Tag_Term->slug . "'>" .$Tag_Term->name . "</a>, ";}
			if (sizeOf($Tag_Terms) > 0) {$ReturnString = substr($ReturnString, 0, strlen($ReturnString)-2);}
			$ReturnString .= "</div>";
		}

		if ($Socialmedia[0] != "") {
			$ReturnString .= "<div class='ufaq-social-links'>Share: ";
			$ReturnString .= "<ul class='rrssb-buttons'>";
		}
		if(in_array("Facebook", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Facebook", $FAQ_Permalink, $faq->post_title);}
		if(in_array("Google", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Google", $FAQ_Permalink, $faq->post_title);}
		if(in_array("Twitter", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Twitter", $FAQ_Permalink, $faq->post_title);}
		if(in_array("Linkedin", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Linkedin", $FAQ_Permalink, $faq->post_title);}
		if(in_array("Pinterest", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Pinterest", $FAQ_Permalink, $faq->post_title);}
		if(in_array("Email", $Socialmedia)) {$ReturnString .= EWD_UFAQ_Add_Social_Media_Buttons("Email", $FAQ_Permalink, $faq->post_title);}
		if ($Socialmedia[0] != "") {
			$ReturnString .= "</ul>";
			$ReturnString .= "</div>";
		}

		if ($Include_Permalink == "Yes" and $ajax == "No") {
			$ReturnString .= "<div class='ufaq-permalink'>Permalink: ";
			$ReturnString .= "<a href='" . $FAQ_Permalink . "'>";
			$ReturnString .= "<div class='ufaq-permalink-image'></div>";
			$ReturnString .= "</a>";
			$ReturnString .= "</div>";
		}

		$ReturnString .= "</div>";
		$ReturnString .= "</div>";
	}
	$ReturnString .= "</div>";

	return $ReturnString;
}
add_shortcode("select-faq", "Display_Select_FAQs");