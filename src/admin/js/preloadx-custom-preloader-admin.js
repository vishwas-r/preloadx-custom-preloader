(function( $ ) {
	'use strict';

	function toggleBackgroundInputs() {
		var typeEl = document.getElementById('preloadx_bgtype');
		var type = typeEl ? typeEl.value : 'color';

		var colorEl = document.getElementById('color-input');
		var gradEl = document.getElementById('gradient-input');
		var imgEl = document.getElementById('image-input');

		if (colorEl) colorEl.style.display = (type === 'color') ? 'block' : 'none';
		if (gradEl) gradEl.style.display = (type === 'gradient') ? 'block' : 'none';
		if (imgEl) imgEl.style.display = (type === 'image') ? 'block' : 'none';

		changeBackground(type);
	}

	function changeBackground(type) {
		var elements = document.getElementsByClassName('pxpreloader-preview');
		var inputEl = document.getElementById('preloadx_bg' + type);
		var val = inputEl ? inputEl.value : '';

		for (var i = 0; i < elements.length; i++) {
			if (type === 'image') {
				elements[i].style.background = val ? 'url(' + val + ')' : '#000';
				elements[i].style.backgroundSize = 'cover';
				elements[i].style.backgroundRepeat = 'no-repeat';
				elements[i].style.backgroundPosition = 'center';
			} else {
				elements[i].style.background = (elements[i].getAttribute('id') === 'no-loader') ? 'none' : val;
			}
		}
	}

	document.addEventListener('DOMContentLoaded', function() {
		toggleBackgroundInputs();

		// Background type select
		var bgTypeEl = document.getElementById('preloadx_bgtype');
		if (bgTypeEl) {
			bgTypeEl.addEventListener('change', function() {
				toggleBackgroundInputs();
			});
		}

		// Background color picker
		var bgColorEl = document.getElementById('preloadx_bgcolor');
		if (bgColorEl) {
			bgColorEl.addEventListener('input', function() {
				var hex = this.value;
				var hexSpan = this.parentElement.querySelector('.preloadx-color-hex');
				if (hexSpan) hexSpan.textContent = hex;
				changeBackground('color');
			});
		}

		// Background gradient text input
		var bgGradEl = document.getElementById('preloadx_bggradient');
		if (bgGradEl) {
			bgGradEl.addEventListener('input', function() {
				changeBackground('gradient');
			});
		}

		// Background image input
		var bgImgEl = document.getElementById('preloadx_bgimage');
		if (bgImgEl) {
			bgImgEl.addEventListener('input', function() {
				changeBackground('image');
			});
		}

		// Preloader accent color picker
		var colorEl = document.getElementById('preloadx_color');
		if (colorEl) {
			colorEl.addEventListener('input', function() {
				var hex = this.value;
				var hexSpan = this.parentElement.querySelector('.preloadx-color-hex');
				if (hexSpan) hexSpan.textContent = hex;
				document.documentElement.style.setProperty('--preloader-color', hex);
			});
		}

		// Dimensions & Typography Live Updates
		var sizeInput = document.getElementById('preloadx_loader_size');
		var sizeBadge = document.getElementById('preloadx-size-val');
		var unitInput = document.getElementById('preloadx_loader_size_unit');
		var sizeHint = document.getElementById('preloadx-size-hint');
		var unitBtns = document.querySelectorAll('.preloadx-unit-btn');

		function updateLoaderSize() {
			if (!sizeInput) return;
			var unit = unitInput ? unitInput.value : '%';
			var val = parseInt(sizeInput.value, 10) || (unit === '%' ? 100 : 60);

			if (sizeBadge) {
				sizeBadge.textContent = val + unit;
			}

			if (unit === '%') {
				var calcSize = Math.max(20, Math.min(120, Math.round(60 * (val / 100))));
				document.documentElement.style.setProperty('--preloader-size', calcSize + 'px');
			} else {
				var calcPx = Math.max(20, Math.min(120, val));
				document.documentElement.style.setProperty('--preloader-size', calcPx + 'px');
			}
		}

		if (sizeInput) {
			sizeInput.addEventListener('input', updateLoaderSize);
		}

		unitBtns.forEach(function(btn) {
			btn.addEventListener('click', function() {
				var targetUnit = this.getAttribute('data-unit');
				if (!targetUnit || (unitInput && unitInput.value === targetUnit)) return;

				unitBtns.forEach(function(b) { b.classList.remove('active'); });
				this.classList.add('active');

				var oldUnit = unitInput ? unitInput.value : '%';
				if (unitInput) unitInput.value = targetUnit;

				if (sizeInput) {
					var curVal = parseInt(sizeInput.value, 10) || 60;
					if (targetUnit === '%') {
						sizeInput.min = '10';
						sizeInput.max = '200';
						sizeInput.step = '1';
						var newPct = Math.min(200, Math.max(10, Math.round((curVal / 60) * 100)));
						sizeInput.value = newPct;
						if (sizeHint) sizeHint.textContent = 'Responsive percentage scale (10% to 200%).';
					} else {
						sizeInput.min = '20';
						sizeInput.max = '400';
						sizeInput.step = '1';
						var newPx = Math.min(400, Math.max(20, Math.round(60 * (curVal / 100))));
						sizeInput.value = newPx;
						if (sizeHint) sizeHint.textContent = 'Fixed pixel size (20px to 400px+).';
					}
					updateLoaderSize();
				}
			});
		});

		// Initialise size preview
		updateLoaderSize();

		var radiusInput = document.getElementById('preloadx_loader_radius');
		var radiusBadge = document.getElementById('preloadx-radius-val');
		if (radiusInput) {
			radiusInput.addEventListener('input', function() {
				if (radiusBadge) radiusBadge.textContent = this.value + 'px';
				document.documentElement.style.setProperty('--preloader-radius', this.value + 'px');
			});
			document.documentElement.style.setProperty('--preloader-radius', radiusInput.value + 'px');
		}

		var fontInput = document.getElementById('preloadx_font_size');
		var fontBadge = document.getElementById('preloadx-font-val') || document.getElementById('preloadx-font-size-val');
		if (fontInput) {
			fontInput.addEventListener('input', function() {
				if (fontBadge) fontBadge.textContent = this.value + 'px';
				document.documentElement.style.setProperty('--preloader-font-size', this.value + 'px');
			});
			document.documentElement.style.setProperty('--preloader-font-size', fontInput.value + 'px');
		}

		// Modern Tab Switching
		var tabs = document.querySelectorAll('.preloadx-tabs .nav-tab');
		var tabContents = document.querySelectorAll('.preloadx-tab-content');

		tabs.forEach(function(tab) {
			tab.addEventListener('click', function(e) {
				e.preventDefault();
				tabs.forEach(function(t) { t.classList.remove('nav-tab-active'); });
				tabContents.forEach(function(c) { c.style.display = 'none'; });

				tab.classList.add('nav-tab-active');
				var target = tab.getAttribute('href');
				var targetContent = document.querySelector(target);
				if (targetContent) targetContent.style.display = 'block';
			});
		});

		// Card Selection: Clicking anywhere on a card selects its radio
		$(document).on('click', '.preloadx-card', function() {
			var $radio = $(this).find('input[name="preloadx_selected"]');
			if (!$radio.prop('checked')) {
				$radio.prop('checked', true).trigger('change');
			}
		});

		// Radio change handler: updates card active styling and conditional field visibility
		$(document).on('change', 'input[name="preloadx_selected"]', function() {
			var selected = $(this).val();

			// Update active card styling
			$('.preloadx-card').removeClass('is-selected');
			$(this).closest('.preloadx-card').addClass('is-selected');

			// Hide conditional boxes
			$('#custom-image-input').hide();
			$('#text-reveal-input').hide();

			// Show relevant conditional box
			if (selected === 'custom-image' || selected === 'svg-outline') {
				$('#custom-image-input').slideDown(180);
			} else if (selected === 'text-reveal') {
				$('#text-reveal-input').slideDown(180);
			}
		});

		// Settings Form AJAX Submission
		$('#preloadx-settings-form').on('submit', function(e) {
			e.preventDefault();
			var $btn = $(this).find('.preloadx-save-btn');
			var originalHtml = $btn.html();
			$btn.prop('disabled', true).html('<span class="dashicons dashicons-update spin"></span> Saving...');

			var formData = new FormData(this);
			formData.append('action', 'preloadx_set_options');

			var ajaxEndpoint = (window.preloadxAdmin && window.preloadxAdmin.ajax_url) ? window.preloadxAdmin.ajax_url : (window.ajaxurl || 'admin-ajax.php');

			$.ajax({
				type: 'POST',
				url: ajaxEndpoint,
				dataType: 'json',
				data: Object.fromEntries(formData.entries()),
				success: function(response) {
					$('#preloadx-settings-response-message').hide();
					if (response.success) {
						$('#preloadx-settings-response-message').html('<span class="dashicons dashicons-yes-alt"></span> ' + response.data).removeClass('error').addClass('success').fadeIn();
					} else {
						$('#preloadx-settings-response-message').html('<span class="dashicons dashicons-warning"></span> ' + response.data).removeClass('success').addClass('error').fadeIn();
					}
					setTimeout(function() {
						$('#preloadx-settings-response-message').fadeOut();
					}, 6000);
				},
				error: function() {
					$('#preloadx-settings-response-message').html('<span class="dashicons dashicons-dismiss"></span> An error occurred, please try again.').removeClass('success').addClass('error').fadeIn();
					setTimeout(function() {
						$('#preloadx-settings-response-message').fadeOut();
					}, 6000);
				},
				complete: function() {
					$btn.prop('disabled', false).html(originalHtml);
				}
			});
		});
	});

})( jQuery );
