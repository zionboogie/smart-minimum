
(function (richText, element, editor) {
	var name = "new-addto/new-addto";
	// ボタンタイトル
	var title = "アンダーライン";
	// 追加クラス名
	var className = "underline";
	richText.registerFormatType(name, {
		title: title,
		tagName: "span",
		className: className,
		edit: function ({ isActive, value, onChange }) {
			return element.createElement(editor.RichTextToolbarButton, {
				icon: "editor-underline",
				title: title,
				onClick: function () {
					onChange(
						richText.toggleFormat(value, {
							type: name,
						})
					);
				},
				isActive: isActive,
			});
		},
	});
})(window.wp.richText, window.wp.element, window.wp.editor);

(function () {
	var blocks = wp.blocks;

	// コード
	blocks.registerBlockStyle("core/code", {
		name: "code prettyprint linenums lang-html",
		label: "HTMLコード",
	});
	blocks.registerBlockStyle("core/code", {
		name: "code prettyprint linenums lang-pug",
		label: "Pugコード",
	});
	blocks.registerBlockStyle("core/code", {
		name: "code prettyprint linenums lang-scss",
		label: "SCSSコード",
	});
	blocks.registerBlockStyle("core/code", {
		name: "code prettyprint linenums lang-js",
		label: "JavaScriptコード",
	});
	blocks.registerBlockStyle("core/code", {
		name: "code prettyprint linenums lang-php",
		label: "PHPコード",
	});

	// 画像
	blocks.registerBlockStyle("core/image", {
		name: "image fig-style",
		label: "上下マージン",
	});

	// タイトル
	blocks.registerBlockStyle("core/heading", {
		name: "h h-syntax",
		label: "構文タイトル",
	});
	blocks.registerBlockStyle("core/heading", {
		name: "h h-code",
		label: "コードサンプル用タイトル",
	});
	blocks.registerBlockStyle("core/heading", {
		name: "h h-example",
		label: "例文用タイトル",
	});

	// 段落
	blocks.registerBlockStyle("core/paragraph", {
		name: "p box-syntax",
		label: "構文",
	});
	blocks.registerBlockStyle("core/paragraph", {
		name: "p box-comment",
		label: "コメント",
	});
})();

