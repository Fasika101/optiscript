<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'OptiScript') }} - Ethiopia's Unified Eye Prescription System</title>

    <meta name="description" content="OptiScript is Ethiopia's first unified digital eye prescription management system. Create, store, and manage prescriptions digitally with secure cloud storage.">
    <meta name="keywords" content="Ethiopia, eye prescription, digital healthcare, optometry, prescription management, eye care">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; font-size: 15px; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.5rem 1.125rem;
            border-radius: 0.4375rem;
            font-weight: 600;
            font-size: 0.8125rem;
            line-height: 1.125rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
        }
        .btn-primary:hover { background: #1d4ed8; box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35); }

        .btn-secondary {
            background: #fff;
            color: #334155;
            border: 1.5px solid #cbd5e1;
        }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }

        .btn-lg {
            padding: 0.625rem 1.375rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            border-radius: 0.5rem;
        }

        .btn-ghost {
            background: transparent;
            color: #475569;
            padding: 0.5rem 0.875rem;
            font-size: 0.8125rem;
        }
        .btn-ghost:hover { color: #2563eb; background: #f1f5f9; transform: none; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        @keyframes pulse-ring {
            0%   { transform: scale(0.95); opacity: 0.7; }
            50%  { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.7; }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes fillBar {
            from { width: 0; }
            to   { width: 100%; }
        }
        @keyframes typeCursor {
            0%, 100% { opacity: 1; }
            50%      { opacity: 0; }
        }

        .animate-fade-up {
            animation: fadeUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) both;
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08);
        }

        /* Animated prescription card */
        .rx-card {
            animation: float 6s ease-in-out infinite;
        }
        .rx-row {
            opacity: 0;
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        .rx-row:nth-child(1) { animation-delay: 0.3s; }
        .rx-row:nth-child(2) { animation-delay: 0.6s; }
        .rx-row:nth-child(3) { animation-delay: 0.9s; }
        .rx-row:nth-child(4) { animation-delay: 1.2s; }
        .rx-row:nth-child(5) { animation-delay: 1.5s; }

        .rx-value {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            animation: typeReveal 1s steps(6) forwards;
        }
        .rx-value-1 { animation-delay: 1.8s; width: 0; }
        .rx-value-2 { animation-delay: 2.1s; width: 0; }
        .rx-value-3 { animation-delay: 2.4s; width: 0; }

        @keyframes typeReveal {
            to { width: 3.5rem; }
        }

        .rx-status-dot {
            animation: pulse-ring 2s ease-in-out infinite;
        }

        .rx-progress {
            height: 3px;
            background: #e2e8f0;
            border-radius: 999px;
            overflow: hidden;
        }
        .rx-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #2563eb, #6366f1);
            border-radius: 999px;
            animation: fillBar 2s cubic-bezier(0.4, 0, 0.2, 1) 2.6s forwards;
            width: 0;
        }

        header {
            transition: box-shadow 0.3s ease, background 0.3s ease;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        @media (min-width: 640px) {
            header { padding-left: 1.5rem; padding-right: 1.5rem; }
        }
        @media (min-width: 1024px) {
            header { padding-left: 2rem; padding-right: 2rem; }
        }
        header.scrolled {
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        }

        /* Typography — slightly compact */
        .t-hero {
            font-size: clamp(1.75rem, 4.5vw, 3.25rem);
            line-height: 1.15;
        }
        .t-section {
            font-size: clamp(1.375rem, 2.5vw, 1.875rem);
            line-height: 1.25;
        }
        .t-lead { font-size: 1.0625rem; line-height: 1.65; }
        .t-body { font-size: 0.9375rem; line-height: 1.6; }
        .t-small { font-size: 0.8125rem; }
        .t-label { font-size: 0.6875rem; }

        /* Consistent section spacing */
        .page-section {
            padding: 4rem 1.5rem;
        }
        @media (min-width: 640px) {
            .page-section { padding: 5rem 2rem; }
        }
        @media (min-width: 1024px) {
            .page-section { padding: 5.5rem 3rem; }
        }

        /* Extra top space below sticky header on first section */
        .hero-section {
            padding-top: 5rem;
        }
        @media (min-width: 640px) {
            .hero-section { padding-top: 5.5rem; }
        }

        /* Scroll anchor offset for sticky header */
        section[id] {
            scroll-margin-top: 5rem;
        }

        /* About section — side-by-side layout (prescription left, text right) */
        .about-layout {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            align-items: stretch;
        }
        @media (min-width: 768px) {
            .about-layout {
                flex-direction: row;
                align-items: center;
                gap: 4rem;
            }
            .about-layout__rx {
                flex: 0 0 42%;
                max-width: 42%;
            }
            .about-layout__text {
                flex: 1;
                min-width: 0;
            }
        }

        .site-footer {
            background-color: #f1f5f9;
            border-top: 1px solid #e2e8f0;
            padding-top: 2.75rem;
            padding-bottom: 2.75rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            color: #0f172a;
        }
        @media (min-width: 640px) {
            .site-footer {
                padding-left: 2rem;
                padding-right: 2rem;
                padding-bottom: 3.5rem;
            }
        }
        @media (min-width: 1024px) {
            .site-footer { padding-left: 3rem; padding-right: 3rem; }
        }
        .site-footer h3,
        .site-footer p,
        .site-footer a,
        .site-footer nav a {
            color: #0f172a;
        }
        .site-footer p.subtitle {
            color: #475569;
            font-size: 0.6875rem;
        }
        .site-footer p.tagline {
            color: #64748b;
        }
        .site-footer nav a {
            font-size: 0.8125rem;
        }
        .site-footer a:hover {
            color: #2563eb;
        }
        .site-footer a.link-accent {
            color: #2563eb;
            font-weight: 500;
        }
        .site-footer a.link-accent:hover {
            color: #1d4ed8;
        }

        .hero-preview {
            margin-top: 2.5rem;
            padding-top: 1rem;
        }
        @media (min-width: 640px) {
            .hero-preview {
                margin-top: 3.5rem;
                padding-top: 1.5rem;
            }
        }

        /* New Online Optics section */
        .optics-card {
            background: linear-gradient(135deg, #eff6ff 0%, #eef2ff 100%);
            border: 1px solid #bfdbfe;
            border-radius: 0.875rem;
            padding: 1.75rem;
            color: #0f172a;
        }
        @media (min-width: 640px) {
            .optics-card { padding: 2.25rem; }
        }
        @media (min-width: 1024px) {
            .optics-card { padding: 2.75rem; }
        }
        .optics-card h2 {
            color: #0f172a;
            font-weight: 700;
            font-size: clamp(1.375rem, 2.5vw, 1.875rem);
        }
        .optics-card p,
        .optics-card li span {
            color: #334155;
        }
        .optics-impact {
            background: #fff;
            border: 1px solid #dbeafe;
            border-radius: 0.625rem;
            padding: 1.375rem;
            color: #0f172a;
        }
        .optics-impact h3 {
            color: #0f172a;
            font-weight: 600;
            font-size: 1rem;
        }
        .optics-impact p {
            color: #475569;
            font-size: 0.8125rem;
        }

        .feature-card { padding: 1.375rem !important; }
        .feature-card h3 { font-size: 0.9375rem !important; }
        .feature-card p { font-size: 0.8125rem !important; }
        .feature-card .icon-wrap {
            width: 2.5rem;
            height: 2.5rem;
            margin-bottom: 1rem;
        }
        .feature-card .icon-wrap svg { width: 1.125rem; height: 1.125rem; }

        .hero-card { padding: 1.375rem !important; }
        .hero-card .rx-grid { gap: 0.625rem; }
        .hero-card .rx-cell { padding: 0.75rem !important; }
        .hero-card .rx-value { font-size: 0.9375rem !important; }

        .site-header-inner { height: 3.5rem; }
        .site-logo { width: 2.25rem; height: 2.25rem; }
        .site-logo svg { width: 1.125rem; height: 1.125rem; }
        .site-brand-title { font-size: 1.0625rem; }
        .site-brand-sub { font-size: 0.6875rem; }
        .site-nav a { font-size: 0.8125rem; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <!-- Header -->
    <header id="site-header" class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center site-header-inner">
                <div class="flex items-center gap-3">
                    <div class="site-logo bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="site-brand-title font-bold text-slate-900 font-['Space_Grotesk']">OptiScript</h1>
                        <p class="site-brand-sub text-slate-500">Ethiopia's Eye Prescription System</p>
                    </div>
                </div>

                <nav class="site-nav hidden md:flex items-center gap-8">
                    <a href="#features" class="text-slate-600 hover:text-blue-600 transition-colors duration-300">Features</a>
                    <a href="#about" class="text-slate-600 hover:text-blue-600 transition-colors duration-300">About</a>
                    <a href="#contact" class="text-slate-600 hover:text-blue-600 transition-colors duration-300">Contact</a>
                </nav>

                <div class="flex items-center gap-5">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-section page-section bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="t-hero animate-fade-up font-bold text-slate-900 mb-5 font-['Space_Grotesk']">
                Digital Eye Care for
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Ethiopia</span>
            </h1>
            <p class="t-lead animate-fade-up delay-100 text-slate-600 mb-8 max-w-3xl mx-auto">
                OptiScript is Ethiopia's first unified digital eye prescription management system.
                Create, store, and manage prescriptions with secure cloud storage and seamless clinic integration.
            </p>

            <div class="animate-fade-up delay-200 flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-lg">Create Prescription</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">View Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started — It's Free</a>
                    <a href="#about" class="btn btn-secondary btn-lg">See Demo</a>
                @endauth
            </div>

            <div class="hero-preview animate-fade-up delay-300 max-w-md mx-auto">
                <div class="hero-card bg-white rounded-2xl shadow-xl border border-slate-200 animate-float">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="t-body font-semibold text-slate-900">Digital Prescription</h3>
                                <p class="t-small text-slate-500">Patient: Abebe Kebede</p>
                            </div>
                        </div>
                        <span class="t-label bg-green-100 text-green-800 px-2.5 py-1 rounded-full font-medium">Active</span>
                    </div>
                    <div class="rx-grid grid grid-cols-3 mb-4">
                        <div class="rx-cell bg-slate-50 rounded-lg text-center">
                            <div class="t-label text-slate-500 mb-1 uppercase">SPH</div>
                            <div class="rx-value font-mono font-semibold text-slate-900">-2.50</div>
                        </div>
                        <div class="rx-cell bg-slate-50 rounded-lg text-center">
                            <div class="t-label text-slate-500 mb-1 uppercase">CYL</div>
                            <div class="rx-value font-mono font-semibold text-slate-900">-0.75</div>
                        </div>
                        <div class="rx-cell bg-slate-50 rounded-lg text-center">
                            <div class="t-label text-slate-500 mb-1 uppercase">AXIS</div>
                            <div class="rx-value font-mono font-semibold text-slate-900">180°</div>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 pt-3 flex justify-between t-small">
                        <span class="text-slate-500">Created</span>
                        <span class="text-slate-900 font-medium">{{ date('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="page-section bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="reveal text-center mb-12">
                <h2 class="t-section font-bold text-slate-900 mb-3 font-['Space_Grotesk']">
                    Everything you need for modern eye care
                </h2>
                <p class="t-body text-slate-600 max-w-3xl mx-auto">
                    Streamline your practice with powerful tools designed specifically for Ethiopian healthcare providers
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Digital Prescriptions</h3>
                    <p class="text-slate-600 leading-relaxed">Create and manage eye prescriptions digitally. No more paper forms — everything is stored securely in the cloud.</p>
                </div>
                <!-- Feature 2 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Patient Management</h3>
                    <p class="text-slate-600 leading-relaxed">Comprehensive patient records with prescription history, follow-ups, and treatment tracking all in one place.</p>
                </div>
                <!-- Feature 3 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Analytics & Reports</h3>
                    <p class="text-slate-600 leading-relaxed">Track prescription trends, patient outcomes, and clinic performance with detailed analytics and custom reports.</p>
                </div>
                <!-- Feature 4 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Multi-Clinic Network</h3>
                    <p class="text-slate-600 leading-relaxed">Connect multiple clinics across Ethiopia for seamless patient referrals and coordinated care delivery.</p>
                </div>
                <!-- Feature 5 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Secure & Compliant</h3>
                    <p class="text-slate-600 leading-relaxed">Bank-level security with encrypted data storage and compliance with healthcare privacy standards.</p>
                </div>
                <!-- Feature 6 -->
                <div class="reveal feature-card bg-slate-50 rounded-xl">
                    <div class="icon-wrap bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">Mobile Ready</h3>
                    <p class="text-slate-600 leading-relaxed">Access prescriptions anywhere with our mobile-optimized platform designed for busy healthcare providers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About — prescription animation left, text right -->
    <section id="about" class="page-section bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="about-layout">

                <!-- Left: animated prescription -->
                <div class="about-layout__rx reveal">
                    <div class="rx-card bg-white rounded-2xl shadow-xl border border-slate-200 p-6 sm:p-8 w-full">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 uppercase tracking-wider">OptiScript Rx</p>
                                    <p class="font-semibold text-slate-900 text-sm">Generating prescription…</p>
                                </div>
                            </div>
                            <span class="rx-status-dot w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        </div>

                        <div class="space-y-4">
                            <div class="rx-row flex justify-between items-center">
                                <span class="text-sm text-slate-500">Patient</span>
                                <span class="text-sm font-medium text-slate-900">Abebe Kebede</span>
                            </div>
                            <div class="rx-row flex justify-between items-center">
                                <span class="text-sm text-slate-500">Clinic</span>
                                <span class="text-sm font-medium text-slate-900">Addis Vision Center</span>
                            </div>
                            <div class="rx-row flex justify-between items-center">
                                <span class="text-sm text-slate-500">Doctor</span>
                                <span class="text-sm font-medium text-slate-900">Dr. Selam T.</span>
                            </div>

                            <div class="rx-row grid grid-cols-3 gap-3 pt-2">
                                <div class="bg-slate-50 rounded-lg p-3 text-center">
                                    <div class="text-[10px] text-slate-400 uppercase mb-1">SPH</div>
                                    <div class="font-mono font-bold text-blue-600 rx-value rx-value-1">-2.50</div>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-3 text-center">
                                    <div class="text-[10px] text-slate-400 uppercase mb-1">CYL</div>
                                    <div class="font-mono font-bold text-indigo-600 rx-value rx-value-2">-0.75</div>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-3 text-center">
                                    <div class="text-[10px] text-slate-400 uppercase mb-1">AXIS</div>
                                    <div class="font-mono font-bold text-purple-600 rx-value rx-value-3">180°</div>
                                </div>
                            </div>

                            <div class="rx-row pt-2">
                                <div class="flex justify-between text-xs text-slate-500 mb-2">
                                    <span>Processing</span>
                                    <span class="text-blue-600 font-medium">Verified</span>
                                </div>
                                <div class="rx-progress">
                                    <div class="rx-progress-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: about text -->
                <div class="about-layout__text reveal">
                    <p class="t-label font-semibold text-blue-600 uppercase tracking-wider mb-2">About OptiScript</p>
                    <h2 class="t-section font-bold text-slate-900 mb-5 font-['Space_Grotesk']">
                        Unifying eye prescriptions across Ethiopia
                    </h2>
                    <div class="space-y-4 text-slate-600 leading-relaxed">
                        <p class="t-body">
                            OptiScript is Ethiopia's first unified digital eye prescription management system — built to connect clinics, doctors, and patients through one secure platform.
                        </p>
                        <p class="t-body">
                            Our platform enables optometrists, ophthalmologists, and eye care clinics to digitally create, store, and share prescriptions while maintaining the highest standards of patient privacy and data security.
                        </p>
                        <p class="t-body">
                            Built specifically for the Ethiopian healthcare ecosystem, OptiScript works on any device, integrates with existing clinic workflows, and is <strong class="text-slate-900">free forever</strong> for healthcare providers.
                        </p>
                    </div>
                    <ul class="mt-6 space-y-2.5">
                        @foreach(['Standardized national prescription format', 'Multi-doctor clinic support', 'PDF export & print ready', 'Free forever for Ethiopian clinics'] as $item)
                        <li class="flex items-center gap-2.5 t-small text-slate-700">
                            <span class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- New Online Optics -->
    <section class="page-section bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="reveal optics-card">
                <div class="grid lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <h2 class="t-section mb-4 font-['Space_Grotesk']">New Online Optics</h2>
                        <p class="t-body mb-6 leading-relaxed">
                            Your trusted partner for quality eyeglass frames and optical solutions. Browse our extensive collection of designer and affordable frames.
                        </p>
                        <ul class="space-y-3 mb-6 t-body">
                            @foreach(['Premium quality frames from trusted brands', 'Fast delivery across Ethiopia', 'Expert fitting guidance and 24/7 support'] as $point)
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $point }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <a href="https://newonlineoptics.com" target="_blank" rel="noopener noreferrer"
                           class="btn btn-primary btn-lg">
                            Shop Eyeglass Frames
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex justify-center lg:justify-end">
                        <div class="optics-impact max-w-sm w-full">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg mb-2">Community Impact</h3>
                            <p class="text-sm leading-relaxed">
                                New Online Optics powers OptiScript free for Ethiopian clinics and runs the Dejene & Zenebech Foundation offering free frames to those in need every Friday.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="page-section bg-slate-50">
        <div class="reveal max-w-3xl mx-auto text-center">
            <h2 class="t-section font-bold text-slate-900 mb-4 font-['Space_Grotesk']">
                Ready to Transform Eye Care in Ethiopia?
            </h2>
            <p class="t-body text-slate-600 mb-6 leading-relaxed">
                Join eye care professionals already using OptiScript to deliver better patient outcomes — free forever.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-lg">Create Your First Prescription</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started for Free</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Already have an account?</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer / Contact -->
    <footer id="contact" class="site-footer">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-10 items-center">
                <div class="flex items-center gap-3">
                    <div class="site-logo bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="site-brand-title font-bold font-['Space_Grotesk']">OptiScript</h3>
                        <p class="site-brand-sub subtitle">Ethiopia's Eye Prescription System</p>
                    </div>
                </div>

                <nav class="site-nav flex justify-center gap-8">
                    <a href="#features">Features</a>
                    <a href="#about">About</a>
                    <a href="https://newonlineoptics.com" target="_blank" rel="noopener noreferrer">Shop Frames</a>
                </nav>

                <div class="text-center md:text-right">
                    <p class="t-small">
                        Made with ❤️ by
                        <a href="https://newonlineoptics.com" target="_blank" rel="noopener noreferrer" class="link-accent">New Online Optics</a>
                    </p>
                    <p class="t-label tagline mt-1">Free forever for Ethiopian healthcare</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Header shadow on scroll
        const header = document.getElementById('site-header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 10);
        }, { passive: true });

        // Reveal on scroll
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(el => observer.observe(el));
    </script>
</body>
</html>
