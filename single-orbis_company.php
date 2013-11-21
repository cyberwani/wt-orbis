<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="page-header">
			<h1>
				<?php the_title(); ?>

				<small><?php _e( 'Company Details', 'orbis' ); ?></small>
			</h1>
		</div>

		<div class="row">
			<div class="span8">
				<?php do_action( 'orbis_before_main_content' ); ?>

				<div class="panel">
					<header>
						<h3><?php _e( 'Description', 'orbis' ); ?></h3>
					</header>

					<div class="content">
						<?php the_content(); ?>
					</div>
				</div>

				<?php do_action( 'orbis_after_main_content' ); ?>

				<?php comments_template( '', true ); ?>
			</div>

			<div class="span4">
				<?php do_action( 'orbis_before_side_content' ); ?>
				
				<?php if ( function_exists( 'p2p_register_connection_type' ) ) : ?>
				
					<div class="panel">
						<header>
							<h3><?php _e(' Connected persons', 'orbis' ); ?></h3>
						</header>

						<?php

						$connected = new WP_Query( array(
						  'connected_type'  => 'persons_to_companies',
						  'connected_items' => get_queried_object(),
						  'nopaging'        => true
						) );

						if ( $connected->have_posts() ) : ?>

							<ul class="list">
								<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>

									<li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</li>

								<?php endwhile; ?>
							</ul>

						<?php wp_reset_postdata(); else : ?>

							<div class="content">
								<p class="alt">
									<?php _e( 'No persons connected.', 'orbis' ); ?>
								</p>
							</div>
					
						<?php endif; ?>
					</div>
				
				<?php endif; ?>
				
				<div class="panel">
					<header>
						<h3><?php _e( 'Additional Information', 'orbis' ); ?></h3>
					</header>

					<div class="content">
						<dl>
							<dt><?php _e( 'Posted on', 'orbis' ); ?></dt>
							<dd><?php echo get_the_date(); ?></dd>

							<dt><?php _e( 'Posted by', 'orbis' ); ?></dt>
							<dd><?php echo get_the_author(); ?></dd>

							<dt><?php _e( 'Actions', 'orbis' ); ?></dt>
							<dd><?php edit_post_link( __( 'Edit', 'orbis' ) ); ?></dd>
						</dl>
					</div>
				</div>

				<?php do_action( 'orbis_after_side_content' ); ?>
			</div>
		</div>
	</div>

<?php endwhile; ?>

<?php get_footer();