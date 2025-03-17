jQuery(document).ready(function () {
  var lang = jQuery("html").attr("dir");
  var rtl = false;
  if (lang === "rtl") {
    rtl = true;
  }
  if (jQuery(".carousel-slider").length) {
    jQuery(".carousel-slider").slick({
      dots: false,
      infinite: true,
      //adaptiveHeight: true,
      autoplaySpeed: "5000",
      speed: "500",
      pauseOnHover: false,
      autoplay: true,
      // rows: 1,
      // slidesPerRow: 1,
      slidesToShow: 4,
      slidesToScroll: 1,
      draggable: true,
      fade: false,
      focusOnSelect: true,
      centerMode: true,
      centerPadding: "100px",
      //appendArrows: '.button-container',
      arrows: true,
      rtl: rtl,
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            centerPadding: "80px",
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            centerPadding: "80px",
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            centerPadding: "60px",
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerPadding: "50px",
          },
        },
      ],
    });
  }
  if (jQuery(".hero-slider").length) {
    var $slider = jQuery(".hero-slider")
      .on("init", function (slick) {
        jQuery(".hero-slider").fadeIn(1000);
      })
      .slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        lazyLoad: "ondemand",
        autoplaySpeed: 5000,
        fade: false,
        speed: "800",
        pauseOnHover: false,
        focusOnSelect: true,
        draggable: true,
        dots: true,
        //asNavFor: '.hero-thumbs',
        rtl: rtl,
      });
    var $heroThumbs = jQuery(".hero-thumbs")
      .on("init", function (slick) {
        jQuery(".hero-thumbs").fadeIn(1000);
      })
      .slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        lazyLoad: "ondemand",
        //asNavFor: '.hero-slider',
        dots: false,
        arrows: false,
        centerMode: false,
        focusOnSelect: true,
        infinite: false,
      });
  }
  if (jQuery(".slick-single").length) {
    var $sliderMarquee = jQuery(".slick-single")
      .on("init", function (slick) {
        jQuery(".slick-single").fadeIn(1000);
      })
      .slick({
        speed: 500,
        autoplay: false,
        autoplaySpeed: 5000,
        centerMode: true,
        centerPadding: "0px",
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
        infinite: true,
        initialSlide: 1,
        pauseOnHover: false,
        draggable: true,
        focusOnSelect: false,
        arrows: true,
        dots: true,
        rtl: rtl,
      });
  }
  if (jQuery(".slick-marquee, .slick-marquee-rtl").length) {
    jQuery(".slick-marquee, .slick-marquee-rtl").each(function (index) {
      var $currentSlider = jQuery(this); // Store reference to the current slider
      var isRtl = $currentSlider.hasClass("slick-marquee-rtl");

      // Set custom delay based on index
      var customDelay = index == 2 ? 0 : 0;

      setTimeout(function () {
        $currentSlider
          .on("init", function () {
            $currentSlider.fadeIn(1000);
          })
          .slick({
            speed: 30000,
            autoplay: true,
            autoplaySpeed: 0,
            centerMode: true,
            centerPadding: "0px",
            cssEase: "linear",
            slidesToShow: 1,
            slidesToScroll: 1,
            variableWidth: false,
            infinite: true,
            initialSlide: 1,
            pauseOnHover: false,
            draggable: false,
            focusOnSelect: false,
            arrows: false,
            buttons: false,
            rtl: isRtl, // Set rtl based on the class
          });
      }, customDelay);
    });
  }

  if (jQuery(".thumbs-slider").length) {
    var $thumbSlider = jQuery(".thumbs-slider")
      .on("init", function (slick) {
        jQuery(".thumbs-slider").fadeIn(1000);
      })
      .slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        lazyLoad: "ondemand",
        autoplaySpeed: 10000,
        fade: true,
        speed: "300",
        pauseOnHover: false,
        focusOnSelect: true,
        draggable: true,
        rtl: rtl,
        asNavFor: ".thumbs-nav, .thumbs-img-slider",
        responsive: [
          {
            breakpoint: 767,
            settings: {
              autoplay: true,
              dots: true,
            },
          },
        ],
      });

    var $ThumsImgWrapper = jQuery(".thumbs-img-slider");
    var $thumbSliderImg = jQuery($ThumsImgWrapper)
      .on("init", function (slick) {
        jQuery($ThumsImgWrapper).fadeIn(1000);
      })
      .slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        lazyLoad: "ondemand",
        fade: false,
        speed: "300",
        pauseOnHover: false,
        focusOnSelect: true,
        draggable: true,
        rtl: rtl,
        //swipe: false,
        asNavFor: ".thumbs-nav, .thumbs-slider",
        centerMode: false,
        centerPadding: "0px",
        responsive: [
          {
            breakpoint: 767,
            settings: {
              fade: true,
            },
          },
        ],
      });

    var $thumbs = jQuery(".thumbs-nav")
      .on("init", function (slick) {
        jQuery(".thumbs-nav").fadeIn(1000);
      })
      .slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        lazyLoad: "ondemand",
        asNavFor: ".thumbs-slider, .thumbs-img-slider",
        dots: false,
        arrows: false,
        centerMode: false,
        focusOnSelect: true,
        infinite: false,
      });
  }
  if (jQuery(".features-slider").length) {
    jQuery(".features-slider").slick({
      dots: true,
      arrows: false,
      infinite: true,
      //adaptiveHeight: true,
      autoplaySpeed: "5000",
      speed: "800",
      pauseOnHover: false,
      autoplay: true,
      // rows: 1,
      // slidesPerRow: 1,
      slidesToShow: 6,
      slidesToScroll: 6,
      draggable: true,
      fade: false,
      focusOnSelect: true,
      centerMode: false,
      centerPadding: "300px",
      //appendArrows: '.button-container',
      arrows: true,
      rtl: rtl,
      responsive: [
        {
          breakpoint: 1600,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
            centerPadding: "100px",
          },
        },
        {
          breakpoint: 1399,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
            centerPadding: "100px",
          },
        },
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            centerPadding: "300px",
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            centerPadding: "200px",
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            centerPadding: "100px",
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerPadding: "10px",
          },
        },
      ],
    });
  }
});
