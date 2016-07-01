<?php
/* The function that creates the HTML on the front-end, based on the parameters
* supplied in the product-catalog shortcode */
function Display_Popular_FAQs($atts) {
    extract( shortcode_atts( array(
                'post_count'=>5),
            $atts
        )
    );
    echo "called";
    $ReturnString = do_shortcode("[ultimate-faqs post_count=".$post_count." orderby='popular']");

		return $ReturnString;
}
add_shortcode("popular-faqs", "Display_Popular_FAQs");
