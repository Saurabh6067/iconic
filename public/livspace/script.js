// Toast Notification Function
function showToast(message, type = "success") {
    const toastContainer = document.getElementById("toastContainer");

    // Create toast element
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;

    // Set icon based on type
    const icon = type === "success" ? "✓" : type === "error" ? "✕" : "ℹ";

    toast.innerHTML = `
        <div class="toast-icon">${icon}</div>
        <div class="toast-message">${message}</div>
        <button class="toast-close" onclick="this.parentElement.remove()">×</button>
    `;

    toastContainer.appendChild(toast);

    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add("hiding");
        setTimeout(() => {
            toast.remove();
        }, 400);
    }, 5000);
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// Modal functionality
const modal = document.getElementById("quoteModal");
const quoteBtn = document.querySelector(".quote-btn");
const modalClose = document.querySelector(".modal-close");
const modalOverlay = document.querySelector(".modal-overlay");

// Open modal when GET FREE QUOTE button is clicked
if (quoteBtn) {
    quoteBtn.addEventListener("click", function (e) {
        e.preventDefault();
        modal.classList.add("active");
        document.body.style.overflow = "hidden"; // Prevent background scrolling
    });
}

// Close modal when X button is clicked
if (modalClose) {
    modalClose.addEventListener("click", function () {
        modal.classList.remove("active");
        document.body.style.overflow = ""; // Restore scrolling
    });
}

// Close modal when clicking overlay
if (modalOverlay) {
    modalOverlay.addEventListener("click", function () {
        modal.classList.remove("active");
        document.body.style.overflow = "";
    });
}

// Auto-open modal on page load for mobile devices
// window.addEventListener("load", function () {
// 	if (window.innerWidth <= 768) {
// 		setTimeout(function () {
// 			modal.classList.add("active");
// 			document.body.style.overflow = "hidden";
// 		}, 500);
// 	}
// });

// Close modal with Escape key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && modal.classList.contains("active")) {
        modal.classList.remove("active");
        document.body.style.overflow = "";
    }
});

// Quote form submission handler
const quoteForm = document.getElementById("quoteForm");
if (quoteForm) {
    quoteForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(this);

        // Get CSRF token from meta tag
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        // Submit to Laravel backend
        fetch("/enquiry/submit", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken || "",
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    showToast(
                        data.message ||
                            "Thank you for your request! Our team will contact you within 24 hours.",
                        "success"
                    );
                    // Close modal
                    modal.classList.remove("active");
                    document.body.style.overflow = "";
                    // Reset form
                    this.reset();
                } else {
                    showToast(
                        "Something went wrong. Please try again.",
                        "error"
                    );
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showToast(
                    "Thank you for your request! Our team will contact you soon.",
                    "success"
                );
                // Close modal
                modal.classList.remove("active");
                document.body.style.overflow = "";
                // Reset form
                this.reset();
            });
    });
}

// Mobile menu toggle
const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
const navLinks = document.querySelector(".nav-links");

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
}

// Quote button inline handler (for budget section)
const quoteBtnInline = document.querySelector(".quote-btn-inline");
if (quoteBtnInline) {
    quoteBtnInline.addEventListener("click", function (e) {
        e.preventDefault();
        modal.classList.add("active");
        document.body.style.overflow = "hidden";
    });
}

// Hero form submission handler
const leadForm = document.getElementById("leadForm");
if (leadForm) {
    leadForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(this);

        // Get CSRF token from meta tag (we'll add this to HTML)
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        // Submit to Laravel backend
        fetch("/enquiry/submit", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken || "",
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    showToast(
                        data.message ||
                            "Thank you for your interest! Our team will contact you within 24 hours.",
                        "success"
                    );
                    this.reset();
                } else {
                    showToast(
                        "Something went wrong. Please try again.",
                        "error"
                    );
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showToast(
                    "Thank you for your interest! Our team will contact you soon.",
                    "success"
                );
                this.reset();
            });
    });
}

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

// Observe all sections for animation
document.querySelectorAll("section").forEach((section) => {
    section.style.opacity = "0";
    section.style.transform = "translateY(20px)";
    section.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(section);
});

// Counter animation for stats
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent =
                target.toLocaleString() + (element.dataset.suffix || "");
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString();
        }
    }, 16);
}

// Trigger counter animation when stats section is visible
const statsSection = document.querySelector(".stats");
if (statsSection) {
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll(".stat-item h3");
                counters.forEach((counter) => {
                    const text = counter.textContent;
                    const number = parseInt(text.replace(/\D/g, ""));
                    if (number) {
                        counter.dataset.suffix = text.includes("+") ? "+" : "";
                        animateCounter(counter, number);
                    }
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    statsObserver.observe(statsSection);
}

// Add active state to navigation on scroll
window.addEventListener("scroll", () => {
    const sections = document.querySelectorAll("section[id]");
    const scrollPosition = window.scrollY + 100;

    sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute("id");
        const navLink = document.querySelector(
            `.nav-links a[href="#${sectionId}"]`
        );

        if (
            scrollPosition >= sectionTop &&
            scrollPosition < sectionTop + sectionHeight
        ) {
            document.querySelectorAll(".nav-links a").forEach((link) => {
                link.classList.remove("active");
            });
            if (navLink) {
                navLink.classList.add("active");
            }
        }
    });

    // Add shadow to navbar on scroll
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.style.boxShadow = "0 4px 20px rgba(0,0,0,0.1)";
    } else {
        navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
    }
});

// CTA button handlers
document.querySelectorAll(".cta-button").forEach((button) => {
    button.addEventListener("click", function (e) {
        // If button is not in a form, scroll to contact or show modal
        if (!this.closest("form")) {
            e.preventDefault();
            const contactSection = document.getElementById("contact");
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: "smooth" });
            }
        }
    });
});

// Play button functionality for testimonial video
const playButton = document.querySelector(".play-button");
if (playButton) {
    playButton.addEventListener("click", function () {
        alert(
            "Video player would open here. Connect this to your video content."
        );
        // In a real implementation, you would open a video modal here
    });
}

// Image lazy loading for better performance
if ("loading" in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach((img) => {
        img.src = img.dataset.src;
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement("script");
    script.src =
        "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
    document.body.appendChild(script);
}

// Add ripple effect to buttons
document.querySelectorAll(".cta-button, .social-btn").forEach((button) => {
    button.addEventListener("click", function (e) {
        const ripple = document.createElement("span");
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + "px";
        ripple.style.left = x + "px";
        ripple.style.top = y + "px";
        ripple.classList.add("ripple");

        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });
});

// Console welcome message
console.log(
    "%c🏠 Welcome to Iconic Interior Decorator!",
    "color: #e74c3c; font-size: 20px; font-weight: bold;"
);
console.log(
    "%cTransforming spaces, creating dreams",
    "color: #7f8c8d; font-size: 14px;"
);

// Initialize page
document.addEventListener("DOMContentLoaded", () => {
    console.log("Page loaded successfully!");

    // Add any initialization code here
    const year = new Date().getFullYear();
    const footerYear = document.querySelector(".footer-bottom p");
    if (footerYear) {
        footerYear.textContent = footerYear.textContent.replace("2025", year);
    }
});

// Work Gallery Slider - Owl Carousel Initialization
$(document).ready(function () {
    $(".gallery-slider").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            768: {
                items: 4,
            },
            1000: {
                items: 5,
            },
        },
    });

    // Initialize LightGallery for each category
    const galleries = {};
    const categories = [
        "kitchen",
        "wardrobe",
        "temple",
        "tvunit",
        "bed",
        "wallmolding",
        "sofa",
        "balcony",
        "ceiling",
        "bathroom",
    ];

    categories.forEach((category) => {
        const galleryElement = document.getElementById(`gallery-${category}`);
        if (galleryElement) {
            galleries[category] = lightGallery(galleryElement, {
                speed: 500,
                plugins: [lgZoom, lgThumbnail],
                selector: "a",
                thumbnail: true,
                animateThumb: true,
                zoomFromOrigin: false,
                allowMediaOverlap: true,
                toggleThumb: true,
            });
        }
    });

    // Add click handlers to gallery cards
    $(".gallery-card").on("click", function (e) {
        e.preventDefault();
        const galleryType = $(this).data("gallery");
        if (galleries[galleryType]) {
            const firstLink = $(`#gallery-${galleryType} a`).first()[0];
            if (firstLink) {
                firstLink.click();
            }
        }
    });
});

// Partners Slider - Owl Carousel Initialization
$(document).ready(function () {
    $(".partners-slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 4,
            },
            600: {
                items: 4,
            },
            768: {
                items: 4,
            },
            1000: {
                items: 4,
            },
        },
    });
});
