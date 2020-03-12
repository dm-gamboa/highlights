<?php
/**
 * Template part for displaying the sections in single project pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Highlights
 */

?>

<?php
$title  = highlights_htmlify( $section[ 'title' ] );
$type   = highlights_htmlify( $section[ 'type' ] );
$for    = highlights_htmlify( $section[ 'for' ] );
$class = "$for $type $title";
?>

<div class="<?php echo $class; ?>">
    <?php if( $section[ 'image' ] ): ?>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
    <?php endif;?>

    <?php if( $section[ 'title' ] ): ?>
        <h3 class="title section-title"><?php echo $section[ 'title' ]; ?></h3>
    <?php endif;?>

    <?php if( $section[ 'text' ] ): ?>
        <p class="text section-text"><?php echo $section[ 'text' ]; ?></p>
    <?php endif;?>

    <?php if( $section[ 'code' ] ): ?>
        <div class="code-snippets">
            <?php foreach( $section[ 'code' ] as $code ): ?>
                <?php if( $code[ 'language' ] && $code[ 'snippet' ] ): ?>
                    <div class="code-snippet">
                        <!-- <button class="button code-toggle">View Code Snippet</button> -->
                        <span class="language"><?php echo $code[ 'language' ]; ?></span>
                        <pre><?php echo $code[ 'snippet' ]; ?></pre>
                    </div><!--.code-snippet-->
                <?php endif; ?>
            <?php endforeach; ?>
        </div><!--.code-snippets-->
    <?php endif;?>
</div><!--.featured-project-->
