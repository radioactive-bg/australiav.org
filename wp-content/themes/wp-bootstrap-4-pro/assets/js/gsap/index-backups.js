console.clear();
gsap.registerPlugin(ScrollTrigger);

// Dynamically resolve the script path
const scriptPath = document.currentScript.src;
const basePath = scriptPath.substring(0, scriptPath.lastIndexOf("/")); // Get the directory of the script

const animation = lottie.loadAnimation({
  container: document.querySelector(".lottie-container"),
  renderer: "svg",
  loop: false, // Do not loop automatically
  autoplay: false,
  path: `${basePath}/lottie-files/lottie-lego.json`, // Correct dynamic path
});

animation.setSpeed(1);

// Flag to manage animation state
let isStopping = false;

// ScrollTrigger to play/stop/reset the animation
ScrollTrigger.create({
  trigger: ".lottie-container", // Target element
  start: "top center", // Start trigger position
  end: "bottom center", // End trigger position
  markers: false, // Use markers for testing (set to false in production)

  // Play animation when entering trigger area
  onEnter: () => {
    isStopping = false;
    animation.goToAndPlay(0); // Start animation from the beginning
  },

  // Stop animation after it finishes the loop when leaving
  onLeave: () => {
    if (!isStopping) {
      isStopping = true;
      animation.addEventListener("loopComplete", stopAnimation);
    }
  },

  // Play animation when scrolling back into view
  onEnterBack: () => {
    isStopping = false;
    animation.goToAndPlay(0); // Restart animation when entering back
  },

  // Stop animation after it finishes the loop when scrolling out upwards
  onLeaveBack: () => {
    if (!isStopping) {
      isStopping = true;
      animation.addEventListener("loopComplete", stopAnimation);
    }
  },
  scrub: false, // Disable scrub for discrete control
});

// Stop animation after loop completes
function stopAnimation() {
  animation.stop();
  animation.removeEventListener("loopComplete", stopAnimation);
}

// let paused = true;
// const box = document.querySelector(".box");
// if (box) {
//   box.classList.add("exists");
//   const t = gsap
//     .to(box, {
//       x: 0,
//       rotation: 0,
//       paused: false,
//     })
//     .reverse();
//   let paused = false; // Define 'paused' variable
//   box.addEventListener("click", () => {
//     animation.setDirection(paused ? 1 : -1);
//     t.reversed(!t.reversed());
//     animation.play();
//     paused = !paused;
//   });
// } else {
//   console.warn("The element '.box' does not exist.");
// }



// --------------- Home Animation --------------- //
// const animationHome = lottie.loadAnimation({
//   container: document.querySelector(".hero-lottie-wrapper"),
//   renderer: "svg",
//   loop: true, // Do  loop automatically
//   autoplay: true,
//   path: `${basePath}/lottie-files/sphere-animation.json`, // Correct dynamic path
// });

// animationHome.setSpeed(1);

// // Fade-in when Lottie animation is loaded
// animationHome.addEventListener("DOMLoaded", () => {
//   const container = document.querySelector(".hero-lottie-wrapper");
//   container.classList.add("animated"); // Add the 'visible' class for fade-in effect
//   container.classList.add("zoomIn");
// });
// --------------- End Home Animation --------------- //


// --------------- PopUp Animation --------------- //
const data = {
  popup1: {
    popupId: "#popup1",
    // border: "#popup1Svg #border",
    bg: {
      user: "#popup1Svg #userBg",
      username: "#popup1Svg #usernameBg",
      team: "#popup1Svg #teamBg",
      teamname: "#popup1Svg #teamnameBg",
    },
  },
  popup2: {
    popupId: "#popup2",
    //border: "#popup2Svg #border",
    bg: {
      user: "#popup2Svg #userBg",
      username: "#popup2Svg #usernameBg",
      team: "#popup2Svg #teamBg",
      teamname: "#popup2Svg #teamnameBg",
    },
  },
  popup3: {
    popupId: "#popup3",
    //border: "#popup3Svg #border",
    bg: {
      user: "#popup3Svg #userBg",
      username: "#popup3Svg #usernameBg",
      team: "#popup3Svg #teamBg",
      teamname: "#popup3Svg #teamnameBg",
    },
  },
  popup4: {
    popupId: "#popup4",
    //border: "#popup4Svg #border",
    bg: {
      user: "#popup4Svg #userBg",
      username: "#popup4Svg #usernameBg",
      team: "#popup4Svg #teamBg",
      teamname: "#popup4Svg #teamnameBg",
    },
  },
  popup5: {
    popupId: "#popup5",
    //border: "#popup5Svg #border",
    bg: {
      user: "#popup5Svg #userBg",
      username: "#popup5Svg #usernameBg",
      team: "#popup5Svg #teamBg",
      teamname: "#popup5Svg #teamnameBg",
    },
  },
};

// Application Initialization
const app = {
  initialize: function () {
    view.setAnimationControls();
  },
};

// View Logic
const view = {
  setAnimationControls: function () {
    const buttons = document.querySelectorAll(".btn");
    const animations = {};

    buttons.forEach((button) => {
      const targetPopup = button.getAttribute("data-popup");
      const popupData = data[targetPopup];

      if (!popupData) {
        console.warn(`No popup data found for "${targetPopup}"`);
        return;
      }

      // Initialize animation only once
      if (!animations[targetPopup]) {
        animations[targetPopup] = Animation(popupData);
      }

      const popupElement = document.querySelector(popupData.popupId);

      // Mouseenter Event: Show and play animation
      button.addEventListener("mouseenter", () => {
        document.querySelectorAll(".popup-container").forEach((popup) => {
          popup.style.display = "none";
        });
        popupElement.style.display = "block";
        animations[targetPopup].play(0); // Play from the start
      });

      // Mouseleave Event: Reverse animation and hide
      button.addEventListener("mouseleave", () => {
        animations[targetPopup].reverse();
        setTimeout(() => {
          popupElement.style.display = "none";
        }, 0); // Wait for reverse animation to finish
      });
    });
  },
};

// Animation Constructor
function Animation(popup) {
  return gsap
    .timeline({ paused: true })
    // .from(popup.border, {
    //   duration: 0.2,
    //   scaleY: 0,
    //   opacity: 0,
    //   transformOrigin: "bottom",
    //   ease: "power1.out",
    // })
    .from(popup.bg.user, {
      duration: 0.2,
      scaleX: 0,
      opacity: 0,
      transformOrigin: "left center",
      ease: "power1.out",
    })
    .from(popup.bg.username, {
      duration: 0.2,
      scaleX: 0,
      opacity: 0,
      transformOrigin: "left center",
      ease: "power1.out",
    })
    .from(popup.bg.team, {
      duration: 0.2,
      scaleX: 0,
      opacity: 0,
      transformOrigin: "left center",
      ease: "power1.out",
    })
    .from(popup.bg.teamname, {
      duration: 0.2,
      scaleX: 0,
      opacity: 0,
      transformOrigin: "left center",
      ease: "power1.out",
    });
}

// Initialize App on Window Load
window.onload = function () {
  app.initialize();
};
