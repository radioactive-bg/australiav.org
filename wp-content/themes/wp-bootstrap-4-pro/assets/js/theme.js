// Set all carousel items to the same height
function carouselNormalization() {
  (window.heights = []), //create empty array to store height values
    window.tallest; //create variable to make note of the tallest slide
  function normalizeHeights() {
    jQuery(
      ".section-testimonial .carousel-item, .section-hero-slider .carousel-item"
    ).each(function () {
      //add heights to array
      window.heights.push(jQuery(this).outerHeight());
    });
    window.tallest = Math.max.apply(null, window.heights); //cache largest value
    jQuery(
      ".section-testimonial .carousel-item, .section-hero-slider .carousel-item"
    ).each(function () {
      jQuery(this).css("min-height", tallest + "px");
    });
  }
  normalizeHeights();
  jQuery(window).on("resize orientationchange", function () {
    (window.tallest = 0), (window.heights.length = 0); //reset vars
    jQuery(
      ".section-testimonial .carousel-item, .section-hero-slider .carousel-item"
    ).each(function () {
      jQuery(this).css("min-height", "0"); //reset min-height
    });
    normalizeHeights(); //run it again
  });
}

jQuery(document).ready(function (jQuery) {
  "use strict";
  // For changing body class on scroll

  jQuery(window).on("scroll resize", function () {
    var headerHeight = jQuery("#masthead").outerHeight();
    var sectionHeight = jQuery("#hero, .full-page-header").outerHeight();
    if (!jQuery("body").hasClass("page-id-488xxxxxxx") == true) {
      if (jQuery("#hero, .full-page-header").length) {
        var calculateHeight = sectionHeight - headerHeight;
      }
    } else {
      var calculateHeight = 0;
    }
    // Default was 250
    if (jQuery(window).scrollTop() >= calculateHeight) {
      jQuery(".trans-header").addClass("body-scrolled");
    } else {
      return jQuery(".trans-header").removeClass("body-scrolled");
    }
  });

  // Dropdown toggle
  jQuery(".dropdown-menu .dropdown-toggle").on("click", function (e) {
    if (!jQuery(this).next().hasClass("show")) {
      jQuery(this)
        .parents(".dropdown-menu")
        .first()
        .find(".show")
        .removeClass("show");
    }
    var $subMenu = jQuery(this).next(".dropdown-menu");
    $subMenu.toggleClass("show");

    jQuery(this)
      .parents("li.nav-item.dropdown.show")
      .on("hidden.bs.dropdown", function (e) {
        jQuery(".dropdown-submenu .show").removeClass("show");
      });

    return false;
  });
  jQuery(".btn-search").on("click", function (e) {
    jQuery(".dropdown-search").slideToggle();
    jQuery("#search").focus();
  });
  // Soft scroll to anchor on nav links
  if (jQuery("header").hasClass("sticky-top")) {
    var headerHeight = jQuery("header").height();
    var ofset = headerHeight;
  } else {
    var ofset = 0;
  }

  jQuery('.nav-link:not([data-toggle="tab"])').on("click", function (event) {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = jQuery(this.hash);
      target = target.length
        ? target
        : jQuery("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        event.preventDefault();
        jQuery("html, body").animate(
          {
            scrollTop: target.offset().top - ofset,
          },
          1000,
          function () {
            var $target = jQuery(target);
            $target.focus();
            if ($target.is(":focus")) {
              return false;
            } else {
              $target.attr("tabindex", "-1");
              $target.focus();
            }
          }
        );
      }
    }
  });
  jQuery('.nav-link[href^="#"]').on("click", function (event) {
    if (jQuery(".navbar-collapse").hasClass("show") == true) {
      jQuery(".navbar-collapse").removeClass("show");
    }
  });
  var hostname = jQuery(location).attr("hostname");
  var protocol = jQuery(location).attr("protocol");
  var protocolsufix = "//";
  var string = "/";
  var hash = jQuery(location).attr("hash");

  if (!jQuery("body").hasClass("home") == true) {
    jQuery("header .nav-link").hover(
      function () {
        var href = jQuery(this).attr("href"); // Get the href attribute
        if (href && href.indexOf(hostname) === -1) {
          jQuery(this).attr("href", function (index, attr) {
            return attr.replace(
              hash,
              protocol + protocolsufix + hostname + string + hash
            );
          });
        }
      },
      function () {
        var href = jQuery(this).attr("href"); // Get the href attribute
        if (href && href.indexOf(hostname) === -1) {
          jQuery(this).attr("href", function (index, attr) {
            return attr.replace(
              protocol + protocolsufix + hostname + string + hash,
              hash
            );
          });
        }
      }
    );
  }
  // Add smooth scrolling to all links
  // Select all links with hashes
  var $root = jQuery("html, body");
  jQuery(
    'section a[href^="#"]:not([data-toggle]):not([role="button"]):not([data-toggle="tab"])'
  ).click(function (event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = jQuery(this.hash);
      target = target.length
        ? target
        : jQuery("[name=" + this.hash.slice(1) + "]");
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        var ofset = jQuery("header").outerHeight();
        $root.animate(
          {
            scrollTop: target.offset().top - ofset,
          },
          1000,
          function () {
            // Callback after animation
            // Must change focus!
            var $target = jQuery(target);
            $target.focus();
            if ($target.is(":focus")) {
              // Checking if the target was focused
              return false;
            } else {
              $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            }
          }
        );
      }
    }
  });

  // Set all carousel items to the same height
  carouselNormalization();

  // Bootstrap slider Animation
  function bootstrapAnimatedLayer() {
    function doAnimations(elems) {
      //Cache the animationend event in a variable
      var animEndEv = "webkitAnimationEnd animationend";
      elems.each(function () {
        var $this = jQuery(this),
          $animationType = $this.data("animation");
        $this.addClass($animationType).one(animEndEv, function () {
          $this.removeClass($animationType);
        });
      });
    }
    //Variables on page load
    var $myCarousel = jQuery("#hero_slider"),
      $firstAnimatingElems = $myCarousel
        .find(".carousel-item:first")
        .find("[data-animation ^= 'animated']");
    //Initialize carousel
    //$myCarousel.carousel();
    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);
    //Other slides to be animated on carousel slide event
    $myCarousel.on("slide.bs.carousel", function (e) {
      var $animatingElems = jQuery(e.relatedTarget).find(
        "[data-animation ^= 'animated']"
      );
      doAnimations($animatingElems);
    });
  }
  bootstrapAnimatedLayer();
});

// Arrow on scroll up and down
if (document.getElementById("onTop")) {
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("onTop").style.cssText =
        "opacity: 1; visibility: visible";
    } else {
      document.getElementById("onTop").style.cssText =
        "opacity: 0; visibility: hidden";
    }

    prevScrollpos = currentScrollPos;
    if (window.innerHeight + window.scrollY >= document.body.scrollHeight) {
      document.getElementById("onTop").style.cssText =
        "opacity: 1; visibility: visible";
    }
    if (window.innerHeight + window.pageYOffset == window.innerHeight) {
      document.getElementById("onTop").style.cssText =
        "opacity: 0; visibility: hidden";
    }
  };
}

// Parallax Variant 1
(function () {
  window.addEventListener("scroll", function () {
    var depth, i, layer, layers, len, movement, topDistance, translate3d;
    topDistance = this.pageYOffset;
    layers = document.querySelectorAll("[data-type='parallax']");
    for (i = 0, len = layers.length; i < len; i++) {
      layer = layers[i];
      depth = layer.getAttribute("data-depth");
      movement = topDistance * depth;
      translate3d = "translate3d(0, " + movement + "px, 0)";
      layer.style["-webkit-transform"] = translate3d;
      layer.style["-moz-transform"] = translate3d;
      layer.style["-ms-transform"] = translate3d;
      layer.style["-o-transform"] = translate3d;
      layer.style.transform = translate3d;
    }
  });
}).call(this);

// Parallax Variant 2
var winScrollTop = 0;
jQuery.fn.is_on_screen = function () {
  var win = jQuery(window);
  var viewport = {
    top: win.scrollTop(),
    left: win.scrollLeft(),
  };
  //viewport.right = viewport.left + win.width();
  viewport.bottom = viewport.top + win.height();

  var bounds = this.offset();
  //bounds.right = bounds.left + this.outerWidth();
  bounds.bottom = bounds.top + this.outerHeight();

  return !(viewport.bottom < bounds.top || viewport.top > bounds.bottom);
};

function parallax() {
  var scrolled = jQuery(window).scrollTop();
  jQuery(".parallax-section").each(function () {
    if (jQuery(this).is_on_screen()) {
      var firstTop = jQuery(this).offset().top;
      var img = jQuery(this).find("img");
      var div = jQuery(this).find(".parralax-content");
      var speed = img.data("speed");
      var divSpeed = div.data("speed");
      var imgMoveTop = (firstTop - winScrollTop) * speed;
      var divMoveTop = (firstTop - winScrollTop) * divSpeed;
      img.css(
        "transform",
        "translateY(" + -imgMoveTop + "px) translateX(-50%)"
      );
      div.css(
        "transform",
        "translateY(" + -divMoveTop + "px) translateX(-50%)"
      );
    }
  });
}

jQuery(window).scroll(function (e) {
  winScrollTop = jQuery(this).scrollTop();
  parallax();
});
