document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation Toggle
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (navToggle) {
        navToggle.addEventListener('change', function() {
            if (this.checked) {
                navMenu.style.height = navMenu.scrollHeight + 'px';
            } else {
                navMenu.style.height = '0';
            }
        });
    }
    
    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('.nav-menu a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close mobile menu if open
            if (navToggle && navToggle.checked) {
                navToggle.checked = false;
                navMenu.style.height = '0';
            }
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 70; // Adjust for fixed header
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Progress bar animation for skills
    const progressBars = document.querySelectorAll('.progressbar');
    
    // Function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Function to animate progress bars
    function animateProgressBars() {
        progressBars.forEach(bar => {
            if (isElementInViewport(bar) && !bar.classList.contains('animated')) {
                const percent = bar.getAttribute('data-percent');
                bar.style.width = percent + '%';
                bar.classList.add('animated');
            }
        });
    }
    
    // Initial check when page loads
    animateProgressBars();
    
    // Check again on scroll
    window.addEventListener('scroll', animateProgressBars);
    
    // Active navigation highlighting
    const sections = document.querySelectorAll('section, header');
    
    function highlightNavigation() {
        let scrollPosition = window.scrollY;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + sectionId) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
    
    // Initialize highlighting
    highlightNavigation();
    
    // Update on scroll
    window.addEventListener('scroll', highlightNavigation);
    
    // Add style for active links
    const style = document.createElement('style');
    style.textContent = `
        .nav-menu a.active {
            color: var(--secondary-color);
            font-weight: 700;
        }
    `;
    document.head.appendChild(style);
    
    // Add animation for section entry
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(section);
    });
    
    // Add fade-in class styles
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(animationStyle);
    
    // Back to top button
    const backToTopButton = document.createElement('div');
    backToTopButton.classList.add('back-to-top');
    backToTopButton.innerHTML = '↑';
    document.body.appendChild(backToTopButton);
    
    // Add styles for back to top button
    const backToTopStyle = document.createElement('style');
    backToTopStyle.textContent = `
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 99;
            font-size: 20px;
            box-shadow: var(--shadow);
        }
        
        .back-to-top.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .back-to-top:hover {
            background-color: var(--primary-color);
        }
    `;
    document.head.appendChild(backToTopStyle);
    
    // Show/hide back to top button
    function toggleBackToTopButton() {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    }
    
    // Initial check
    toggleBackToTopButton();
    
    // Update on scroll
    window.addEventListener('scroll', toggleBackToTopButton);
    
    // Click event for back to top button
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add a typing animation to the greeting
    const greetingText = document.querySelector('.greeting-text');
    
    if (greetingText) {
        const originalText = greetingText.textContent;
        greetingText.textContent = '';
        
        let charIndex = 0;
        function typeWriter() {
            if (charIndex < originalText.length) {
                greetingText.textContent += originalText.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, 100);
            }
        }
        
        // Start typing effect after a slight delay
        setTimeout(typeWriter, 500);
    }
    
    // Add hover effect to project items (for future projects)
    const projectStyle = document.createElement('style');
    projectStyle.textContent = `
        .project-item {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .project-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .project-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .project-info {
            padding: 1.5rem;
            background-color: white;
        }
        
        .project-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .project-desc {
            color: var(--text-light);
            margin-bottom: 1rem;
        }
        
        .project-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 3px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .project-link:hover {
            background-color: var(--primary-color);
            color: white;
        }
    `;
    document.head.appendChild(projectStyle);
});