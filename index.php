<?php get_header(); ?>

<?php if (have_posts()) : ?>
  
	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if( is_single() ) { ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
	<?php } else { 
		// post thumbnail if it exist
		if ( has_post_thumbnail() && is_sticky() ) {
			the_post_thumbnail('sticky-thumb');
		}?>
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php } ?>
		<div class="post-text">
		<?php
		// when browsing category, search, etc
		if ( is_home() || is_archive() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() ) { 
			// GH the_excerpt();
                        the_content(__('Read the full post','comet').' &raquo;');
			wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
		// everything else, including single posts
		} else { 
			the_content(__('Read the full post','comet').' &raquo;');
			wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
		} ?>
		</div>
		<div class="post-meta">
			<div class="row">
				<?php if ( comments_open() ) { ?>
					<div class="alignright"><?php comments_popup_link(__('No Comments','comet'),__('1 Comment','comet'),__('% Comments','comet')); ?></div>
				<?php } ?>
				<span class="post-author">by <?php the_author() ?> on </span><em><?php the_time('F j, Y') ?></em>
				&nbsp;&bull;&nbsp; <a href="<?php the_permalink() ?>" rel="bookmark">Permalink</a>
				<?php edit_post_link(__('Edit Post','comet'), ' &nbsp;&bull;&nbsp; ', ''); ?>
			</div>
			<div class="row"><?php _e('Posted in','comet'); ?> <?php the_category(', ') ?></div>
			<div class="row"><?php the_tags(__('Tagged ','comet').' ', ', ', '');?></div>
		</div>
		<div class="print-view"
			<p><em>Posted by <?php the_author() ?> on <?php the_time('F j, Y') ?></em></p>
			<p><?php the_permalink(); ?></p>
		</div>
	</div>
	<!--/post -->

	<?php if (is_single()) { ?>
	<div class="post post-nav">
		<?php previous_post_link('<div class="alignleft"><i>'.__('Previous Post','comet').'</i><br />%link</div>'); ?>
		<?php next_post_link('<div class="alignright"><i>'.__('Next Post','comet').'</i><br />%link</div>'); ?>
	</div>
	<?php } ?>
	
	<div class="sep"></div>

	<?php comments_template(); ?>
		
	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; '.__('Older Posts','comet')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Posts','comet').' &raquo;') ?></div>
	</div>

	<?php else : ?>

	<div class="post">
		<h1 class="post-title"><?php _e('Post not found','comet'); ?></h1>
		<div class="post-text">
			<p><?php _e('The post you were looking for could not be found.','comet'); ?></p>
		</div>
	</div>
		
<?php endif; ?>

<?php get_footer(); ?>
