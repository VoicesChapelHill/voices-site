<?php if ( is_sidebar_active('primary_widget_area') ) : ?>
        <div class="widget-area">
                <?php dynamic_sidebar('primary_widget_area'); ?>
        </div><!-- #primary .widget-area -->
<?php endif; ?>       
 
<?php if ( is_sidebar_active('secondary_widget_area') ) : ?>
        <div class="widget-area">
                <?php dynamic_sidebar('secondary_widget_area'); ?>
        </div><!-- #secondary .widget-area -->
<?php endif; ?>