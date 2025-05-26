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

// Javascript for My Projects Carousel
// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    //----------------------
    //  Get DOM Elements
    //----------------------
    const categoryItems = document.querySelectorAll('.category-item');
    const categoryProjects = document.querySelectorAll('.category-projects');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const carouselDots = document.querySelector('.carousel-dots');

    // Current active category and slide
    let currentCategory = 'personal-portfolio';
    let currentSlideIndex = 0;

    // Initialize the carousel
    function initializeCarousel() {
        // Active category  (Personal Portfolio)
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');

        // Create dots for active category
        createDots(slides.length);

        // Show the first slide
        if (slides.length > 0) {
            slides[0].classList.add('active');
        }

        updateDots();
    }

    // Create Dots for carousel Navigation
    function createDots (numSlides){
        // clear existing dots
        carouselDots.innerHTML = '';

        // create new dots
        for (let i = 0; i < numSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            dot.dataset.index = 1;

            // ADd click event to each dot
            dot.addEventListener('click', function() {
                currentSlideIndex = parseInt(this.dataset.index);
                updateSlides();
            });

            carouselDots.appendChild(dot);
        }
    }

    // Update the dots to show active state
    function updateDots() {
        const dots = carouselDots.querySelectorAll('.dots');
        dots.forEach((dot, index) => {
            if (index === currentSlideIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    //Update slides based on current index
    function updateSlides() {
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');

        // Hide all slide
        slides.forEach(slide => {
            slide.classList.remove('active');
        })

        // Show current slide
        slide[currentSlideIndex].classList.add('active');

        updateDots();
    }

    // Switch to a different category
    function switchCategory (categoryId) {
        // Update currentCategory
        currentCategory = categoryId;

        // Hide all Category projects
        categoryProjects.forEach(category => {
            category.style.display = 'none';
        });
        
        // Show selected category
        const activeCategory = document.getElementById(categoryId);
        activeCategory.style.dispaly = 'block';

        // reset all slide
        currentSlideIndex = 0;

        // Create new dots for this category
        const slides = activeCategory.querySelectorAll('.project-slide');
        createDots(slides.length);

        // Update slides to show the frist one
        updateSlides();
    }

    //Event: Category item click
    categoryItems.forEach(items => {
        items.addEventListener('click', function() {
            // remove active class from items
            categoryItems.forEach(cat => cat.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');

            // Switch to the selected category
            const categoryId = this.getAttribute('date-category');
            switchCategory(categoryId);
        });
    });

    // Event: Previous button click
    prevBtn.addEventListener('click', function() {
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');
    })

});