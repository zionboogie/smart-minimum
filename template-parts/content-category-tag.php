
		<!-- entry-container -->
		<div class="entry-container">
			<div class="inner">



<?php
// パンくずリストの出力
get_template_part( 'template-parts/pagination' );
?>

<?php
if ( have_posts() ) :
?>
				<ul class="default-list">

<?php
	while ( have_posts() ):
		the_post();
		// 記事タイトルの出力
?>

					<li><a href="<?php echo the_permalink()?>"> <i class="fa icon-paper-plane-empty"></i><?php echo the_title()?></a></li>

<?php
	endwhile;
?>

				</ul>


<?php
global $pg_navi;
if ( $pg_navi ):
?>
<!-- .page-navi -->
<div class="pagination-nav">
<?php
echo $pg_navi;
?>
</div>
<!-- / .page-navi -->
<?php
endif;
?>


<?php
endif;
?>
			</div>



			<!-- sidebar-container -->
			<div class="sidebar-container">
<?php
// サイドバーの出力
get_sidebar();
?>

			</div>
			<!-- /sidebar-container -->


		</div>
		<!-- /entry-container -->
