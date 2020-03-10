<?php
/**
 * Template part for displaying featured projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

?>

<?php
// ----------------------------------------
//  # ACF FIELDS
// ----------------------------------------
if( function_exists( 'get_field' ) ){
    // ----------------------------------------
    //  # OVERVIEW
    // ----------------------------------------
    $overviewACF = get_field( 'overview' );

    if( $overviewACF ){
        $overview = array (
            'description'       => $overviewACF[ 'description' ],
            'link_github'       => $overviewACF[ 'link' ][ 'github' ],
            'link_live_site'    => $overviewACF[ 'link' ][ 'live_site' ]
        );
    }
}
// ----------------------------------------

// ----------------------------------------
//  # TAXONOMIES
// ----------------------------------------
echo "TEST: ";
$terms = get_the_terms( $post->ID, 'type' );
foreach( $terms as $term ){
    $type .= $term->name . ' ';
    echo $type . "<br />";
}

$devTools   = get_the_terms( $post->ID, 'development' );
$desTools   = get_the_terms( $post->ID, 'design' );
$projTools  = get_the_terms( $post->ID, 'project-management' );
// ----------------------------------------
?>

<div class="featured-project">
    <aside class="content-aside">
        <figure class="preview"><?php the_post_thumbnail(); ?></figure>
        <span class="links">
            <?php if( $overview[ 'link_github' ] ): ?>
                <a class="github" href="<?php echo esc_url( $overview[ 'link_github' ] ); ?>">GitHub</a>
            <?php endif; ?>

            <?php if( $overview[ 'link_github' ] ): ?>
                <a class="live-site" href="<?php echo esc_url( $overview[ 'link_live_site' ] );?>">Live Site</a>
            <?php endif; ?>
        </span><!--.links-->
    </aside><!--.aside-->
    
    <div class="content-main">
        <h2 class="title"><?php the_title(); ?></h3>
        <h3 class="type"><?php echo $type; ?></h3>

        <div class="tools">
            <ul class="development tools-list">
                <?php if( $devTools ): ?>
                    <?php foreach( $devTools as $devTool ): ?>
                        <li class="tool"><?php echo $type; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.development.tools-list-->

            <ul class="design tools-list">
                <?php if( $desTools ): ?>
                    <?php foreach( $desTools as $desTool ): ?>
                        <li class="tool"><?php echo $desTool->name ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.design.tools-list-->

            <ul class="project tools-list">
                <?php if( $projTools ): ?>
                    <?php foreach( $projTools as $projTool ): ?>
                        <li class="tool"><?php echo $projTool->name ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.project.tools-list-->
        </div><!--.tools-->    
    </div><!--.content-main-->

    <div class="content-hover">
        <p class="description"><?php echo $overview[ 'description' ]; ?></p>
    </div><!--.content-hover-->
</div><!--.featured-project-->
