<?php
require_once 'db.php';

// Veritabanından blog yazılarını çekelim
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmetlerimiz | Woody Digital</title>
    <meta name="description" content="SEO, Web Tasarım, Google Ads, Sosyal Medya Yönetimi, Branding ve Yazılım Geliştirme hizmetlerimizi keşfedin.">
    <meta name="keywords" content="SEO Ajansı, Web Tasarım, Google Ads, Sosyal Medya, Branding">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://www.woodydigital.com/services">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /*==========================================
            TOPBAR & GENEL YAPILANDIRMA
        ==========================================*/
        .topbar {
            background: #0f172a;
            color: #fff;
            font-size: 14px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1001; /* Header'ın üstünde kalması için */
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .topbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 48px;
        }

        .topbar__info {
            display: flex;
            gap: 30px;
        }

        .topbar__info a {
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: .9;
            transition: .3s;
        }

        .topbar__info a:hover {
            opacity: 1;
            color: #38bdf8;
        }

        .topbar__socials {
            display: flex;
            gap: 18px;
        }

        .topbar__socials a {
            font-size: 18px;
            transition: .3s;
        }

        .topbar__socials a:hover {
            color: #38bdf8;
            transform: translateY(-3px);
        }                             
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /*==========================================
            HEADER (NAVIGASYON)
        ==========================================*/
        header {
            position: fixed;
            top: 48px; /* Topbar yüksekliği kadar aşağıdan başlar */
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 90px;
        }

        .logo {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
        }
        .logo span {
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            position: relative;
            padding: 8px 0;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #2563eb;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #2563eb;
            border-radius: 2px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .lang-switch {
            display: flex;
            gap: 8px;
            background: #f1f5f9;
            padding: 6px;
            border-radius: 99px;
        }

        .lang-btn {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            padding: 6px 12px;
            border-radius: 99px;
            cursor: pointer;
        }

        .lang-btn.active {
            background: #ffffff;
            color: #2563eb;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 15px;
            padding: 14px 28px;
            border-radius: 99px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.35);
        }

        /*==========================================
            BLOG HERO (Giriş Alanı Üst Boşluk Ayarı)
        ==========================================*/
        .blog-hero {
            padding: 240px 0 100px; /* Sabit menülerden ötürü padding artırıldı */
            background: radial-gradient(circle at 10% 15%, rgba(254,242,242,0.7) 0%, transparent 50%),
                        radial-gradient(circle at 90% 80%, rgba(239,246,255,0.9) 0%, transparent 60%),
                        linear-gradient(180deg, #82b0f1 0%, #ffffff 100%);
            text-align: center;
        }

        .breadcrumb {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .section-tag {
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #2563eb;
            font-weight: 700;
            margin-bottom: 20px;
            background: rgba(37, 99, 235, 0.08);
            padding: 6px 16px;
            border-radius: 99px;
        }

        .blog-hero h1 {
            font-size: 62px;
            font-weight: 800;
            color: #0f172a;
            max-width: 850px;
            margin: 0 auto 24px;
            line-height: 1.15;
            letter-spacing: -1px;
        }

        .blog-hero p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 19px;
            line-height: 1.7;
            color: #475569;
        }

        /*==========================================
            FEATURED BLOG (Öne Çıkan Makale)
        ==========================================*/
        .featured-blog {
            padding: 100px 0 140px;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: 1fr;
        }

        .featured-image {
            overflow: hidden;
            border-radius: 24px;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .featured-grid:hover .featured-image img {
            transform: scale(1.04);
        }

        .featured-category {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .featured-content h2 {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            color: #0f172a;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .featured-content p {
            font-size: 17px;
            line-height: 1.8;
            color: #475569;
            margin-bottom: 30px;
        }

        .featured-meta {
            display: flex;
            gap: 24px;
            margin-bottom: 40px;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            border-top: 1px solid #f1f5f9;
            padding-top: 24px;
        }

        .featured-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .featured-meta i {
            font-size: 18px;
            color: #94a3b8;
        }

        /*==========================================
            RESPONSIVE (MOBİL UYUMLULUK)
        ==========================================*/
        @media(max-width: 1150px) {
            .nav-links, .nav-right .lang-switch {
                display: none;
            }
            .featured-grid {
                gap: 40px;
                padding: 20px;
            }
            .blog-hero h1 {
                font-size: 50px;
            }
            .featured-content h2 {
                font-size: 36px;
            }
        }

        @media(max-width: 992px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }
            .featured-content {
                padding: 10px;
            }
        }

        @media(max-width: 768px) {
            header {
                top: 0; /* Mobilde topbar gizlenirse veya akış değişirse diye sıfırlanabilir */
            }
            .blog-hero {
                padding: 160px 0 70px;
            }
            .blog-hero h1 {
                font-size: 36px;
            }
            .blog-hero p {
                font-size: 16px;
            }
            .featured-content h2 {
                font-size: 28px;
            }
            .featured-meta {
                flex-direction: column;
                gap: 12px;
                padding-top: 20px;
            }
        }

        /*==========================================
            BLOG POSTS
        ==========================================*/
        .blog-posts {
            padding: 130px 0;
            background: #f8fbff;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 35px;
            margin-top: 70px;
        }

        .blog-card {
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 23, 42, .06);
            transition: .4s;
            border: 1px solid #eef2f7;
        }

        .blog-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 35px 70px rgba(37, 99, 235, .15);
        }

        .blog-card__image {
            position: relative;
            overflow: hidden;
        }

        .blog-card__image img {
            width: 100%;
            display: block;
            transition: .5s;
        }

        .blog-card:hover img {
            transform: scale(1.08);
        }

        .blog-category {
            position: absolute;
            left: 20px;
            top: 20px;
            background: #2563eb;
            color: white;
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .blog-card__content {
            padding: 30px;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #64748b;
            margin-bottom: 18px;
        }

        .blog-card h3 {
            font-size: 24px;
            line-height: 1.4;
            margin-bottom: 18px;
        }

        .blog-card p {
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .blog-card a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #2563eb;
            font-weight: 600;
        }

        .blog-card a i {
            transition: .3s;
        }

        .blog-card:hover a i {
            transform: translateX(6px);
        } 

        @media(max-width: 992px) {
            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 768px) {
            .blog-posts {
                padding: 80px 0;
            }
            .blog-grid {
                grid-template-columns: 1fr;
            }
            .blog-card h3 {
                font-size: 21px;
            }
        } 

        /*==========================================
            BLOG SEARCH
        ==========================================*/
        .blog-search {
            padding: 70px 0 20px;
            background: #ffffff;
        }

        .blog-search__wrapper {
            display: flex;
            justify-content: center;
        }

        .blog-search__box {
            position: relative;
            width: 100%;
            max-width: 650px;
        }

        .blog-search__box input {
            width: 100%;
            height: 68px;
            padding: 0 25px 0 65px;
            border-radius: 999px;
            border: 2px solid #eef2f7;
            background: #fff;
            font-size: 17px;
            outline: none;
            transition: .35s;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        }

        .blog-search__box input:focus {
            border-color: #2563eb;
            box-shadow: 0 15px 35px rgba(37, 99, 235, .15);
        }

        .blog-search__box i {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #2563eb;
        }

        .popular-tags {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .popular-tags span {
            font-weight: 600;
            color: #64748b;
        }

        .tag-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 999px;
            background: #eff6ff;
            color: #2563eb;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        .tag-btn:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-3px);
        }

        /*==========================================
            BLOG FILTER
        ==========================================*/
        .blog-filter {
            padding: 30px 0 60px;
            background: #fff;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 14px 26px;
            border: none;
            border-radius: 999px;
            background: #eff6ff;
            color: #2563eb;
            font-weight: 600;
            cursor: pointer;
            transition: .35s;
        }

        .filter-btn:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-3px);
        }

        .filter-btn.active {
            background: #2563eb;
            color: white;
            box-shadow: 0 10px 25px rgba(37, 99, 235, .25);
        }

        .blog-card {
            opacity: 1;
            transform: translateY(0);
            transition: opacity .35s ease, transform .35s ease;
        }

        .blog-card.hide {
            opacity: 0;
            transform: translateY(25px);
            pointer-events: none;
        }

        /*==========================================
            NEWSLETTER SIDEBAR
        ==========================================*/
        .newsletter-card p {
            color: #64748b;
            line-height: 1.8;
            margin: 20px 0 25px;
        }

        .newsletter-form {
            display: flex;
            gap: 12px;
        }

        .newsletter-form input {
            flex: 1;
            height: 56px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 0 18px;
            outline: none;
            font-size: 15px;
            transition: .3s;
        }

        .newsletter-form input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .10);
        }

        .newsletter-form button {
            width: 56px;
            height: 56px;
            border: none;
            border-radius: 16px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            font-size: 20px;
            transition: .35s;
        }

        .newsletter-form button:hover {
            transform: translateY(-3px);
            background: #1d4ed8;
        }

        .blog-sidebar {
            position: sticky;
            top: 120px;
            align-self: start;
        }
    </style>
</head>

<body>

    <!-- ÜST BİLGİ BARİ (Topbar) -->
    <div class="topbar">
        <div class="container">
            <div class="topbar__info">
                <a href="tel:+905555555555"><i class="ri-phone-fill"></i> +90 (555) 555 55 55</a>
                <a href="mailto:info@woodydigital.com"><i class="ri-mail-fill"></i> info@woodydigital.com</a>
            </div>
            <div class="topbar__socials">
                <a href="#"><i class="ri-instagram-line"></i></a>
                <a href="#"><i class="ri-facebook-box-line"></i></a>
                <a href="#"><i class="ri-linkedin-box-line"></i></a>
                <a href="#"><i class="ri-youtube-line"></i></a>
            </div>
        </div>
    </div> 

    <!--==========================================
        HEADER (ÜST MENÜ / NAVİGASYON)
    ===========================================-->
    <header>
        <div class="container nav-container">
            <!-- Logo -->
            <a href="index.html" class="logo">
                Woody<span>Digital</span>
            </a>

            <!-- Menü Linkleri -->
            <ul class="nav-links">
                <li><a href="index.html">Ana Sayfa</a></li>
                <li><a href="about.html">Hakkımızda</a></li>
                <li><a href="services.html">Hizmetler</a></li>
                <li><a href="blog.php" class="active">Blog</a></li>
                <li><a href="contact.html">İletişim</a></li>
            </ul>

            <!-- Sağ Yapı (Dil ve Teklif Butonu) -->
            <div class="nav-right">
                <div class="lang-switch">
                    <span class="lang-btn active">TR</span>
                    <span class="lang-btn">EN</span>
                    <span class="lang-btn">RU</span>
                    <span class="lang-btn">AR</span>
                </div>
                <a href="quote.html" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px;">
                    Ücretsiz Teklif Al
                </a>
            </div>
        </div>
    </header>

    <main>
        <!--==========================================
            BLOG HERO (GİRİŞ ALANI)
        ===========================================-->
        <section class="blog-hero">
            <div class="container">
                <span class="section-tag">Woody Digital Blog</span>
                <h1>Dijital Dünyadan<br>En Güncel Bilgiler</h1>
                <p>
                    SEO, Google Ads, Yapay Zeka, Web Tasarım ve Dijital Pazarlama 
                    hakkında güncel içerikleri keşfedin.
                </p>
            </div>
        </section>

        <!--==========================================
            FEATURED ARTICLE (ÖNE ÇIKAN MAKALE)
        ===========================================-->
        <section class="featured-blog">
            <div class="container">
                <div class="featured-grid">
                    <div class="featured-image">
                        <img src="assets/images/blog/featured.webp" alt="2026 Dijital Pazarlama">
                    </div>
                    
                    <div class="featured-content">
                        <span class="featured-category">Öne Çıkan Makale</span>
                        <h2>2026 Dijital Pazarlama Trendleri</h2>
                        <p>
                            SEO, Yapay Zeka, Google Ads, UX Tasarım ve içerik 
                            pazarlamasındaki en önemli trendleri keşfedin.
                        </p>
                        
                        <div class="featured-meta">
                            <span>
                                <i class="ri-calendar-line"></i>
                                12 Temmuz 2026
                            </span>
                            <span>
                                <i class="ri-time-line"></i>
                                8 dk okuma
                            </span>
                        </div>
                        
                        <a href="blog-detail.html" class="btn btn-primary">
                            Yazıyı Oku
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!--==========================================
                BLOG POSTS
        ===========================================-->
        <section class="blog-posts">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Son Yazılar</span>
                    <h2>Dijital Dünyadan Güncel İçerikler</h2>
                    <p>
                        SEO, reklam yönetimi, web tasarım, yapay zeka ve dijital pazarlama
                        hakkında uzman ekibimizin hazırladığı içerikleri keşfedin.
                    </p>
                </div>

                <div class="blog-grid"> 
                    <?php if(!empty($posts)): ?>
                        <?php foreach ($posts as $item): ?>
                            <article class="blog-card" data-category="all">
                                <div class="blog-card__image">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                                    <span class="blog-category">Blog</span>
                                </div>
                                <div class="blog-card__content">
                                    <div class="blog-meta">
                                        <span><i class="ri-calendar-line"></i> <?= date('d.m.Y', strtotime($item['created_at'])) ?></span>
                                        <span><i class="ri-user-line"></i> <?= htmlspecialchars($item['author'] ?? 'Admin') ?></span>
                                    </div>
                                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                                    <p>
                                        <?= htmlspecialchars($item['summary']) ?>
                                    </p>
                                    <a href="blog-detail.php?id=<?= $item['id'] ?>">
                                        Devamını Oku <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Henüz eklenmiş bir blog yazısı bulunmuyor.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!--==========================================
                    BLOG SEARCH & NEWSLETTER
        ===========================================-->
        <section class="blog-search">
            <div class="container">
                <div class="blog-search__wrapper">
                    <div class="blog-search__box">
                        <i class="ri-search-line"></i>
                        <input type="text" id="blogSearch" placeholder="Blog yazılarında ara...">
                    </div>
                </div>

                <div class="popular-tags">
                    <span>Popüler:</span>
                    <button class="tag-btn">SEO</button>
                    <button class="tag-btn">Google Ads</button>
                    <button class="tag-btn">Web Tasarım</button>
                    <button class="tag-btn">Yapay Zeka</button>
                    <button class="tag-btn">E-Ticaret</button>
                </div>

                <div class="sidebar-card newsletter-card" style="max-width: 650px; margin: 50px auto 0;">
                    <h3>E-Bülten Aboneliği</h3>
                    <p>
                        Dijital pazarlama, SEO ve yapay zeka hakkında en güncel içerikleri
                        e-posta adresinize gönderelim.
                    </p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="E-posta adresinizi girin" required>
                        <button type="submit">
                            <i class="ri-send-plane-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!--==========================================
                    BLOG FILTER
        ===========================================-->
        <section class="blog-filter">
            <div class="container">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Tümü</button>
                    <button class="filter-btn" data-filter="seo">SEO</button>
                    <button class="filter-btn" data-filter="google ads">Google Ads</button>
                    <button class="filter-btn" data-filter="web tasarım">Web Tasarım</button>
                    <button class="filter-btn" data-filter="sosyal medya">Sosyal Medya</button>
                    <button class="filter-btn" data-filter="branding">Branding</button>
                    <button class="filter-btn" data-filter="yapay zeka">Yapay Zeka</button>
                    <button class="filter-btn" data-filter="yazılım">Yazılım</button>
                    <button class="filter-btn" data-filter="e-ticaret">E-Ticaret</button>
                </div>
            </div>
        </section>
    </main>

    <!-- JS BAĞLANTILARI -->
    <script src="js/script.js"></script>
    <script>
        /*==========================================
                    BLOG SEARCH
        ==========================================*/
        const blogSearch = document.getElementById("blogSearch");
        const blogCards = document.querySelectorAll(".blog-card");

        if (blogSearch) {
            blogSearch.addEventListener("keyup", function () {
                const value = this.value.toLowerCase().trim();
                blogCards.forEach(card => {
                    const title = card.querySelector("h3").textContent.toLowerCase();
                    const category = card.querySelector(".blog-category") ? card.querySelector(".blog-category").textContent.toLowerCase() : "";
                    const text = card.querySelector("p").textContent.toLowerCase();

                    if (title.includes(value) || category.includes(value) || text.includes(value)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        } 

        /*==========================================
                    BLOG FILTER
        ==========================================*/
        const filterButtons = document.querySelectorAll(".filter-btn");

        filterButtons.forEach(button => {
            button.addEventListener("click", () => {
                filterButtons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");

                const filter = button.dataset.filter;

                blogCards.forEach(card => {
                    const category = card.dataset.category;
                    if (filter === "all" || category === filter) {
                        card.style.display = "block";
                        card.classList.remove("hide");
                    } else {
                        card.style.display = "none";
                        card.classList.add("hide");
                    }
                });
            });
        });
    </script>
</body>
</html>