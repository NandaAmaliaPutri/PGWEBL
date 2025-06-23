<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Gunungkidul - Jelajahi Keindahan Alam</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><linearGradient id="mountain" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%234CAF50;stop-opacity:0.8"/><stop offset="100%" style="stop-color:%232E7D32;stop-opacity:0.9"/></linearGradient></defs><path d="M0,600 L0,300 L200,150 L400,250 L600,100 L800,200 L1000,80 L1200,180 L1200,600 Z" fill="url(%23mountain)"/></svg>');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 40%, rgba(76, 175, 80, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(33, 150, 243, 0.3) 0%, transparent 50%);
            animation: shimmer 6s ease-in-out infinite alternate;
        }

        @keyframes shimmer {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 4px 20px rgba(0,0,0,0.5);
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .cta-button {
            background: linear-gradient(45deg, #ff6b6b, #ff8e53);
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 107, 107, 0.6);
            color: white;
        }

        .info-card {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            animation: slideInUp 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.8s ease;
        }

        .info-card:hover::before {
            left: 100%;
        }

        .profile-section {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .profile-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .social-link {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 25px;
            background: rgba(255,255,255,0.2);
            display: inline-block;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .social-link:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            color: white;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .feature-card:hover::before {
            transform: translateX(0);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .info-card {
                padding: 2rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            animation: bounce 2s infinite;
            z-index: 3;
        }

        .stats-section {
            background: rgba(255,255,255,0.1);
            padding: 3rem 0;
            margin: 3rem 0;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .stat-item {
            text-align: center;
            color: white;
            padding: 1rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            display: block;
            color: #4ecdc4;
        }

        .stat-label {
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Explore<br><span style="color: #4ecdc4;">Gunungkidul</span></h1>
                    <p class="hero-subtitle">
                        <i class="fa-solid fa-map-marked-alt me-2"></i>
                        Jelajahi keindahan alam dan budaya Kabupaten Gunungkidul melalui platform WebGIS interaktif yang menakjubkan
                    </p>
                    <a href="/map" class="cta-button">
                        <i class="fa-solid fa-compass me-2"></i>
                        Mulai Penjelajahan
                    </a>
                </div>
            </div>
        </div>

        <div class="scroll-indicator">
            <i class="fa-solid fa-chevron-down fa-2x"></i>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number">100+</span>
                        <div class="stat-label">Destinasi Wisata</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number">25+</span>
                        <div class="stat-label">Pantai Eksotis</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <div class="stat-label">Gua Alami</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number">∞</span>
                        <div class="stat-label">Pengalaman Tak Terlupakan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <!-- Profile Section -->
        <div class="info-card">
            <div class="profile-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-3">
                            <i class="fa-solid fa-user-circle me-2"></i>
                            Developer Profile
                        </h3>
                        <h4 class="mb-3" style="color: #4ecdc4;">Nanda Amalia Putri</h4>
                        <p class="mb-0">Passionate GIS Developer & Tourism Enthusiast</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="social-links">
                            <a href="https://www.linkedin.com/in/nanda-amalia-putri-92048432b" target="_blank" class="social-link">
                                <i class="fab fa-linkedin me-2"></i>LinkedIn
                            </a>
                            <a href="https://instagram.com/nandaamma" target="_blank" class="social-link">
                                <i class="fab fa-instagram me-2"></i>@nandaamma
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="mt-4">
                <h2 class="section-title">
                    <i class="fa-solid fa-mountain me-3"></i>
                    Selamat Datang di Explore Gunungkidul
                </h2>

                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="lead mb-4" style="font-size: 1.2rem; line-height: 1.8;">
                            Platform WebGIS revolusioner yang menampilkan persebaran lokasi wisata menakjubkan di Kabupaten Gunungkidul. Temukan berbagai destinasi alam yang memukau, kekayaan budaya yang autentik, dan petualangan tak terlupakan melalui peta interaktif yang canggih dan mudah digunakan.
                        </p>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-map-marked-alt"></i>
                        </div>
                        <h4>Peta Interaktif</h4>
                        <p>Jelajahi lokasi wisata dengan peta interaktif yang detail dan mudah digunakan. Temukan rute terbaik menuju destinasi impianmu.</p>
                    </div>

                    <div class="feature-card" onclick="window.location.href='/table'" style="cursor: pointer;">
                        <div class="feature-icon">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <h4>Galeri Visual</h4>
                        <p>Nikmati koleksi foto dan video berkualitas tinggi dari setiap destinasi wisata yang ada di Gunungkidul.</p>
                    </div>

                    <div class="feature-card" onclick="window.location.href='/points'" style="cursor: pointer;">
                        <div class="feature-icon">
                            <i class="fa-solid fa-info-circle"></i>
                        </div>
                        <h4>Informasi Lengkap</h4>
                        <p>Dapatkan informasi detail tentang fasilitas, akses, tiket masuk, dan tips berkunjung untuk setiap lokasi wisata.</p>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center mt-5 p-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); border-radius: 15px;">
                    <h3 class="mb-3" style="color: #667eea;">Siap Memulai Petualanganmu?</h3>
                    <p class="mb-4">Klik menu <strong>"Peta Wisata"</strong> untuk mulai menjelajahi titik-titik wisata terbaik yang bisa kamu kunjungi. Nikmati pengalaman menjelajah Gunungkidul dengan mudah, informatif, dan menyenangkan!</p>

                    <a href="/map" class="cta-button me-3">
                        <i class="fa-solid fa-map me-2"></i>
                        Lihat Peta Wisata
                    </a>

                    <a href="/table" class="btn btn-outline-primary btn-lg" style="border-radius: 25px; padding: 12px 30px;">
                        <i class="fa-solid fa-list me-2"></i>
                        Daftar Destinasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll animation for elements
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-section');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Counter animation for stats
        const counters = document.querySelectorAll('.stat-number');
        const animateCounters = () => {
            counters.forEach(counter => {
                const target = counter.innerText.includes('∞') ? '∞' : parseInt(counter.innerText.replace('+', ''));
                if (target === '∞') return;

                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.innerText = target + '+';
                        clearInterval(timer);
                    } else {
                        counter.innerText = Math.floor(current) + '+';
                    }
                }, 50);
            });
        };

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    </script>
</body>
</html>
