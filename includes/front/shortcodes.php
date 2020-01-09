<?php

// Logged in shortcode

add_shortcode('logged-in','show_user_content');
add_shortcode('logged-out','show_guest_content');

function show_user_content($atts,$content = null){
	if (!is_user_logged_in()){
		return "";
	}
	return $content;
}

function show_guest_content($atts,$content){
	if (!is_user_logged_in()){
		return $content;
	}
}

// [year] shortcode

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

// Sitemap

function sitemap_function( $atts ){
	ob_start(); ?>
	<h2 id="pages">Pages</h2>
<ul>
<?php
// Add pages you'd like to exclude in the exclude here
wp_list_pages(
  array(
    'exclude' => 'Subscription confirmation',
    'title_li' => '',
  )
);
?>
</ul>

<h2 id="posts">Posts</h2>
<ul>
<?php
// Add categories you'd like to exclude in the exclude here
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo "<li><h3>".$cat->cat_name."</h3>";
  echo "<ul>";
  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
  while(have_posts()) {
    the_post();
    $category = get_the_category();
    // Only display a post link once, even if it's in multiple categories
    if ($category[0]->cat_ID == $cat->cat_ID) {
      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    }
  }
  echo "</ul>";
  echo "</li>";
}
?>
</ul>

<?php
foreach( get_post_types( array('public' => true) ) as $post_type ) {
  if ( in_array( $post_type, array('post','page','attachment') ) )
    continue;

  $pt = get_post_type_object( $post_type );

  echo '<h2>'.$pt->labels->name.'</h2>';
  echo '<ul>';

  query_posts('post_type='.$post_type.'&posts_per_page=-1');
  while( have_posts() ) {
    the_post();
    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }

  echo '</ul>';
}
?>
	<? return ob_get_clean();
}
add_shortcode( 'site-map', 'sitemap_function' );


// Breadcrumb

function breadcrumb_function( $atts ){
	ob_start();
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('
		<p id="breadcrumbs" class="breadcrumb">','</p>
		');
	}
	return ob_get_clean();
}
add_shortcode( 'breadcrumb', 'breadcrumb_function' );

/***** SECTION: Advanced Custom Fields *****/

if ( !function_exists( 'get_field' ) )
return;

if( function_exists('get_field')) {

	// Contact Details

	function contact_details( $atts, $content = null ){
		reset_rows();
		ob_start();
		$a = shortcode_atts( array(
				'placement' => 'left',
				'display'  =>  'block'
		), $atts );
		?>
		<div class="contact details <?php echo $a['display']; ?>">
			<?php if( have_rows('contact_details', 'options') ) { ?>
				<?php while( have_rows('contact_details', 'options') ): the_row();
					$type = get_sub_field('type', 'options');
					$detail = get_sub_field('detail', 'options');
					$detailformatted = (int)(str_replace( array('(', ')', '-', '.', ' '), '', $detail));
					$tooltip = get_sub_field('tooltip', 'options');
					?>
					<div itemscope itemtype="http://schema.org/Organization" data-toggle="tooltip" data-placement="<?php echo $a['placement']; ?>" data-original-title="<?php if( $tooltip ) { echo $tooltip; } ?>" class="<?php echo $a['display']; ?>">
						<?php if ( in_array($type, array('phone','mobile')) ) { ?>
							<a itemprop="telephone" content="+64<?php echo $detailformatted; ?>" href="tel:+64<?php echo $detailformatted; ?>">
							<?php } elseif ($type == 'mail') { ?>
									<a class="mailto-link" href="mailto:<?php echo $detail; ?>" itemprop="email">
								<?php } ?>
						<?php if( $type ) { ?>
							<i class="fa fa-fw fa-<?php echo $type; ?>"></i>
						<?php } ?>
						<?php if( $detail ) { ?>
							<span class="title"><?php echo $detail; ?></span>
						<?php } ?>
						<?php if ( in_array($type, array('phone','mobile','mail')) ) { ?>
							</a>
						<?php } ?>
					</div>
				<?php endwhile; ?>
			<?php } ?>
		</div>
		<? return ob_get_clean();
	}
	add_shortcode( 'contact-details', 'contact_details' );

	/***** SECTION: Social Media */

	function social_media( $atts ){
	reset_rows();
	ob_start();
	$a = shortcode_atts( array(
			'placement' => 'left',
			'display'  =>  'block'
	), $atts );
	if( have_rows('social_media', 'options') ) { ?>
		<div class="social-media details <?php echo $a['display']; ?>">
		<?php while( have_rows('social_media', 'options') ): the_row();
			$provider = get_sub_field('provider', 'options');
			$page_url = get_sub_field('page_url', 'options'); ?>
			<div data-toggle="tooltip" data-placement="<?php echo $a['placement']; ?>" data-original-title="<?php echo $provider['label']; ?>" class="<?php echo $a['display']; ?>">
				<a href="<?php echo $page_url; ?>" target="_blank">
					<i class="fa fa-fw fa-<?php echo $provider['value']; ?>"></i>
					<span class="title"><?php echo $provider['label']; ?></span>
				</a>
			</div>
		<?php endwhile;
	}
	?>
	</div>
	<?php return ob_get_clean();
	}
	add_shortcode( 'social-media', 'social_media' );

// FB Page

	function facebook_page( $atts ){
		reset_rows();
		while( have_rows('social_media', 'options') ): the_row();
			$provider = get_sub_field('provider', 'options');
			$page_url = get_sub_field('page_url', 'options');
			if ($provider['label'] == 'Facebook') {
				ob_start(); ?>
				<div class="fb-page" data-href="<?php echo $page_url ?>" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="<?php echo $page_url ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $page_url ?>"><?php echo get_bloginfo('name'); ?></a></blockquote></div>
			<?php return ob_get_clean();
		}
		endwhile;
	}
	add_shortcode( 'facebook-page', 'facebook_page' );

// Like Button

	function fb_like( $atts ){
		reset_rows();
		$a = shortcode_atts( array(
				'colour' => 'light',
				'placement' => 'bottom',
		), $atts );
		while( have_rows('social_media', 'options') ): the_row();
		$provider = get_sub_field('provider', 'options');
		$page_url = get_sub_field('page_url', 'options');
		if ($provider['label'] == 'Facebook') {
			ob_start(); ?>
			<div class="fb-like" data-href="<?php echo $page_url ?>" data-width="60" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="false" data-colorscheme="<?php echo $a['colour'] ?>" data-toggle="tooltip" data-placement="<?php echo $a['placement'] ?>" data-original-title="Like us on Facebook">
			</div>
			<? return ob_get_clean();
		}
		endwhile;
	}
	add_shortcode( 'facebook-like', 'fb_like' );
}

function social_share_buttons( $atts ){
	$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
	$title = get_the_title();
	$a = shortcode_atts( array(
			'colour' => 'light',
			'placement' => 'top',
			'title' => 'Share This Page!',
			'orientation' => 'horizontal',
			'position' => 'static',
	), $atts );
	ob_start(); ?>
	<ul class="social-share <?php echo $a['display'] ?> flex-<?php echo $a['orientation'] ?> <?php echo $a['position'] ?>" data-toggle="tooltip" data-colour="<?php echo $a['colour'] ?>" data-placement="<?php echo $a['placement'] ?>" data-original-title="<?php echo $a['title'] ?>">
	  <li class="facebook">
	    <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
	    <span class="fa fa-facebook"></span>
	  </a></li>
	  <li class="twitter">
			<a rel="nofollow" href="https://twitter.com/intent/tweet?text=Auckland%20Store&amp;url=<?php echo $url; ?>" target="_blank">
			<span class="fa fa-twitter"></span>
	  </a></li>
	  <li class="linkedin">
			<a rel="nofollow" href="https://www.linkedin.com/shareArticle?url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;mini=true" target="_blank">
	    <span class="fa fa-linkedin"></span>
	  </a></li>
	  <li class="email">
			<a rel="nofollow" href="mailto:?subject=Auckland%20Store&amp;body=<?php echo $url; ?>" target="_blank">
	    <span class="fa fa-mail"></span>
	  </a></li>
	</ul>
	<?php return ob_get_clean();
}
add_shortcode( 'social-share', 'social_share_buttons' );
