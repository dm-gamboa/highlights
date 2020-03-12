<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Highlights
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php
// ----------------------------------------
//  # ACF FIELDS
// ----------------------------------------
if( function_exists( 'get_field' ) ){
    // ----------------------------------------
    //  # EXTERNAL LINKS
	// ----------------------------------------
	$externalLinksACF = get_field( 'external_links', 'option' );
	if( have_rows( 'external_links', 'option' ) ){
		while( have_rows('external_links', 'option' ) ){
			the_row();

			if( have_rows( 'link' ) ){
				while( have_rows( 'link' ) ){
					the_row();

					$linkData = array (
						'name' 	=> get_sub_field( 'name' ),
						'url'	=> get_sub_field( 'url' ),
						'tab'	=> get_sub_field( 'tab' ),
						'icon'	=> get_sub_field( 'icon' )
					);

					if( $linkData[ 'tab'] ){
						$linkData[ 'tab' ] = 'target="_blank"';
					}else{
						$linkData[ 'tab' ] = "";
					}

					$externalLinks[] = $linkData;
				}
			}			
		}

	}
}
// ----------------------------------------
?>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'highlights' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<div class="main-navigation-item site-branding">
				<?php the_custom_logo(); ?>
			</div><!-- .site-branding -->
			
			<?php if( $externalLinks ): ?>
				<ul class="main-nav-item nav external-links-nav">
					<?php foreach( $externalLinks as $externalLink ): ?>
						<li class="nav-item">
							<a 	class="external-link icon-link" href="<?php echo esc_url( $externalLink[ 'url' ] ); ?>" <?php echo $externalLink[ 'tab']; ?>>
									<?php
									if ( !$externalLink[ 'icon' ] ):
										echo $externalLink[ 'name' ];
									elseif( $externalLink[ 'icon' ][ 'source' ] == 'Class' ): ?>
										<span class="icon <?php echo $externalLink[ 'icon' ][ 'class' ]; ?>"></span>
									<?php
									elseif( $externalLink[ 'icon' ][ 'source' ] == 'HTML' ):
										echo $externalLink[ 'icon' ][ 'html' ]; 
									else: ?>
										<img src="<?php echo esc_url( $externalLink[ 'image' ]['url'] ); ?>" alt="<?php echo esc_attr( $externalLink[ 'image' ]['alt'] ); ?>" />
									<?php
									endif;
									?>
							</a>
						</li><!--menu-item-->
					<?php endforeach; ?>
				</ul><!--.external-links-menu-->
			<?php endif; ?>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
