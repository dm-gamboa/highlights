<?php
/**
 * Template part for displaying the overview section in single project pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

?>

<?php
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
        <h1 class="title"><?php the_title(); ?></h1>
        <h3 class="type"><?php echo $projectType; ?></h3>

        <div class="tools">
            <ul class="development tools-list">
                <h3>Development Tools</h3>
                <?php if( $devTools ): ?>
                    <?php foreach( $devTools as $devTool ): ?>
                        <li class="tool"><?php echo $devTool; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.development.tools-list-->

            <ul class="design tools-list">
                <h3>Design Tools</h3>
                <?php if( $desTools ): ?>
                    <?php foreach( $desTools as $desTool ): ?>
                        <li class="tool"><?php echo $desTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.design.tools-list-->

            <ul class="project tools-list">
                <h3>Project Management Tools</h3>
                <?php if( $projTools ): ?>
                    <?php foreach( $projTools as $projTool ): ?>
                        <li class="tool"><?php echo $projTool ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul><!--.project.tools-list-->
        </div><!--.tools-->
    </div><!--.content-main-->

    <div class="content-main-hover">
        <p class="description"><?php echo $overview[ 'description' ]; ?></p>
    </div><!--.content-hover-->
</div><!--.featured-project-->
