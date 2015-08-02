do($ = jQuery) ->
	$ ->
		$('.jqui-accordion').accordion(
			active: false
			collapsible: true
			heightStyle: 'content'
		)
		$('.jqui-tabs').tabs(
			active: false
			collapsible: true
			show: 500
		)
		$('.jqui-tt').tooltip()

		# OPEN / CLOSE DD tag
		# INITIALIZE
		$('.accordion-dl').children('dd').hide()
		$('.accordion-dl').on
			'mouseenter': ->
				$(@).addClass('hover')
				return
			'mouseleave': ->
				$(@).removeClass('hover')
				return
			'click': ->
				if !$(@).hasClass('active')
					$(@).children('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up')
					$(@).next('dd').stop().slideDown ->
						$(@).prev('dt').addClass('active')
						return
				else
					$(@).children('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down')
					$(@).next('dd').stop().slideUp ->
						$(@).prev('dt').removeClass('active')
						return
				return
		, 'dt'

		return