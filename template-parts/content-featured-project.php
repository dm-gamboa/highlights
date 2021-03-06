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
            'link_github'       => $overviewACF[ 'links' ][ 'github' ],
            'link_live_site'    => $overviewACF[ 'links' ][ 'live_site' ]
        );
    }
}
// ----------------------------------------

// ----------------------------------------
//  # TAXONOMIES
// ----------------------------------------

$projectType    = highlights_get_terms_in_subcategory( 'type', 'project' );
// Get the most specific project type
while( highlights_get_terms_in_subcategory( 'type', $projectType[0], 'name' ) ){
    $projectType = highlights_get_terms_in_subcategory( 'type', $projectType[0], 'name' );
}
$projectType    = $projectType[0];

$devTools       = highlights_get_terms_in_subcategory( 'type', 'development' );
$desTools       = highlights_get_terms_in_subcategory( 'type', 'design' );
$projTools      = highlights_get_terms_in_subcategory( 'type', 'project-management' );
// ----------------------------------------
?>

<li class="featured-project">
    <div class="content">
        <aside class="content-section aside">
            <?php the_post_thumbnail(); ?>
        </aside><!--.content-section-->
        
        <div class="content-section text">
            <div class="heading">
                <h2 class="project-title"><?php the_title(); ?></h2>
                <span class="project-info">
                    <h3 class="project-type"><?php echo $projectType; ?></h3>
                    <span class="links">
                        <?php if( $overview[ 'link_github' ] ): ?>
                            <a class="icon-link" href="<?php echo esc_url( $overview[ 'link_github' ] ); ?>" target="_blank">
                                <span class="icon icon-github">
                                    <span class="screen-reader-text">GitHub</span>
                                </span>
                            </a><!--.icon-link-->
                        <?php endif; ?>

                        <?php if( $overview[ 'link_live_site' ] ): ?>
                            <a class="live-site button button-link" href="<?php echo esc_url( $overview[ 'link_live_site' ] );?>" target="_blank">Live Site</a>
                        <?php endif; ?>
                    </span><!--.links-->
                </span><!--.project-info-->
            </div><!--.heading-->

            <div class="tools">
                <ul class="development tools-list">
                    <span class="tool-type icon-link">
                        <span class="icon icon-development">
                            <span class="screen-reader-text">Project Management Tools</span>
                        </span>
                    </span><!--.tool-type-->
                    <?php if( $devTools ): ?>
                        <?php foreach( $devTools as $devTool ): ?>
                            <li class="tool"><?php echo $devTool; ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul><!--.development.tools-list-->

                <ul class="design tools-list">
                    <span class="tool-type icon-link">
                        <span class="icon icon-design">
                            <span class="screen-reader-text">Project Management Tools</span>
                        </span>
                    </span><!--.tool-type-->
                    <?php if( $desTools ): ?>
                        <?php foreach( $desTools as $desTool ): ?>
                            <li class="tool"><?php echo $desTool ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul><!--.design.tools-list-->

                <ul class="project tools-list">
                    <span class="tool-type icon-link">
                        <span class="icon icon-project-management">
                            <span class="screen-reader-text">Project Management Tools</span>
                        </span>
                    </span><!--.tool-type-->
                    <?php if( $projTools ): ?>
                        <?php foreach( $projTools as $projTool ): ?>
                            <li class="tool"><?php echo $projTool ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul><!--.project.tools-list-->

            </div><!--.tools-->

            <a class="button button-link" href="<?php the_permalink(); ?>">Read More</a>
        </div><!--.content-section.text-->

        <div class="content-section text-hover">
            <p class="description"><?php echo $overview[ 'description' ]; ?></p>
            <a class="button button-link" href="<?php the_permalink(); ?>">Read More</a>
        </div><!--.content-section.text-hover-->
    </div><!--.content-->
</li><!--.featured-project-->
