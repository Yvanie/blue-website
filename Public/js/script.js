
const scrollToTopBtn = document.getElementById('scrollToTopBtn');

window.onscroll = function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollToTopBtn.classList.add('show');
    } else {
        scrollToTopBtn.classList.remove('show');
    }
};

scrollToTopBtn.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    });
};

const infoNavbar = document.querySelector('.info-navbar');
const navbar = document.querySelector('.navbar');


let lastScrollTop = 0;

window.addEventListener('scroll', () => {
    const scrollPosition = window.scrollY;
    const isMobile = window.innerWidth <= 768; 

    if (isMobile) {
        infoNavbar.classList.add('hidden'); 
        navbar.style.top = '0'; // 
    } else {
        if (scrollPosition > lastScrollTop) {
            infoNavbar.classList.add('hidden'); 
        } else {
            infoNavbar.classList.remove('hidden'); 
        }
        if (scrollPosition > 0) {
            infoNavbar.classList.add('fixed');
            navbar.style.top = '0';
        } else {
            infoNavbar.classList.remove('fixed');
            navbar.style.top = '40px'; 
        }
    }

    lastScrollTop = scrollPosition; 
});

let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
function showSlide(index) {
  slides.forEach(slide => slide.style.display = "none");
  slides[index].style.display = "block";
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
}
showSlide(currentSlide);
setInterval(nextSlide, 5000);
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('nav-links');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('is-active'); 
    const icon = hamburger.querySelector('i');
    if (hamburger.classList.contains('is-active')) {
        icon.classList.remove('fa-bars'); 
        icon.classList.add('fa-times'); 
    } else {
        icon.classList.remove('fa-times'); 
        icon.classList.add('fa-bars'); 
    }
});

let currentIndex = 0;
const logosPerSlide = 6; 
const totalLogos = document.querySelectorAll('.partner-logo').length; 

const partnerWrapper = document.querySelector('.partner-wrapper');
const clonedLogos = document.querySelectorAll('.partner-logo').forEach((logo, index) => {
    if (index < logosPerSlide) {
        const clone = logo.cloneNode(true);
        partnerWrapper.appendChild(clone);
    }
});

function slideLogos() {
    const offset = currentIndex * -(100 / logosPerSlide); 
    partnerWrapper.style.transition = 'transform 0.5s ease'; 
    partnerWrapper.style.transform = `translateX(${offset}%)`; 

    currentIndex++;
    if (currentIndex >= totalLogos) {
        currentIndex = 0; 
        setTimeout(() => {
            partnerWrapper.style.transition = 'none'; 
            partnerWrapper.style.transform = `translateX(0%)`; 
        }, 500); 
    }
}


setInterval(slideLogos, 3000);



function toggleDescription(serviceId) {
    const desc = document.getElementById(`desc-${serviceId}`);
    const readMoreButton = document.querySelector(`#desc-${serviceId} + .read-more`);
    const allDescriptions = document.querySelectorAll('.description');
    const allButtons = document.querySelectorAll('.read-more');
    
    allDescriptions.forEach((descElement, index) => {
        if (descElement !== desc && descElement.style.webkitLineClamp !== "4") {
            descElement.style.webkitLineClamp = "4";
            allButtons[index].innerText = "Read More"; 
        }
    });

    if (desc.style.webkitLineClamp === "4") {
        desc.style.webkitLineClamp = "unset"; 
        readMoreButton.innerText = "Read Less"; 
    } else {
        desc.style.webkitLineClamp = "4"; 
        readMoreButton.innerText = "Read More"; 
    }
}


document.addEventListener("DOMContentLoaded", () => {
    const allDescriptions = document.querySelectorAll(".description");
    allDescriptions.forEach(desc => {
        desc.style.webkitLineClamp = "4"; 
    });
});




let currentPage = 1;
const postsPerPage = 6;

const blogPosts = document.querySelectorAll('.single-post');

const renderPosts = () => {
    const startIndex = (currentPage - 1) * postsPerPage;
    const endIndex = startIndex + postsPerPage;

    blogPosts.forEach((post, index) => {
        if (index >= startIndex && index < endIndex) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });
};

const renderPagination = () => {
    const totalPages = Math.ceil(blogPosts.length / postsPerPage);
    const pageNumbersContainer = document.getElementById('page-numbers');
    pageNumbersContainer.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.classList.add('pagination-btn');
        pageButton.textContent = i;
        pageButton.onclick = () => {
            currentPage = i;
            renderPosts();
            renderPagination();
        };
        if (i === currentPage) {
            pageButton.style.backgroundColor = '#2980b9';
        }
        pageNumbersContainer.appendChild(pageButton);
    }

    document.getElementById('prev-page').disabled = currentPage === 1;
    document.getElementById('next-page').disabled = currentPage === totalPages;
};

document.getElementById('prev-page').onclick = () => {
    if (currentPage > 1) {
        currentPage--;
        renderPosts();
        renderPagination();
    }
};

document.getElementById('next-page').onclick = () => {
    const totalPages = Math.ceil(blogPosts.length / postsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        renderPosts();
        renderPagination();
    }
};


renderPosts();
renderPagination();



