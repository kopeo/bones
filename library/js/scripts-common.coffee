###
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
###
###
SKROLLR
モバイルでは難しい。。。
###
# s = skrollr.init({forceHeight: false});
# console.log "test"
###
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
###
updateViewportDimensions = ->
  w = window
  d = document
  e = d.documentElement
  g = d.getElementsByTagName('body')[0]
  x = w.innerWidth||e.clientWidth||g.clientWidth
  y = w.innerHeight||e.clientHeight||g.clientHeight
  return {} =
    width : x
    height : y
# setting the viewport width
viewport = updateViewportDimensions();

###
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
###
# waitForFinalEvent = do ->
#   console.log "wait"
#   timers = {};
#   (callback, ms, uniqueId) ->
#     if !uniqueId
#       uniqueId = "Don't call this twice without a uniqueId"
#     if timers[uniqueId]
#       clearTimeout timers[uniqueId]
#     timers[uniqueId] = setTimeout callback, ms
#     return

footerOffsetY = 0
###
JQUERY CAPCEL
###
do($ = jQuery) ->
  ###
  resizeやscrollを指定時間経過後に１回だけ実行する
  ###
  $.extend({
    waitForFinalEvent2 : do ->
      timers = {};
      (callback, ms, uniqueId) ->
        if !uniqueId
          uniqueId = "Don't call this twice without a uniqueId"
        if timers[uniqueId]
          clearTimeout timers[uniqueId]
        timers[uniqueId] = setTimeout callback, ms
        return
    getFooterOffsetY : ->
      # console.log "footer:" + $(".footer").outerHeight(true)
      # console.log "document:" + $(document).height()
      footerOffsetY = $(document).height() - $(".footer").outerHeight(true) # - $gotoTop.outerHeight(true)
      return
  });
  ###
   * We're going to swap out the gravatars.
   * In the functions.php file, you can see we're not loading the gravatar
   * images on mobile to save bandwidth. Once we hit an acceptable viewport
   * then we can swap out those images since they are located in a data attribute.
  ###
  loadGravatars = ->
    # set the viewport using the function above
    viewport = updateViewportDimensions();
    # if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768)
      $('.comment img[data-gravatar]').each ->
        $(this).attr('src',$(this).attr('data-gravatar'))
  # end function

  ###
  outer click
  ###
  removeOuterCallback = (obj) ->
    obj.removeClass("outer")
    return

  $ocL = $("#outerClickLayer")
  $ocL.on 'click', ->
    $(@).hide()
    $closeObj = $(".outer")
    e = $(@).data('effect')
    switch (e)
      when "slideSide"
        $closeObj.stop().animate 'right' : "-" + $SMW, ->
          $closeObj.hide()
          removeOuterCallback($closeObj)
          return
      else
        $closeObj.stop().slideUp removeOuterCallback($closeObj)
    # $(window).off 'touchmove.noScroll'
    return
  $.fn.showOuterClickLayer = (opt) ->
    $ocL.css('height', $("#container").outerHeight(true)).show()
    # effect
    effect = if opt? then opt else "slideUp"
    $ocL.data 'effect', effect
    $(@).addClass "outer"
    # $(".mobile .subPageList>ul").perfectScrollbar();
    # touch scroll off
    $(window).on 'touchmove.noScroll', (e) ->
      # e.preventDefault();
      return
    return

  ###
  jQuery image is loaded check
  ###
  $.fn.isLoaded = ->
    this.filter("img").filter ->
      this.complete
    .length > 0

  $gotoTop = $("#gotoTop")
  $pf = $('#product-footer-nav')
  $HH = $('.home .header')
  $SM = $("#side-menu")
  $SMW = ""
  ###
   * Put all your regular jQuery in here.
  ###

  $ ->
    ###
     * Let's fire off the gravatar function
     * You can remove this if you don't need it
    ###
    loadGravatars()

    ###
    SMOOTH SCROLL
    ###
    $('a:empty').css({display: 'block'});
    $('.smooth a[href^=#]').on 'click', ->
      speed = 400;
      href= $(@).attr("href");
      target = $(@.hash);
      position = target.offset().top - 60;
      $("html,body").animate({scrollTop:position}, speed, 'swing');
      return false;

    ###
    SCROLL FINISHED BIND
    ###
    timerId = 0
    floatingMenu = (s) ->
      # ロード後のscriptなどでheightが変わることがあるため、毎回実施
      $.getFooterOffsetY()

      # if footerOffsetY == 0
      #   $.getFooterOffsetY()
      # console.log $(window).outerHeight(true) + "-" + footerOffsetY
      # console.log "innerH:" + window.innerHeight
      # console.log "jqueryH:" + $(window).outerHeight(true)
      y = if window.innerHeight then window.innerHeight else $(window).outerHeight(true)
      # console.log $(window).outerHeight(true);
      y = s + y - footerOffsetY
      d = 20
      if $pf?
        d += $pf.outerHeight(true)
      $_to = if y < 0 then d else d + y
      $gotoTop.css( 'bottom', $_to + "px")
      if $pf?
        $_to = if y < 0 then 0 else y
        $pf.css 'bottom', $_to
        $pf.fadeIn();
      if s > 300
        $gotoTop.fadeIn()
      return

    ###
    HEADER CONTROL
    ###
    #   スクロールでトップページ用ナビゲーションがヘッダに隠れると通常ナビゲーションが現れるように
    #   さらに、ヘッダの高さをトップページ用から通常サイズへ
    #   同時にサイドメニューのトリガーの位置調整も行う。
    showSideMenuTrigger = ->
      $y = $('.header').outerHeight() + 21;
      $('#side-menu-trigger').css("top", $y).fadeIn();
      return
    headerControl = (s) ->
      if $HH.length
        $n = $('.head-nav')
        $('.head-branding').animate {'height': if s > 200 then 80 else 300 }, ->
          # if $('.header').offset().top > 10000
          if $('.frontPage-nav').offset().top - $('.header').outerHeight()  < s
            if !$n.hasClass("bond")
              $('.head-nav').slideDown 'fast', ->
                $n.addClass("bond")
                do showSideMenuTrigger
                return
            else
              do showSideMenuTrigger
          else
            if $n.hasClass("bond")
              $('.head-nav').slideUp 'fast', ->
                $n.removeClass("bond")
                do showSideMenuTrigger
                return
            else
              do showSideMenuTrigger
          return
      else
        do showSideMenuTrigger
      return
    headerControl 0

    ###
    READ MORE
    ###
    $('.readMore').each ->
      $(@).css 'position','relative'
      str = ($(@).find('p').first().html())
      str = str.substr(0, 8) + "..."
      $(@).find('p').css(
        'position': 'relative'
        'top': '-21px'
      ).hide()
      $(@).prepend($('<a href="javascript:void(0)">').addClass('trigger-readMore').css(
        'position': 'relative'
      ).html(str))
      return
    $('.readMore').on 'click', '.trigger-readMore', ->
      $(@).fadeOut ->
        $(@).nextAll('p').css(
          'position': 'static'
          'top': 0
        )
        return
      $(@).nextAll('p').each ->
        $(@).slideDown()
        return
      return

    # スクロール停止イベントのバインド
    $(window).on 'scrollFinish', (event, scrollTop) ->
      # メニュー移動処理呼び出し
      floatingMenu(scrollTop)
      return
    # スクロールイベントのバインド
    $(window).on 'scroll', ->
      scrollTop = $(document).scrollTop();
      $gotoTop.stop().hide()
      $pf.stop().hide()
      if (timerId)
        clearTimeout(timerId);
      # 1秒間スクロールしない場合はscrollFinishイベントを呼び出し
      timerId = setTimeout ->
        timerId = null;
        $(window).trigger("scrollFinish", [scrollTop]);
      , 500
      return

    $(window).unload ->
      $(window).unbind "scroll scrollFinish"
      return

    ###
    MAGIC POPUP
    ###
    #dialog
    # $closeHTML = '<button title="%title%" class="mfp-close"><i class="gi gi-close-alt"></i>'
    # $('.popup-dialog-trigger').magnificPopup({
    #   type: 'inline',
    #   fixedContentPos: false,
    #   fixedBgPos: true,
    #   overflowY: 'auto',
    #   closeBtnInside: true,
    #   preloader: false,
    #   midClick: true,
    #   removalDelay: 300,
    #   mainClass: 'my-mfp-zoom-in'
    # })

    # #popup window
    # $('.popup-inline-trigger').magnificPopup({
    #   type: 'inline',
    #   preloader: false,
    #   focus: '#name',
    #   closeBtnInside: false,
    #   closeMarkup: $closeHTML,
    #   removalDelay: 300,
    #   mainClass: "mfp-fade",
    #   # When elemened is focused, some mobile browsers in some cases zoom in
    #   # It looks not nice, so we disable it:
    #   callbacks: {
    #     beforeOpen: ->
    #       if $(window).width() < 700
    #         this.st.focus = false;
    #       else
    #         this.st.focus = '#name';
    #       return
    #   }
    # })

    #popup form
    # $('.form-ajax-popup').magnificPopup({
    #   type: 'ajax',
    #   closeMarkup: $closeHTML
    #   closeBtnInside: false
    #   fixedContentPos: true
    #   callbacks:
    #     ajaxContentAdded: ->
    #       $('.mfp-container div.wpcf7 > form').wpcf7InitForm();
    #       $form = $(@.content)
    #       d = $form.attr("data-default")
    #       $form.find("#product").val(d);
    #       $form.find(".privacypolicy-body").perfectScrollbar();
    #       return
    # })

    # #popup gallery
    # $('.gallery').magnificPopup({
    #   delegate: "a"
    #   type: "image"
    #   closeOnContentClick: false
    #   closeMarkup: $closeHTML
    #   closeBtnInside: false
    #   mainClass: "mfp-with-zoom mfp-img-mobile"
    #   image: {
    #     verticalFit: true
    #     titleSrc: (item) ->
    #       item.el.attr('title') + '&middot; <a class="image-source-link" href="' + item.el.attr('data-source') + '" target="_blank">image source</a>'
    #   }
    #   gallery: {
    #     enabled: true
    #   }
    #   zoom: {
    #     enabled: true
    #     duration: 300
    #     opener: (element) ->
    #       element.find('img')
    #   }
    # })

    ###
    CAROUSEL
    ###
    $(".owl-carousel1").owlCarousel({
      items: 1
      itemsDesktop: [1029, 1]
      itemsDesktopSmall: false
      itemsTablet: [768, 1]
      itemsMobile: [479, 1]
      navigation: true
      navigationText: ['&lt;', '&gt;']
      afterInit: ->
        return
    })

    activateSubMenu = (r) ->
      c = "nav-itemOutline"
      $r = $(r)
      id = $r.attr('id')
      o_anchor = $r.children('a.subItem')
      if o_anchor.length
        # o_target = o_anchor.closest('.childMenu-container').children('.nav-itemOutline').html("")
        o_img = "/wp-content/themes/azis/library/images/" + id + ".jpg"
        if !$r.children('.' + c).length && o_anchor.length > 0 then $r.append($("<div>").addClass(c))
        o_target = $r.children('.' + c)
        # o_target = if ($r.children('.' + c).length) then $r.children('.' + c) else $r.append($("<div>").addClass(c))
        if (!$r.children(c).html())
          # console.log("HTML hasn't set")
          if o_target.children('a').length == 0 then o_target.append('<a href="' + o_anchor.attr('href') + '" style="background-image: url(' + o_img + ');">
        <p>' + o_anchor.attr('title') + '</p></a>')
        # o_img = "/wp-content/themes/azis/library/images/thumb-#{id}.jpg"
        $parent = $r.parent()
        o_target.css(
          top: 0
          left: $parent.outerWidth()
          height: $parent.outerHeight()
        )

        if ($("<img/>").attr('src', o_img).isLoaded)
          # console.log('image has been loaded')
          o_target.hide().stop().fadeIn('fast')
        else
          # console.log('now loading')
          o_figure = o_target.children('figure')
          o_figure.addClass("loading")
          # preload
          $('<img/>').load o_img, (response, status, xhr) ->
            if (status != "error")
              # console.log('image has just loaded')
              $(@).remove() #memory leaks
              o_figure.removeClass("loading")
            else
              o_target.html('<a href="javascript:void(0)"><p>エラー。再度お試しください。</p></a>')
            return
      o_anchor.addClass("aimHover")
      return
    #end of function

    deactivateSubMenu = (r) ->
      # console.log("let's hide!")
      $(r).children(".nav-itemOutline").hide()
      $(r).children("a.subItem").removeClass("aimHover")
      return
    #end of function

    ###
    SIDEMENU
    ###
    # OPEN SIDE MENU
    $("#side-menu-trigger").on 'click', ->
      # set height
      # h = if $(window).innerHeight() then $(window).innerHeight() else $(window).height
      # $mobileMenu.children('ul').css 'height', h - $(@).outerHeight(true) - 80
      # show panel
      $SM.css({
        'width': $SMW,
        'right': "-" + $SMW
      }).show().stop().animate 'right': 0
      $SM.showOuterClickLayer("slideSide")
      return
    # CLOSE SIDE MENU
    closeMenuPanel = ->
      $SM.animate 'right' : "-" + $SMW
      $ocL.hide()
      return
    $SM.on 'swiperight', closeMenuPanel
    $(".closeButton").on 'tap click', closeMenuPanel


    ###
      header menu bind for desktop
    ###
    scriptsForDesktop = ->
      $(window).on 'scrollFinish', (event, scrollTop) ->
        headerControl(scrollTop)
        return
      $(window).on 'scroll', ->
        $('#side-menu-trigger').fadeOut();

      # $(".subPageList").children("ul").css 'height', "auto"
      # $(".nav").on(
      #   mouseenter: ->
      #     $(@).addClass("hover")
      #     targetID = $(@).data("dropdownContentId")
      #     if (targetID)
      #       $subMenu = $("#" + targetID)
      #     else
      #       $subMenu = $(@).children(".childMenu-container")
      #       $('#header-searchbox-container').stop().slideUp ->
      #           $("#header-searchbox-container .search-field").blur()
      #           return
      #     $('.parentMenu').not(@).removeClass("hover").children(".childMenu-container").stop().slideUp()
      #     if ($subMenu.css("display") == "none")
      #       $(".nav-itemOutline").hide()
      #       $(".aimHover").removeClass "aimHover"
      #       $subMenu.stop().slideDown 'fast', ->
      #         # forcus search box
      #         if targetID == "header-searchbox-container"
      #           $("#header-searchbox-container .search-field").focus()
      #         return
      #       activateSubMenu($(@).find("li").first().get(0)) #初期選択項目をset
      #       # console.log(obj.get(0))
      #       $subMenu.showOuterClickLayer()
      #     return
      #   # mouseleave: ->
      #   #   # $(@).children(".childMenu-container").stop().slideUp()
      #   #   return
      # , ".parentMenu")

      # $(".childMenu").menuAim(
      #   activate: activateSubMenu
      #   deactivate: deactivateSubMenu
      # )
      return

    scriptsForMobile = ->
      # On mobile, SIDE MENU TRIGGER is always needed!
      $('#side-menu-trigger').show();
      return

    ###
    GET WINDOW SIZE
    ###
    initBasedOnScreen = ->
      # 一旦バインド系をクリアする
      # $("#mobile-menu-trigger").off()
      # $(".nav").off()
      $(window).off "scrollFinish"

      # position re-get
      $.getFooterOffsetY()

      # scripts by window size
      # SET SIDE MENU WIDTH
      if Modernizr.mq('(min-width: 768px)')
        $SMW = "400px"
        do scriptsForDesktop
      else
        $SMW = "80%"
        do scriptsForMobile
      return


    do initBasedOnScreen

    ###
    GALLERY POSITIVE ALPHA
    ###
    # $gallery = $('.img-group')
    # $gallery.on {
    #   'mouseover': ->
    #     # console.log "on"
    #     $(@).parents(".img-group").find("img").not(this).stop().fadeTo(300,0.5);
    #     return
    #   'mouseleave': ->
    #     # console.log "off"
    #     $gallery.find("img").not(this).stop().fadeTo(300,1);
    #     return
    # }, 'img'


    $(window).resize ->
      # console.log "resize"
      $.waitForFinalEvent2 initBasedOnScreen, 200
      $.getFooterOffsetY()
      return

    return #end ready function

  ###
  WINDOW ON LOAD EVENT
  ###
  $(window).load ->
    $.getFooterOffsetY()

    return #eof window.load events

  return #eof jquery capcel





