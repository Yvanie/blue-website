const infoNavbar = document.querySelector('.info-navbar');
const navbar = document.querySelector('.navbar');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
    const scrollPosition = window.scrollY;
    const isMobile = window.innerWidth <= 768; // Check if on mobile

    if (isMobile) {
        infoNavbar.classList.add('hidden'); // Always hide info navbar on mobile
        navbar.style.top = '0'; // Ensure navbar is at the top
    } else {
        // Show or hide the info navbar based on scroll position
        if (scrollPosition > lastScrollTop) {
            // Scrolling down
            infoNavbar.classList.add('hidden'); // Hide info navbar
        } else {
            // Scrolling up
            infoNavbar.classList.remove('hidden'); // Show info navbar
        }

        // Fix the info navbar to the top when scrolling
        if (scrollPosition > 0) {
            infoNavbar.classList.add('fixed');
            navbar.style.top = '0'; // Keep navbar at the top
        } else {
            infoNavbar.classList.remove('fixed');
            navbar.style.top = '40px'; // Reset navbar position
        }
    }

    lastScrollTop = scrollPosition; // Update last scroll position
});

// Hamburger Menu Toggle
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('nav-links');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('is-active'); // Toggle the active state for hamburger
    const icon = hamburger.querySelector('i');

    // Change the icon based on the active state
    if (hamburger.classList.contains('is-active')) {
        icon.classList.remove('fa-bars'); // Remove hamburger icon
        icon.classList.add('fa-times'); // Add X icon
    } else {
        icon.classList.remove('fa-times'); // Remove X icon
        icon.classList.add('fa-bars'); // Add hamburger icon
    }
});

let currentIndex = 0;
const logosPerSlide = 6; // Number of logos to display per slide
const totalLogos = document.querySelectorAll('.partner-logo').length; // Total logos

// Clone the first few logos for a seamless effect
const partnerWrapper = document.querySelector('.partner-wrapper');
const clonedLogos = document.querySelectorAll('.partner-logo').forEach((logo, index) => {
    if (index < logosPerSlide) {
        const clone = logo.cloneNode(true);
        partnerWrapper.appendChild(clone);
    }
});

function slideLogos() {
    const offset = currentIndex * -(100 / logosPerSlide); // Calculate offset
    partnerWrapper.style.transition = 'transform 0.5s ease'; // Smooth transition
    partnerWrapper.style.transform = `translateX(${offset}%)`; // Move logos

    currentIndex++;
    
    // Reset to the beginning without a transition for seamless looping
    if (currentIndex >= totalLogos) {
        currentIndex = 0; // Reset index for seamless looping
        setTimeout(() => {
            partnerWrapper.style.transition = 'none'; // Disable transition for instant jump
            partnerWrapper.style.transform = `translateX(0%)`; // Reset position
        }, 500); // Short delay for visual effect
    }
}

// Slide logos every 3 seconds
setInterval(slideLogos, 3000);