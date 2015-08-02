do($ = jQuery) ->
	$ ->
		$taxP = 0.08

		calcPrice = (e) ->
			# Init Price Data
			$('#course-line .selectedCourse').html("")
			$('#course-line .price').html("-円")
			$('#tax-line .price').html("−円")
			$('#totalPrice').html("−円")
			$('#certificateStamp-line').hide()
			$('#shortTerm-line').hide()
			$('#certificateStamp-line .price').text('-円')
			$('#shortTerm-line .price').text('-円')

			$s = $('[name="course"]:checked')
			$val = parseInt($s.val())
			$total = $val
			$temp = 0
			if($val)
				$tax = Math.round(Number($val * $taxP));
				$total += $tax
				# course
				$('#course-line .selectedCourse').text(" : " + $s.next('label').text())
				# price
				$('#course-line .price').text(Number($val).toLocaleString() + '円')
				# tax
				$('#tax-line .price').text(Number($tax).toLocaleString() + '円')
				# cetificateStamp
				if $s.hasClass('needOpt')
					$('#certificateStamp-line').show()
					if $('#certificateStamp').prop('checked')
						$temp = Number($('#certificateStamp').val())
						$total += $temp
						$('#certificateStamp-line .price').text($temp.toLocaleString() + '円')
				else
					$('#certificateStamp').prop('checked', false)
				# shortTerm
				if $s.hasClass('hasShortCourse')
					$('#shortTerm-line').show()
					if $('#shortTerm').prop('checked')
						$temp = Number($('#shortTerm').val())
						$total += $temp
						$('#shortTerm-line .price').text($temp.toLocaleString() + '円')
				else
					$('#shortTerm').prop('checked', false)
				# total
				$('#totalPrice').text(Number($total).toLocaleString() + '円')

				# 内訳を表示
				$('.totalPrice-detail').slideDown()
			else
				$('#certificateStamp').prop('checked', false)
				$('#shortTerm').prop('checked', false)

			return

		# CALCULATION PRICE
		$('input.calc').on 'click', ->
			do calcPrice
			# Scroll to TotalPriceTable
			if !$(@).hasClass('priceOption')
				target = $('#section-priceTotal')
				position = target.offset().top - 60;
				$("html,body").animate({scrollTop:position}, 400, 'swing');

		# OPTION PRICE Calc Tax
		$('[data-price]').each ->
			$p = Math.round(Number($(@).data('price')) * ($taxP + 1))
			$(@).next('.withTax').text('（税込' + Number($p).toLocaleString() + '円）')
			return

		do calcPrice
		return

