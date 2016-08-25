<form method="get" class="" action="<?php echo home_url( '/' ); ?>">
  	<div class="input-group">
    <input type="text" name="s" value="<?php echo esc_attr(get_search_query());?>" class="form-control" placeholder="<?php esc_html_e('Search here','dentistry');?>">
    <span class="input-group-btn">
    <button class="btn tp-btn-default" type="submit"><i class="fa fa-search"></i></button>
    </span> </div>
</form>
