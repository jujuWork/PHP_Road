// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    // --------------------------
    // Get DOM Elements
    // --------------------------
    const categoryItems = document.querySelectorAll('.category-item');
    const categoryProjects = document.querySelectorAll('.category-projects');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const carouselDots = document.querySelector('.carousel-dots');

    // Current active category and slide
    let currentCategory = 'personal-portfolio';
    let currentSlideIndex = 0;

    // --------------------------
    // Initialize the carousel
    // --------------------------
    function initializeCarousel() {
        // Set up the active category (Personal Portfolio by default)
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');
        
        // Create dots for the active category
        createDots(slides.length);
        
        // Show the first slide
        if (slides.length > 0) {
            slides[0].classList.add('active');
        }
        
        // Update dots
        updateDots();
    }

    // --------------------------
    // Create dots for carousel navigation
    // --------------------------
    function createDots(numSlides) {
        // Clear existing dots
        carouselDots.innerHTML = '';
        
        // Create new dots
        for (let i = 0; i < numSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            dot.dataset.index = i;
            
            // Add click event to each dot
            dot.addEventListener('click', function() {
                currentSlideIndex = parseInt(this.dataset.index);
                updateSlides();
            });
            
            carouselDots.appendChild(dot);
        }
    }

    // --------------------------
    // Update the dots to show active state
    // --------------------------
    function updateDots() {
        const dots = carouselDots.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            if (index === currentSlideIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    // --------------------------
    // Update slides based on current index
    // --------------------------
    function updateSlides() {
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');
        
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Show current slide
        slides[currentSlideIndex].classList.add('active');
        
        // Update dots
        updateDots();
    }

    // --------------------------
    // Switch to a different category
    // --------------------------
    function switchCategory(categoryId) {
        // Update currentCategory
        currentCategory = categoryId;
        
        // Hide all category projects
        categoryProjects.forEach(category => {
            category.style.display = 'none';
        });
        
        // Show the selected category
        const activeCategory = document.getElementById(categoryId);
        activeCategory.style.display = 'block';
        
        // Reset slide index
        currentSlideIndex = 0;
        
        // Create new dots for this category
        const slides = activeCategory.querySelectorAll('.project-slide');
        createDots(slides.length);
        
        // Update slides to show the first one
        updateSlides();
    }

    // --------------------------
    // Event: Category item click
    // --------------------------
    categoryItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            categoryItems.forEach(cat => cat.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Switch to the selected category
            const categoryId = this.getAttribute('data-category');
            switchCategory(categoryId);
        });
    });

    // --------------------------
    // Event: Previous button click
    // --------------------------
    prevBtn.addEventListener('click', function() {
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');
        
        // Decrease the index, loop back to the end if needed
        currentSlideIndex--;
        if (currentSlideIndex < 0) {
            currentSlideIndex = slides.length - 1;
        }
        
        // Update the slides
        updateSlides();
    });

    // --------------------------
    // Event: Next button click
    // --------------------------
    nextBtn.addEventListener('click', function() {
        const activeCategory = document.getElementById(currentCategory);
        const slides = activeCategory.querySelectorAll('.project-slide');
        
        // Increase the index, loop back to the beginning if needed
        currentSlideIndex++;
        if (currentSlideIndex >= slides.length) {
            currentSlideIndex = 0;
        }
        
        // Update the slides
        updateSlides();
    });

    // --------------------------
    // Keyboard navigation (optional)
    // --------------------------
    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowLeft') {
            prevBtn.click();
        } else if (event.key === 'ArrowRight') {
            nextBtn.click();
        }
    });

    // Initialize the carousel
    initializeCarousel();
});