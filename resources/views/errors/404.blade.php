{{-- resources/views/errors/404.blade.php --}}
@extends('site.layout.master')

@section('head')
    <title>صفحه پیدا نشد - خطای 404</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #218DCD;
            --secondary: #146C94;
            --accent: #0ff6f9;
            --light: #fff;
        }

        .error-card {
            background: var(--light);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .error-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--light);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .error-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            animation: pulse 8s infinite linear;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 0.5rem;
            text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .error-content {
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .error-icon {
            font-size: 5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            animation: bounce 2s infinite;
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #555;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: var(--light);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(33, 141, 205, 0.4);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(33, 141, 205, 0.6);
            color: var(--light);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: var(--light);
            transform: translateY(-3px);
        }

        .search-box {
            max-width: 500px;
            margin: 0 auto 2rem;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding-left: 3rem;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(33, 141, 205, 0.2);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 1.2rem;
        }

        .decoration {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
        }

        .decoration-1 {
            top: 10%;
            right: 5%;
            font-size: 10rem;
            color: var(--primary);
        }

        .decoration-2 {
            bottom: 10%;
            left: 5%;
            font-size: 8rem;
            color: var(--secondary);
        }

        .error-footer {
            text-align: center;
            margin-top: 2rem;
            color: #777;
            font-size: 0.9rem;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 5rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .error-content {
                padding: 2rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-5 text-center">
        <div class="error-container">
            <div class="error-card">
                <!-- دکوریشن‌های پس‌زمینه -->
                <div class="decoration decoration-1">
                    <i class="bi bi-search"></i>
                </div>
                <div class="decoration decoration-2">
                    <i class="bi bi-x-circle"></i>
                </div>

                <!-- هدر صفحه خطا -->
                <div class="error-header">
                    <h1 class="error-code">404</h1>
                    <h2 class="error-title">صفحه مورد نظر یافت نشد</h2>
                    <p>متأسفیم، اما صفحه‌ای که به دنبال آن هستید وجود ندارد.</p>
                </div>

                <!-- محتوای صفحه خطا -->
                <div class="error-content">
                    <div class="error-icon">
                        <i class="bi bi-emoji-frown"></i>
                    </div>

                    <p class="error-message">
                        ممکن است آدرس را اشتباه وارد کرده باشید یا صفحه به مکان دیگری منتقل شده است.
                        لطفاً آدرس را بررسی کنید یا از جستجو برای یافتن آنچه نیاز دارید استفاده کنید.
                    </p>
                    <!-- فوتر -->
                    <div class="error-footer">
                        <p>اگر فکر می‌کنید این یک خطاست، لطفاً با پشتیبانی تماس بگیرید.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // افزودن انیمیشن به جعبه جستجو هنگام کلیک
        document.querySelector('.search-input').addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });

        document.querySelector('.search-input').addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });

        // مدیریت ارسال فرم جستجو
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    alert(`جستجو برای: "${searchTerm}"\n\nاین یک صفحه نمایشی است. در یک سایت واقعی، این عمل شما را به نتایج جستجو هدایت می‌کند.`);
                    this.value = '';
                }
            }
        });

        // افزودن افکت‌های تعاملی به دکمه‌ها
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection
