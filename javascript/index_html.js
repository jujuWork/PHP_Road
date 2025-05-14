// Initialize progress bars when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Set progress bar values
    initProgressBars();
    
    // Add smooth scrolling for navigation links
    addSmoothScrolling();
});

// Initialize progress bars with animation
function initProgressBars() {
    const progressBars = document.querySelectorAll('.progressbar');
    
    // Create an Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // When progress bar section is visible
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const percent = progressBar.getAttribute('data-percent');
                
                // Animate the progress bar after a small delay
                setTimeout(() => {
                    progressBar.style.width = percent + '%';
                }, 300);
                
                // Stop observing this element after animation
                observer.unobserve(progressBar);
            }
        });
    }, { threshold: 0.1 });
    
    // Observe all progress bars
    progressBars.forEach(bar => {
        observer.observe(bar);
    });
}

// Add smooth scrolling for navigation links
function addSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the target element
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Add offset for fixed header
                const headerOffset = 70;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                // Smooth scroll to the target
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                document.getElementById('nav-toggle').checked = false;
            }
        });
    });
}

// Add active class to navigation links based on scroll position
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('header, section');
    const navLinks = document.querySelectorAll('.nav-menu a');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.clientHeight;
        
        if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
        }
    });
});




// Project Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Select slider elements
    const slider = document.querySelector('.projects-slider');
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow');
    const dotsContainer = document.querySelector('.slider-dots');
    
    // Get all project cards
    const projectCards = document.querySelectorAll('.project-card');
    const totalProjects = projectCards.length;
    
    // Clone cards for infinite loop
    setupInfiniteLoop();
    
    // Initialize slider state
    let currentIndex = 0;
    let projectsPerView = getProjectsPerView();
    let isTransitioning = false;
    
    // Setup slider
    setupSlider();
    
    // Function to clone cards for infinite loop
    function setupInfiniteLoop() {
        // Clone first and last cards for infinite loop effect
        projectCards.forEach(card => {
            const clone = card.cloneNode(true);
            slider.appendChild(clone);
        });
        
        // Clone another set at the beginning
        Array.from(projectCards).reverse().forEach(card => {
            const clone = card.cloneNode(true);
            slider.insertBefore(clone, slider.firstChild);
        });
    }
    
    // Setup slider
    function setupSlider() {
        // Set initial position to show original cards (skip clones)
        currentIndex = totalProjects;
        updateSliderPosition(false);
        
        // Generate dots based on original cards count
        generateDots();
        updateDots();
        
        // Add event listeners
        prevArrow.addEventListener('click', goToPrevSlide);
        nextArrow.addEventListener('click', goToNextSlide);
        
        // Add transition end event
        slider.addEventListener('transitionend', handleTransitionEnd);
        
        // Handle responsiveness
        window.addEventListener('resize', handleResize);
    }
    
    // Get number of projects per view based on screen width
    function getProjectsPerView() {
        if (window.innerWidth > 992) {
            return 3;
        } else if (window.innerWidth > 768) {
            return 2;
        } else {
            return 1;
        }
    }
    
    // Generate pagination dots
    function generateDots() {
        dotsContainer.innerHTML = '';
        const numberOfDots = Math.ceil(totalProjects / projectsPerView);
        
        for (let i = 0; i < numberOfDots; i++) {
            const dot = document.createElement('div');
            dot.classList.add('slider-dot');
            dot.dataset.index = i;
            dot.addEventListener('click', () => {
                if (!isTransitioning) {
                    goToSlide(i * projectsPerView + totalProjects);
                }
            });
            dotsContainer.appendChild(dot);
        }
    }
    
    // Update slider position
    function updateSliderPosition(withTransition = true) {
        const allCards = document.querySelectorAll('.project-card');
        const cardWidth = allCards[0].offsetWidth + 20; // Width + gap
        
        if (withTransition) {
            slider.style.transition = 'transform 0.4s ease-in-out';
            isTransitioning = true;
        } else {
            slider.style.transition = 'none';
        }
        
        slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }
    
    // Handle transition end
    function handleTransitionEnd() {
        isTransitioning = false;
        
        const allCards = document.querySelectorAll('.project-card');
        
        // If we've scrolled to the cloned items at the end
        if (currentIndex >= totalProjects * 2) {
            currentIndex = totalProjects;
            updateSliderPosition(false);
        }
        
        // If we've scrolled to the cloned items at the beginning
        if (currentIndex < totalProjects) {
            currentIndex = totalProjects;
            updateSliderPosition(false);
        }
        
        updateDots();
    }
    
    // Update dots
    function updateDots() {
        const dots = document.querySelectorAll('.slider-dot');
        const normalizedIndex = (currentIndex - totalProjects) % totalProjects;
        const activeIndex = Math.floor(normalizedIndex / projectsPerView);
        
        dots.forEach((dot, index) => {
            const dotIndex = parseInt(dot.dataset.index);
            dot.classList.toggle('active', dotIndex === activeIndex);
        });
    }
    
    // Go to previous slide
    function goToPrevSlide() {
        if (!isTransitioning) {
            currentIndex--;
            updateSliderPosition();
        }
    }
    
    // Go to next slide
    function goToNextSlide() {
        if (!isTransitioning) {
            currentIndex++;
            updateSliderPosition();
        }
    }
    
    // Go to specific slide
    function goToSlide(index) {
        currentIndex = index;
        updateSliderPosition();
    }
    
    // Handle window resize
    function handleResize() {
        const newProjectsPerView = getProjectsPerView();
        
        // If the number of visible projects changes, update the slider
        if (projectsPerView !== newProjectsPerView) {
            projectsPerView = newProjectsPerView;
            
            // Update dots based on new configuration
            generateDots();
            updateSliderPosition(false);
            updateDots();
        } else {
            // Just update position in case card sizes changed
            updateSliderPosition(false);
        }
    }
});