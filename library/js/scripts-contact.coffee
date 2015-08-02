do($ = jQuery) ->
	$ ->
		$formNav = $('.form-nav')
		changeTab = (id) ->
			$t = $('#' + id)
			# CHANGE BUTTON STATUS
			if $t.length
				$formNav.find('a').not($t).removeClass("btn__blue").addClass('btn__gray')
				$t.removeClass('btn__gray').addClass('btn__blue')
				$class = $t.data('target')
				$('.form-item').each ->
					if $(@).hasClass($class)
						$(@).stop().fadeIn()
					else
						$(@).stop().hide()
					return
			return

		$formNav.on 'click', 'a', ->
			changeTab $(@).attr('id')
			return

		changeTab "trigger-contact"
		return
	return