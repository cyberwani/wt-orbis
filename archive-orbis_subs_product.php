<?php get_header(); ?>

<div class="page-header clearfix">
	<h1 class="pull-left">
		<?php post_type_archive_title(); ?>

		<small>
			<?php
			
			printf( __( 'Overview of %1$s', 'orbis' ),
				strtolower( post_type_archive_title( '', false ) )
			);
		
			?>
		</small>
	</h1>

	<a class="btn btn-primary pull-right" href="<?php echo orbis_get_url_post_new(); ?>">
		<span class="glyphicon glyphicon-plus"></span> <?php _e( 'Add subscription product', 'orbis' ); ?>
	</a>
</div>

<div class="panel">
	<header>
		<h3><?php _e( 'Overview', 'orbis' ); ?></h3>
	</header>

	<?php get_template_part( 'templates/search_form' ); ?>
	
	<?php if ( have_posts() ) : ?>
	
		<table class="table table-striped table-bordered table-condense table-hover">
			<thead>
				<tr>
					<th><?php _e( 'Title', 'orbis' ); ?></th>
					<th><?php _e( 'Price', 'orbis' ); ?></th>
					<th><?php _e( 'Cost Price', 'orbis' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php while ( have_posts() ) : the_post(); ?>
	
					<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<td>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

							<?php if ( get_comments_number() != 0  ) : ?>
							
								<div class="comments-number">
									<span class="glyphicon glyphicon-comment"></span>
									<?php comments_number( '0', '1', '%' ); ?>
								</div>
							
							<?php endif; ?>
						</td>
						<td>
							<?php 
							
							$price = get_post_meta( get_the_ID(), '_orbis_subscription_product_price', true );
							
							if ( empty( $price ) ) {
								echo '&mdash;';
							} else {
								echo orbis_price( $price );
							}

							?>
						</td>
						<td>
							<div class="actions">
								<?php 
							
								$price = get_post_meta( get_the_ID(), '_orbis_subscription_product_cost_price', true );
							
								if ( empty( $price ) ) {
									echo '&mdash;';
								} else {
									echo orbis_price( $price );
								}
							
								?>
							
								<div class="nubbin">
									<?php orbis_edit_post_link(); ?>
								</div>
							</div>
						</td>
					</tr>
	
				<?php endwhile; ?>
			</tbody>
		</table>

	<?php else : ?>

		<div class="content">
			<p class="alt">
				<?php _e( 'No results found.', 'orbis' ); ?>
			</p>
		</div>

	<?php endif; ?>
</div>

<?php orbis_content_nav(); ?>

<?php get_footer(); ?>