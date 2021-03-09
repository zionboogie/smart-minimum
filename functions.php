<?php
/**
* テーマのための関数
*
* @link https://github.com/zionboogie/smart-minimum
*
* @package WordPress
* @subpackage SMART-MINIMUM
* @since 1.0.0
*/

/*#########################################################

基本設定 テーマ設定・オプションを初期化

#########################################################*/
add_action( 'after_setup_theme', function() {

	/* ========================================================
	セキュリティ
	=========================================================*/
	// WordPressのバージョンを非表示
	remove_action('wp_head','wp_generator');

	// 短縮URLを非表示
	remove_action('wp_head', 'wp_shortlink_wp_head');

	// Microsoftが提供するブログエディタ「Windows Live Writer」のマニフェストファイル
	remove_action('wp_head', 'wlwmanifest_link');

	// プラグインのバージョン情報非表示
	function remove_cssjs_ver2( $src ) {
		// テーマ内のファイルは対象外
		if ( strpos( $src, 'ver=' ) && !strpos( $src, get_template() ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
	add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
	add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );

	// headタグのmeta（generator）タグを取り除く
	foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header',
		'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
		if ( has_action( $action, 'the_generator' ) )
			remove_action( $action, 'the_generator' );
	}

	// HEAD要素から各フィードへのURL出力を削除
	remove_action('wp_head', 'feed_links', 2);	// サイト全体の記事、コメントフィードリンクの削除
	remove_action('wp_head', 'feed_links_extra', 3);	// // 記事のコメント、記事アーカイブ、カテゴリなどのフィードリンクの削除

	// フィード自体の出力を停止
	remove_action('do_feed_rdf', 'do_feed_rdf');
	remove_action('do_feed_rss', 'do_feed_rss');
	remove_action('do_feed_rss2', 'do_feed_rss2');
	remove_action('do_feed_atom', 'do_feed_atom');


	/* ========================================================
	軽量化
	=========================================================*/
	// 絵文字削除
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles' );
	remove_action('admin_print_styles', 'print_emoji_styles');

	// Microsoftが提供するブログエディター「Windows Live Writer」を使用する際のマニフェストファイル
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// RSD用のxml（外部サービスを使ってサイトを運営する予定がある場合はコメントアウト）
	remove_action('wp_head', 'rsd_link');

	// oEmbed 機能に必要なリンク
	remove_action('wp_head','rest_output_link_wp_head');
	remove_action('wp_head','wp_oembed_add_discovery_links');
	remove_action('wp_head','wp_oembed_add_host_js');


	/* ========================================================
	基本設定
	=========================================================*/
	// フィードのlink要素を自動出力する
	// add_theme_support( 'automatic-feed-links' );

	// ドキュメントのタイトル出力をWordPressに管理させる
	add_theme_support( 'title-tag' );

	// 投稿ページにてアイキャッチ画像の欄を表示
	add_theme_support( 'post-thumbnails' );

	// ブロックエディタ用スタイル機能をテーマに追加 
	add_theme_support( 'editor-styles' );
	// ブロックエディタ用CSSの読み込み
	add_editor_style( './common/css/style-editor.css' );

	// WordPressコアから出力されるHTMLタグをHTML5のフォーマットにする
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
		'style',
		'script',
		'navigation-widgets',
		'search-form',
	) );

	// 投稿フォーマットのサポート
	add_theme_support( 'post-formats', array(
	// 	'aside',	//アサイド
	// 	'gallery',	//ギャラリー
	// 	'link',		//リンク
	// 	'image',	//画像
	// 	'quote',	//引用
	// 	'status',	//ステータス
	// 	'video',	//動画
	// 	'audio',	//音声
	// 	'chat',		//チャット
	) );

	// 記事の自動整形（ダブルクオーテーションなどの引用符など）を無効にする
	add_filter( 'run_wptexturize', '__return_false' );
});


/* ========================================================
コンテンツ幅の設定（アイキャッチ画像のトリミングなどに影響）
=========================================================*/
add_action( 'after_setup_theme', function() {
	$GLOBALS['content_width'] = apply_filters( 'smart_content_width', 1080 );
}, 0 );


/*#########################################################

汎用関数

#########################################################*/

/* ========================================================
カテゴリの出力
=========================================================*/
function smart_entry_category($pretag="", $endtag="") {
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		printf( $pretag.'%1$s'.$endtag,
			$categories_list
		);
	}
}

/* ========================================================
タグの出力
=========================================================*/
function smart_entry_tag($pretag="", $endtag="") {
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ) {
		printf( $pretag.'%1$s'.$endtag,
			$tags_list
		);
	}
}

/* ========================================================
トピックパス
=========================================================*/
function get_breadcrumb() {
	echo '<a href="'.home_url() . '">home</a> / ';
	if ( is_category() || is_single() ){
		the_category(" / ");
		if ( is_single() ) {
			echo " / ";
			the_title();
		}
	} else if ( is_page() ) {
		echo the_title();
	} else if ( is_search() ) {
		echo "検索";
	}
}

/*#########################################################

フック

#########################################################*/

/* ========================================================
ウィジェットの追加
=========================================================*/
add_action( 'widgets_init', function() {
	// 管理画面左カラムにウィジェット追加
	register_sidebar(array(
		'id'			=> 'sidebar-1',
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
	));
} );


/* ========================================================
フロントのCSSとJSの読み込み
=========================================================*/
add_action('wp_enqueue_scripts', function(){
	/*
	ディレクトリ単位でCSSを変更したい場合のサンプル
	*/
	/*
		// CSSディレクトリ
		$uri = get_template_directory_uri() . "/common/css/";
	
		// クエリパラメータを削除
		$url = preg_replace( '/\?.+$/', '', $_SERVER["REQUEST_URI"] );
		$handle = parse_url($url, PHP_URL_PATH);
		// /で配列作成
		$handle = explode('/', $handle);
		$uri .= $handle[1] . "/style.css";
	
		*/
	
	/*
	テンプレートの種類毎にCSSを変更したい場合のサンプル
	*/
	/*
		// CSSディレクトリ
		$uri = get_template_directory_uri() . "/common/css/";
	
		// トップページの場合
		if ( is_home() ) {
			$uri .= "top.css";
	
		// 詳細ページの場合
		} else if( is_single() ){
	
			$uri .= "single.css";
	
		// カテゴリかタグ、カスタムタクソノミーのアーカイブページの場合
		} else if( is_category() || is_tag() || is_tax() ){
			$uri .= "category.css";
	
		// エラーページの場合
		} else if ( is_404() ){
			$uri .= "error.css";
	
		// 該当なし
		} else {
			$uri .= "common.css";
	
		}
	*/
	
	// CSSディレクトリ
	$uri = get_template_directory_uri() . "/style.css";

	// スタイルの出力
	wp_enqueue_style("smart-style", $uri, array(), wp_get_theme()->get( 'Version' ));

	/*
	テンプレートの種類毎にJavaScriptを変更したい場合のサンプル
	*/
	// JSディレクトリ
	$uri = get_template_directory_uri() . "/common/js/";
	// 管理画面
	if( is_home() ){
		$uri .= 'index.js';

	// 詳細ページの場合
	} else if( is_single() ){
		$uri .= "single.js";

	// カテゴリかタグ、カスタムタクソノミーのアーカイブページの場合
	} else if( is_category() || is_tag() || is_tax() ){
		$uri .= "category.js";

	// エラーページの場合
	} else if ( is_404() ){
		$uri .= "error.js";

	// 該当なし
	} else {
		$uri .= "common.js";
	}
	wp_enqueue_script('smart-script', $uri, array(), wp_get_theme()->get( 'Version' ), true);
});

/* ========================================================
管理画面：CSS・JSの読み込み制御
=========================================================*/
add_action('admin_enqueue_scripts', function($hook_suffix){
	// 投稿ページのみ
	if( 'post.php' === $hook_suffix || 'post-new.php' === $hook_suffix ){
		// CSSディレクトリ
		$uri = get_template_directory_uri() . "/common/css/editor-helper.css";
		// スタイルの出力
		wp_enqueue_style("smart-style", $uri, array(), wp_get_theme()->get( 'Version' ));

		// JSディレクトリ
		$uri = get_template_directory_uri() . "/common/js/editor-helper.js";
		wp_enqueue_script('smart-script', $uri, array(), wp_get_theme()->get( 'Version' ), true);
	}
});

/* ========================================================
フロント：CSS・JSの読み込み制御
=========================================================*/
add_action( 'wp_enqueue_scripts', function() {
	//管理画面系CSSの読み込み制限
	wp_deregister_style( 'dashicons' );
	wp_deregister_style( 'aioseop-toolbar-menu' );

	//投稿用プラグインのCSS
	if ( !is_single() ){
		wp_deregister_style( 'toc-screen' );
		wp_deregister_style( 'liquid-block-speech' );
		wp_deregister_style( 'tablepress-default' );
		wp_deregister_style( 'post-views-counter-frontend' );
	}

	// 固定ページとシングルページはjQueryを読み込まない
	// if ( is_page() || is_single() ) {
		// wp_deregister_script( 'jquery' );
	// }
}, 100 );

/* ========================================================
メインクエリの設定
=========================================================*/
add_action( 'pre_get_posts', function($query) {
	/* 管理画面、メインクエリ以外に干渉しない */
	if( is_admin() || ! $query->is_main_query() ) return;

	/* TOPページ */
	if ( $query->is_home() ) {
		return;

	/* カテゴリーページ */
	} else if ( $query->is_category() ){
		return;

	/* アーカイブページ */
	} else if ( $query->is_archive() ){
		return;

	/* タグページ */
	} else if ( $query->is_tag() ){
		return;

	/* タクソノミーページ */
	} else if ( $query->is_tax() ){
		return;

	/* 詳細ページ */
	} else if ( $query->is_single() ){
		return;

	/* 検索ページ */
	} else if ( $query->is_search() ){
		return;

	/* 固定ページ */
	} else if ( $query->is_page() ){
		return;

 	}
} );
