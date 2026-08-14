<?php
session_start();
$page_title = "Barber Society";
$current_year = date('Y');
$logged_in = isset($_SESSION['customer_id']);
$customer_name = $_SESSION['customer_name'] ?? '';

$services = [
    [
        "num"   => "01",
        "name"  => "Classic Cut & Fade",
        "desc"  => "Precision scissor or clipper cuts tailored to your style. Clean low, mid, or high fade with sharp detailing — every line intentional.",
        "tags"  => ["Classic Cut — ₱350", "Fade & Taper — ₱400", "Kids Cut — ₱250"],
        "price" => "₱350",
        "label" => "Starting at",
        "word"  => "CUT",
    ],
    [
        "num"   => "02",
        "name"  => "Beard Sculpt & Shave",
        "desc"  => "Shape, trim, and line up your beard to perfection. Traditional straight razor shave with hot towel treatment — the full ritual.",
        "tags"  => ["Beard Sculpt — ₱250", "Hot Towel Shave — ₱300"],
        "price" => "₱250",
        "label" => "Starting at",
        "word"  => "BEARD",
    ],
    [
        "num"   => "03",
        "name"  => "Hair + Beard Combo",
        "desc"  => "Full cut and beard grooming in one session. The complete package — walk out looking like the sharpest version of yourself.",
        "tags"  => ["Hair + Beard — ₱600", "Best Value"],
        "price" => "₱600",
        "label" => "Full session",
        "word"  => "COMBO",
    ],
];

$steps = [
    ["num" => "01", "title" => "Book or Walk In",      "desc" => "Reserve a slot ahead or simply walk in — we accommodate both. Check availability by phone or drop by."],
    ["num" => "02", "title" => "Consult Your Barber",  "desc" => "Your barber sits with you to understand your style, face shape, and what you're going for."],
    ["num" => "03", "title" => "The Cut",               "desc" => "Precision work, every time. Scissors, clippers, straight razor — whatever the moment calls for."],
    ["num" => "04", "title" => "Walk Out Sharp",        "desc" => "Clean finish, hot towel, final check. You leave looking — and feeling — like the best version of yourself."],
];

$barbers = [
    ["name" => "Aivan Cabaraban", "title" => "Master Barber",   "exp" => "12 years experience"],
    ["name" => "Jeem Balbarez",   "title" => "Senior Stylist",  "exp" => "8 years experience"],
    ["name" => "Jeremiah Ibalio",   "title" => "Fade Specialist", "exp" => "5 years experience"],
];

$faqs = [
    ["q" => "Do I need a reservation?",              "a" => "Walk-ins are always welcome when slots are open. For guaranteed availability, we recommend booking in advance — especially on weekends."],
    ["q" => "How long does a session take?",          "a" => "A standard cut takes around 30–45 minutes. A full combo (hair + beard) typically runs 60–75 minutes depending on complexity."],
    ["q" => "Do you do kids' cuts?",                 "a" => "Yes — our Kids Cut is ₱250, done with care and patience. Gentle, precise, and stress-free for the young gents."],
    ["q" => "What payment methods do you accept?",   "a" => "We accept cash, GCash, and Maya. Card payments are also available at the counter."],
    ["q" => "Where are you located?",                "a" => "123 Kalayaan Ave, Laguna, Calamba City. Accessible by MRT (Kamuning Station) and major jeepney routes along Quezon Ave."],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ─── Variables ─── */
        :root {
            --bg:           #0C0F0C;
            --text:         #F2F2F2;
            --text-dim:     rgba(242, 242, 242, 0.75);
            --text-faint:   rgba(242, 242, 242, 0.40);
            --border:       rgba(242, 242, 242, 0.15);
            --border-mid:   rgba(242, 242, 242, 0.20);
            --accent-faint: rgba(242, 242, 242, 0.08);
            --accent-faint2:rgba(242, 242, 242, 0.04);
            --btn-bg:       #0C0F0C;
            --btn-text:     #0C0F0C;
        }

        /* ─── Reset ─── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            font-size: 15px;
            line-height: 1.6;
        }

        /* ─── Scrollbar ─── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border-mid); border-radius: 3px; }

        /* ─── Ticker ─── */
        .ticker {
            background: var(--accent-faint);
            overflow: hidden;
            white-space: nowrap;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 200;
        }
        .ticker-track {
            display: inline-flex;
            animation: tick 28s linear infinite;
        }
        .ticker-track span {
            padding: 0 2rem;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-dim);
        }
        @keyframes tick {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ─── Nav ─── */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 2.5rem;
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 33px; left: 0; right: 0;
            z-index: 100;
            background: rgba(12, 15, 12, 0.92);
            backdrop-filter: blur(12px);
        }
        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 0.1em;
            color: var(--text);
            text-decoration: none;
        }
        .nav-links {
            display: flex;
            gap: 0.7rem;
            list-style: none;
            align-items: center;
            padding-left: 0.5rem;
        }
        .nav-links a {
            color: var(--text-dim);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-pill {
            background: var(--btn-bg) !important;
            color: #F2F2F2 !important;
            border: 1px solid #F2F2F2;
            padding: 0.45rem 1.2rem;
            border-radius: 999px;
            font-weight: 600 !important;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: opacity 0.2s;
        }
        .nav-pill:hover { opacity: 0.88; }

        /* ─── Page offset for fixed bars ─── */
        .page-body { padding-top: calc(33px + 64px); }

        /* ─── Buttons ─── */
        .btn-main {
            background: var(--btn-bg);
            color: var(--btn-text);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 999px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-main:hover { opacity: 0.88; transform: translateY(-2px); }
        .btn-ghost {
            background: var(--btn-bg);
            color: var(--btn-text);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1.5px solid var(--border-mid);
            padding: 0.8rem 1.8rem;
            border-radius: 999px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: border-color 0.2s, transform 0.2s;
        }
        .btn-ghost:hover { border-color: var(--btn-text); transform: translateY(-2px); }

        .hero-actions .btn-main,
        .hero-actions .btn-ghost {
            color: #F2F2F2 !important;
            border: 1px solid #F2F2F2;
        }

        /* ─── Hero ─── */
        .hero {
            display: block;
            min-height: 70vh;
            border-bottom: 1px solid var(--border);
        }
        .hero-left {
            width: 100%;
            padding: 3rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .hero-right {
            display: none;
        }
        .hero-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: auto;
            padding-bottom: 3rem;
        }
        .hero-hl {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(5rem, 9vw, 9rem);
            line-height: 0.88;
            letter-spacing: -0.01em;
            color: var(--text);
            margin-bottom: 2rem;
        }
        .hero-hl em {
            font-style: normal;
            display: block;
            color: var(--text-dim);
        }
        .hero-sub {
            font-size: 0.88rem;
            color: var(--text-dim);
            line-height: 1.8;
            max-width: 340px;
            margin-bottom: 2.5rem;
        }
        .hero-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }

        .hero-right {
            padding: 4rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hero-right-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .clock {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 0.12em;
            color: var(--text-faint);
        }
        .est-badge {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
        }
        .hero-visual {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .hero-card {
            background: var(--accent-faint);
            border: 1px solid var(--border-mid);
            border-radius: 20px;
            width: 100%;
            max-width: 320px;
            aspect-ratio: 3/4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }
        .hero-card-bg {
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 20px,
                rgba(237, 232, 104, 0.025) 20px,
                rgba(237, 232, 104, 0.025) 21px
            );
        }
        .hero-card-inner {
            position: relative;
            text-align: center;
        }
        .hero-card-inner h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            letter-spacing: 0.06em;
            color: var(--text);
        }
        .hero-card-inner p {
            font-size: 0.72rem;
            color: var(--text-dim);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .slot-pill {
            background: var(--accent-faint);
            border: 1px solid var(--border-mid);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            bottom: 1.5rem;
            left: 1.5rem;
            right: 1.5rem;
        }
        .slot-pill span { font-size: 0.7rem; color: var(--text-dim); }
        .slot-pill strong { font-size: 0.7rem; font-weight: 600; color: var(--text); }
        .hero-right-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .hero-addr-label {
            font-size: 0.68rem;
            color: var(--text-faint);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .hero-addr {
            font-size: 0.8rem;
            color: var(--text-dim);
        }
        .hero-stat-mini { text-align: right; }
        .hero-stat-mini span {
            display: block;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            color: var(--text);
            line-height: 1;
        }
        .hero-stat-mini small {
            font-size: 0.65rem;
            color: var(--text-faint);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* ─── Stats Strip ─── */
        .stats-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-bottom: 1px solid var(--border);
        }
        .stat-cell {
            padding: 2rem 2.5rem;
            border-right: 1px solid var(--border);
            text-align: center;
        }
        .stat-cell:last-child { border-right: none; }
        .stat-n {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.8rem;
            color: var(--text);
            line-height: 1;
            margin-bottom: 0.2rem;
        }
        .stat-l {
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
        }

        /* ─── Service Sections ─── */
        .service-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid var(--border);
            min-height: 380px;
        }
        .service-section.reverse { direction: rtl; }
        .service-section.reverse > * { direction: ltr; }
        .service-content {
            padding: 4rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-right: 1px solid var(--border);
        }
        .service-section.reverse .service-content {
            border-right: none;
            border-left: 1px solid var(--border);
        }
        .service-tag {
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.8rem;
        }
        .service-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.4rem, 4vw, 3.5rem);
            line-height: 0.92;
            color: var(--text);
            margin-bottom: 1.2rem;
        }
        .service-desc {
            font-size: 0.85rem;
            color: var(--text-dim);
            line-height: 1.8;
            max-width: 380px;
            margin-bottom: 1.6rem;
        }
        .service-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .service-tag-pill {
            background: var(--accent-faint);
            border: 1px solid var(--border-mid);
            border-radius: 999px;
            padding: 0.3rem 0.9rem;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-dim);
        }
        .service-visual {
            background: var(--accent-faint2);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            min-height: 320px;
        }
        .service-visual-word {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 9rem;
            color: rgba(237, 232, 104, 0.05);
            letter-spacing: -0.04em;
            user-select: none;
            line-height: 1;
            text-align: center;
        }
        .price-badge {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            background: var(--btn-bg);
            border-radius: 12px;
            padding: 0.8rem 1.2rem;
            text-align: center;
        }
        .price-badge span {
            display: block;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            line-height: 1;
            color: #F2F2F2;
        }
        .price-badge small {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #F2F2F2;
        }

        /* ─── Process ─── */
        .process-section { padding: 5rem 2.5rem; border-bottom: 1px solid var(--border); }
        .process-header { margin-bottom: 3.5rem; }
        .section-tag {
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.6rem;
        }
        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.4rem, 4vw, 3.5rem);
            line-height: 0.92;
            color: var(--text);
            max-width: 520px;
        }
        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
        }
        .process-step {
            background: var(--bg);
            padding: 2.5rem 2rem;
            transition: background 0.2s;
        }
        .process-step:hover { background: var(--accent-faint2); }
        .step-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            color: rgba(237, 232, 104, 0.08);
            line-height: 1;
            margin-bottom: 1.2rem;
        }
        .step-title { font-weight: 600; font-size: 0.95rem; color: var(--text); margin-bottom: 0.6rem; }
        .step-desc { font-size: 0.8rem; color: var(--text-faint); line-height: 1.7; }

        /* ─── Team ─── */
        .team-section { padding: 5rem 2.5rem; border-bottom: 1px solid var(--border); }
        .team-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 3rem;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
        }
        .barber-card {
            background: var(--bg);
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            transition: background 0.2s;
        }
        .barber-card:hover { background: var(--accent-faint2); }
        .barber-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--accent-faint);
            border: 1.5px solid var(--border-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            color: var(--text);
        }
        .barber-name { font-weight: 600; font-size: 1rem; color: var(--text); margin-bottom: 0.2rem; }
        .barber-role { font-size: 0.68rem; color: var(--text-faint); letter-spacing: 0.1em; text-transform: uppercase; }
        .barber-exp { font-size: 0.72rem; color: var(--text-faint); margin-top: auto; }

        /* ─── FAQ ─── */
        .faq-section { padding: 5rem 2.5rem; border-bottom: 1px solid var(--border); }
        .faq-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2rem, 3.5vw, 3rem);
            line-height: 0.92;
            color: var(--text);
            max-width: 500px;
            margin-bottom: 0.8rem;
        }
        .faq-sub { font-size: 0.85rem; color: var(--text-faint); margin-bottom: 3rem; }
        .faq-item { border-top: 1px solid var(--border); overflow: hidden; }
        .faq-q {
            width: 100%;
            background: none;
            border: none;
            color: var(--text);
            text-align: left;
            padding: 1.3rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: 0.92rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            gap: 1rem;
        }
        .faq-icon {
            font-size: 1.2rem;
            color: var(--text-faint);
            flex-shrink: 0;
            transition: transform 0.3s;
            line-height: 1;
        }
        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
            font-size: 0.82rem;
            color: var(--text-dim);
            line-height: 1.75;
        }
        .faq-a-inner { padding-bottom: 1.2rem; }
        .faq-item.open .faq-icon { transform: rotate(45deg); }
        .faq-item.open .faq-a { max-height: 200px; }

        /* ─── CTA Banner ─── */
        .cta-banner {
            padding: 5rem 2.5rem;
            border-bottom: 1px solid var(--border);
            background: var(--accent-faint2);
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 2rem;
        }
        .cta-banner h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            line-height: 0.9;
            color: var(--text);
        }
        .cta-banner h2 em { font-style: normal; color: var(--text-dim); }

        .cta-banner .btn-main {
            color: #F2F2F2 !important;
            border: 1px solid #F2F2F2;
            background: var(--btn-bg);
        }

        /* ─── Hours & Contact ─── */
        .hours-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid var(--border);
        }
        .hours-left { padding: 4rem 2.5rem; border-right: 1px solid var(--border); }
        .hours-right { padding: 4rem 2.5rem; }
        .section-tag-sm {
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.6rem;
        }
        .hours-left h2,
        .hours-right h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            color: var(--text);
            margin-bottom: 2rem;
        }
        .hours-table { width: 100%; border-collapse: collapse; }
        .hours-table tr { border-bottom: 1px solid var(--border); }
        .hours-table td { padding: 0.85rem 0; font-size: 0.82rem; color: var(--text-dim); }
        .hours-table td:first-child { font-weight: 500; color: var(--text); }
        .hours-table td:last-child { text-align: right; }
        .hours-table .closed td { color: var(--text-faint); }
        .contact-items { display: flex; flex-direction: column; gap: 1.4rem; }
        .contact-item label {
            display: block;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.25rem;
        }
        .contact-item p { font-size: 0.85rem; color: var(--text-dim); line-height: 1.6; }

        /* ─── Marquee Footer ─── */
        .footer-marquee {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 1.5rem 0;
            overflow: hidden;
            white-space: nowrap;
            background: var(--accent-faint2);
        }
        .marquee-track {
            display: inline-flex;
            animation: marquee 20s linear infinite;
        }
        .marquee-item {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4rem;
            letter-spacing: 0.06em;
            color: rgba(237, 232, 104, 0.06);
            padding: 0 1.5rem;
            flex-shrink: 0;
        }
        .marquee-dot {
            color: rgba(237, 232, 104, 0.12);
            font-size: 1.5rem;
            align-self: center;
        }
        @keyframes marquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ─── Footer ─── */
        footer {
            padding: 2.5rem 2.5rem;
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 2rem;
            align-items: center;
        }
        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            letter-spacing: 0.1em;
            color: var(--text);
        }
        .footer-copy { font-size: 0.68rem; color: var(--text-faint); letter-spacing: 0.06em; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--text); }

        /* ─── Responsive ─── */
        @media (max-width: 768px) {
            nav { padding: 1rem 1.5rem; }
            .nav-links { display: none; }
            .page-body { padding-top: calc(33px + 56px); }
            .hero,
            .service-section,
            .hours-section { grid-template-columns: 1fr; }
            .service-section.reverse { direction: ltr; }
            .service-content { border-right: none; border-left: none; border-bottom: 1px solid var(--border); }
            .service-section.reverse .service-content { border-left: none; }
            .service-visual { min-height: 220px; }
            .stats-strip,
            .process-grid { grid-template-columns: 1fr 1fr; }
            .team-grid { grid-template-columns: 1fr; }
            .cta-banner { grid-template-columns: 1fr; }
            footer { grid-template-columns: 1fr; text-align: center; }
            .footer-links { justify-content: center; }
            .hero-right { display: none; }
        }
    </style>
</head>
<body>

<!-- Ticker -->
<div class="ticker">
    <div class="ticker-track">
        <?php for ($i = 0; $i < 4; $i++): ?>
        <span>Barber Society</span><span>·</span>
        <span>Premium Grooming</span><span>·</span>
        <span>Walk-ins Welcome</span><span>·</span>
        <span>Est. 2018</span><span>·</span>
        <span>Not Just A Cut</span><span>·</span>
        <?php endfor; ?>
    </div>
</div>

<!-- Nav -->
<nav>
    <a href="#home" class="nav-logo">Barber.Society</a>
    <ul class="nav-links">
        <li><a href="#services">Services</a></li>
        <li><a href="#team">Team</a></li>
        <li><a href="#hours">Hours</a></li>
        <li><a href="<?php echo $logged_in ? 'ReservationPage.php' : 'AccountLogin.php'; ?>" class="nav-pill">Book Now</a></li>
        <?php if ($logged_in): ?>
        <li><a href="AccountProfile.php" class="nav-pill">👤 <?php echo htmlspecialchars(explode(' ', $customer_name)[0]); ?></a></li>
        <?php else: ?>
        <li><a href="AccountLogin.php" class="nav-pill">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="page-body">

    <!-- Hero -->
    <section class="hero" id="home">
        <div class="hero-left">
            <p class="hero-label">Premium Barbershop · Laguna, Calamba City</p>
            <div>
                <h1 class="hero-hl">Not Just<em>A Cut.</em></h1>
                <p class="hero-sub">Precision grooming crafted for the modern man. Walk in a client, leave looking like yourself — only sharper.</p>
                <div class="hero-actions">
                    <a href="<?php echo $logged_in ? 'ReservationPage.php' : 'AccountLogin.php'; ?>" class="btn-main">Book Appointment</a>
                    <a href="#services" class="btn-ghost">Our Services</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Strip -->
    <div class="stats-strip">
        <div class="stat-cell"><div class="stat-n">6+</div><div class="stat-l">Years Open</div></div>
        <div class="stat-cell"><div class="stat-n">3K+</div><div class="stat-l">Happy Clients</div></div>
        <div class="stat-cell"><div class="stat-n">3</div><div class="stat-l">Expert Barbers</div></div>
        <div class="stat-cell"><div class="stat-n">100%</div><div class="stat-l">Satisfaction</div></div>
    </div>

    <!-- Services -->
    <?php foreach ($services as $i => $s): ?>
    <div id="<?php echo $i === 0 ? 'services' : ''; ?>" class="service-section<?php echo $i % 2 !== 0 ? ' reverse' : ''; ?>">
        <div class="service-content">
            <p class="service-tag">Our Service · <?php echo $s['num']; ?></p>
            <h2 class="service-title"><?php echo $s['name']; ?></h2>
            <p class="service-desc"><?php echo $s['desc']; ?></p>
            <div class="service-tags">
                <?php foreach ($s['tags'] as $tag): ?>
                <span class="service-tag-pill"><?php echo $tag; ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="service-visual">
            <div class="service-visual-word"><?php echo $s['word']; ?></div>
            <div class="price-badge">
                <span><?php echo $s['price']; ?></span>
                <small><?php echo $s['label']; ?></small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Process -->
    <div class="process-section">
        <div class="process-header">
            <p class="section-tag">How It Works</p>
            <h2 class="section-title">From Walk-in<br>to Walk-out Sharp</h2>
        </div>
        <div class="process-grid">
            <?php foreach ($steps as $step): ?>
            <div class="process-step">
                <div class="step-num"><?php echo $step['num']; ?></div>
                <div class="step-title"><?php echo $step['title']; ?></div>
                <div class="step-desc"><?php echo $step['desc']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Team -->
    <div class="team-section" id="team">
        <div class="team-header">
            <div>
                <p class="section-tag">The Crew</p>
                <h2 class="section-title">Meet The Barbers</h2>
            </div>
            <a href="<?php echo $logged_in ? 'ReservationPage.php' : 'AccountLogin.php'; ?>" class="btn-main">Book a Session</a>
        </div>
        <div class="team-grid">
            <?php foreach ($barbers as $b): ?>
            <div class="barber-card">
                <div class="barber-avatar"><?php echo strtoupper(substr($b['name'], 0, 1)); ?></div>
                <div>
                    <p class="barber-name"><?php echo $b['name']; ?></p>
                    <p class="barber-role"><?php echo $b['title']; ?></p>
                </div>
                <p class="barber-exp"><?php echo $b['exp']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- FAQ -->
    <div class="faq-section">
        <p class="section-tag-sm">Questions</p>
        <h2 class="faq-title">Frequently Asked</h2>
        <p class="faq-sub">Something on your mind? Here are the most common ones.</p>
        <div>
            <?php foreach ($faqs as $faq): ?>
            <div class="faq-item">
                <button class="faq-q">
                    <?php echo $faq['q']; ?>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-a">
                    <div class="faq-a-inner"><?php echo $faq['a']; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- CTA Banner -->
    <div class="cta-banner" id="book">
        <h2>Ready for Your<br><em>Best Cut?</em></h2>
        <a href="<?php echo $logged_in ? 'ReservationPage.php' : 'AccountLogin.php'; ?>" class="btn-main" style="font-size:0.78rem;padding:1rem 2rem;flex-shrink:0">
            Reserve a Slot &rarr;
        </a>
    </div>

    <!-- Hours & Contact -->
    <div class="hours-section" id="hours">
        <div class="hours-left">
            <p class="section-tag-sm">Hours</p>
            <h2>When We're Open</h2>
            <table class="hours-table">
                <tr><td>Monday &ndash; Friday</td><td>9:00 AM &ndash; 8:00 PM</td></tr>
                <tr><td>Saturday</td><td>8:00 AM &ndash; 9:00 PM</td></tr>
                <tr><td>Sunday</td><td>10:00 AM &ndash; 6:00 PM</td></tr>
                <tr class="closed"><td>Public Holidays</td><td>Closed</td></tr>
            </table>
        </div>
        <div class="hours-right">
            <p class="section-tag-sm">Contact</p>
            <h2>Find Us</h2>
            <div class="contact-items">
                <div class="contact-item">
                    <label>Address</label>
                    <p>123 Kalayaan Ave, Laguna<br>Calamba City, Philippines</p>
                </div>
                <div class="contact-item">
                    <label>Phone</label>
                    <p>+63 912 345 6789</p>
                </div>
                <div class="contact-item">
                    <label>Email</label>
                    <p>hello@barbersociety.ph</p>
                </div>
                <div class="contact-item">
                    <label>Instagram</label>
                    <p>@barbersociety.ph</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Marquee -->
    <div class="footer-marquee">
        <div class="marquee-track">
            <?php for ($i = 0; $i < 2; $i++): ?>
            <span class="marquee-item">BARBER SOCIETY</span><span class="marquee-dot">&middot;</span>
            <span class="marquee-item">NOT JUST A CUT</span><span class="marquee-dot">&middot;</span>
            <span class="marquee-item">BARBER SOCIETY</span><span class="marquee-dot">&middot;</span>
            <span class="marquee-item">PRECISION GROOMING</span><span class="marquee-dot">&middot;</span>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-logo">Barber.Society</div>
        <p class="footer-copy">&copy; <?php echo $current_year; ?> Barber Society. All rights reserved.</p>
        <div class="footer-links">
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#book">Book</a>
        </div>
    </footer>

</div><!-- end .page-body -->

<script>
    // Live clock
    function updateClock() {
        const now = new Date();
        let h = now.getHours(), m = now.getMinutes(), s = now.getSeconds();
        const ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        const el = document.getElementById('clock');
        if (el) el.textContent =
            String(h).padStart(2,'0') + ':' +
            String(m).padStart(2,'0') + ':' +
            String(s).padStart(2,'0') + ' ' + ampm;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // FAQ accordion
    document.querySelectorAll('.faq-q').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.parentElement;
            const wasOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            if (!wasOpen) item.classList.add('open');
        });
    });
</script>

</body>
</html>