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
  path: `${basePath}/lottie-files/coding.json`, // Correct dynamic path
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

// --------------- PopUp Animation --------------- //
const data = {
  popup1: {
    popupId: "#popup1",
    bg: {
      user: "#popup1Svg #userBg",
      username: "#popup1Svg #usernameBg",
      team: "#popup1Svg #teamBg",
      teamname: "#popup1Svg #teamnameBg",
    },
  },
  popup2: {
    popupId: "#popup2",
    bg: {
      user: "#popup2Svg #userBg",
      username: "#popup2Svg #usernameBg",
      //team: "#popup2Svg #teamBg",
      //teamname: "#popup2Svg #teamnameBg",
    },
  },
  popup3: {
    popupId: "#popup3",
    bg: {
      user: "#popup3Svg #userBg",
      username: "#popup3Svg #usernameBg",
      //team: "#popup3Svg #teamBg",
      //teamname: "#popup3Svg #teamnameBg",
    },
  },
  popup4: {
    popupId: "#popup4",
    bg: {
      user: "#popup4Svg #userBg",
      username: "#popup4Svg #usernameBg",
     // team: "#popup4Svg #teamBg",
     // teamname: "#popup4Svg #teamnameBg",
    },
  },
  popup5: {
    popupId: "#popup5",
    bg: {
      user: "#popup5Svg #userBg",
      username: "#popup5Svg #usernameBg",
      //team: "#popup5Svg #teamBg",
      //teamname: "#popup5Svg #teamnameBg",
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
    // .from(popup.bg.team, {
    //   duration: 0.2,
    //   scaleX: 0,
    //   opacity: 0,
    //   transformOrigin: "left center",
    //   ease: "power1.out",
    // })
    // .from(popup.bg.teamname, {
    //   duration: 0.2,
    //   scaleX: 0,
    //   opacity: 0,
    //   transformOrigin: "left center",
    //   ease: "power1.out",
    // });
}

// Initialize App on Window Load
window.onload = function () {
  app.initialize();
};

const sections = gsap.utils.toArray(".horizontal__item");
let maxWidth = 0;

const getMaxWidth = () => {
  maxWidth = 0;
  sections.forEach((section) => {
    maxWidth += section.offsetWidth;
    maxWidth += gsap.getProperty(section, "marginLeft");
  });

  maxWidth += gsap.getProperty(".horizontal", "paddingLeft");
  maxWidth += gsap.getProperty(".horizontal .row", "paddingLeft");
  // after the calculations above the right side of the last image  should be flush against the right side of the window
  // but with the scrollbar sitting on top of it, so you might want to add some space
  // if you want the white margin/padding to be visible
  maxWidth += 0; // Default was 700

  return maxWidth;
};

getMaxWidth();
ScrollTrigger.addEventListener("refreshInit", getMaxWidth);

let scrollTween = gsap.to(sections, {
  x: () => `-${maxWidth - window.innerWidth}`,
  ease: "none",
});

let horizontalScroll = ScrollTrigger.create({
  animation: scrollTween,
  trigger: ".horizontal",
  // pin: ".page-id-488 .site-content",
  pin: ".page-id-4884545 .site-content",
  start: "top 80%", // Start trigger position
  markers: false,
  scrub: 0.5,
  end: () => `+=${maxWidth}`,
  invalidateOnRefresh: true,
});

//COUNT UP
let numbers = document.querySelectorAll(".numbers");
console.warn(numbers);
var startCount = 0,
  num = {
    var: startCount,
  };

let tlNumber1 = gsap
  .timeline({
    scrollTrigger: {
      trigger: "#number-01",
      containerAnimation: scrollTween,
      start: "0% 50%",
      markers: false,
      end: "100% 0%",
      toggleActions: "restart none none reverse",
    },
  })
  .to("#number-01", {
    textContent: 4000 + "+",
    duration: 1,
    snap: { textContent: 1 },

    ease: "none",
    onUpdate: changeNumber,
  });

let tlNumber2 = gsap
  .timeline({
    scrollTrigger: {
      trigger: "#number-02",
      containerAnimation: scrollTween,
      start: "0% 50%",
      markers: false,
      end: "100% 0%",
      toggleActions: "restart none none reverse",
    },
  })
  .to("#number-02", {
    textContent: 45,
    snap: { textContent: 1 },

    duration: 1,
    ease: "none",
    onUpdate: changeNumber,
  });

let tlNumber3 = gsap
  .timeline({
    scrollTrigger: {
      trigger: "#number-03",
      containerAnimation: scrollTween,
      start: "-50% 50%",
      markers: false,
      end: "100% 0%",
      toggleActions: "restart none none reverse",
    },
  })
  .to("#number-03", {
    textContent: 30,
    snap: { textContent: 1 },

    duration: 1,
    ease: "none",
    onUpdate: changeNumber,
  });

let tlNumber4 = gsap
  .timeline({
    scrollTrigger: {
      trigger: "#number-04",
      containerAnimation: scrollTween,
      start: "-150% 50%",
      markers: false,
      end: "100% 0%",
      toggleActions: "restart none none reverse",
    },
  })
  .to("#number-04", {
    textContent: 190,
    snap: { textContent: 1 },

    duration: 1,
    ease: "none",
    onUpdate: changeNumber,
  });

function changeNumber() {
  numbers.innerHTML = num.var.toFixed();
}

// MAKE IT DRAGGABLE
// Add <div class="drag-proxy"></div>
// Register Dragable 

// var dragRatio = maxWidth / (maxWidth - window.innerWidth);

// var drag = Draggable.create(".drag-proxy", {
//     trigger: ".horizontal",
//     type: "x",
//     inertia: false,
//     allowContextMenu: true,
//     onPress() {
//         this.startScroll = horizontalScroll.scroll();
//     },
//     onDrag() {
//         horizontalScroll.scroll(
//             this.startScroll - (this.x - this.startX) * dragRatio
//         );
//     },
//     onThrowUpdate() {
//         horizontalScroll.scroll(
//             this.startScroll - (this.x - this.startX) * dragRatio
//         );
//     }
// })[0];
