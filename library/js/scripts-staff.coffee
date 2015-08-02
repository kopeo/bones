do($ = jQuery) ->
  $ ->
    $mb = true
    $owl = null
    $closeHTML = '<button title="%title%" class="mfp-close"><i class="fa fa-close"></i>'
    # POPUP STAFF PROFILE (FOR MOBILE)
    $('.ajax-popup').magnificPopup({
      type: 'ajax',
      disableOn: ->
        return $mb
      ,
      closeMarkup: $closeHTML
      closeBtnInside: false
      fixedContentPos: true
      callbacks:
        ajaxContentAdded: ->
          # $('.mfp-container div.wpcf7 > form').wpcf7InitForm();
          # $form = $(@.content)
          # d = $form.attr("data-default")
          # $form.find("#product").val(d);
          # $form.find(".privacypolicy-body").perfectScrollbar();
          return
    })

    #CHANGE IMAGE SOURCE ON DESKTOP
    changeStaffImg = () ->
      $_c = 0
      $_t = $('#staffList img')
      # load images for desktop
      if ! $mb
        $_t.hide().each ->
          $(@).one "load", ->
            $_c++
            if $_c >= $_t.length
              $_t.show()
              $('#staffList').owlCarousel
                items: 10
                itemsDesktop : [1399, 7]
                itemsDesktopSmall : [1030, 5]
                itemsTablet : [768, 5]
                autoPlay : 2000
                stopOnHover : true
              $owl = $('#staffList').data('owlCarousel')
            return
          .attr('src', $(@).data('large'))
          return
      return

    # LOAD STAFF PROFILE TO HEADER (FOR DESKTOP)
    staffDataLoad = (event) ->
      event.preventDefault()
      console.log "test"
      return

    # REGISTER DESKTOP SCRIPT
    scriptsForDesktop = ->
      $mb = false
      do changeStaffImg

      $('#staffList').on "click", "a", (e) ->
        e.preventDefault()
        $url = $(@).attr('href')
        $container = $('#profile-container')
        $container.addClass('loading').children('.ajax-container').fadeOut()
        $.ajax
            type: "GET"
            url: $url
            dataType: 'html'
            success: (data) ->
              $container.removeClass("loading").addClass("loaded").children('.ajax-container').html($(data).find('.hentry')).fadeIn()
              $.getFooterOffsetY()
              return
            error: (data) ->
              $container.removeClass('loading').children('.ajax-container').fadeIn()
              return
        return false
      return

    # REGISTER MOBILE SCRIPTS
    scriptsForMobile = ->
      $mb = true
      if $owl?
        $('#staffList').data('owlCarousel').destroy()
        $owl = null
      return

    resizeFunctions = ->
      # INITIALIZE
      $('#staffList').off('click')

      # BY WINDOW SIZE
      if Modernizr.mq('(min-width: 768px)')
        do scriptsForDesktop
      else
        do scriptsForMobile
      return

    $(window).resize ->
      do resizeFunctions
      return

    do resizeFunctions

    return
  return