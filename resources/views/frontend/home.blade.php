<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iconic Interior Decorator - Transform Your Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/livspace/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- LightGallery CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery-bundle.min.css">

    <!-- Toast Notification Styles -->
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 10px;
            margin-bottom: 10px;
            min-width: 300px;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            animation: slideInRight 0.4s ease-out;
            position: relative;
            overflow: hidden;
        }

        .toast.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .toast.error {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }

        .toast-icon {
            font-size: 24px;
            margin-right: 12px;
        }

        .toast-message {
            flex: 1;
            font-size: 14px;
            line-height: 1.5;
        }

        .toast-close {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            margin-left: 12px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .toast-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast.hiding {
            animation: slideOutRight 0.4s ease-out forwards;
        }

        @media (max-width: 480px) {
            .toast-container {
                right: 10px;
                left: 10px;
                top: 10px;
            }

            .toast {
                min-width: auto;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="/livspace/assets/new_logo/9723.png" alt="">
            </div>
            <button class="quote-btn">GET FREE QUOTE</button>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background">
            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1600&q=80" alt="Modern Living Room"
                class="hero-bg-image">
            <div class="hero-overlay"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Bring home beautiful<br>interiors <span class="highlight">that fit your<br>budget</span></h1>
                    <p class="hero-subtitle">Experience unmatched quality & timely delivery with Iconic Interior
                        Decorator</p>
                </div>
                <div class="hero-form">
                    <div class="form-header">
                        <h3>Designs for Every<br>Budget</h3>
                        <div class="form-pagination">1/2</div>
                    </div>
                    <form id="leadForm">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="tel" name="phone" placeholder="Phone number" required>
                        <input type="email" name="email" placeholder="Email" required>

                        <div class="whatsapp-checkbox">
                            <input type="checkbox" id="whatsapp" name="whatsapp" value="1" checked>
                            <label for="whatsapp">Send me updates on WhatsApp</label>
                        </div>
                        <button type="submit" class="next-button">Submit</button>
                        <p class="form-footer">
                            By submitting this form, you agree to the
                            <a href="#">privacy policy</a> & <a href="#">terms and conditions</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp Float Button -->
    @if($siteSettings->whatsapp)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp) }}?text={{ urlencode($siteSettings->whatsapp_message ?? 'Hello, I am interested in your services') }}"
            class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif

    <!-- Social Float Buttons - Left Side -->
    @if($siteSettings->instagram)
        <a href="{{ $siteSettings->instagram }}" class="instagram-float" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    @endif
    @if($siteSettings->facebook)
        <a href="{{ $siteSettings->facebook }}" class="facebook-float" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
    @endif

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-box">
                    <div class="feature-icon">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="38" fill="#F5F5F5" />
                            <path d="M25 40L35 30L35 50L25 40Z" fill="#FF6B6B" />
                            <rect x="30" y="32" width="25" height="20" stroke="#333" stroke-width="2" fill="none" />
                            <path d="M32 50L32 42L53 42L53 50" stroke="#333" stroke-width="2" fill="none" />
                            <path d="M45 35L52 42L58 36" stroke="#FF6B6B" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3>Personalised designs</h3>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="38" fill="#F5F5F5" />
                            <circle cx="40" cy="35" r="15" fill="white" stroke="#333" stroke-width="2" />
                            <path d="M40 25L42 30L47 30.5L42.5 34L44 39L40 36L36 39L37.5 34L33 30.5L38 30L40 25Z"
                                fill="#FF6B6B" />
                            <path d="M28 48L32 52L40 58L48 52L52 48" fill="#FF6B6B" />
                            <path d="M28 48L32 52L40 58L48 52L52 48" stroke="#FF6B6B" stroke-width="1.5" />
                            <path d="M25 48L28 50L28 53L25 51L25 48Z" fill="#E74C3C" />
                            <path d="M55 48L52 50L52 53L55 51L55 48Z" fill="#E74C3C" />
                        </svg>
                    </div>
                    <h3>Flat 10-year warranty¹</h3>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="38" fill="#F5F5F5" />
                            <rect x="30" y="28" width="22" height="28" rx="2" fill="white" stroke="#333"
                                stroke-width="2" />
                            <path d="M35 35L38 38L45 31" stroke="#FF6B6B" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <line x1="34" y1="44" x2="48" y2="44" stroke="#333" stroke-width="1.5"
                                stroke-linecap="round" />
                            <line x1="34" y1="49" x2="44" y2="49" stroke="#333" stroke-width="1.5"
                                stroke-linecap="round" />
                            <path d="M48 25L52 28L52 35L56 32" stroke="#FF6B6B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3>Transparent pricing</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Work Gallery Section -->
    <section class="work-gallery">
        <div class="container">
            <h2>Our Work Gallery</h2>
            <div class="owl-carousel owl-theme gallery-slider">
                @foreach($galleryCategories as $category)
                    <div class="gallery-card" data-gallery="{{ $category->slug }}">
                        <div class="gallery-icon">
                            <i class="{{ $category->icon ?? 'fas fa-image' }}"></i>
                        </div>
                        <h3>{{ $category->name }}</h3>
                    </div>
                @endforeach
            </div>

            <!-- Hidden galleries for each category -->
            <div class="hidden-galleries" style="display: none;">
                @foreach($galleryCategories as $category)
                    <!-- {{ $category->name }} Gallery -->
                    <div id="gallery-{{ $category->slug }}" class="category-gallery">
                        @foreach($category->images as $image)
                            <a href="{{ asset('storage/' . $image->image) }}" data-sub-html="<h4>{{ $image->title }}</h4>"></a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <h2>Let our numbers do the talking!</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>3200+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-item">
                    <h3>3500+</h3>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-item">
                    <h3>12</h3>
                    <p>Cities</p>
                </div>
                <div class="stat-item">
                    <i class="fas fa-award"></i>
                    <p>Industry Awards</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Budget Homes Section -->
    <section class="budget-homes-section">
        <div class="container">
            <div class="budget-header">
                <div class="budget-text">
                    <h2>Homes for every budget</h2>
                    <p class="budget-subtitle">Our interior designers work with you keeping in mind your requirements
                        and budget</p>
                </div>
                <button class="quote-btn-inline">GET FREE QUOTE</button>
            </div>
            <div class="budget-cards">
                <div class="budget-card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=600&q=80"
                            alt="2BHK Interior">
                        <span class="price-badge">Starting at 3.57L*</span>
                    </div>
                    <div class="card-label">2BHK</div>
                </div>
                <div class="budget-card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600&q=80"
                            alt="3BHK Interior">
                        <span class="price-badge">Starting at 4.23L*</span>
                    </div>
                    <div class="card-label">3BHK</div>
                </div>
                <div class="budget-card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?w=600&q=80"
                            alt="4BHK Interior">
                        <span class="price-badge">Starting at 4.81L*</span>
                    </div>
                    <div class="card-label">4BHK</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial">
        <div class="container">
            <div class="testimonial-content">
                <div class="testimonial-image">
                    <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=600&q=80"
                        alt="Happy Family">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="testimonial-text">
                    <blockquote>
                        "Our experience with Iconic Interior Decorator was pleasurable because of the project managers.
                        The work got done before 45 days just the way we wanted it to be."
                    </blockquote>
                    <p class="testimonial-author">Swati and Gaurav</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2>Interior Price Estimator</h2>
            <p class="section-subtitle">Calculate an approximate cost of doing your interiors!</p>

            <div class="pricing-grid">
                <div class="pricing-card">
                    <i class="fas fa-couch"></i>
                    <h4>Full Home</h4>
                    <p>Complete interior solutions for your entire home</p>
                    <button class="cta-button">Calculate Now</button>
                </div>
                <div class="pricing-card">
                    <i class="fas fa-utensils"></i>
                    <h4>Modular Kitchen</h4>
                    <p>Stylish and functional kitchen designs</p>
                    <button class="cta-button">Calculate Now</button>
                </div>
                <div class="pricing-card">
                    <i class="fas fa-paint-roller"></i>
                    <h4>Renovation</h4>
                    <p>Transform your existing space</p>
                    <button class="cta-button">Calculate Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="services-header">
                <h2>What we offer</h2>
                <button class="quote-btn-inline">GET FREE QUOTE</button>
            </div>

            <div class="services-slider-wrapper">
                <button class="slider-btn slider-prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="services-slider">
                    <div class="services-track">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3>Our services</h3>
                            <ul>
                                <li>Modular kitchens</li>
                                <li>Modular wardrobes</li>
                                <li>Lighting</li>
                                <li>Flooring</li>
                                <li>Electrical work</li>
                                <li>Civil work</li>
                                <li>False ceiling</li>
                                <li>Wall design & painting</li>
                            </ul>
                        </div>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3>Warranty</h3>
                            <ul class="warranty-list">
                                <li>
                                    <strong>FLAT 10-year warranty¹</strong> - Stay worry-free with our warranty policy
                                    on
                                    modular products.
                                </li>
                                <li>
                                    <strong>Up to 1-year on-site service warranty¹</strong> - Warranty on on-site
                                    services such
                                    as painting, electrical, plumbing and more.
                                </li>
                            </ul>
                        </div>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3>Technology & science</h3>
                            <ul class="tech-list">
                                <li>
                                    <strong>AquaBloc® Technology</strong> - Hermetically sealed edges that ensure no
                                    moisture
                                    enters the panels of your modular cabinets.
                                </li>
                                <li>
                                    <strong>AntiBubble® Technology</strong> - Super seamless panels without air bubbles
                                    for your
                                    modular cabinets.
                                </li>
                                <li>
                                    <strong>DuraBuild™ Technology</strong> - Robust structure for modular cabinets,
                                    making them
                                    strong and long-lasting.
                                </li>
                                <li>
                                    <strong>Design Science</strong> - Modular kitchens with improved accessibility that
                                    makes
                                    daily tasks more efficient and reduces stress on the body.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button class="slider-btn slider-next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="slider-dots">
                <span class="dot active" data-slide="0"></span>
                <span class="dot" data-slide="1"></span>
                <span class="dot" data-slide="2"></span>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <div class="container">
            <h2>Our trusted partners</h2>
            <p class="section-subtitle">We work with leading brands to deliver quality</p>
            <div class="owl-carousel owl-theme partners-slider">
                @forelse($partners as $partner)
                    <div class="partner-item">
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}">
                    </div>
                @empty
                    <div class="partner-item">
                        <img src="https://toppng.com/uploads/preview/godrej-logo-vector-free-11574196008bdq2jyxivw.png"
                            alt="Partner">
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section class="download-section">
        <div class="container">
            <div class="download-content">
                <div class="download-image">
                    <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?w=500" alt="Interior Design">
                </div>
                <div class="download-text">
                    <h2>Download home interior<br>design catalogue</h2>
                    <p>Get inspired by our latest interior design trends and ideas</p>
                    <button class="cta-button">Download Catalogue</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process">
        <div class="container">
            <h2>How it works</h2>
            <div class="process-timeline">
                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-icon-circle">
                            <div class="step-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <div class="step-connector-line"></div>
                    </div>
                    <div class="step-content">
                        <h4>Meet a designer</h4>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-icon-circle">
                            <div class="step-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="step-connector-line"></div>
                    </div>
                    <div class="step-content">
                        <h4>(5% payment*) Book a renovation</h4>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-icon-circle">
                            <div class="step-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                        </div>
                        <div class="step-connector-line"></div>
                    </div>
                    <div class="step-content">
                        <h4>(60% payment) Execution begins</h4>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-icon-circle">
                            <div class="step-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                        </div>
                        <div class="step-connector-line"></div>
                    </div>
                    <div class="step-content">
                        <h4>(100% payment) Final installations</h4>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-icon-circle">
                            <div class="step-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                    </div>
                    <div class="step-content">
                        <h4>Move in and enjoy!</h4>
                    </div>
                </div>
            </div>
            <button class="cta-button process-cta">BOOK FREE CONSULTATION</button>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews">
        <div class="container">
            <h2>We'll let our clients do the talking</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-image">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200" alt="Reviewer">
                    </div>
                    <p class="review-text">"Professional service and stunning results. They understood exactly what we
                        wanted!"</p>
                    <h5>Rajesh Kumar</h5>
                    <p class="review-location">New Delhi</p>
                </div>
                <div class="review-card">
                    <div class="review-image">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200" alt="Reviewer">
                    </div>
                    <p class="review-text">"From concept to completion, everything was handled perfectly. Highly
                        recommend!"</p>
                    <h5>Priya Sharma</h5>
                    <p class="review-location">Mumbai</p>
                </div>
                <div class="review-card">
                    <div class="review-image">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200" alt="Reviewer">
                    </div>
                    <p class="review-text">"Amazing transformation! The team was professional and delivered on time."
                    </p>
                    <h5>Amit Patel</h5>
                    <p class="review-location">Bangalore</p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news">
        <div class="container">
            <h2>In the news</h2>
            <div class="news-grid">
                @forelse($news as $newsItem)
                    <div class="news-card">
                        <div class="news-icon">{{ $newsItem->icon }}</div>
                        <p>"{{ $newsItem->title }}"</p>
                    </div>
                @empty
                    <div class="news-card">
                        <div class="news-icon">📰</div>
                        <p>"Leading interior design firm transforms urban living spaces"</p>
                    </div>
                    <div class="news-card">
                        <div class="news-icon">🏆</div>
                        <p>"Winner of Best Interior Design Award 2024"</p>
                    </div>
                    <div class="news-card">
                        <div class="news-icon">⭐</div>
                        <p>"Rated #1 for customer satisfaction in home interiors"</p>
                    </div>
                    <div class="news-card">
                        <div class="news-icon">💡</div>
                        <p>"Innovative design solutions setting new industry standards"</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="final-cta">
        <div class="container">
            <h2>Your dream home is just a click away</h2>
            <p>Transform your space with Iconic Interior Decorator</p>
            <button class="cta-button cta-large">Schedule Free Consultation</button>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="connect">
        <div class="container">
            <h2>Connect with us</h2>
            <p class="connect-subtitle">Reach out on WhatsApp or give us a call for the best home design experience.</p>
            <div class="connect-buttons">
                <a href="tel:+919917725700" class="connect-btn call-btn">
                    <i class="fas fa-phone-alt"></i>
                    <span>CALL NOW</span>
                </a>
                <a href="https://wa.me/919917725700?text=Hello%20iconic%20interior%20decorator%20Team%2C%20I%20am%20interested%20to%20know%20more%20about%20your%20home%20interior%20design%2Frenovation%20services"
                    class="connect-btn whatsapp-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WHATSAPP</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ICONIC INTERIOR DECORATOR</h3>
                    <p>Transforming spaces, creating dreams</p>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Shop no 203 stone hills homes shahberi greater Noida
                            sector 4</p>
                        @if($siteSettings->mobile)
                            <p><i class="fas fa-phone"></i> {{ $siteSettings->mobile }}</p>
                        @endif
                        @if($siteSettings->email)
                            <p><i class="fas fa-envelope"></i> {{ $siteSettings->email }}</p>
                        @endif
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Full Home Interiors</a></li>
                        <li><a href="#">Modular Kitchen</a></li>
                        <li><a href="#">Wardrobes</a></li>
                        <li><a href="#">Renovation</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        @if($siteSettings->facebook)
                            <a href="{{ $siteSettings->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if($siteSettings->instagram)
                            <a href="{{ $siteSettings->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($siteSettings->pinterest)
                            <a href="{{ $siteSettings->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                        @endif
                        @if($siteSettings->youtube)
                            <a href="{{ $siteSettings->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Iconic Interior Decorator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Quote Modal -->
    <div id="quoteModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <div class="modal-header">
                <h2>Get Your Free Quote</h2>
                <p>Fill in your details and we'll get back to you within 24 hours</p>
            </div>
            <form id="quoteForm" class="quote-form">
                <div class="form-group">
                    <label for="quoteName">Full Name *</label>
                    <input type="text" id="quoteName" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="quoteEmail">Email Address *</label>
                    <input type="email" id="quoteEmail" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="quotePhone">Phone Number *</label>
                    <div class="phone-input-wrapper-modal">
                        <input type="tel" id="quotePhone" name="phone" placeholder="Phone number" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="whatsapp-checkbox">
                        <input type="checkbox" id="whatsappModal" name="whatsapp" value="1" checked>
                        <label for="whatsappModal">Send me updates on WhatsApp</label>
                    </div>
                </div>
                <button type="submit" class="submit-quote-btn">Submit Request</button>
            </form>
        </div>
    </div>

    <!-- jQuery (required for Owl Carousel) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- LightGallery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="/livspace/script.js"></script>
</body>

</html>