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



});