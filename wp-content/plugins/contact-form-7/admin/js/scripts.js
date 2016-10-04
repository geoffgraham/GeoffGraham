(function($) {

	'use strict';

	if (typeof _wpcf7 == 'undefined' || _wpcf7 === null) {
		_wpcf7 = {};
	}

	$(function() {
		var welcomePanel = $('#welcome-panel');
		var updateWelcomePanel;

		updateWelcomePanel = function( visible ) {
			$.post( ajaxurl, {
				action: 'wpcf7-update-welcome-panel',
				visible: visible,
				welcomepanelnonce: $( '#welcomepanelnonce' ).val()
			});
		};

		$('a.welcome-panel-close', welcomePanel).click(function(event) {
			event.preventDefault();
			welcomePanel.addClass('hidden');
			updateWelcomePanel( 0 );
		});

		$('#contact-form-editor').tabs({
			active: _wpcf7.activeTab,
			activate: function(event, ui) {
				$('#active-tab').val(ui.newTab.index());
			}
		});

		$('#contact-form-editor-tabs').focusin(function(event) {
			$('#contact-form-editor .keyboard-interaction').css(
				'visibility', 'visible');
		}).focusout(function(event) {
			$('#contact-form-editor .keyboard-interaction').css(
				'visibility', 'hidden');
		});

		$('input:checkbox.toggle-form-table').click(function(event) {
			$(this).wpcf7ToggleFormTable();
		}).wpcf7ToggleFormTable();

		if ('' == $('#title').val()) {
			$('#title').focus();
		}

		$.wpcf7TitleHint();

		$('.contact-form-editor-box-mail span.mailtag').click(function(event) {
			var range = document.createRange();
			range.selectNodeContents(this);
			window.getSelection().addRange(range);
		});

		$('[data-config-field]').each(function() {
			var section = $(this).attr('data-config-field');

			if (_wpcf7.configErrors[section]) {
				var $list = $('<ul></ul>').attr({
					'role': 'alert',
					'class': 'config-error'
				});

				$.each(_wpcf7.configErrors[section], function(i, val) {
					var $li = $('<li></li>').text(val.message);

					if (val.link) {
						var $link = $('<a></a>').attr({
							'href': val.link,
							'class': 'external'
						}).text(_wpcf7.howToCorrectLink);

						$li = $li.append(' ').append($link);
					}

					$li.appendTo($list);
				});

				$(this).after($list).attr({'aria-invalid': 'true'});
			}
		});

		$(window).on('beforeunload', function(event) {
			var changed = false;

			$('#wpcf7-admin-form-element :input[type!="hidden"]').each(function() {
				if ($(this).is(':checkbox, :radio')) {
					if (this.defaultChecked != $(this).is(':checked')) {
						changed = true;
					}
				} else if ($(this).is('select')) {
					$(this).find('option').each(function() {
						if (this.defaultSelected != $(this).is(':selected')) {
							changed = true;
						}
					});
				} else {
					if (this.defaultValue != $(this).val()) {
						changed = true;
					}
				}
			});

			if (changed) {
				event.returnValue = _wpcf7.saveAlert;
				return _wpcf7.saveAlert;
			}
		});

		$('#wpcf7-admin-form-element').submit(function() {
			if ('copy' != this.action.value) {
				$(window).off('beforeunload');
			}

			if ('save' == this.action.value) {
				$('#publishing-action .spinner').addClass('is-active');
			}
		});
	});

	$.fn.wpcf7ToggleFormTable = function() {
		return this.each(function() {
			var formtable = $(this).closest('.contact-form-editor-box-mail').find('fieldset');

			if ($(this).is(':checked')) {
				formtable.removeClass('hidden');
			} else {
				formtable.addClass('hidden');
			}
		});
	};

	/**
	 * Copied from wptitlehint() in wp-admin/js/post.js
	 */
	$.wpcf7TitleHint = function() {
		var title = $('#title');
		var titleprompt = $('#title-prompt-text');

		if ('' == title.val()) {
			titleprompt.removeClass('screen-reader-text');
		}

		titleprompt.click(function() {
			$(this).addClass('screen-reader-text');
			title.focus();
		});

		title.blur(function() {
			if ('' == $(this).val()) {
				titleprompt.removeClass('screen-reader-text');
			}
		}).focus(function() {
			titleprompt.addClass('screen-reader-text');
		}).keydown(function(e) {
			titleprompt.addClass('screen-reader-text');
			$(this).unbind(e);
		});
	};

})(jQuery);
