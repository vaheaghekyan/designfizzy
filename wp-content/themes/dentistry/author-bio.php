<?php
/*
 * The template for displaying Author bios
 *
 * @package dentistry
 */
?>  
<div class="col-md-12">  
    <div class="post-author">
        <div class="row">
            <div class="col-md-4">
            	<div class="author-pic"><?php echo get_avatar(get_the_author_meta('ID'),256); ?></div>
            </div>
            <div class="col-md-8">
                <div class="author-bio">
                  <div class="author-name">
                    <h2><?php echo get_the_author_meta('display_name');?></h2>
                    <small><?php esc_html_e( 'Author', 'dentistry' ); ?></small>
                 </div>
                 <?php
                    $author_content = get_the_author_meta('description');
                    if(!empty($author_content))
                    {
                        echo '<p>'.esc_html($author_content).'</p>'; 
                    }
                    if(!get_the_author_meta('description')) 
                    esc_html_e('No description.Please update your profile.','dentistry'); 
                 ?>     
              <p><?php esc_html_e( 'View all post by ', 'dentistry' ); ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><span><?php echo get_the_author_meta('display_name'); ?></span></a></p>
              </div>
            </div>
        </div>
    </div>
</div>