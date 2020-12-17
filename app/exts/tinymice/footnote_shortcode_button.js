jQuery(document).ready(function($) {
	tinymce.create('tinymce.plugins.footnote_shortcode_button', {
		init: function(ed, url) {
			// Register command for when button is clicked
			// ed.addCommand('wpse72394_insert_shortcode', function() {
			// 	selected = tinyMCE.activeEditor.selection.getContent()

			// 	if (selected) {
			// 		//If text is selected when button is clicked
			// 		//Wrap shortcode around it.
			// 		content = '[shortcode]' + selected + '[/shortcode]'
			// 	} else {
			// 		content = '[shortcode]'
			// 	}

			// 	tinymce.execCommand('mceInsertContent', false, content)
			// })

			// Register buttons - trigger above command when clicked
			ed.addButton('footnote_shortcode_button', {
				title: '插入註解',
				// cmd: 'wpse72394_insert_shortcode',
				image: url + '/footnote_shortcode_button.png',
				onclick: function() {
					ed.windowManager.open({
						title: '插入註解',
						body: [
							{
								type: 'textbox',
								name: 'source',

								multiline: true,
							},
						],
						onsubmit: function(e) {
							ed.focus()

							ed.selection.setContent(
								'[efn_note]' + e.data.source + '[/efn_note]'
								// '<pre class="language-' +
								// 	e.data.language +
								// 	' line-numbers"><code>' +
								// 	e.data.source +
								// 	ed.selection.getContent() +
								// 	'</code></pre>'
							)
						},
					})
				},
			})
		},
	})

	tinymce.PluginManager.add(
		'footnote_shortcode_button',
		tinymce.plugins.footnote_shortcode_button
	)
})
