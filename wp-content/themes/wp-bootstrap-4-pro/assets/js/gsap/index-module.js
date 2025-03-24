// Import the necessary function for preloading images
import { preloadImages, getGrid } from "./utils.js";

// Define a variable that will store the Lenis smooth scrolling object
// let lenis;

// // Function to initialize Lenis for smooth scrolling
// const initSmoothScrolling = () => {
//   // Instantiate the Lenis object with specified properties
//   lenis = new Lenis({
//     lerp: 0.1, // Lower values create a smoother scroll effect
//     smoothWheel: true, // Enables smooth scrolling for mouse wheel events
//   });

//   // Update ScrollTrigger each time the user scrolls
//   lenis.on("scroll", () => ScrollTrigger.update());

//   // Define a function to run at each animation frame
//   const scrollFn = (time) => {
//     lenis.raf(time); // Run Lenis' requestAnimationFrame method
//     requestAnimationFrame(scrollFn); // Recursively call scrollFn on each frame
//   };
//   // Start the animation frame loop
//   requestAnimationFrame(scrollFn);
// };

// All elements with class .grid
const grids = document.querySelectorAll(".grid");

// Function to apply scroll-triggered animations to a given grid
const applyAnimation = (grid) => {
  const gridWrap = grid.querySelector(".grid-wrap");
  const gridItems = grid.querySelectorAll(".grid__item");
  const gridItemsInner = [...gridItems].map((item) =>
    item.querySelector(".grid__item-inner")
  );

  if (!gridWrap) {
    //console.error("gridWrap not found in:", grid);
    return;
  }

 // console.log("Applying animation to grid:", grid);

  const timeline = gsap.timeline({
    defaults: { ease: "none" },
    scrollTrigger: {
      trigger: gridWrap,
      start: "top bottom+=5%",
      end: "bottom top-=5%",
      scrub: true,
    },
  });

  // Apply different animations based on type

 

  // Responsive animation logic using GSAP matchMedia
  const mm = gsap.matchMedia();
  const breakPoint = 992; // Adjust breakpoint as needed

  mm.add(
    {
      isDesktop: `(min-width: ${breakPoint}px)`,
      isMobile: `(max-width: ${breakPoint - 1}px)`,
    },
    (context) => {
      const { isDesktop, isMobile } = context.conditions;

      if (isDesktop) {
        // Set some CSS related style values
        grid.style.setProperty("--grid-width", "100%");
        grid.style.setProperty("--perspective", "2000px");
        grid.style.setProperty("--grid-inner-scale", "1.55");
        grid.style.setProperty("--grid-item-ratio", "1");
        grid.style.setProperty("--grid-columns", "6");
        grid.style.setProperty("--grid-gap", "2vw");
        timeline.set(gridWrap, {
          transformOrigin: "100% 100%",
          rotationY: -30,
          xPercent: 20,
        });
        //console.log("Desktop settings applied");
      }

      if (isMobile) {
        // Set some CSS related style values
        grid.style.setProperty("--grid-width", "160%");
        grid.style.setProperty("--perspective", "2000px");
        grid.style.setProperty("--grid-inner-scale", "1.4");
        grid.style.setProperty("--grid-item-ratio", "1");
        grid.style.setProperty("--grid-columns", "6");
        grid.style.setProperty("--grid-gap", "14vw");
        timeline.set(gridWrap, {
          transformOrigin: "50% 50%",
          rotationY: 0,
          xPercent: 0,
        });
        //console.log("Mobile settings applied");
      }

      // Cleanup function (optional)
      return () => {
        //console.log("Cleaning up...");
      };
    }
  );

  const gridObj = getGrid(gridItems);

  timeline
    .set(gridObj, {
      z: () => gsap.utils.random(-3000, -1000),
    })
    .fromTo(
      gridObj,
      {
        yPercent: () => gsap.utils.random(100, 1000),
        rotationY: -45,
        filter: "brightness(200%)",
      },
      {
        ease: "power2",
        yPercent: () => gsap.utils.random(-1000, -100),
        rotationY: 45,
        filter: "brightness(0%)",
      },
      0
    )
    .fromTo(
      gridWrap,
      {
        rotationZ: -5,
      },
      {
        rotationX: -20,
        rotationZ: 10,
        scale: 1.2,
      },
      0
    )
    .fromTo(
      gridItemsInner,
      {
        scale: 2,
      },
      {
        scale: 0.5,
      },
      0
    );
};

// Apply animations to each grid
const scroll = () => {
  //console.log("Applying animations to all grids...");
  grids.forEach((grid, i) => {
    //console.log(`Processing grid ${i}`);
    applyAnimation(grid);
  });
};

// Preload images, initialize smooth scrolling, apply scroll-triggered animations, and remove loading class from body
preloadImages(".grid__item-inner").then(() => {
  //console.log("Images preloaded. Initializing animations...");
  //initSmoothScrolling();
  scroll();
  document.body.classList.remove("loading");
});
