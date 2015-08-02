do($ = jQuery) ->
	$ ->

		# TOGGLE QUESTIONS
		# c:class of the answer which have to open
		toggleQuestions = ($c)->
			$FAQC = $('#faq-body-container')
			$FAQ = $('#faq-body').fadeOut 'fast', ->
				$FAQC.addClass('loading')
				if !$c
					$FAQ.children('li').slideDown 'fast', ->
						$FAQC.removeClass('loading')
						$FAQ.fadeIn()
						return
				else
					$FAQ.children('li:not(".' + $c + '")').slideUp 'fast', ->
						$FAQ.children('li.' + $c).slideDown 'fast', ->
							$FAQC.removeClass('loading')
							$FAQ.fadeIn()
							return
						return
				return
			return

		# MAIN
		$('#faq-nav').on "click", "a", (e)->
			e.preventDefault()
			$c = $(@).data('tag')
			toggleQuestions($c)
			$('#faq-nav').find('a.btn__green').addClass("btn__gray").removeClass("btn__green")
			$(@).removeClass("btn__gray").addClass("btn__green")
			return


		return