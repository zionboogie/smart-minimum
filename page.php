<?php
/*
固定ページ用テンプレート
*/
// ヘッダの出力
get_header();
?>


<!-- main -->
<main class="main-container">

<?php
// パンくずリストの出力
//get_template_part( 'template-parts/breadcrumb' );
?>

<?php if ( have_posts() ) : ?>

	<!-- entry-content -->
	<section class="entry-container">
		<?php the_content(); ?>
	</section>
	<!-- /entry-content -->

<?php endif; ?>

<?php
// サイドバーの出力
get_sidebar();
?>

</main>
<!-- /main -->

<?php
// フッタの出力
get_footer();
?>