<?php function add_inline_scripts_to_footer(){ 
if ( is_single() ) { ?>
	<script id="toc" type="text/javascript"> 
	/* ---Table of Contents Js ---*/
	window.addEventListener('DOMContentLoaded', (event) => {
	const article = document.getElementById("article-content");
	const headings = article.querySelectorAll("h2, h3");
	const toc = document.getElementById("toc");
	const totalHeadings = headings.length;
	let tocOl = document.createElement("ul");
	let tocFragment = new DocumentFragment();
	let mainLi = null;
	let subUl = null;
	let subLi = null;
	let isSibling = false;

	if(totalHeadings > 1) {
	for (let element of headings) {
		let anchor = document.createElement("button");
		let anchorText = element.innerText;
		anchor.innerText = anchorText;
		let elementId = anchorText.replaceAll(" ", "-").toLowerCase();
		//anchor.href = "#" + elementId;
		element.id = elementId;
		let level = element.nodeName;
		anchor.addEventListener("click", (e) => {
			//e.preventDefault();
			smoothScroll(elementId);
		});
		function smoothScroll(elementId){
		const elementScroll = document.getElementById(elementId);
		var navbarOffset = 66;
		var elementPosition = elementScroll.getBoundingClientRect().top;
		var offsetPosition = elementPosition + window.pageYOffset - navbarOffset;
			 // Check if Lenis is initialized
			if (typeof lenis !== "undefined") {
				lenis.scrollTo(offsetPosition); // Use Lenis for scrolling
			} else {
				window.scrollTo({
					top: offsetPosition,
					behavior: "smooth", // Fallback to default smooth scroll
				});
			}
		}
		if ("H3" === level) {
			if (mainLi) {
				subLi = document.createElement("li");
				subLi.appendChild(anchor);

				if (isSibling === false) {
					subUl = document.createElement("ul");
				}
				subUl.appendChild(subLi);
				mainLi.appendChild(subUl);

				isSibling = true;
			}
		} else {
			mainLi = document.createElement("li");
			mainLi.appendChild(anchor);
			tocFragment.appendChild(mainLi);
			isSibling = false;
			subUl = null;
		}
	}
	tocOl.append(tocFragment);
	toc.append(tocOl);
	} else {
		toc.style.display = "none";
	}
	});
	</script>
<?php }
  $double_image =  get_field('double_image','options'); 
  if ($double_image == true) { 
	// Here is double called script. Needs to be fixed!!!
	wp_print_script_tag(
		array('defer' => true, 'src' => esc_url(get_template_directory_uri() . '/assets/js/double-image/gsap.min.js'), 'id' => 'gsap-min-js',)
	);
	wp_print_script_tag(
		array('defer' => true,'src' => esc_url(get_template_directory_uri() . '/assets/js/double-image/imagesloaded.pkgd.min.js'), 'id' => 'imagesloaded-min-js')
	);
?>
<script type="module">
	import { DoubleImageEffect } from '<?php echo esc_url(get_template_directory_uri() . '/assets/js/double-image/doubleImageEffect.js');?>';
	[...document.querySelectorAll('.double')].forEach(el => new DoubleImageEffect(el));
	imagesLoaded(document.querySelectorAll('.double__img'), {background: true}, () => {
		document.body.classList.remove('loading');
	});
</script>
<?php }
	$lazyload =  get_field('lazyload','options');  if ($lazyload == true) { ?>
	<script type="text/javascript"> var lazyLoadInstance = new LazyLoad({ effect : "fadeIn" });</script>
<?php } 
	$softscroll =  get_field('softscroll','options');  if ($softscroll == true) { ?>
	<script type="text/javascript">
	// Initialize Lenis for smooth scrolling
	// (function () {
	// (function () { ... })(); is commonly used to encapsulate code and avoid polluting the global scope. 
	// It's especially useful when dealing with modular or reusable code or when you want to isolate your logic.
		let lenis;

		const initSmoothScrolling = () => {
		lenis = new Lenis({
			smooth: true,
			lerp: 0.9,
		});

		const animateScroll = (time) => {
			lenis.raf(time);
			requestAnimationFrame(animateScroll);
		};

		// Allow native scroll inside .table-responsive
		document.addEventListener("wheel", (event) => {
			const tableResponsive = event.target.closest(".table-responsive");
			if (tableResponsive) {
			const isAtTop = tableResponsive.scrollTop === 0 && event.deltaY < 0;
			const isAtBottom =
				tableResponsive.scrollHeight - tableResponsive.scrollTop <=
				tableResponsive.clientHeight && event.deltaY > 0;

			// Prevent Lenis scrolling only when the user is actively scrolling the table
			if (!isAtTop && !isAtBottom) {
				event.stopPropagation(); // Stop Lenis from interfering
				return;
			}
			}
			lenis.start(); // Allow Lenis scroll outside .table-responsive
		});
		
		// Allow touch scrolling in .table-responsive
		document.addEventListener("touchmove", (event) => {
			const tableResponsive = event.target.closest(".table-responsive");
			if (tableResponsive) {
			event.stopPropagation(); // Allow native scrolling inside table-responsive
			}
		});

		requestAnimationFrame(animateScroll);
		};

		document.addEventListener("DOMContentLoaded", initSmoothScrolling);
	// })();
	</script>
<?php }
$typewriter =  get_field('typewriter','options');  if ($typewriter == true) { ?>
	<script type="text/javascript"> 
		// Typewriter(jquery) on Page Heading
		jQuery(document).ready(function (jQuery) {
		var element = jQuery(".jumbotron-heading, .page .full-page-header h1");
		if (!element.length) {
			return; // Exit if element does not exist
		}

		// Function to set the height
		function setHeadingHeight() {
			if (element.length) {
			var headingHeight = element.outerHeight(); // Get the height
			element.css("min-height", headingHeight + "px"); // Set the height
			setTimeout(function () {
				element.css("opacity", 1);
			}, 100);
			}
		}
		// Initial execution
		setHeadingHeight();
		// Recalculate on window resize
		jQuery(window).on("resize", function () {
			// Clear the height and set it again on resize
			element.css("min-height", "unset") 
			setHeadingHeight();
		});

		typing(0, element.data("text"));

		function typing(index, text) {
			var textIndex = 1;

			var tmp = setInterval(function () {
			if (textIndex < text[index].length + 1) {
				element.text(text[index].substr(0, textIndex));
				textIndex++;
			} else {
				var parentPageHeading = element.closest(".full-page-header");
				var parentHeroSection = element.closest(".jumbotron-content");
				setTimeout(function () {
				// deleting(index, text);
				parentPageHeading
					.find(
					".the-content *:not(.gradient-mesh):not(.gradient-mesh *) , .brandheading-btn"
					)
					.addClass("animated fadeInUp");
				parentHeroSection
					.find(
					".jumbotron-description , .jumbotron-cta"
					)
					.addClass("animated fadeInUp");
				}, 300);
				clearInterval(tmp);
			}
			}, 60);
		}

		// function deleting(index, text) {
		//   var textIndex = text[index].length;
		//   var tmp = setInterval(function () {
		//     if (textIndex + 1 > 0) {
		//       element.text(text[index].substr(0, textIndex));
		//       textIndex--;
		//     } else {
		//       index++;
		//       if (index == text.length) {
		//         index = 0;
		//       }
		//       typing(index, text);
		//       clearInterval(tmp);
		//     }
		//   }, 60);
		// }
		});
    </script>
<?php }
$in_vew_animation =  get_field('in_vew_animation','options');  if ($in_vew_animation == true) { ?>
	<script type="text/javascript"> 
      jQuery(document).ready(function ($) {
                var $container =  $('#content section:not(.full-page-header):not(.jumbotron) .container');
				var $container_fluid =  $('#content section:not(.full-page-header):not(.jumbotron) .container-fluid');
				var $container_archive =  $('#content>.container');
				var $animation_containers = $container.add($container_fluid).add($container_archive);
				var $window = $(window);

				function check_if_in_view() {
					var window_height = $window.height();
					var window_top_position = $window.scrollTop();
					var window_bottom_position = (window_top_position + window_height);
					$.each($animation_containers, function () {
						var $in_view_element = $(this);
						var element_height = $in_view_element.outerHeight();
						var element_top_position = $in_view_element.offset().top;
						var element_bottom_position = (element_top_position + element_height);
						//check to see if this current container is within viewport

						if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
							setTimeout(function () {
								$in_view_element.addClass('in-view');
								$('.in-view').each(function () {
									$('h2.entry-title, h3, .item-description p, .item-description li, .section-desc p, .section-desc a, .section-desc li, .section-desc a, .content:not(.accordion-item-content) p, .content li, .content a, .content+a,.content+a+a', this).each(function (i) {
										var animationStart = $(this);
										setTimeout(function () {
											animationStart.addClass('animated fadeInUp', !animationStart.hasClass('animated fadeInUp')).css("opacity", 1);
										}, 50 * i);
									});
                                    $('h2:not(.entry-title)', this).each(function (i) {
                                        var animationStart = $(this);
                                        setTimeout(function () {
                                            animationStart.addClass('reveal', !animationStart.hasClass('reveal')).css("opacity", 1);
                                        }, 10 * i);
                                    });
								});
							}, 300);
						} else {
							$in_view_element.removeClass('in-view');
							$in_view_element.find('h2, h3, .item-description p, .item-description li, .section-desc p, .section-desc a, .section-desc li, .section-desc a, .content:not(.accordion-item-content) p, .content li, .content a, .content+a,.content+a+a').removeClass('animated fadeInUp reveal').css("opacity", 0);
						}
					});
				}

				$window.on('scroll resize', check_if_in_view);
				$window.trigger('scroll');
		});
    </script>
<?php }
	$touchSwipe =  get_field('touchSwipe','options');  if ($touchSwipe == true) { 
    wp_print_script_tag(
		array('defer' => true, 'src' => esc_url(get_template_directory_uri() . '/assets/js/jquery.touchSwipe.min.js'), 'id' => 'touchSwipe',)
	);?>
	<script type="text/javascript"> 
		jQuery(document).ready(function (jQuery) {
			  "use strict";
					  // Bootstrap Carousel swipe function
			  jQuery(".carousel").carousel({
				// interval: false,
				// pause: true
			  });
			  jQuery(".carousel .carousel-inner").swipe({
				swipeLeft: function (event, direction, distance, duration, fingerCount) {
				  this.parent().carousel('next');
				},
				swipeRight: function () {
				  this.parent().carousel('prev');
				},
				threshold: 0,
				tap: function (event, target) {
				  //window.location = jQuery(this).find('.carousel-item.active a').attr('href');
				},
				excludedElements: "label, button, input, select, textarea, .noSwipe"
			  });
			  jQuery('.carousel .carousel-inner').on('dragstart', 'a', function () {
				return false;
			  });
		 });
    </script>
<?php }
}