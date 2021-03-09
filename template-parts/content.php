<?php
/**
* パーツ：記事一覧のループ部分
*/
?>

	<!-- 記事ヘッダの出力 -->
	<?php get_template_part( 'template-parts/contentheader' ); ?>

	<!-- entry-content -->
	<section class="entry-container">
		<?php echo get_field('text'); ?>
		<?php echo post_custom('text'); ?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</section>
	<!-- /entry-content -->

	<!-- entry-footer -->
	<footer class="entry-footer">

		<!-- コメントの表示 -->
		<?php comments_template(); ?>

	</footer>
	<!-- /entry-footer -->