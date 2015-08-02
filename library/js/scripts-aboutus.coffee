do($ = jQuery) ->
	$ ->
		# GOOGLE MAP
		$M = $('#gMap')

		# Resize map block
		resize_mapHeight = ->
			$H = $('#information-data').outerHeight(true)
			$wH = if window.innerHeight then window.innerHeight else $(window).outerHeight(true)
			if $wH < $H
				$H = $wH - 100
			$M.css 'height', $H
			return

		do resize_mapHeight

		$(window).resize ->
			do resize_mapHeight
			return

		$M.googleMap
			zoom: 14
		$M.addMarker
			coords: [34.1752344, 133.7191052] # Map center (optional)
			type: "ROADMAP" #  Map type (optional)
			title: '高瀬自動車学校'
			# text: '<img src="/wp-content/theme/images/gmap-content.jpg" alt="高瀬自動車学校">'

		return