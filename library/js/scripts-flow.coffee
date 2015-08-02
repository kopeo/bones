do($ = jQuery) ->
	$ ->
		# TOGGLE QUESTIONS
		# c:class of the answer which have to open
		toggleCourse = ($c)->
			$TMC = $('#flow-timeline-container')
			$TM = $('#flow-timeline-body').fadeOut 'fast', ->
				$TMC.addClass('loading')
				$other = if $c == 'course-car' then '.course-motorcycle' else '.course-car'
				$TM.find($other).slideUp 'fast', ->
					$TM.find('.' + $c).slideDown 'fast', ->
						$TMC.removeClass('loading')
						$TM.fadeIn()
						return
				return
			return

		# MAIN
		$('#flow-nav').on "click", "a", (e)->
			e.preventDefault()
			$c = $(@).data('course')
			toggleCourse($c)
			$('#flow-nav').find('a.btn__green').addClass("btn__gray").removeClass("btn__green")
			$(@).removeClass("btn__gray").addClass("btn__green")
			return

			return