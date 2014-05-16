<?php get_header(); ?>


<div id="left-column">

	<div id="sidemenu">
		<?php
		if(!$post->post_parent){
			// will display the subpages of this top level page
			$children = wp_list_pages("sort_column=menu_order,post_title&title_li=&child_of=".$post->ID."&echo=0&depth=1");
		}
		else{

			if($post->ancestors) {
				// now you can get the the top ID of this page
				// wp is putting the ids DESC, thats why the top level ID is the last one
				$ancestors = end($post->ancestors);
				$children = wp_list_pages("sort_column=menu_order,post_title&title_li=&child_of=".$ancestors."&echo=0&depth=1");
			}
		}

		if ($children) { ?>
			<ul class="menu">
				<?php echo $children; ?>
			</ul>
		<?php } ?>

	</div> <!-- close sidemenu -->
    
    <div id="sidewidget">
    
		<?php get_sidebar( 'text' ); ?>
    
    </div><!-- close sidewidget -->
    
</div> <!-- close left-column -->

<div id="content-area">

	<div id="breadcrumb">
    
    	<?php the_breadcrumb(); ?>
    
	</div><!-- close breadcrumb -->
    
    
	<?php while (have_posts()) : the_post(); ?>
			<?php if ( in_category( 'featured' )){ // do nothing if in category 'featured'
			 } else { ?>
            <h2><?php the_title(); ?></h2>
            <?php } ?>
            <?php the_content(); ?>
            <div style="clear:both;"></div>
            
   	<?php endwhile; ?>
	
    <div id="featured-image">

		<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  			the_post_thumbnail( 'category-thumbnail' );
			} 
		?>
	</div><!-- close featured-img -->

</div><!-- close content-area -->

<?php get_footer(); ?>