<?php get_header();  global $my_date; ?>

	<div>
		<?php get_sidebar( 'slider' ); ?>
	</div> 


  	<div id="two-column">
    
       	<h5> <em>VOICES</em> Concerts</h5>
        
    	<div id="home-posts"><!-- pull from Category called Voices Concerts-->
      		<?php $voices_query = new WP_Query('category_name=voices_concerts&posts_per_page=4&order=ASC'); ?>
        	<?php while ($voices_query->have_posts()) : $voices_query->the_post(); ?>
            <strong><?php the_title(); ?></strong>
			<?php the_content(); ?>
            <br />
            <?php endwhile; ?>
    	</div> <!-- close home-posts -->	

	</div>	<!-- close two-columnm -->
 
 
	<div id="two-column">
    
       	<h5> Cantari Concerts</h5>
       
      	<div id="home-posts"><!-- pull from Category called Cantari Concerts-->
            <?php $cantari_query = new WP_Query('category_name=cantari_concerts&posts_per_page=4&order=asc'); ?>
        	<?php while ($cantari_query->have_posts()) : $cantari_query->the_post(); ?>
			<strong><?php the_title(); ?></strong>
			<?php the_content(); ?>
            <br />
            <?php endwhile; ?>
        </div>	<!-- close home-posts -->
        
  	</div> <!-- close two-column -->
    
  	<div id="last-column">
		<h5> Get Involved</h5><!-- pull from Category called Get Involved-->
       
    	<div id="home-posts">
            <?php $involved_query = new WP_Query('category_name=get_involved&posts_per_page=4'); ?>
        	<?php while ($involved_query->have_posts()) : $involved_query->the_post(); ?>
			<strong><?php the_title(); ?></strong>
			<?php the_content(); ?>
            <br />   
            <?php endwhile; ?>   
    	</div><!-- close home-posts -->
  
  	</div><!-- close last-column -->


<?php get_footer(); ?>