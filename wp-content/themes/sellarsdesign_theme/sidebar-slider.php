<div id="homeslider">
    
        <ul id="slider1">
            <?php $wp_query = new WP_Query(array('category_name'=>'featured','showposts'=>'10')); ?>
            <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
            <?php global $more; $more = 0; ?>
            <li>
                <?php if ( $video ) : ?>
                    <div class="feature_video"><?php echo $video; ?></div>
                <?php else: ?>
                    <a class="feature_img" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail( 'home-feature' ); ?></a>
                <?php endif; ?>
                <div class="bannercontent">
                    <?php the_excerpt(); ?>
                    <a class="read_more" href="<?php the_permalink() ?>" rel="bookmark">Read more</a>
                </div> 
            </li>
            <?php endwhile; ?>
            <?php else : // do not delete ?>
			<?php endif; // do not delete ?>
        </ul>
        
    </div>