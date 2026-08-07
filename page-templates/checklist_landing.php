<?php
/**
 * Template Name: Check List tổng quan hành vi của trẻ
 * 
 * @package Hieucon
 */
$is_start = isset($_GET['start']);
get_header();
?>

<!-- Landing Page Head Assets -->
<link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    tailwind.config = {
        corePlugins: {
            preflight: false,
        },
        theme: {
            extend: {
                colors: {
                    navy: '#002795',
                    yellow: '#FFD154',
                    cream: '#FAF9F6',
                    'text-dark': '#3D3D3D',
                    'text-soft': '#555555'
                },
                fontFamily: {
                    oswald: ['Oswald', 'sans-serif'],
                    quicksand: ['Quicksand', 'sans-serif']
                }
            }
        }
    }
</script>
<style>
    :root {
      --navy: #002795;
      --navy-light: #1a3a8c;
      --yellow: #FFD154;
      --yellow-soft: #FFF3CC;
      --charcoal: #3D3D3D;
      --cream: #FAF9F6;
      --white: #FFFFFF;
      --gray: #888888;
      --gray-light: #F0EEE9;
      --green: #2E7D6B;
      --green-light: #E8F5F1;
      --red-soft: #FFF0F0;
      --border: #E0DDDA;
      --shadow: 0 4px 24px rgba(0, 39, 149, 0.08);
      --shadow-hover: 0 8px 32px rgba(0, 39, 149, 0.15);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Quicksand', sans-serif;
      background: var(--cream);
      color: var(--charcoal);
      line-height: 1.7;
    }

    /* ── HERO ── */
    .hero {
      background: var(--navy);
      color: var(--white);
      padding: 80px 24px 100px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 320px;
      height: 320px;
      border-radius: 50%;
      background: rgba(255, 209, 84, 0.08);
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -80px;
      left: -40px;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: rgba(255, 209, 84, 0.05);
    }

    .hero-badge {
      display: inline-block;
      background: var(--yellow);
      color: var(--navy);
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 6px 18px;
      border-radius: 20px;
      margin-bottom: 24px;
    }

    .hero h1 {
      font-family: 'Oswald', sans-serif;
      font-size: clamp(28px, 5vw, 48px);
      font-weight: 900;
      line-height: 1.2;
      margin-bottom: 20px;
      max-width: 720px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero h1 span {
      color: var(--yellow);
    }

    .hero p {
      font-size: 16px;
      font-weight: 300;
      opacity: 0.85;
      max-width: 560px;
      margin: 0 auto 40px;
    }

    .hero-stats {
      display: flex;
      justify-content: center;
      gap: 48px;
      flex-wrap: wrap;
    }

    .stat {
      text-align: center;
    }

    .stat-num {
      font-family: 'Oswald', sans-serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--yellow);
      display: block;
    }

    .stat-label {
      font-size: 13px;
      opacity: 0.7;
    }

    /* ── INTRO CARD ── */
    .intro-card {
      max-width: 760px;
      margin: -40px auto 0;
      background: var(--white);
      border-radius: 20px;
      padding: 40px 48px;
      box-shadow: var(--shadow);
      position: relative;
      z-index: 10;
    }

    .intro-card h2 {
      font-family: 'Oswald', sans-serif;
      font-size: 22px;
      color: var(--navy);
      margin-bottom: 16px;
    }

    .intro-card p {
      font-size: 15px;
      color: #555;
      margin-bottom: 12px;
    }

    .has-pattern-bg {
      position: relative !important;
      background: transparent !important;
      overflow: hidden !important;
      z-index: 1 !important;
    }
    .has-pattern-bg::before {
      content: "" !important;
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      bottom: 0 !important;
      background-color: #002795 !important;
      z-index: -2 !important;
      pointer-events: none !important;
    }
    .has-pattern-bg::after {
      content: "" !important;
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      bottom: 0 !important;
      background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pattern-hieu-con.png?v=1.2") !important;
      background-size: 220px !important;
      background-position: right -30px center !important;
      background-repeat: no-repeat !important;
      opacity: 0.12 !important;
      z-index: -1 !important;
      pointer-events: none !important;
    }
    #hero-section.has-pattern-bg::after {
      background-size: 800px !important;
      background-position: -150px center !important;
      opacity: 0.08 !important;
    }

    .intro-steps {
      display: flex;
      gap: 20px;
      margin-top: 28px;
      flex-wrap: wrap;
    }
    @media (max-width: 1024px) {
      .progress-steps {
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 8px;
        justify-content: flex-start !important;
        gap: 6px !important;
      }
      .progress-step {
        flex-shrink: 0 !important;
      }
      #survey-sidebar.show-mobile-overlay {
        display: flex !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        background: rgba(15, 23, 42, 0.95) !important;
        z-index: 9999 !important;
        padding: 32px 24px !important;
        justify-content: center !important;
        align-items: center !important;
        overflow-y: auto !important;
      }
      #survey-sidebar.show-mobile-overlay > div {
        width: 100% !important;
        max-width: 400px !important;
        background: var(--navy) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5) !important;
        border-radius: 16px !important;
        padding: 24px 20px !important;
      }
      #close-radar-btn {
        display: block !important;
      }
      .check-item-row {
        position: relative !important;
        background: var(--white) !important;
        padding: 12px 14px !important;
        gap: 12px !important;
      }
      .check-main {
        font-size: 14.5px !important;
        font-weight: 600 !important;
        line-height: 1.45 !important;
      }
      .check-options {
        gap: 10px !important;
      }
      .check-opt-label {
        padding: 8px 12px !important;
        font-size: 13px !important;
      }
      .info-tooltip-wrapper {
        position: static !important;
      }
      .info-tooltip-content {
        position: absolute !important;
        left: 12px !important;
        right: 12px !important;
        top: 12px !important;
        bottom: auto !important;
        transform: none !important;
        width: auto !important;
        z-index: 100 !important;
        display: none;
        pointer-events: auto !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
      }
      .info-tooltip-wrapper.active .info-tooltip-content {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
      }
      .info-tooltip-content::after {
        display: none !important;
      }
    }

    .intro-step {
      flex: 1;
      min-width: 140px;
      text-align: center;
      padding: 20px 16px;
      background: var(--gray-light);
      border-radius: 14px;
    }

    .intro-step-num {
      width: 36px;
      height: 36px;
      background: var(--navy);
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 15px;
      margin: 0 auto 10px;
    }

    .intro-step p {
      font-size: 13px;
      color: var(--charcoal);
      margin: 0;
    }

    /* ── INFO FORM ── */
    .section-wrap {
      max-width: 820px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .form-section {
      background: var(--white);
      border-radius: 20px;
      padding: 40px 48px;
      margin: 32px auto;
      max-width: 820px;
      box-shadow: var(--shadow);
    }

    .section-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 28px;
      padding-bottom: 20px;
      border-bottom: 2px solid var(--gray-light);
    }

    .section-icon {
      width: 48px;
      height: 48px;
      background: var(--navy);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }

    .section-title {
      font-family: 'Oswald', sans-serif;
      font-size: 20px;
      color: var(--navy);
    }

    .section-subtitle {
      font-size: 13px;
      color: var(--gray);
      margin-top: 2px;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-group label {
      font-size: 13px;
      font-weight: 600;
      color: var(--charcoal);
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      color: var(--charcoal);
      background: var(--cream);
      transition: border-color 0.2s;
      outline: none;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: var(--navy);
      background: var(--white);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 80px;
    }

    /* ── PROGRESS BAR ── */
    .progress-wrap {
      max-width: 820px;
      margin: 40px auto 0;
      padding: 0 24px;
    }

    .progress-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .progress-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--navy);
    }

    .progress-count {
      font-size: 13px;
      color: var(--gray);
    }

    .progress-bar {
      height: 8px;
      background: var(--gray-light);
      border-radius: 10px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--navy), var(--navy-light));
      border-radius: 10px;
      transition: width 0.4s ease;
      width: 0%;
    }

    .progress-steps {
      display: flex;
      justify-content: space-between;
      margin-top: 12px;
      flex-wrap: wrap;
      gap: 8px;
    }

    .progress-step {
      font-size: 11px;
      color: var(--gray);
      cursor: pointer;
      padding: 4px 10px;
      border-radius: 12px;
      transition: all 0.2s;
      border: 1.5px solid transparent;
    }

    .progress-step.active {
      color: var(--navy);
      border-color: var(--navy);
      font-weight: 600;
      background: rgba(0, 39, 149, 0.05);
    }

    .progress-step.done {
      color: var(--green);
      border-color: var(--green);
      background: var(--green-light);
    }

    /* ── CHECKLIST SECTION ── */
    .checklist-section {
      background: var(--white);
      border-radius: 20px;
      padding: 40px 48px;
      margin: 16px auto;
      max-width: 820px;
      box-shadow: var(--shadow);
      display: block;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .group-score {
      display: flex;
      align-items: center;
      gap: 12px;
      background: var(--gray-light);
      border-radius: 12px;
      padding: 12px 18px;
      margin-bottom: 24px;
    }

    .group-score-label {
      font-size: 13px;
      color: var(--gray);
    }

    .group-score-value {
      font-size: 20px;
      font-weight: 700;
      color: var(--navy);
      font-family: 'Oswald', sans-serif;
    }

    .group-score-bar {
      flex: 1;
      height: 6px;
      background: var(--border);
      border-radius: 10px;
      overflow: hidden;
    }

    .group-score-fill {
      height: 100%;
      background: var(--navy);
      border-radius: 10px;
      transition: width 0.3s;
      width: 0%;
    }

    .checklist-items {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .check-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 14px 18px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      cursor: pointer;
      transition: all 0.2s;
      background: var(--cream);
      user-select: none;
    }

    .check-item:hover {
      border-color: var(--navy-light);
      background: rgba(0, 39, 149, 0.03);
    }

    .check-item.checked {
      border-color: var(--navy);
      background: rgba(0, 39, 149, 0.05);
    }

    .check-item input[type="checkbox"] {
      display: none;
    }

    .check-box {
      width: 22px;
      height: 22px;
      border: 2px solid var(--border);
      border-radius: 6px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      margin-top: 1px;
    }

    .check-item.checked .check-box {
      background: var(--navy);
      border-color: var(--navy);
    }

    .check-box::after {
      content: '✓';
      color: var(--white);
      font-size: 13px;
      font-weight: 700;
      display: none;
    }

    .check-item.checked .check-box::after {
      display: block;
    }

    .check-text {
      flex: 1;
    }

    .check-main {
      font-size: 14px;
      font-weight: 500;
      color: var(--charcoal);
      line-height: 1.5;
    }

    .check-example {
      font-size: 12px;
      color: var(--gray);
      margin-top: 3px;
      font-style: italic;
    }

    /* ── TOOLTIP HÀNH VI ── */
    .info-tooltip-wrapper {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      vertical-align: middle;
    }

    .info-tooltip-trigger {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background: rgba(0, 39, 149, 0.08);
      color: var(--navy);
      font-size: 10px;
      font-weight: 700;
      cursor: help;
      transition: all 0.2s;
      user-select: none;
      font-family: sans-serif;
      margin-right: 6px;
    }

    .info-tooltip-wrapper:hover .info-tooltip-trigger {
      background: var(--navy);
      color: var(--white);
    }

    .info-tooltip-content {
      visibility: hidden;
      width: 250px;
      background-color: var(--navy);
      color: var(--white);
      text-align: left;
      border-radius: 8px;
      padding: 10px 12px;
      position: absolute;
      z-index: 999;
      bottom: 130%; /* Trực quan hóa nằm trên nút i */
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.2s, visibility 0.2s;
      box-shadow: 0 10px 25px rgba(0, 39, 149, 0.15);
      font-size: 12.5px;
      font-weight: 500;
      line-height: 1.4;
      pointer-events: none;
      font-family: 'Quicksand', sans-serif;
      border: 1.5px solid rgba(255, 255, 255, 0.15);
      font-style: normal;
    }

    /* Tooltip mũi tên chỉ xuống */
    .info-tooltip-content::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -6px;
      border-width: 6px;
      border-style: solid;
      border-color: var(--navy) transparent transparent transparent;
    }

    .info-tooltip-wrapper:hover .info-tooltip-content {
      visibility: visible;
      opacity: 1;
    }

    /* Wide quiz pill buttons style */
    .check-opt-label {
      box-shadow: 0 2px 4px rgba(0,0,0,0.02);
      border-width: 1.5px !important;
    }
    
    /* Completed group collapse styles */
    .checklist-section.completed-group .checklist-items,
    .checklist-section.completed-group .open-section,
    .checklist-section.completed-group .group-score {
      display: none !important;
    }
    
    /* Collapsed completed blue block styling */
    .checklist-section.completed-group {
      background: var(--navy) !important;
      color: white !important;
      border: none !important;
      box-shadow: 0 10px 20px rgba(0,39,149,0.15) !important;
      padding: 16px 20px !important;
      border-radius: 16px !important;
      margin-bottom: 20px !important;
      border-bottom: none !important;
      padding-bottom: 16px !important;
    }
    .checklist-section.completed-group .section-title {
      color: white !important;
    }
    .checklist-section.completed-group .section-subtitle {
      color: rgba(255, 255, 255, 0.7) !important;
    }
    .checklist-section.completed-group .section-icon {
      background: rgba(255, 255, 255, 0.15) !important;
      color: white !important;
    }
    .checklist-section.completed-group .accordion-arrow {
      color: white !important;
    }
    .checklist-section.completed-group .section-header {
      border-bottom: none !important;
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
    
    /* Rotate arrow when collapsed */
    .checklist-section.completed-group .accordion-arrow {
      transform: rotate(180deg);
    }
    .check-opt-label:hover {
      border-color: var(--navy) !important;
      background-color: #f8fafc !important;
    }
    .check-opt-label[id^="label-yes-"].checked {
      background: var(--navy) !important;
      border-color: var(--navy) !important;
      color: white !important;
      box-shadow: 0 4px 12px rgba(0,39,149,0.15) !important;
    }
    .check-opt-label[id^="label-no-"].checked {
      background: #475569 !important;
      border-color: #475569 !important;
      color: white !important;
      box-shadow: 0 4px 12px rgba(71,85,105,0.15) !important;
    }

    /* ── NAV BUTTONS ── */
    .nav-buttons {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 32px;
      padding-top: 24px;
      border-top: 2px solid var(--gray-light);
      flex-wrap: wrap;
      gap: 12px;
    }

    .btn {
      padding: 14px 32px;
      border-radius: 12px;
      font-family: 'Quicksand', sans-serif;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
    }

    .btn-primary {
      background: var(--navy);
      color: var(--white);
    }

    .btn-primary:hover {
      background: var(--navy-light);
      transform: translateY(-1px);
      box-shadow: var(--shadow-hover);
    }

    .btn-secondary {
      background: transparent;
      color: var(--navy);
      border: 2px solid var(--navy);
    }

    .btn-secondary:hover {
      background: rgba(0, 39, 149, 0.05);
    }

    .btn-submit {
      background: var(--green);
      color: var(--white);
      padding: 16px 40px;
      font-size: 16px;
    }

    .btn-submit:hover {
      background: #245f54;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(46, 125, 107, 0.3);
    }

    /* ── OPEN-ENDED ── */
    .open-section {
      background: var(--yellow-soft);
      border-radius: 14px;
      padding: 24px 28px;
      margin-top: 24px;
      border-left: 4px solid var(--yellow);
    }

    .open-section label {
      font-size: 14px;
      font-weight: 600;
      color: var(--charcoal);
      display: block;
      margin-bottom: 8px;
    }

    .open-section textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid #E8D88A;
      border-radius: 10px;
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      background: var(--white);
      outline: none;
      resize: vertical;
      min-height: 80px;
    }

    /* ── RESULT PAGE ── */
    #result-page {
      display: none;
      max-width: 820px;
      margin: 32px auto;
      padding: 0 24px 60px;
    }

    .result-hero {
      background: var(--navy);
      border-radius: 20px;
      padding: 48px;
      color: var(--white);
      text-align: center;
      margin-bottom: 24px;
    }

    .result-hero h2 {
      font-family: 'Oswald', sans-serif;
      font-size: 28px;
      margin-bottom: 12px;
    }

    .result-hero p {
      opacity: 0.8;
      font-size: 15px;
    }

    .result-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 24px;
    }

    .result-card {
      background: var(--white);
      border-radius: 16px;
      padding: 24px;
      box-shadow: var(--shadow);
      border-top: 4px solid var(--border);
    }

    .result-card.priority-1 {
      border-top-color: #E53E3E;
    }

    .result-card.priority-2 {
      border-top-color: #DD6B20;
    }

    .result-card.priority-3 {
      border-top-color: #D69E2E;
    }

    .result-card.priority-low {
      border-top-color: var(--green);
    }

    .result-rank {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 6px;
      color: var(--gray);
    }

    .result-group-name {
      font-size: 16px;
      font-weight: 700;
      color: var(--charcoal);
      margin-bottom: 12px;
    }

    .result-score-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .result-pct {
      font-family: 'Oswald', sans-serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--navy);
    }

    .result-bar {
      flex: 1;
      height: 8px;
      background: var(--gray-light);
      border-radius: 10px;
      overflow: hidden;
    }

    .result-bar-fill {
      height: 100%;
      border-radius: 10px;
      transition: width 1s ease;
    }

    .priority-1 .result-bar-fill {
      background: #E53E3E;
    }

    .priority-2 .result-bar-fill {
      background: #DD6B20;
    }

    .priority-3 .result-bar-fill {
      background: #D69E2E;
    }

    .priority-low .result-bar-fill {
      background: var(--green);
    }

    .result-ticked {
      font-size: 12px;
      color: var(--gray);
      margin-top: 8px;
    }

    .cta-box {
      background: linear-gradient(135deg, var(--navy) 0%, #1a3a8c 100%);
      border-radius: 20px;
      padding: 48px;
      text-align: center;
      color: var(--white);
      margin-top: 24px;
    }

    .cta-box h3 {
      font-family: 'Oswald', sans-serif;
      font-size: 26px;
      margin-bottom: 12px;
    }

    .cta-box p {
      opacity: 0.85;
      font-size: 15px;
      margin-bottom: 32px;
      max-width: 480px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-form {
      display: flex;
      gap: 12px;
      max-width: 440px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    .cta-form input {
      flex: 1;
      min-width: 200px;
      padding: 14px 18px;
      border-radius: 12px;
      border: none;
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      outline: none;
    }

    .cta-form button {
      padding: 14px 28px;
      background: var(--yellow);
      color: var(--navy);
      border: none;
      border-radius: 12px;
      font-family: 'Quicksand', sans-serif;
      font-weight: 700;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
    }

    .cta-form button:hover {
      background: #ffc832;
      transform: translateY(-1px);
    }

    .disclaimer {
      background: var(--gray-light);
      border-radius: 14px;
      padding: 20px 24px;
      margin-top: 24px;
      font-size: 12px;
      color: var(--gray);
      line-height: 1.8;
      border-left: 3px solid var(--border);
    }

    /* ── RESPONSIVE HELPERS & GRID LAYOUT (Vanilla CSS replacements for Tailwind) ── */
    /* Fallback styles for CTA Buttons & Layout if Tailwind fails to load on Host */
    .bg-white.rounded-2xl {
      background: #ffffff !important;
      border-radius: 16px !important;
      padding: 24px !important;
      border: 1px solid rgba(0,39,149,0.12) !important;
      box-shadow: 0 4px 20px rgba(0,39,149,0.05) !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 12px !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }
    .bg-white.rounded-2xl a {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      padding: 10px 14px !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      font-size: 12px !important;
      text-align: center !important;
      box-sizing: border-box !important;
      border: none !important;
      width: 100% !important;
      color: #ffffff !important;
      text-decoration: none !important;
    }
    .bg-white.rounded-2xl a[href*="facebook.com"] {
      background: linear-gradient(to bottom right, #1877F2, #0A58CA) !important;
    }
    .bg-white.rounded-2xl a[href*="zalo.me"] {
      background: linear-gradient(to bottom right, #00A1FF, #0068FF) !important;
    }
    .bg-white.rounded-2xl a[href*="tai-khoan"] {
      background: var(--navy) !important;
    }
    .bg-white.rounded-2xl a[href*="dang-nhap"] {
      background: #f05a25 !important;
    }
    .mobile-only-widget {
      display: none !important;
    }
    .desktop-only-widget {
      display: block !important;
    }
    .survey-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 24px;
      align-items: start;
    }
    @media (max-width: 1024px) {
      .mobile-only-widget {
        display: block !important;
      }
      .desktop-only-widget {
        display: none !important;
      }
    }
    @media (min-width: 1025px) {
      .survey-grid {
        grid-template-columns: 3fr 1fr;
      }
      .survey-sidebar-sticky {
        position: sticky !important;
        top: 96px !important;
      }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {

      .form-section,
      .checklist-section {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin-bottom: 32px !important;
        border-bottom: 1.5px solid var(--border) !important;
        padding-bottom: 24px !important;
        border-radius: 0 !important;
      }
      .checklist-section:last-of-type {
        border-bottom: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
      }
      .section-header {
        gap: 12px !important;
        margin-bottom: 16px !important;
        padding-bottom: 12px !important;
      }
      .section-icon {
        width: 44px !important;
        height: 44px !important;
        border-radius: 12px !important;
        font-size: 20px !important;
      }
      .section-title {
        font-size: 17px !important;
        font-weight: 700 !important;
        line-height: 1.3 !important;
      }
      .section-subtitle {
        font-size: 13px !important;
        color: #4b5563 !important;
        font-weight: 500 !important;
        margin-top: 4px !important;
        line-height: 1.4 !important;
      }
      .open-section {
        padding: 16px 20px !important;
        margin-top: 24px !important;
        border-radius: 12px !important;
      }
      .open-section label {
        font-size: 13.5px !important;
        margin-bottom: 8px !important;
      }
      .open-section textarea {
        padding: 10px 14px !important;
        font-size: 13.5px !important;
      }
      #checklist-main-column .btn-submit {
        width: 100% !important;
        padding: 14px 24px !important;
        font-size: 15px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        border-radius: 12px !important;
      }
      #checklist-main-column .flex.justify-end.mt-8 {
        justify-content: center !important;
        margin-top: 24px !important;
      }

      .intro-card {
        padding: 28px 20px;
      }

      .form-row {
        grid-template-columns: 1fr;
      }

      .result-grid {
        grid-template-columns: 1fr;
      }

      .cta-box {
        padding: 32px 20px;
      }

      .hero-stats {
        gap: 24px;
      }
    }
    
    .btn-hero-start {
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-hero-start:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 14px 28px rgba(255,209,84,0.45) !important;
      background-color: #ffe082 !important;
    }
    .btn-hero-start:active {
      transform: translateY(-1px) scale(1);
    }
    
    <?php if ($is_start): ?>
    #main-header, #colophon {
      display: none !important;
    }
    <?php endif; ?>

    .check-opt-label.checked .check-opt-box {
      background: var(--navy) !important;
      border-color: var(--navy) !important;
    }
    .check-opt-box::after {
      content: '✓';
      color: #fff;
      font-size: 12px;
      font-weight: 800;
      display: none;
    }
    .check-opt-label.checked .check-opt-box::after {
      display: block;
    }
  </style>

<div class="landing-checklist-wrapper antialiased relative z-10 bg-[var(--cream)] text-[var(--charcoal)] font-quicksand">
<!-- HERO -->
    <section class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden has-pattern-bg" id="hero-section" <?php if ($is_start) echo 'style="display:none;"'; ?>>
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#2563eb] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[blob_7s_infinite]"></div>
            <div class="absolute top-1/4 -right-24 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[blob_7s_infinite_2s]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-left flex flex-col justify-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[rgba(255,255,255,0.1)] backdrop-blur-md border border-solid border-[rgba(255,255,255,0.2)] text-cream text-sm font-semibold mb-6 w-fit">
                    <span class="w-2 h-2 rounded-full bg-yellow animate-pulse"></span>
                    Công cụ đánh giá
                </div>
                
                <h1 class="font-oswald mb-6 text-white tracking-wide uppercase" style="line-height: 1.35;">
                    <span class="block font-bold tracking-wider opacity-90 whitespace-nowrap" style="font-size: clamp(18px, 5.2vw, 30px);">BỘ CÔNG CỤ NHẬN DIỆN</span>
                    <span class="text-yellow uppercase block my-2 sm:my-2.5 font-black whitespace-nowrap" style="color: var(--yellow); font-size: clamp(24px, 7.6vw, 48px); letter-spacing: 0.02em;">CÁC RÀO CẢN SỨC KHỎE</span>
                    <span class="block font-bold tracking-wider opacity-90 whitespace-nowrap" style="font-size: clamp(18px, 5.2vw, 30px);">THƯỜNG GẶP Ở TRẺ TỰ KỶ</span>
                </h1>
                
                <p class="font-quicksand text-sm sm:text-base leading-relaxed text-[rgba(250,249,246,0.9)] mb-6 font-light max-w-xl">
                    Đằng sau nhiều khó khăn về hành vi có thể là những vấn đề sức khỏe chưa được nhận diện. Bộ công cụ này giúp ba mẹ quan sát nhanh 8 nhóm dấu hiệu thường gặp ở trẻ tự kỷ, từ đó biết nhóm nào cần theo dõi, trao đổi chuyên môn và ưu tiên hỗ trợ trước.
                </p>
                
                <!-- Combined Stats & Action Card (2/3 Stats, 1/3 Button) -->
                <div class="bg-[rgba(255,255,255,0.06)] border border-solid border-[rgba(255,255,255,0.12)] rounded-2xl p-4 shadow-[0_8px_32px_rgba(0,0,0,0.08)] mb-6 text-white max-w-xl">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        
                        <!-- Left 2/3: Stats Columns -->
                        <div class="md:col-span-2 grid grid-cols-3 gap-2 text-center items-center">
                            <div class="py-1">
                                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow" style="color: var(--yellow); line-height: 1;">8</span>
                                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Nhóm cơ quan</span>
                            </div>
                            <div class="border-l border-r border-solid border-white/10 py-1">
                                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow" style="color: var(--yellow); line-height: 1;">40+</span>
                                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Biểu hiện</span>
                            </div>
                            <div class="py-1">
                                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow" style="color: var(--yellow); line-height: 1;">10'</span>
                                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Thời gian làm</span>
                            </div>
                        </div>

                        <!-- Right 1/3: Start Button -->
                        <div class="md:col-span-1 flex justify-center md:justify-end">
                            <button onclick="goToIntro()" class="btn-hero-start w-full text-center" style="padding: 14px 20px; background: var(--yellow); color: var(--navy); font-family: 'Oswald', sans-serif; font-weight: 700; font-size: 15px; text-transform: uppercase; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 6px 15px rgba(255,209,84,0.3); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                                <span>BẮT ĐẦU NGAY</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Nguồn tham khảo khoa học (Listed directly below the button in a 2-column grid layout) -->
                <div class="text-left text-white max-w-xl bg-[rgba(255,255,255,0.03)] border border-solid border-[rgba(255,255,255,0.08)] rounded-2xl p-5 shadow-[0_8px_32px_rgba(0,0,0,0.04)]">
                    <h3 class="text-yellow font-bold text-xs uppercase tracking-wider mb-3.5 flex items-center gap-2" style="color: var(--yellow); font-family: 'Oswald', sans-serif; letter-spacing: 0.05em; margin: 0 0 14px 0;">
                        📖 Nguồn tham khảo đối chứng khoa học:
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <ul class="list-none p-0 m-0 flex flex-col gap-3 font-light text-[rgba(250,249,246,0.8)] leading-relaxed text-[11px]" style="display:flex; flex-direction:column; gap:10px; padding-left:0; margin:0; list-style:none;">
                            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">PSC:</strong> Sàng lọc hành vi & cảm xúc (trẻ từ 4-16 tuổi).</span>
                            </li>
                            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">CSHQ:</strong> Sàng lọc rối loạn giấc ngủ (trẻ 4-12 tuổi).</span>
                            </li>
                            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">BAMBI:</strong> Khảo sát hành vi ăn uống tự kỷ (2-11 tuổi).</span>
                            </li>
                        </ul>
                        <ul class="list-none p-0 m-0 flex flex-col gap-3 font-light text-[rgba(250,249,246,0.8)] leading-relaxed text-[11px]" style="display:flex; flex-direction:column; gap:10px; padding-left:0; margin:0; list-style:none;">
                            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">VADRS:</strong> Đánh giá nguy cơ Tăng động - Giảm chú ý (6-12 tuổi).</span>
                            </li>
                            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">Documenting Hope:</strong> Tổ chức phi lợi nhuận của Mỹ về phục hồi trẻ chậm phát triển thần kinh từ gốc.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bang-check-list.png" alt="Bộ công cụ nhận diện các rào cản sức khỏe" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full aspect-square" style="aspect-ratio: 1 / 1;" />
            </div>
        </div>
    </section>

  <!-- SURVEY PAGE CONTAINER (GRID LAYOUT) -->
  <div class="max-w-7xl mx-auto px-6 py-12" id="survey-page-container" style="<?php echo $is_start ? 'display:block;' : 'display:none;'; ?>">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
        
        <!-- CỘT TRÁI (1/4): WIDGET FIXED/STICKY -->
        <div class="lg:col-span-1 lg:sticky lg:top-24 flex flex-col gap-6" id="sticky-sidebar">
            <!-- WIDGET CÁCH SỬ DỤNG (Nổi bật màu Navy) -->
            <div class="bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg" style="background-color: var(--navy); color: white;">
                <!-- Decorative subtle light circle -->
                <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
                
                <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase" style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 17px; letter-spacing: 0.03em;">
                    <span style="font-size:18px;">📋</span> Hướng dẫn làm bài
                </h3>
                <div class="flex flex-col gap-4" style="display: flex; flex-direction: column; gap: 16px; font-size: 13.5px; line-height: 1.5; color: #ffffff;">
                    <div class="flex gap-3 items-start">
                        <div style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;" class="shrink-0">1</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Nhập thông tin cơ bản về con (Họ tên, ngày sinh, chiều cao, cân nặng...).</p>
                    </div>
                    <div class="flex gap-3 items-start">
                        <div style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;" class="shrink-0">2</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Tích chọn những dấu hiệu quan sát được ở con qua 8 nhóm hệ cơ quan.</p>
                    </div>
                    <div class="flex gap-3 items-start">
                        <div style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;" class="shrink-0">3</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Điền thông tin liên hệ của phụ huynh để nhận kết quả phân tích gửi qua email.</p>
                    </div>
                </div>
            </div>
            
            <!-- WIDGET DISCLAIMER -->
            <div class="hidden lg:block bg-[#fefce8] border border-solid border-[#fef08a] rounded-2xl p-6 shadow-[0_4px_20px_rgba(254,240,138,0.15)]">
                <h3 class="text-[#854d0e] font-bold text-sm mb-3 flex items-center gap-2" style="margin-bottom: 12px; font-weight:700;">
                    <span style="font-size:16px;">⚠️</span> Lưu ý quan trọng
                </h3>
                <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light" style="margin:0; font-size:12px; line-height:1.6;">
                    Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn phù hợp.
                </p>
                <div class="mt-4 pt-3 border-t border-solid border-[#fef08a] text-[11px] text-[#854d0e] font-medium" style="margin-top:16px; padding-top:12px; border-top:1px solid #fef08a; font-size:11px; font-weight:500;">
                    Tài liệu tham khảo: Documenting Hope
                </div>
            </div>
            
            <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
            <div class="hidden lg:block bg-white rounded-2xl p-6 border border-solid border-[rgba(0,39,149,0.12)] shadow-[0_4px_20px_rgba(0,39,149,0.05)] flex flex-col gap-3 w-full">
                <!-- Nút: Cộng đồng Facebook -->
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                    rel="noopener noreferrer" title="Cộng Đồng Cha Mẹ"
                    class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                    aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
                    <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;" class="group-hover:scale-110 transition-transform">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                    </svg>
                    <span>Cộng đồng</span>
                </a>

                <!-- Nút: Hỏi đáp Zalo -->
                <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
                    title="Kết Nối Chuyên Gia"
                    class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                    aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
                    <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
                    <span>Hỏi đáp Zalo</span>
                </a>

                <!-- Nút: Đăng nhập / Tài khoản -->
                <?php
                $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
                if ($current_member):
                    ?>
                    <a href="<?php echo home_url('/tai-khoan/'); ?>"
                        class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
                        style="text-decoration:none; display:flex;">
                        <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                        <span>Tài khoản</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo home_url('/dang-nhap/'); ?>"
                        class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
                        style="text-decoration:none; display:flex;">
                        <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                        <span>Đăng nhập</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- CỘT PHẢI (3/4): KHU VỰC FORM CHÍNH -->
        <div class="lg:col-span-3" id="right-form-column">
          <!-- MAIN FORM -->

    <!-- THÔNG TIN CƠ BẢN -->
    <div class="form-section" id="info-section">
      <div class="section-header">
        <div class="section-icon">👤</div>
        <div>
          <div class="section-title">Thông tin về con</div>
          <div class="section-subtitle">Giúp chuyên gia tư vấn hiểu ngữ cảnh trước buổi gặp</div>
        </div>
      </div>
      <!-- GROUP 1: Tên của con -->
      <div style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">1. Tên của con</div>
      <div class="form-row" style="margin-bottom:24px;">
        <div class="form-group" style="grid-column: 1 / -1;">
          <label>Họ và tên của con *</label>
          <input type="text" id="child-name" placeholder="Ví dụ: Nguyễn Văn A" required style="padding:14px 16px; font-size:15px; font-weight:600;">
        </div>
      </div>

      <!-- GROUP 2: Thông tin của con -->
      <div style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">2. Thông tin của con</div>
      <div class="form-row">
        <div class="form-group" style="position:relative;">
          <label style="margin-bottom:8px; display:flex; flex-wrap:wrap; align-items:center; gap:6px;">
            <span>Ngày sinh của con *</span>
            <span style="font-size:12px; color:var(--gray); font-weight:400; text-transform:none;">(Để tính chính xác độ tuổi)</span>
          </label>
          <div style="display:flex; border: 1.5px solid var(--border); border-radius: 10px; overflow: hidden; background: var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
            <div style="flex:1; border-right: 1px solid var(--border); position: relative;">
              <div style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">Ngày</div>
              <input type="text" inputmode="numeric" list="dob-days" id="child-dob-day" oninput="calculateAge()" placeholder="DD" style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
              <datalist id="dob-days">
                <?php for($i=1; $i<=31; $i++) { echo '<option value="'.$i.'">'; } ?>
              </datalist>
            </div>
            <div style="flex:1; border-right: 1px solid var(--border); position: relative;">
              <div style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">Tháng</div>
              <input type="text" inputmode="numeric" list="dob-months" id="child-dob-month" oninput="calculateAge()" placeholder="MM" style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
              <datalist id="dob-months">
                <?php for($i=1; $i<=12; $i++) { echo '<option value="'.$i.'">'; } ?>
              </datalist>
            </div>
            <div style="flex:1.2; position: relative;">
              <div style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">Năm</div>
              <input type="text" inputmode="numeric" list="dob-years" id="child-dob-year" oninput="calculateAge()" placeholder="YYYY" style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
              <datalist id="dob-years">
                <?php $curYear = date('Y'); for($i=$curYear; $i>=($curYear-20); $i--) { echo '<option value="'.$i.'">'; } ?>
              </datalist>
            </div>
          </div>
          <div id="calculated-age" style="font-size: 13px; color: var(--navy); margin-top: 8px; font-weight: 600; text-align:left;"></div>
          <input type="hidden" id="child-age" value="">
        </div>

        <div class="form-group">
          <label style="margin-bottom:8px; display:flex; flex-wrap:wrap; align-items:center; gap:6px;">
            <span>Giới tính *</span>
            <span style="font-size:12px; color:var(--gray); font-weight:400; text-transform:none;">(Dùng cho chỉ số phát triển)</span>
          </label>
          <div style="display:flex; gap:12px; height: 49.5px;">
            <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
              <input type="radio" name="child-gender" value="Bé trai" style="width:16px; height:16px; margin:0;"> Bé trai
            </label>
            <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
              <input type="radio" name="child-gender" value="Bé gái" style="width:16px; height:16px; margin:0;"> Bé gái
            </label>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4" style="margin-bottom: 24px;">
        <div class="form-group" style="position:relative;">
          <label>Chiều cao (cm) *</label>
          <input type="number" id="child-height" placeholder="Ví dụ: 105" required style="padding:14px 16px; font-size:15px; font-weight:600;">
        </div>
        <div class="form-group" style="position:relative;">
          <label>Cân nặng (kg) *</label>
          <input type="number" step="0.1" id="child-weight" placeholder="Ví dụ: 18.5" required style="padding:14px 16px; font-size:15px; font-weight:600;">
        </div>
      </div>

      <!-- GROUP 3: Tình trạng -->
      <div style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">3. Tình trạng & Can thiệp</div>
      <div class="form-row">
        <div class="form-group">
          <label>Chẩn đoán hiện tại *</label>
          <select id="child-diagnosis">
            <option value="">-- Chọn --</option>
            <option>Tự kỷ (ASD)</option>
            <option>Tăng động giảm chú ý (ADHD)</option>
            <option>Chậm phát triển</option>
            <option>Chưa có chẩn đoán chính thức</option>
            <option>Khác</option>
          </select>
        </div>
        <div class="form-group">
          <label>Con đang được can thiệp gì?</label>
          <input type="text" id="child-therapy" placeholder="ABA, ngôn ngữ, vật lý trị liệu...">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group" style="grid-column: 1 / -1;">
          <label>Đang dùng sản phẩm hỗ trợ nào không?</label>
          <input type="text" id="child-supplement" placeholder="Vitamin, men vi sinh, Omega-3...">
        </div>
      </div>
      <div class="form-group">
        <label>Điều cha mẹ lo lắng nhất về con hiện tại là gì?</label>
        <textarea id="parent-concern" placeholder="Chia sẻ ngắn gọn điều khiến cha mẹ trăn trở nhất..."></textarea>
      </div>
      <div class="nav-buttons" style="justify-content:center;">
        <button class="btn btn-primary" onclick="startChecklist()">Bắt đầu kiểm tra →</button>
      </div>
    </div> <!-- /#info-section -->

    <!-- MOBILE ONLY: DISCLAIMER & CTA BUTTONS -->
    <div class="block lg:hidden mt-8 flex flex-col gap-6">
        <!-- Divider to separate checklist from bottom content -->
        <div class="border-t-2 border-solid border-[#e2e8f0] my-2 pt-2"></div>
        <!-- WIDGET DISCLAIMER -->
        <div class="bg-[#fefce8] border border-solid border-[#fef08a] rounded-2xl p-6 shadow-[0_4px_20px_rgba(254,240,138,0.15)]">
            <h3 class="text-[#854d0e] font-bold text-sm mb-3 flex items-center gap-2" style="margin-bottom: 12px; font-weight:700; margin-top:0;">
                <span style="font-size:16px;">⚠️</span> Lưu ý quan trọng
            </h3>
            <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light" style="margin:0; font-size:12px; line-height:1.6;">
                Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn phù hợp.
            </p>
            <div class="mt-4 pt-3 border-t border-solid border-[#fef08a] text-[11px] text-[#854d0e] font-medium" style="margin-top:16px; padding-top:12px; border-top:1px solid #fef08a; font-size:11px; font-weight:500;">
                Tài liệu tham khảo: Documenting Hope
            </div>
        </div>
        
        <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
        <div class="bg-white rounded-2xl p-6 border border-solid border-[rgba(0,39,149,0.12)] shadow-[0_4px_20px_rgba(0,39,149,0.05)] flex flex-col gap-3 w-full">
            <!-- Nút: Cộng đồng Facebook -->
            <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                rel="noopener noreferrer" title="Cộng Đồng Cha Mẹ"
                class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
                <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;" class="group-hover:scale-110 transition-transform">
                    <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                </svg>
                <span>Cộng đồng</span>
            </a>

            <!-- Nút: Hỏi đáp Zalo -->
            <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
                title="Kết Nối Chuyên Gia"
                class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
                <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
                <span>Hỏi đáp Zalo</span>
            </a>

            <!-- Nút: Đăng nhập / Tài khoản -->
            <?php
            $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
            if ($current_member):
                ?>
                <a href="<?php echo home_url('/tai-khoan/'); ?>"
                    class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
                    style="text-decoration:none; display:flex;">
                    <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                    <span>Tài khoản</span>
                </a>
            <?php else: ?>
                <a href="<?php echo home_url('/dang-nhap/'); ?>"
                    class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
                    style="text-decoration:none; display:flex;">
                    <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                    <span>Đăng nhập</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
  </div> <!-- /#right-form-column -->
</div> <!-- /.grid -->
</div> <!-- /#survey-page-container -->

<!-- SURVEY ACTIVE CONTAINER (GRID LAYOUT FOR SURVEY STEP) -->
<div class="max-w-7xl mx-auto px-6 py-12 survey-grid" id="survey-active-container" style="display:none;">
        
        <!-- CỘT TRÁI (3/4): KHU VỰC KHẢO SÁT CHÍNH -->
        <div id="checklist-main-column">
             <!-- MAIN FORM -->
             <div id="main-form">
                 
                 <!-- MOBILE ONLY: HƯỚNG DẪN KHẢO SÁT -->
                 <div class="block lg:hidden bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg mb-6" style="background-color: var(--navy); color: white;">
                     <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
                     <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase" style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em; margin-top: 0;">
                         <span style="font-size:18px;">📋</span> Hướng dẫn khảo sát
                     </h3>
                     <div class="flex flex-col gap-4" style="display: flex; flex-direction: column; gap: 16px; font-size: 13px; line-height: 1.5; color: #ffffff;">
                         <div class="flex gap-2.5 items-start">
                             <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">1</div>
                             <p class="m-0" style="margin:0; font-weight:500;">Tích chọn các dấu hiệu quan sát thấy ở con trong nhóm hiện tại.</p>
                         </div>
                         <div class="flex gap-2.5 items-start">
                             <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">2</div>
                             <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Tiếp theo →" hoặc click tên nhóm ở trên để chuyển phần.</p>
                         </div>
                         <div class="flex gap-2.5 items-start">
                             <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">3</div>
                             <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Hoàn thiện & nhận kết quả" sau khi điền xong nhóm thứ 8.</p>
                         </div>
                     </div>
                 </div>
                 
                 <!-- PROGRESS -->
                 <div class="progress-wrap" id="progress-wrap" style="display:none;">
                   <div class="progress-header">
                     <span class="progress-label">Tiến trình hoàn thành</span>
                     <span class="progress-count" id="progress-count">0 / 8 nhóm</span>
                   </div>
                   <div class="progress-bar">
                     <div class="progress-fill" id="progress-fill"></div>
                   </div>
                   <div class="progress-steps" id="progress-steps"></div>
                 </div>

                 <!-- CHECKLIST DATA -->
                 <div id="checklist-container"></div>
                  
                  <!-- OPEN-ENDED & SUBMIT SECTION (Outside Groups) -->
                  <div id="survey-completion-section" style="display: none; margin-top: 32px;">
                    <div class="open-section">
                      <label>Triệu chứng khác cha mẹ muốn chia sẻ thêm (không bắt buộc)</label>
                      <textarea id="extra-symptoms" placeholder="Ghi thêm bất kỳ dấu hiệu nào cha mẹ quan sát được ở con..."></textarea>
                    </div>
                    <div class="flex justify-end mt-8">
                      <button type="button" class="btn btn-submit" id="btn-show-parent-info" onclick="ModuleSurvey.completeSurvey()">Hoàn thiện & nhận kết quả →</button>
                    </div>
                  </div>

                 <!-- THÔNG TIN PHỤ HUYNH (Mới - Sau khi xong khảo sát) -->
                 <div class="form-section" id="parent-info-section" style="display:none; max-width:760px; margin: 32px auto;">
                   <div class="section-header">
                     <div class="section-icon">✉️</div>
                     <div>
                       <div class="section-title">Nhận Kết Quả Qua Email</div>
                       <div class="section-subtitle">Vui lòng điền thông tin để nhận kết quả khảo sát chi tiết của con</div>
                     </div>
                   </div>
                   
                   <div class="form-group" style="margin-bottom: 20px;">
                     <label>Tên cha / mẹ *</label>
                     <input type="text" id="parent-name" placeholder="Họ và tên phụ huynh" required style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
                   </div>
                   
                   <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                     <div class="form-group">
                       <label>Số điện thoại / Zalo *</label>
                       <input type="tel" id="parent-phone" placeholder="Ví dụ: 0987654321" required style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
                     </div>
                     <div class="form-group">
                       <label>Email liên hệ nhận kết quả *</label>
                       <input type="email" id="parent-email" placeholder="Ví dụ: email@gmail.com" required style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
                     </div>
                   </div>
                   
                   <div class="nav-buttons" style="display:flex; justify-content:flex-end;">
                     <button class="btn btn-submit" id="btn-final-submit" onclick="submitParentInfo()" style="padding: 14px 28px; background:var(--navy); color:var(--white); font-weight:700; border:none; border-radius:10px; cursor:pointer; font-size:15px; font-family:'Quicksand', sans-serif;">Hoàn thiện & nhận kết quả →</button>
                   </div>
                 </div>

                 <!-- THÀNH CÔNG (Sau khi submit parent-info-section) -->
                 <div class="form-section" id="thankyou-section" style="display:none; text-align:center; padding:48px 32px; max-width:760px; margin: 32px auto;">
                   <div style="font-size: 64px; margin-bottom: 24px;">✉️</div>
                   <h2 style="font-family:'Oswald', sans-serif; font-size:28px; color:var(--navy); margin-bottom:16px;">Đã gửi kết quả thành công!</h2>
                   <p style="font-size:16px; color:var(--charcoal); max-width:540px; margin:0 auto 24px; line-height:1.7;">
                     Kết quả phân tích 8 nhóm dấu hiệu của con đã được gửi tới hòm thư của cha mẹ tại <strong id="sent-email-display" style="color:var(--navy);">[email]</strong>.
                   </p>
                   <p style="font-size:14px; color:#64748b; max-width:500px; margin:0 auto 32px; line-height:1.6; font-style:italic;">
                     Cha mẹ vui lòng kiểm tra hộp thư đến (Inbox). Nếu không tìm thấy thư trong vòng 3-5 phút, vui lòng kiểm tra thêm thư mục <strong>Spam (Thư rác)</strong> hoặc <strong>Promotions (Quảng cáo)</strong>.
                   </p>
                   <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
                     <a href="https://zalo.me/0988717107" target="_blank" rel="noopener" class="btn btn-primary" style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:var(--navy); color:var(--white); border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif;">
                       📞 Kết nối chuyên gia qua Zalo
                     </a>
                     <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" rel="noopener" class="btn btn-secondary" style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:#f1f5f9; color:#334155; border:1px solid #cbd5e1; border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif; transition: background 0.2s;">
                       📬 Kiểm tra Hòm thư đến (Inbox)
                     </a>
                     <a href="https://mail.google.com/mail/u/0/#spam" target="_blank" rel="noopener" class="btn btn-secondary" style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:#fff1f2; color:#be123c; border:1px solid #fecdd3; border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif; transition: background 0.2s;">
                       📁 Kiểm tra Hòm thư Spam
                     </a>
                   </div>
                 </div>

                 <!-- RESULT PAGE -->
                 <div id="result-page">
                   <div class="result-hero">
                     <div style="font-size:48px;margin-bottom:16px;">📋</div>
                     <h2>Bản Ghi Nhận Dấu Hiệu (Checklist)</h2>
                     <p>Dưới đây là thống kê tỷ lệ các dấu hiệu được ghi nhận theo từng nhóm.<br>Chuyên gia tư vấn sẽ sử dụng thông tin này để phân tích chi tiết
                       và đề xuất hướng hỗ trợ phù hợp nhất cho con.</p>
                   </div>
                   <div class="result-grid" id="result-grid"></div>
                   <div class="cta-box">
                     <h3>Đặt lịch tư vấn </h3>
                     <p>Chuyên gia sẽ phân tích kết quả kiểm tra và đưa ra định hướng hỗ trợ cụ thể cho con - hoàn toàn , không
                       ràng buộc.</p>
                     <div class="cta-form">
                       <input type="tel" placeholder="Số điện thoại / Zalo của bạn" id="cta-phone">
                       <button onclick="submitCTA()">Đặt lịch ngay</button>
                     </div>
                     <p style="font-size:13px;opacity:0.6;margin-top:16px;">Hoặc liên hệ trực tiếp qua Zalo: <strong>0xxx xxx
                         xxx</strong></p>
                   </div>
                   <div class="disclaimer">
                     <strong>Lưu ý quan trọng:</strong> Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn
                     đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc
                     chuyên gia có chuyên môn phù hợp.
                      <details class="mt-3 pt-3 border-t border-solid border-slate-200 text-xs text-gray-500 cursor-pointer">
                        <summary class="focus:outline-none hover:text-gray-700 font-semibold">📖 Xem nguồn tài liệu tham khảo</summary>
                        <ul class="list-none p-0 mt-2 flex flex-col gap-2 font-normal text-gray-600 leading-relaxed text-xs" style="display:flex; flex-direction:column; gap:8px; padding-left:0; margin-top:8px; list-style:none;">
                          <li><strong>PSC - Pediatric Symptom Checklist:</strong> Bộ công cụ sàng lọc những vấn đề về cảm xúc và hành vi cho trẻ từ 4 đến 16 tuổi.</li>
                          <li><strong>CSHQ - Children’s Sleep Habits Questionnaire:</strong> Bộ công cụ sàng lọc những vấn đề liên quan đến giấc ngủ cho trẻ từ 48 tháng đến 12 tuổi.</li>
                          <li><strong>BAMBI - Brief Autism Mealtime Behavior Inventory:</strong> Bộ công cụ sàng lọc những vấn đề hành vi liên quan đến ăn uống ở trẻ tự kỷ từ 2 đến dưới 11 tuổi.</li>
                          <li><strong>VADRS - Vanderbilt ADHD Diagnostic Rating Scale:</strong> Bộ công cụ sàng lọc nguy cơ Tăng động - Giảm chú ý và các rối loạn liên quan, thường dùng cho trẻ từ 6 đến 12 tuổi.</li>
                          <li><strong>Documenting Hope:</strong> Một tổ chức phi lợi nhuận tại Hoa Kỳ, tập trung vào giáo dục, nghiên cứu và cung cấp tài nguyên về sức khỏe toàn diện cho trẻ em mắc các rối loạn phát triển thần kinh, bao gồm tự kỷ.</li>
                        </ul>
                      </details>
                   </div>
                 </div>

             </div> <!-- /#main-form -->
        </div> <!-- /#checklist-main-column -->
        
        <!-- CỘT PHẢI (1/4): SIDEBAR BIỂU ĐỒ & HƯỚNG DẪN (Sticky) -->
        <div class="survey-sidebar-sticky" id="survey-sidebar" style="display:flex; flex-direction:column; gap:24px;">
            
            <!-- WIDGET 2: HƯỚNG DẪN KHẢO SÁT (Màu Navy) -->
            <div class="desktop-only-widget bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg" style="background-color: var(--navy); color: white;">
                <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
                <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase" style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em;">
                    <span style="font-size:18px;">📋</span> Hướng dẫn khảo sát
                </h3>
                <div class="flex flex-col gap-4" style="display: flex; flex-direction: column; gap: 16px; font-size: 13px; line-height: 1.5; color: #ffffff;">
                    <div class="flex gap-2.5 items-start">
                        <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">1</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Tích chọn các dấu hiệu quan sát thấy ở con trong nhóm hiện tại.</p>
                    </div>
                    <div class="flex gap-2.5 items-start">
                        <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">2</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Tiếp theo →" hoặc click tên nhóm ở trên để chuyển phần.</p>
                    </div>
                    <div class="flex gap-2.5 items-start">
                        <div style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;" class="shrink-0">3</div>
                        <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Hoàn thiện & nhận kết quả" sau khi điền xong nhóm thứ 8.</p>
                    </div>
                </div>
            </div>
            
            <!-- WIDGET 1: RADAR CHART -->
            <div class="bg-navy rounded-2xl p-4 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white flex flex-col items-center justify-center has-pattern-bg relative" style="background-color: var(--navy); color: white;">
                <!-- Close Button (Only visible on mobile overlay mode) -->
                <button onclick="toggleMobileRadar(false)" class="absolute top-4 right-4 text-white/70 hover:text-white" style="display:none; background:none; border:none; padding:4px; cursor:pointer; z-index: 10;" id="close-radar-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <h3 class="font-bold text-sm mb-3 text-yellow font-oswald tracking-wide uppercase text-center w-full" style="color: var(--yellow); margin-bottom: 12px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em;">
                    📊 Tổng quan dấu hiệu cha mẹ ghi nhận
                </h3>
                <div style="position: relative; width: 100%; height: 280px;">
                    <canvas id="radarChartCanvas"></canvas>
                </div>
                <div class="mt-4 text-[11px] text-white/70 text-center font-light leading-relaxed">
                    Biểu đồ phản ánh tỷ lệ biểu hiện dấu hiệu của từng hệ cơ quan theo thời gian thực.
                </div>
            </div>
            
            <!-- WIDGET 3: DISCLAIMER -->
            <div class="bg-[#fefce8] border border-solid border-[#fef08a] rounded-2xl p-6 shadow-sm">
                <h3 class="text-[#854d0e] font-bold text-sm mb-2 flex items-center gap-2" style="margin-bottom: 8px; font-weight:700;">
                    <span>⚠️</span> Lưu ý quan trọng
                </h3>
                <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light" style="margin:0; font-size:11px; line-height:1.5;">
                    Kết quả và biểu đồ này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán chuyên khoa hoặc chỉ định y khoa chính thức.
                </p>
            </div>
            
            <!-- WIDGET 4: LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
            <div class="bg-white rounded-2xl p-6 border border-solid border-[rgba(0,39,149,0.12)] shadow-[0_4px_20px_rgba(0,39,149,0.05)] flex flex-col gap-3 w-full">
                <!-- Nút: Cộng đồng Facebook -->
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                    rel="noopener noreferrer" title="Cộng Đồng Cha Mẹ"
                    class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                    aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
                    <svg viewBox="0 0 320 512" style="width:12px; height:12px; fill:currentColor;" class="group-hover:scale-110 transition-transform">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                    </svg>
                    <span>Cộng đồng</span>
                </a>

                <!-- Nút: Hỏi đáp Zalo -->
                <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
                    title="Kết Nối Chuyên Gia"
                    class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
                    aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
                    <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
                    <span>Hỏi đáp Zalo</span>
                </a>

                <!-- Nút: Đăng nhập / Tài khoản -->
                <?php
                $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
                if ($current_member):
                    ?>
                    <a href="<?php echo home_url('/tai-khoan/'); ?>"
                        class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
                        style="text-decoration:none; display:flex;">
                        <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                        <span>Tài khoản</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo home_url('/dang-nhap/'); ?>"
                        class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
                        style="text-decoration:none; display:flex;">
                        <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                        <span>Đăng nhập</span>
                    </a>
                <?php endif; ?>
            </div>
            
        </div> <!-- /#survey-sidebar -->
        
</div> <!-- /#survey-active-container -->

  <script>
    // ── DỮ LIỆU CHECKLIST ──
        const GROUPS = [
      {
        id: 'tieuHoa',
        name: 'Rối loạn tiêu hóa',
        icon: '🫁',
        desc: 'Tình trạng đường ruột và các vấn đề về tiêu hóa hàng ngày',
        items: [
          { main: 'Trẻ thường xuyên xì hơi nặng mùi hoặc hơi thở hôi dù đã vệ sinh răng miệng?', example: 'Trẻ thường xuyên xì hơi nặng mùi hoặc có hơi thở hôi (dù đã vệ sinh răng miệng sạch sẽ)?' },
          { main: 'Trẻ hay đầy bụng, chướng bụng, sôi bụng hoặc ợ chua sau ăn?', example: 'Trẻ hay bị đầy bụng, chướng bụng, sôi bụng hoặc ợ chua thường xuyên sau khi ăn?' },
          { main: 'Trẻ đi ngoài không đều, phân lỏng, sống, có bọt hoặc mùi bất thường?', example: 'Trẻ đi ngoài (tiêu) không đều, tính chất phân bất thường (phân sống, lỏng, có bọt hoặc mùi chua/khai nồng)?' },
          { main: 'Trẻ táo bón kéo dài, đau khi đi vệ sinh, són phân hoặc né tránh đi vệ sinh?', example: 'Trẻ bị táo bón kéo dài (nhiều ngày mới đi một lần) kèm theo biểu hiện đau đớn, són phân ra quần hoặc sợ hãi, lảng tránh việc đi vệ sinh?' },
          { main: 'Trẻ có dấu hiệu đau bụng dữ dội như ôm bụng, cong người, khóc nhiều hoặc đập bụng vào vật cứng?', example: 'Trẻ có biểu hiện đau bụng cấp tính như ôm bụng, cong người quấy khóc dữ dội, hoặc đập bụng vào các vật cứng (cạnh bàn, ghế) để tự giảm đau?' }
        ]
      },
      {
        id: 'anUong',
        name: 'Rối loạn ăn uống',
        icon: '🍽️',
        desc: 'Các hành vi kén ăn, nhạy cảm thực phẩm và khó khăn trong bữa ăn',
        items: [
          { main: 'Trẻ chỉ chấp nhận một số rất ít món ăn quen thuộc?', example: 'Trẻ có xu hướng kén ăn, chỉ chấp nhận một danh mục thực phẩm rất hạn hẹp (ví dụ: chỉ ăn đồ chiên, chỉ ăn cơm trắng)?' },
          { main: 'Trẻ rất nhạy với mùi, màu, vị hoặc kết cấu thức ăn?', example: 'Trẻ cực kỳ nhạy cảm với kết cấu (mềm, nhão, giòn), màu sắc hoặc mùi vị của thức ăn, dễ dàng phát hiện ra sự thay đổi nhỏ trong món ăn?' },
          { main: 'Trẻ hay ngậm lâu, không nhai nuốt, buồn nôn hoặc oẹ khi gặp món lạ?', example: 'Trẻ thường xuyên ngậm thức ăn rất lâu trong miệng không chịu nhai nuốt, hoặc có hành vi nôn trớ, oẹ khi ngửi/thấy thức ăn lạ?' },
          { main: 'Chế độ ăn hạn hẹp khiến trẻ chậm tăng cân, sụt cân, mệt mỏi hoặc có dấu hiệu thiếu chất?', example: 'Chế độ ăn quá hạn hẹp (dưới 10 món) khiến trẻ có dấu hiệu thiếu chất (da xanh xao, móng tay có vệt trắng, hay mệt mỏi) hoặc sụt cân/chậm tăng cân?' },
          { main: 'Trẻ ăn/nhai vật không phải thức ăn hoặc bùng nổ dữ dội khi bị ép ăn?', example: 'Trẻ có hành vi ăn, nhai các vật không phải thực phẩm (như giấy, đất, cát, đồ nhựa - hội chứng Pica) hoặc bùng nổ dữ dội nếu bị ép ăn món không thích?' }
        ]
      },
      {
        id: 'giacNgu',
        name: 'Rối loạn giấc ngủ',
        icon: '🌙',
        desc: 'Tình trạng giấc ngủ và nhịp sinh học của trẻ',
        items: [
          { main: 'Trẻ thường mất hơn 60 phút mới ngủ được?', example: 'Trẻ thường xuyên mất hơn 60 phút trằn trọc mới có thể đi vào giấc ngủ?' },
          { main: 'Trẻ phải có điều kiện đặc biệt mới ngủ, như ôm chặt, tiếng ồn trắng hoặc bật đèn?', example: 'Trẻ lệ thuộc hoàn toàn vào các hỗ trợ giác quan hoặc quy trình cứng nhắc để ngủ (phải ôm chặt, phải có tiếng ồn trắng, hoặc phải bật đèn)?' },
          { main: 'Trẻ thức giấc nhiều lần trong đêm và khó ngủ lại?', example: 'Trẻ hay thức giấc giữa đêm (từ 2 lần trở lên) và mất rất nhiều thời gian để dỗ ngủ lại?' },
          { main: 'Khi ngủ, trẻ nghiến răng, đổ mồ hôi nhiều hoặc cử động chân tay liên tục?', example: 'Khi ngủ, trẻ có các biểu hiện thực thể như nghiến răng ken két, đổ mồ hôi trộm đầm đìa hoặc chân tay cử động không ngừng?' },
          { main: 'Trẻ thường la hét hoảng loạn ban đêm hoặc thức trắng nhiều giờ giữa đêm?', example: 'Trẻ thường xuyên gặp cơn hoảng sợ ban đêm (la hét hoảng loạn khi đang ngủ) hoặc thức trắng nhiều giờ liền giữa đêm trong trạng thái tỉnh táo?' }
        ]
      },
      {
        id: 'camGiac',
        name: 'Xử lý giác quan',
        icon: '🎯',
        desc: 'Cách trẻ tiếp nhận và phản ứng với các kích thích từ môi trường',
        items: [
          { main: 'Trẻ sợ tiếng ồn, ánh sáng hoặc khó chịu với một số chất liệu quần áo?', example: 'Trẻ có biểu hiện quá nhạy cảm với các kích thích môi trường như: sợ tiếng ồn bình thường, khó chịu với ánh sáng đèn, hay từ chối mặc quần áo có chất liệu nhất định?' },
          { main: 'Trẻ thích va chạm mạnh, nhìn vật xoay, ngửi đồ vật hoặc tìm cảm giác mạnh?', example: 'Trẻ có xu hướng tìm kiếm cảm giác mạnh như: thích va chạm mạnh vào người khác, nhìn chằm chằm vào vật xoay tròn, hoặc thích ngửi đồ vật/người lạ?' },
          { main: 'Trẻ vụng về, hay vấp ngã, nhảy liên tục hoặc khó điều chỉnh lực tay?', example: 'Trẻ gặp khó khăn về thăng bằng và nhận thức cơ thể: thường xuyên vấp ngã, vụng về, nhảy lên xuống liên tục hoặc không biết điều chỉnh lực tay (quá mạnh hoặc quá nhẹ)?' },
          { main: 'Trẻ khó nhận biết đói, đau, buồn vệ sinh hoặc tín hiệu bên trong cơ thể?', example: 'Trẻ dường như không nhận biết được các tín hiệu nội tại của cơ thể: không cảm thấy đói, đau khi bị thương, hoặc gặp khó khăn lớn trong việc tập đi vệ sinh đúng lúc?' },
          { main: 'Trẻ dễ bùng nổ hoặc đóng băng khi ở nơi quá đông, ồn hoặc nhiều kích thích?', example: 'Trẻ thường xuyên có các cơn bùng nổ (la hét, mất kiểm soát) hoặc đóng băng (im lặng, ngắt kết nối hoàn toàn) khi phải ở nơi có quá nhiều kích thích?' }
        ]
      },
      {
        id: 'tangDong',
        name: 'Tăng động - Giảm chú ý',
        icon: '⚡',
        desc: 'Mức độ hoạt động, khả năng tập trung và tự kiểm soát của trẻ',
        items: [
          { main: 'Trẻ thường không phản hồi khi được gọi hoặc khó theo hướng dẫn?', example: 'Trẻ dường như không nghe thấy khi được gọi tên hoặc không để ý đến hướng dẫn của người lớn vì đang bị thu hút quá mức bởi một chi tiết nhỏ?' },
          { main: 'Trẻ rất khó chuyển hoạt động, dễ khựng lại hoặc bùng nổ khi bị yêu cầu dừng việc đang thích?', example: 'Trẻ có thể cực kỳ tập trung vào thứ mình thích nhưng lại "khựng lại" hoặc bùng nổ khi được yêu cầu chuyển sang một hoạt động khác (như đi tắm, đi ăn)?' },
          { main: 'Trẻ luôn bồn chồn, di chuyển, nhún nhảy hoặc táy máy tay chân?', example: 'Trẻ có biểu hiện bồn chồn, luôn phải di chuyển, nhún nhảy hoặc táy máy tay chân ngay cả khi cơ thể đã mệt mỏi hoặc trong môi trường cần sự yên tĩnh?' },
          { main: 'Trẻ hay lao đi, leo trèo, nhảy từ cao hoặc làm việc nguy hiểm mà chưa kịp cân nhắc?', example: 'Trẻ thường lao đi hoặc thực hiện các hành động nguy hiểm (nhảy từ trên cao, lao ra đường) mà dường như không có sự cân nhắc hay nhận thức được hậu quả ngay lúc đó?' },
          { main: 'Sau khi cố ngồi yên hoặc tập trung, trẻ cáu kỉnh, kiệt sức hoặc ngắt kết nối rõ rệt?', example: 'Sau một khoảng thời gian ngắn cố gắng tập trung hoặc ngồi yên, trẻ có biểu hiện cáu kỉnh dữ dội, mệt mỏi hoặc "ngắt kết nối" hoàn toàn?' }
        ]
      },
      {
        id: 'camXuc',
        name: 'Cảm xúc - Hành vi',
        icon: '🤝',
        desc: 'Khả năng điều tiết cảm xúc, lo âu và các phản ứng khi khủng hoảng',
        items: [
          { main: 'Trẻ có thay đổi cảm xúc thất thường mà không rõ nguyên nhân?', example: 'Trẻ có những cơn vui buồn thất thường mà không có lý do ngoại cảnh rõ ràng (ví dụ: đang chơi bình thường bỗng khóc thét hoặc cười ngặt nghẽo)?' },
          { main: 'Trẻ rất căng thẳng hoặc bùng nổ khi lịch trình thay đổi?', example: 'Trẻ cực kỳ căng thẳng, lo âu hoặc bùng nổ nếu lịch trình sinh hoạt bị thay đổi nhỏ, hoặc gặp khó khăn lớn khi phải dừng việc đang làm để chuyển sang việc khác?' },
          { main: 'Hành vi lặp lại tăng mạnh khi trẻ lo lắng hoặc áp lực?', example: 'Trẻ thực hiện các hành vi lặp đi lặp lại (như vẫy tay, xoay đồ vật, lặp lại lời nói) với cường độ cao hơn hẳn mỗi khi gặp áp lực hoặc lo lắng?' },
          { main: 'Trẻ thường la hét, khóc kéo dài và rất khó dỗ?', example: 'Trẻ thường xuyên có những cơn la hét, khóc lóc dữ dội kéo dài (trên 15-30 phút) mà mọi nỗ lực dỗ dành hay đe dọa của người lớn đều không có tác dụng?' },
          { main: 'Khi khủng hoảng, trẻ tự làm đau hoặc tấn công người khác?', example: 'Khi gặp khủng hoảng, trẻ có hành vi tự làm đau (đập đầu, cắn tay mình) hoặc tấn công người khác (cắn, cào cấu, ném đồ vật)?' }
        ]
      },
      {
        id: 'mienDich',
        name: 'Miễn dịch - Dị ứng',
        icon: '🛡️',
        desc: 'Tình trạng đề kháng, phản ứng viêm và các nhạy cảm thể chất',
        items: [
          { main: 'Trẻ hay hắt hơi, sổ mũi, dụi mắt/mũi, mẩn đỏ hoặc ngứa da?', example: 'Trẻ thường xuyên có các biểu hiện dị ứng như: hay hắt hơi, sổ mũi khi thời tiết thay đổi, dụi mắt/mũi liên tục, hoặc da dễ bị mẩn đỏ, ngứa ngáy, viêm da cơ địa?' },
          { main: 'Trẻ có biểu hiện lạ sau khi ăn một số thực phẩm hoặc tiếp xúc mùi hóa chất?', example: 'Trẻ có biểu hiện lạ sau khi ăn thực phẩm nhất định (sữa, bột mì, đồ ngọt) hoặc ngửi mùi hóa chất như: đỏ tai, đỏ má, quầng thâm mắt đậm lên hoặc đột ngột kích động?' },
          { main: 'Trẻ hay bị viêm tai, viêm họng, viêm amidan hoặc sưng nướu lặp lại?', example: 'Trẻ thường xuyên bị các đợt viêm nhiễm lặp đi lặp lại như: viêm tai giữa, viêm họng, viêm amidan hoặc sưng nướu răng mãn tính?' },
          { main: 'Trẻ dễ ốm, lâu khỏi và sau ốm thường mệt mỏi kéo dài?', example: 'Trẻ rất dễ bị lây bệnh từ người khác (đề kháng kém), mỗi đợt ốm thường kéo dài lâu khỏi hơn bình thường và sau khi khỏi, trẻ vẫn bị sụt giảm năng lượng, mệt mỏi kéo dài?' },
          { main: 'Sau các đợt ốm hoặc dị ứng nặng, trẻ lờ đờ, mất tập trung rõ hoặc giảm kỹ năng đã có?', example: 'Trẻ dường như rơi vào trạng thái "sương mù não" (lờ đờ, mất tập trung hoàn toàn) hoặc đột ngột mất đi các kỹ năng đã thạo (như ngôn ngữ, vệ sinh) mỗi khi hệ miễn dịch bị kích hoạt mạnh do ốm hoặc dị ứng nặng?' }
        ]
      },
      {
        id: 'vanDong',
        name: 'Chức năng vận động',
        icon: '🏃',
        desc: 'Phối hợp vận động thô/tinh và các hoạt động tự phục vụ của trẻ',
        items: [
          { main: 'Trẻ khó cài cúc, kéo khóa, cầm thìa, dùng kéo hoặc bút chì?', example: 'Trẻ gặp khó khăn với các nhiệm vụ cần sự khéo léo của bàn tay như: cài cúc áo, kéo khóa, cầm thìa đúng cách, hoặc sử dụng kéo và bút chì?' },
          { main: 'Trẻ hay vấp ngã, va vào đồ vật hoặc đi đứng thiếu vững vàng?', example: 'Trẻ thường xuyên vấp ngã, va vào đồ vật/người khác khi đi lại, hoặc có tư thế đi đứng trông không vững vàng, thiếu sự nhịp nhàng?' },
          { main: 'Trẻ nhanh mệt, cơ thể mềm yếu, hay tựa người, nằm bò ra bàn hoặc ngồi chữ W?', example: 'Cơ thể trẻ có vẻ "mềm yếu", trẻ nhanh mệt khi phải đi bộ, thường có xu hướng tựa vào người khác, nằm bò ra bàn hoặc ngồi tư thế chữ W để giữ thăng bằng?' },
          { main: 'Trẻ khó học chuỗi vận động mới như nhảy theo nhạc, đạp xe, leo cầu thang?', example: 'Trẻ gặp khó khăn lớn khi học các chuỗi vận động mới (như tập nhảy theo điệu nhạc, đạp xe, hoặc leo trèo cầu thang luân phiên chân)?' },
          { main: 'Trẻ rất khó thực hiện chuỗi tự phục vụ như ăn uống, mặc quần áo, vệ sinh cá nhân?', example: 'Trẻ gặp khó khăn cực lớn trong việc thực hiện các chuỗi hành động tự phục vụ cơ bản (như cầm bát ăn, tự mặc quần áo, vệ sinh cá nhân) hoặc có các kiểu vận động rất cứng nhắc, vụng về.' }
        ]
      }
    ];

    // ==========================================
    // ── CORE APPLICATION CONTROLLER (ChecklistApp) ──
    // ==========================================
    const ChecklistApp = {
      state: {
        userCode: '',
        startTime: null,
        answers: {},
        completedGroups: new Set(),
        currentGroup: 0,
        currentGroupStartTime: Date.now(),
        currentGroupFirstClickRecorded: false,
        deepTracker: {
          activeTime: 0,
          toggles: {},
          thinkTimes: {},
          deletedChars: 0,
          highlighted: new Set(),
          location: 'Đang lấy...',
          ip: '',
          utms: {},
          drop_point: 'Chưa bắt đầu',
          lastFocus: Date.now()
        }
      },

      init() {
        this.state.startTime = Date.now();
        this.initUTM();
        this.initDeepTracking();
        
        // Khởi trị các module con
        ModuleChildInfo.init(this);
        ModuleSurvey.init(this);
        ModuleParentInfo.init(this);
        ModuleSuccess.init(this);
      },

      initUTM() {
        const params = new URLSearchParams(window.location.search);
        for (const [key, value] of params.entries()) {
          if (key.startsWith('utm_')) {
            this.state.deepTracker.utms[key] = value;
          }
        }
      },

      initDeepTracking() {
        // Lấy IP & Vị trí
        fetch('https://api.db-ip.com/v2/free/self')
          .then(res => res.json())
          .then(data => {
              this.state.deepTracker.location = data.city + ', ' + data.countryName;
              this.state.deepTracker.ip = data.ipAddress;
          }).catch(e => {
              this.state.deepTracker.location = 'Không xác định';
          });

        // Active Time
        window.addEventListener('blur', () => { 
          this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus); 
        });
        window.addEventListener('focus', () => { 
          this.state.deepTracker.lastFocus = Date.now(); 
        });
        window.addEventListener('visibilitychange', () => {
          if (document.hidden) {
            this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus);
          } else {
            this.state.deepTracker.lastFocus = Date.now();
          }
        });

        // Text selection
        document.addEventListener('mouseup', () => {
          const selection = window.getSelection().toString().trim();
          if (selection.length > 3 && selection.length < 50) {
            this.state.deepTracker.highlighted.add(selection);
          }
        });

        // Input deletions
        document.addEventListener('keydown', (e) => {
          if ((e.key === 'Backspace' || e.key === 'Delete') && e.target.tagName === 'TEXTAREA') {
            this.state.deepTracker.deletedChars++;
          }
        });
      },

      pingServerDropOff() {
        if (!this.state.userCode) return;
        this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus);
        this.state.deepTracker.lastFocus = Date.now();

        const timeSpent = Math.floor((Date.now() - this.state.startTime) / 1000);
        const da = { 
          ...this.state.deepTracker, 
          highlighted: Array.from(this.state.deepTracker.highlighted), 
          activeTime: Math.floor(this.state.deepTracker.activeTime / 1000) 
        };

        const formData = new FormData();
        formData.append('action', 'hieucon_dh_submit_checklist');
        formData.append('user_code', this.state.userCode);
        formData.append('child_name', ModuleChildInfo.getChildName());
        formData.append('child_age', ModuleChildInfo.getChildAge());
        formData.append('child_gender', ModuleChildInfo.getChildGender());
        formData.append('child_height', ModuleChildInfo.getChildHeight());
        formData.append('child_weight', ModuleChildInfo.getChildWeight());
        formData.append('child_diagnosis', ModuleChildInfo.getChildDiagnosis());
        formData.append('child_therapy', ModuleChildInfo.getChildTherapy());
        formData.append('child_supplement', ModuleChildInfo.getChildSupplement());
        formData.append('parent_concern', ModuleChildInfo.getParentConcern());
        
        // Bổ sung thông tin phụ huynh nếu có
        formData.append('parent_name', ModuleParentInfo.getParentName());
        formData.append('parent_phone', ModuleParentInfo.getParentPhone());
        formData.append('parent_email', ModuleParentInfo.getParentEmail());

        const extraSymptomsEl = document.getElementById('extra-symptoms');
        formData.append('extra_symptoms', extraSymptomsEl ? extraSymptomsEl.value.trim() : '');

        // Bổ sung scores nếu đã hoàn thành trắc nghiệm
        if (Object.keys(this.state.answers).length > 0) {
          const scores = ModuleSurvey.calculateScores();
          const behaviorsByGroup = {};
          scores.forEach(s => {
            if (s.tickedItems && s.tickedItems.length > 0) {
              behaviorsByGroup[s.id] = s.tickedItems;
            }
          });
          formData.append('scores_json', JSON.stringify(scores));
          formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
        }

        formData.append('time_spent', timeSpent);
        formData.append('device_info', navigator.userAgent);
        formData.append('deep_analytics', JSON.stringify(da));

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData }).catch(()=>{});
      }
    };

    // ==========================================
    // ── MODULE 1: THÔNG TIN TRẺ (ModuleChildInfo) ──
    // ==========================================
    const ModuleChildInfo = {
      app: null,

      init(appInstance) {
        this.app = appInstance;
        this.bindEvents();
      },

      bindEvents() {
        const dayEl = document.getElementById('child-dob-day');
        const monthEl = document.getElementById('child-dob-month');
        const yearEl = document.getElementById('child-dob-year');

        if (dayEl && monthEl && yearEl) {
          dayEl.addEventListener('input', () => this.calculateAge());
          monthEl.addEventListener('input', () => this.calculateAge());
          yearEl.addEventListener('input', () => this.calculateAge());
        }
      },

      getChildName() { return document.getElementById('child-name') ? document.getElementById('child-name').value.trim() : ''; },
      getChildAge() { return document.getElementById('child-age') ? document.getElementById('child-age').value : ''; },
      getChildGender() {
        const genderEl = document.querySelector('input[name="child-gender"]:checked');
        return genderEl ? genderEl.value : '';
      },
      getChildHeight() { return document.getElementById('child-height') ? document.getElementById('child-height').value.trim() : ''; },
      getChildWeight() { return document.getElementById('child-weight') ? document.getElementById('child-weight').value.trim() : ''; },
      getChildDiagnosis() { return document.getElementById('child-diagnosis') ? document.getElementById('child-diagnosis').value : ''; },
      getChildTherapy() { return document.getElementById('child-therapy') ? document.getElementById('child-therapy').value.trim() : ''; },
      getChildSupplement() { return document.getElementById('child-supplement') ? document.getElementById('child-supplement').value.trim() : ''; },
      getParentConcern() { return document.getElementById('parent-concern') ? document.getElementById('parent-concern').value.trim() : ''; },

      calculateAge() {
        const d = document.getElementById('child-dob-day').value;
        const m = document.getElementById('child-dob-month').value;
        const y = document.getElementById('child-dob-year').value;
        const displayDiv = document.getElementById('calculated-age');
        const hiddenInput = document.getElementById('child-age');
        
        if (!d || !m || !y) {
          displayDiv.innerText = '';
          hiddenInput.value = '';
          return;
        }

        const dob = new Date(y, m - 1, d);
        const today = new Date();
        
        if (dob.getFullYear() != y || dob.getMonth() != m - 1 || dob.getDate() != d) {
          displayDiv.innerText = 'Ngày sinh không tồn tại';
          displayDiv.style.color = '#e11d48';
          hiddenInput.value = '';
          return;
        }
        
        let months = (today.getFullYear() - dob.getFullYear()) * 12;
        months -= dob.getMonth();
        months += today.getMonth();
        
        if (today.getDate() < dob.getDate()) {
          months--;
        }
        
        if (months < 0) {
          displayDiv.innerText = 'Ngày sinh chưa hợp lệ';
          displayDiv.style.color = '#e11d48';
          hiddenInput.value = '';
          return;
        }
        
        let ageStr = '';
        if (months < 24) {
          ageStr = months + ' tháng tuổi';
        } else {
          const years = Math.floor(months / 12);
          const extraMonths = months % 12;
          ageStr = years + ' tuổi ' + (extraMonths > 0 ? extraMonths + ' tháng' : '');
        }
        
        displayDiv.innerText = 'Tuổi của con: ' + ageStr;
        displayDiv.style.color = 'var(--navy)';
        hiddenInput.value = ageStr;
      },

      validate() {
        const childName = this.getChildName();
        const age = this.getChildAge();
        const gender = this.getChildGender();
        const height = this.getChildHeight();
        const weight = this.getChildWeight();
        const diagnosis = this.getChildDiagnosis();

        if (!childName || !age || !gender || !height || !weight || !diagnosis) {
          alert('Cha mẹ vui lòng điền đầy đủ các thông tin có dấu * trước khi tiếp tục.');
          return false;
        }
        return true;
      },

      submit() {
        if (!this.validate()) return;

        // Sinh mã hồ sơ (userCode) 8 chữ số nếu chưa có
        if (!this.app.state.userCode) {
          this.app.state.userCode = Math.floor(10000000 + Math.random() * 90000000).toString();
        }

        // Đổi trạng thái nút bấm
        const btn = document.querySelector('#info-section .btn-primary');
        if (btn) {
          btn.disabled = true;
          btn.innerText = 'ĐANG KHỞI TẠO HỒ SƠ...';
        }

        // Tạo bản ghi Draft đầu tiên ngay lập tức
        const timeSpent = Math.floor((Date.now() - this.app.state.startTime) / 1000);
        const da = { 
          ...this.app.state.deepTracker, 
          highlighted: Array.from(this.app.state.deepTracker.highlighted), 
          activeTime: Math.floor(this.app.state.deepTracker.activeTime / 1000) 
        };

        const formData = new FormData();
        formData.append('action', 'hieucon_dh_submit_checklist');
        formData.append('user_code', this.app.state.userCode);
        formData.append('child_name', this.getChildName());
        formData.append('child_age', this.getChildAge());
        formData.append('child_gender', this.getChildGender());
        formData.append('child_height', this.getChildHeight());
        formData.append('child_weight', this.getChildWeight());
        formData.append('child_diagnosis', this.getChildDiagnosis());
        formData.append('child_therapy', this.getChildTherapy());
        formData.append('child_supplement', this.getChildSupplement());
        formData.append('parent_concern', this.getParentConcern());
        formData.append('time_spent', timeSpent);
        formData.append('device_info', navigator.userAgent);
        formData.append('deep_analytics', JSON.stringify(da));

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(res => {
          console.log('Draft record initialized:', res);
          this.transitionToNextStep();
        })
        .catch(err => {
          console.error('Error creating draft:', err);
          // Vẫn cho phép tiếp tục dù gặp lỗi kết nối phụ
          this.transitionToNextStep();
        });
      },

      transitionToNextStep() {
        // Hide first container (Child Info step)
        const childInfoContainer = document.getElementById('survey-page-container');
        if (childInfoContainer) childInfoContainer.style.display = 'none';
        
        // Hide Hero Section if visible
        const hero = document.getElementById('hero-section');
        if (hero) hero.style.display = 'none';
        
        // Show second container (Survey step)
        const surveyContainer = document.getElementById('survey-active-container');
        if (surveyContainer) surveyContainer.style.display = 'grid';
        
        // Initialize the Radar Chart!
        initializeRadarChart();
        
        // Hiển thị thanh tiến trình và kích hoạt ModuleSurvey
        document.getElementById('progress-wrap').style.display = 'block';
        ModuleSurvey.start();
      }
    };

    // ==========================================
    // ── MODULE 2: TRẮC NGHIỆM HÀNH VI (ModuleSurvey) ──
    // ==========================================
    const ModuleSurvey = {
      app: null,

      init(appInstance) {
        this.app = appInstance;
      },

      start() {
        this.buildChecklist();
        this.buildProgressSteps();
        this.showGroup(0);

        if (typeof fbq !== 'undefined') {
          fbq('track', 'ViewContent', { content_name: 'Start DH Checklist', content_category: 'Checklist' });
        }

        this.app.state.deepTracker.drop_point = `Nhóm 1 / ${GROUPS.length}: ${GROUPS[0].name}`;
        this.app.pingServerDropOff();

        // Show mobile Radar FAB!
        const fab = document.getElementById('mobile-radar-fab');
        if (fab) fab.style.display = 'flex';
        
        // Show completion section
        const completionSec = document.getElementById('survey-completion-section');
        if (completionSec) completionSec.style.display = 'block';
      },

      buildProgressSteps() {
        const wrap = document.getElementById('progress-steps');
        if (!wrap) return;
        wrap.innerHTML = GROUPS.map((g, i) =>
          `<span class="progress-step" id="pstep-${i}" onclick="ModuleSurvey.jumpToGroup(${i})">${g.icon} ${g.name}</span>`
        ).join('');
      },

      buildChecklist() {
        const container = document.getElementById('checklist-container');
        if (!container) return;
        container.innerHTML = '';
        GROUPS.forEach((group, gi) => {
          if (!this.app.state.answers[group.id]) {
            this.app.state.answers[group.id] = Array(group.items.length).fill(false);
          }
          
          const sec = document.createElement('div');
          sec.className = 'checklist-section';
          sec.id = `group-${gi}`;
          sec.innerHTML = `
            <div class="section-header" onclick="ModuleSurvey.toggleGroupCollapse(${gi})" style="display:flex; align-items:center; justify-content:space-between; width:100%; gap: 16px; margin-bottom: 20px; cursor:pointer; user-select:none;">
              <div style="display:flex; align-items:center; gap: 12px;">
                <div class="section-icon">${group.icon}</div>
                <div>
                  <div class="section-title">${group.name}</div>
                  <div class="section-subtitle">${group.desc}</div>
                </div>
              </div>
              <button type="button" class="accordion-toggle-btn" style="background:none; border:none; color:currentColor; cursor:pointer; padding:4px; display:flex; align-items:center; justify-content:center;">
                <svg class="accordion-arrow" style="width:20px; height:20px; transition: transform 0.3s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
              </button>
            </div>
            <div class="group-score" style="display: none;">
              <span class="group-score-label">Điểm số:</span>
              <span class="group-score-value" id="gscore-${gi}">0 / 15 điểm</span>
              <div class="group-score-bar"><div class="group-score-fill" id="gbar-${gi}"></div></div>
            </div>
            <div class="checklist-items flex flex-col gap-3">
              ${group.items.map((item, ii) => `
                <div class="check-item-row flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 border border-solid border-[#e2e8f0] rounded-xl bg-[#faf9f6] hover:border-navy/40 transition-colors" id="ci-row-${gi}-${ii}">
                  <div class="check-text flex-1">
                    <div class="check-main" style="line-height: 1.5; font-weight: 500; font-size: 14px; color: var(--charcoal); position: relative;">
                      <span>${item.main}</span>
                      <span class="info-tooltip-wrapper inline-flex items-center ml-1.5" onclick="toggleTooltip(this, event)">
                        <span class="info-tooltip-trigger" style="margin: 0 0 0 4px; width: 15px; height: 15px; font-size: 9px; line-height: 15px;">i</span>
                        <span class="info-tooltip-content">Ví dụ: ${item.example}<span style="display:block; text-align:right; font-size:10px; opacity:0.7; margin-top:6px; font-weight:normal;">✕ Chạm để đóng</span></span>
                      </span>
                    </div>
                  </div>
                  <div class="check-options flex gap-3 shrink-0 w-full sm:w-auto">
                    <label class="check-opt-label flex items-center justify-center gap-2 cursor-pointer select-none py-2.5 px-4 border border-solid border-[#cbd5e1] rounded-xl bg-white transition-all text-sm font-bold text-[#334155]" id="label-yes-${gi}-${ii}" style="flex: 1; min-width: 80px; text-align: center;">
                      <input type="checkbox" id="opt-yes-${gi}-${ii}" onchange="ModuleSurvey.toggleItemOption(${gi},${ii},'yes',this)" style="display:none;">
                      <span>Có</span>
                    </label>
                    <label class="check-opt-label flex items-center justify-center gap-2 cursor-pointer select-none py-2.5 px-4 border border-solid border-[#cbd5e1] rounded-xl bg-white transition-all text-sm font-bold text-[#334155]" id="label-no-${gi}-${ii}" style="flex: 1; min-width: 80px; text-align: center;">
                      <input type="checkbox" id="opt-no-${gi}-${ii}" onchange="ModuleSurvey.toggleItemOption(${gi},${ii},'no',this)" style="display:none;">
                      <span>Không</span>
                    </label>
                  </div>
                </div>
              `).join('')}
            </div>
          `;
          container.appendChild(sec);
        });
      },

      toggleItemOption(gi, ii, option, cb) {
        if (option === 'yes') {
          if (cb.checked) {
            const noInput = document.getElementById(`opt-no-${gi}-${ii}`);
            if (noInput) {
              noInput.checked = false;
              noInput.closest('.check-opt-label').classList.remove('checked');
            }
            this.app.state.answers[GROUPS[gi].id][ii] = true;
            cb.closest('.check-opt-label').classList.add('checked');
          } else {
            this.app.state.answers[GROUPS[gi].id][ii] = false;
            cb.closest('.check-opt-label').classList.remove('checked');
          }
        } else {
          if (cb.checked) {
            const yesInput = document.getElementById(`opt-yes-${gi}-${ii}`);
            if (yesInput) {
              yesInput.checked = false;
              yesInput.closest('.check-opt-label').classList.remove('checked');
            }
            this.app.state.answers[GROUPS[gi].id][ii] = false;
            cb.closest('.check-opt-label').classList.add('checked');
          } else {
            cb.closest('.check-opt-label').classList.remove('checked');
          }
        }

        const groupName = GROUPS[gi].name;
        const itemName = GROUPS[gi].items[ii].main;
        
        if (!this.app.state.currentGroupFirstClickRecorded) {
            const thinkSeconds = Math.floor((Date.now() - this.app.state.currentGroupStartTime) / 1000);
            this.app.state.deepTracker.thinkTimes[groupName] = thinkSeconds;
            this.app.state.currentGroupFirstClickRecorded = true;
        }
        
        const itemKey = groupName + ' - ' + itemName;
        this.app.state.deepTracker.toggles[itemKey] = (this.app.state.deepTracker.toggles[itemKey] || 0) + 1;

        this.updateGroupScore(gi);
        this.checkGroupCompletion(gi);
      },

      updateGroupScore(gi) {
        const group = GROUPS[gi];
        let score = 0;
        this.app.state.answers[group.id].forEach((ticked, index) => {
          if (ticked) {
            score += (index + 1);
          }
        });
        document.getElementById(`gscore-${gi}`).textContent = `${score} / 15 điểm`;
        document.getElementById(`gbar-${gi}`).style.width = `${(score / 15) * 100}%`;
        
        // Cập nhật biểu đồ Radar bên cột phải
        updateRadarChartData();
      },

      showGroup(gi) {
        if (this.app.state.currentGroup !== undefined) {
          const prev = document.getElementById(`group-${this.app.state.currentGroup}`);
          if (prev) { 
            prev.classList.remove('active'); 
            this.app.state.completedGroups.add(this.app.state.currentGroup); 
          }
        }
        this.app.state.currentGroup = gi;
        this.app.state.currentGroupStartTime = Date.now();
        this.app.state.currentGroupFirstClickRecorded = false;
        document.querySelectorAll('.checklist-section').forEach(s => s.classList.remove('active'));
        
        const targetGroup = document.getElementById(`group-${gi}`);
        if (targetGroup) {
          targetGroup.classList.add('active');
        }
        
        if (gi > 0 && gi < GROUPS.length) {
            this.app.state.deepTracker.drop_point = `Nhóm ${gi + 1} / ${GROUPS.length}: ${GROUPS[gi].name}`;
            this.app.pingServerDropOff();
        }

        this.updateProgress();
        const progressWrap = document.getElementById('progress-wrap');
        if (progressWrap) {
          window.scrollTo({ top: progressWrap.offsetTop - 20, behavior: 'smooth' });
        }
      },

      jumpToGroup(gi) {
        const el = document.getElementById(`group-${gi}`);
        if (el) {
          window.scrollTo({ top: el.offsetTop - 80, behavior: 'smooth' });
        }
      },

      isGroupCompleted(gi) {
        const itemsCount = GROUPS[gi].items.length;
        for (let ii = 0; ii < itemsCount; ii++) {
          const yesChecked = document.getElementById(`opt-yes-${gi}-${ii}`)?.checked;
          const noChecked = document.getElementById(`opt-no-${gi}-${ii}`)?.checked;
          if (!yesChecked && !noChecked) {
            return false;
          }
        }
        return true;
      },

      checkGroupCompletion(gi) {
        const section = document.getElementById(`group-${gi}`);
        if (!section) return;
        
        const isCompleted = this.isGroupCompleted(gi);
        if (isCompleted) {
          section.classList.add('completed-group');
          this.app.state.completedGroups.add(gi);
        } else {
          section.classList.remove('completed-group');
          this.app.state.completedGroups.delete(gi);
        }
        this.updateProgress();
      },

      expandGroup(gi, event) {
        if (event) {
          event.stopPropagation();
          event.preventDefault();
        }
        const section = document.getElementById(`group-${gi}`);
        if (section) {
          section.classList.remove('completed-group');
        }
      },

      toggleGroupCollapse(gi) {
        const section = document.getElementById(`group-${gi}`);
        if (!section) return;
        
        if (section.classList.contains('completed-group')) {
          section.classList.remove('completed-group');
        } else {
          const isCompleted = this.isGroupCompleted(gi);
          if (isCompleted) {
            section.classList.add('completed-group');
          }
        }
      },

      updateProgress() {
        const done = this.app.state.completedGroups.size;
        const total = GROUPS.length;
        const fillEl = document.getElementById('progress-fill');
        const countEl = document.getElementById('progress-count');
        
        if (fillEl) fillEl.style.width = `${(done / total) * 100}%`;
        if (countEl) countEl.textContent = `${done} / ${total} nhóm`;
        
        GROUPS.forEach((_, i) => {
          const el = document.getElementById(`pstep-${i}`);
          if (el) {
            el.classList.remove('active', 'done');
            if (i === this.app.state.currentGroup) el.classList.add('active');
            else if (this.app.state.completedGroups.has(i)) el.classList.add('done');
          }
        });
      },

      calculateScores() {
        return GROUPS.map(g => {
          let score = 0;
          this.app.state.answers[g.id].forEach((ticked, index) => {
            if (ticked) {
              score += (index + 1);
            }
          });
          const ticked = score;
          const total = 15;
          const pct = Math.round((ticked / total) * 100);
          const tickedItems = g.items.filter((_, i) => this.app.state.answers[g.id][i]).map(x => x.main);
          return { id: g.id, name: g.name, icon: g.icon, ticked, total, pct, tickedItems };
        }).sort((a, b) => b.pct - a.pct);
      },

      completeSurvey() {
        // Auto-fill unanswered questions with "No" (Không)
        GROUPS.forEach((group, gi) => {
          group.items.forEach((item, ii) => {
            const yesChecked = document.getElementById(`opt-yes-${gi}-${ii}`)?.checked;
            const noChecked = document.getElementById(`opt-no-${gi}-${ii}`)?.checked;
            if (!yesChecked && !noChecked) {
              const noInput = document.getElementById(`opt-no-${gi}-${ii}`);
              if (noInput) {
                noInput.checked = true;
                noInput.closest('.check-opt-label').classList.add('checked');
                this.app.state.answers[group.id][ii] = false;
              }
            }
          });
          this.updateGroupScore(gi);
          this.checkGroupCompletion(gi);
        });

        // Recalculate and update Radar Chart to ensure it has all values!
        if (window.myRadarChart) {
          const newData = GROUPS.map(group => {
            const answers = this.app.state.answers[group.id];
            if (!answers) return 0;
            let score = 0;
            answers.forEach((ticked, index) => {
              if (ticked) score += (index + 1);
            });
            return Math.round((score / 15) * 100);
          });
          window.myRadarChart.data.datasets[0].data = newData;
          window.myRadarChart.update();
        }

        this.app.state.completedGroups.add(this.app.state.currentGroup);
        
        // Ẩn phần trắc nghiệm
        document.getElementById('checklist-container').style.display = 'none';
        document.getElementById('progress-wrap').style.display = 'none';
        
        const completionSec = document.getElementById('survey-completion-section');
        if (completionSec) completionSec.style.display = 'none';
        
        // Chuyển tiếp điều khiển sang ModuleParentInfo
        ModuleParentInfo.show();
      }
    };

    // ==========================================
    // ── MODULE 3: THÔNG TIN PHỤ HUYNH (ModuleParentInfo) ──
    // ==========================================
    const ModuleParentInfo = {
      app: null,

      init(appInstance) {
        this.app = appInstance;
      },

      getParentName() { return document.getElementById('parent-name') ? document.getElementById('parent-name').value.trim() : ''; },
      getParentPhone() { return document.getElementById('parent-phone') ? document.getElementById('parent-phone').value.trim() : ''; },
      getParentEmail() { return document.getElementById('parent-email') ? document.getElementById('parent-email').value.trim() : ''; },

      show() {
        const parentSec = document.getElementById('parent-info-section');
        if (parentSec) {
          parentSec.style.display = 'block';
          window.scrollTo({ top: parentSec.offsetTop - 20, behavior: 'smooth' });
        }
        
        // Hide mobile Radar FAB!
        const fab = document.getElementById('mobile-radar-fab');
        if (fab) fab.style.display = 'none';
        
        this.app.state.deepTracker.drop_point = 'Đang điền thông tin phụ huynh';
        this.app.pingServerDropOff();
      },

      validate() {
        const name = this.getParentName();
        const phone = this.getParentPhone();
        const email = this.getParentEmail();
        
        if (!name || !phone || !email) {
          alert('Cha mẹ vui lòng điền đầy đủ các thông tin liên hệ để nhận kết quả.');
          return false;
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          alert('Địa chỉ email không hợp lệ. Vui lòng kiểm tra lại.');
          return false;
        }
        return true;
      },

      submit() {
        if (!this.validate()) return;
        
        const btn = document.getElementById('btn-final-submit');
        if (btn) {
          btn.disabled = true;
          btn.innerText = 'ĐANG GỬI KẾT QUẢ...';
        }
        
        const scores = ModuleSurvey.calculateScores();
        const childName = ModuleChildInfo.getChildName();
        const name = this.getParentName();
        const phone = this.getParentPhone();
        const email = this.getParentEmail();
        const age = ModuleChildInfo.getChildAge();
        const diagnosis = ModuleChildInfo.getChildDiagnosis();
        const therapy = ModuleChildInfo.getChildTherapy();
        const supplement = ModuleChildInfo.getChildSupplement();
        const concern = ModuleChildInfo.getParentConcern();
        const extraSymptomsEl = document.getElementById('extra-symptoms');
        const extra = extraSymptomsEl ? extraSymptomsEl.value.trim() : '';
        const gender = ModuleChildInfo.getChildGender();

        const behaviorsByGroup = {};
        scores.forEach(s => {
            if (s.tickedItems && s.tickedItems.length > 0) {
                behaviorsByGroup[s.id] = s.tickedItems;
            }
        });

        const timeSpent = Math.floor((Date.now() - this.app.state.startTime) / 1000);
        const deviceInfo = navigator.userAgent;

        const formData = new FormData();
        formData.append('action', 'hieucon_dh_submit_checklist');
        formData.append('user_code', this.app.state.userCode);
        formData.append('child_name', childName);
        formData.append('parent_name', name);
        formData.append('parent_phone', phone);
        formData.append('parent_email', email);
        formData.append('child_age', age);
        formData.append('child_diagnosis', diagnosis);
        formData.append('child_gender', gender);
        formData.append('child_height', ModuleChildInfo.getChildHeight());
        formData.append('child_weight', ModuleChildInfo.getChildWeight());
        formData.append('child_therapy', therapy);
        formData.append('child_supplement', supplement);
        formData.append('parent_concern', concern);
        formData.append('extra_symptoms', extra);
        formData.append('scores_json', JSON.stringify(scores));
        formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
        
        this.app.state.deepTracker.drop_point = 'Hoàn thành 100%';
        this.app.state.deepTracker.activeTime += (Date.now() - this.app.state.deepTracker.lastFocus);
        this.app.state.deepTracker.lastFocus = Date.now();
        const da = { 
          ...this.app.state.deepTracker, 
          highlighted: Array.from(this.app.state.deepTracker.highlighted), 
          activeTime: Math.floor(this.app.state.deepTracker.activeTime / 1000) 
        };

        formData.append('time_spent', timeSpent);
        formData.append('device_info', deviceInfo);
        formData.append('deep_analytics', JSON.stringify(da));

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            console.log('Saved checklist:', res);
            if (typeof fbq !== 'undefined') {
              fbq('track', 'Lead', { content_name: 'Complete DH Checklist' });
            }
            this.transitionToNextStep(email);
        })
        .catch(err => {
            console.error(err);
            this.transitionToNextStep(email);
        });
      },

      transitionToNextStep(email) {
        document.getElementById('parent-info-section').style.display = 'none';
        ModuleSuccess.show(email);
      }
    };

    // ==========================================
    // ── MODULE 4: HIỂN THỊ THÀNH CÔNG (ModuleSuccess) ──
    // ==========================================
    const ModuleSuccess = {
      app: null,

      init(appInstance) {
        this.app = appInstance;
      },

      show(email) {
        const emailDisp = document.getElementById('sent-email-display');
        if (emailDisp) {
          emailDisp.textContent = email;
        }
        
        const thankSec = document.getElementById('thankyou-section');
        if (thankSec) {
          thankSec.style.display = 'block';
          window.scrollTo({ top: thankSec.offsetTop - 20, behavior: 'smooth' });
        }
      }
    };

    // ==========================================
    // ── PHƯƠNG THỨC LIÊN KẾT GIAO DIỆN (Nút Bấm) ──
    // ==========================================
    function goToIntro() {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('start', '1');
      window.location.href = window.location.pathname + '?' + urlParams.toString();
    }

    function startChecklist() {
      ModuleChildInfo.submit();
    }

    function submitParentInfo() {
      ModuleParentInfo.submit();
    }

    function submitCTA() {
      const phone = document.getElementById('cta-phone').value.trim();
      if (!phone) { alert('Vui lòng nhập số điện thoại để đặt lịch.'); return; }
      alert(`Cảm ơn cha mẹ! Chuyên gia sẽ liên hệ qua số ${phone} trong vòng 24 giờ để tư vấn. Mã hồ sơ của con là: ${ChecklistApp.state.userCode}`);
      
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Contact');
      }
    }

    // Mobile Radar Modal Toggle helper
    function toggleMobileRadar(show) {
      const sidebar = document.getElementById('survey-sidebar');
      const closeBtn = document.getElementById('close-radar-btn');
      if (sidebar) {
        if (show) {
          sidebar.classList.add('show-mobile-overlay');
          if (closeBtn) closeBtn.style.display = 'block';
        } else {
          sidebar.classList.remove('show-mobile-overlay');
          if (closeBtn) closeBtn.style.display = 'none';
        }
      }
    }

    // Toggle tooltips on click (mobile focus)
    function toggleTooltip(wrapperElement, event) {
      if (event) {
        event.stopPropagation();
        event.preventDefault();
      }
      const isActive = wrapperElement.classList.contains('active');
      
      // Close all open tooltips
      const allActive = document.querySelectorAll('.info-tooltip-wrapper.active');
      allActive.forEach(el => el.classList.remove('active'));
      
      // Toggle current one
      if (!isActive) {
        wrapperElement.classList.add('active');
      }
    }

    // Close tooltips when clicking outside
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.info-tooltip-wrapper')) {
        const allActive = document.querySelectorAll('.info-tooltip-wrapper.active');
        allActive.forEach(el => el.classList.remove('active'));
      }
    });

    // ==========================================
    // ── BIỂU ĐỒ RADAR CHỈ SỐ Y SINH ──
    // ==========================================
    window.myRadarChart = null;

    function initializeRadarChart() {
      const ctx = document.getElementById('radarChartCanvas');
      if (!ctx || window.myRadarChart) return;
      
      const labels = ['TH', 'AU', 'GN', 'GQ', 'TD', 'CX', 'MD', 'VD'];
      const initialData = GROUPS.map(group => {
        const answers = ChecklistApp.state.answers[group.id];
        if (!answers) return 0;
        let score = 0;
        answers.forEach((ticked, index) => {
          if (ticked) score += (index + 1);
        });
        return Math.round((score / 15) * 100);
      });
      
      window.myRadarChart = new Chart(ctx, {
        type: 'radar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Tỷ lệ biểu hiện (%)',
            data: initialData,
            backgroundColor: 'rgba(255, 209, 84, 0.25)', // light yellow
            borderColor: '#FFD154', // theme yellow
            borderWidth: 2,
            pointBackgroundColor: '#002795', // theme navy
            pointBorderColor: '#FFD154',
            pointRadius: 4,
            pointHoverRadius: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: {
            padding: 0
          },
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              animation: false,
              callbacks: {
                title: function(context) {
                  if (!context || !context.length || !context[0]) return '';
                  const index = context[0].dataIndex;
                  const fullNames = [
                    'Rối loạn tiêu hóa',
                    'Rối loạn ăn uống',
                    'Rối loạn giấc ngủ',
                    'Xử lý giác quan',
                    'Tăng động - Giảm chú ý',
                    'Cảm xúc - Hành vi',
                    'Miễn dịch - Dị ứng',
                    'Chức năng vận động'
                  ];
                  return fullNames[index] || '';
                },
                label: function(context) {
                  if (!context || context.raw === undefined) return '';
                  return 'Tỷ lệ biểu hiện: ' + context.raw + '%';
                }
              }
            }
          },
          scales: {
            r: {
              angleLines: {
                color: 'rgba(255, 255, 255, 0.15)'
              },
              grid: {
                color: 'rgba(255, 255, 255, 0.12)'
              },
              pointLabels: {
                display: true,
                color: 'rgba(255, 255, 255, 0.85)',
                font: {
                  family: 'Quicksand, sans-serif',
                  size: 10,
                  weight: '700'
                }
              },
              ticks: {
                display: false,
                stepSize: 20
              },
              suggestedMin: 0,
              suggestedMax: 100
            }
          }
        }
      });

    }

    function updateRadarChartData() {
      if (!window.myRadarChart) return;
      
      const percentages = GROUPS.map(group => {
        const answers = ChecklistApp.state.answers[group.id];
        if (!answers) return 0;
        let score = 0;
        answers.forEach((ticked, index) => {
          if (ticked) score += (index + 1);
        });
        return Math.round((score / 15) * 100);
      });
      
      window.myRadarChart.data.datasets[0].data = percentages;
      window.myRadarChart.update();
    }

    // ==========================================
    // ── DEBUG CONTROLLER (ModuleDebug) ──
    // ==========================================
    const ModuleDebug = {
      activeScreen: 'survey',

      init() {
        const debugHtml = `
          <div id="debug-floating-panel" style="position: fixed; bottom: 20px; right: 20px; z-index: 999999; width: 320px; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.4); padding: 16px; font-family: system-ui, -apple-system, sans-serif; color: #f1f5f9; font-size: 13px; transition: all 0.3s ease;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 8px; margin-bottom: 12px;">
              <strong style="color: #fbbf24; font-size: 14px; display: flex; align-items: center; gap: 6px;">🛠️ DEBUG PANEL</strong>
              <button onclick="ModuleDebug.toggleMinimize()" style="background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 16px;">➖</button>
            </div>
            <div id="debug-panel-content">
              <div style="margin-bottom: 12px;">
                <div style="font-weight: 600; color: #38bdf8; margin-bottom: 6px;">BẬT/TẮT MÀN HÌNH:</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px;">
                  <button onclick="ModuleDebug.showScreen('hero')" class="debug-btn" id="db-btn-hero">1. Intro/Hero</button>
                  <button onclick="ModuleDebug.showScreen('info')" class="debug-btn" id="db-btn-info">2. Thông tin con</button>
                  <button onclick="ModuleDebug.showScreen('survey')" class="debug-btn" id="db-btn-survey">3. Checklist</button>
                  <button onclick="ModuleDebug.showScreen('parent')" class="debug-btn" id="db-btn-parent">4. Nhận kết quả</button>
                </div>
              </div>
              <div style="margin-bottom: 12px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <div style="font-weight: 600; color: #34d399; margin-bottom: 6px;">TIỆN ÍCH NHANH:</div>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                  <button onclick="ModuleDebug.autoFillForms()" style="background: #059669; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">⚡ Điền nhanh thông tin</button>
                  <button onclick="ModuleDebug.autoCheckRandom()" style="background: #2563eb; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">🎲 Chọn ngẫu nhiên Checklist</button>
                </div>
              </div>
              <div style="margin-bottom: 12px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <div style="font-weight: 600; color: #fb7185; margin-bottom: 6px;">XEM TRƯỚC MẪU (SLUG & MAIL):</div>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                  <button onclick="ModuleDebug.debugViewResult()" style="background: #e11d48; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">🌐 Xem trang kết quả mẫu</button>
                  <button onclick="ModuleDebug.previewEmailHtml()" style="background: #7c3aed; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">📧 Xem trước HTML Email</button>
                </div>
              </div>
              <div style="font-size: 11px; color: #64748b; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 8px;">
                Nhấp chuột vào các nút để kiểm tra nhanh luồng chạy.
              </div>
            </div>
          </div>
          <style>
            .debug-btn {
              background: rgba(255, 255, 255, 0.08);
              border: 1px solid rgba(255, 255, 255, 0.1);
              color: #cbd5e1;
              padding: 6px;
              border-radius: 6px;
              cursor: pointer;
              font-size: 11px;
              font-weight: 500;
              text-align: center;
              transition: all 0.2s;
            }
            .debug-btn:hover {
              background: rgba(255, 255, 255, 0.15);
              color: #fff;
            }
            .debug-btn.active {
              background: #e11d48 !important;
              border-color: #e11d48 !important;
              color: white !important;
              font-weight: bold;
            }
          </style>
        `;
        const div = document.createElement('div');
        div.innerHTML = debugHtml;
        document.body.appendChild(div);
        
        // Auto show checklist as initial screen
        this.showScreen('survey');
      },

      toggleMinimize() {
        const content = document.getElementById('debug-panel-content');
        const panel = document.getElementById('debug-floating-panel');
        if (content.style.display === 'none') {
          content.style.display = 'block';
          panel.style.width = '320px';
        } else {
          content.style.display = 'none';
          panel.style.width = '160px';
        }
      },

      showScreen(screenId) {
        const hero = document.getElementById('hero-section');
        const info = document.getElementById('info-section');
        const survey = document.getElementById('survey-active-container');
        const parent = document.getElementById('parent-info-section');
        const thankyou = document.getElementById('thankyou-section');
        const surveyPageContainer = document.getElementById('survey-page-container');

        if (hero) hero.style.display = 'none';
        if (info) info.style.display = 'none';
        if (survey) survey.style.display = 'none';
        if (parent) parent.style.display = 'none';
        if (thankyou) thankyou.style.display = 'none';
        if (surveyPageContainer) surveyPageContainer.style.display = 'none';

        document.querySelectorAll('.debug-btn').forEach(btn => btn.classList.remove('active'));

        if (screenId === 'hero') {
          if (hero) hero.style.display = 'block';
          const btn = document.getElementById('db-btn-hero');
          if (btn) btn.classList.add('active');
        } else if (screenId === 'info') {
          if (surveyPageContainer) surveyPageContainer.style.display = 'block';
          if (info) info.style.display = 'block';
          const btn = document.getElementById('db-btn-info');
          if (btn) btn.classList.add('active');
        } else if (screenId === 'survey') {
          if (survey) survey.style.display = 'grid';
          const checklistContainer = document.getElementById('checklist-container');
          if (checklistContainer) checklistContainer.style.display = 'block';
          const btn = document.getElementById('db-btn-survey');
          if (btn) btn.classList.add('active');
          if (ModuleSurvey && typeof ModuleSurvey.start === 'function') {
            ModuleSurvey.start();
          }
          if (typeof initializeRadarChart === 'function') {
            initializeRadarChart();
          }
          if (typeof updateRadarChartData === 'function') {
            updateRadarChartData();
          }
        } else if (screenId === 'parent') {
          if (survey) survey.style.display = 'block';
          if (parent) parent.style.display = 'block';
          const checklistContainer = document.getElementById('checklist-container');
          if (checklistContainer) checklistContainer.style.display = 'none';
          const btn = document.getElementById('db-btn-parent');
          if (btn) btn.classList.add('active');
        }
      },

      autoFillForms() {
        const fields = {
          'child-name': 'Nguyễn Khánh An',
          'child-age': '5',
          'child-height': '110',
          'child-weight': '18',
          'child-therapy': 'Can thiệp ngôn ngữ tuần 3 buổi',
          'child-supplement': 'DHA, Kẽm, Vitamin D3 K2',
          'parent-concern': 'Con chậm nói, giao tiếp mắt kém, thỉnh thoảng nhón gót',
          'parent-name': 'Nguyễn Văn Minh',
          'parent-phone': '0987654321',
          'parent-email': 'parent.test@gmail.com'
        };

        for (const [id, val] of Object.entries(fields)) {
          const el = document.getElementById(id);
          if (el) {
            el.value = val;
            el.dispatchEvent(new Event('change'));
            el.dispatchEvent(new Event('input'));
          }
        }
        
        const genderMale = document.getElementById('gender-male') || document.querySelector('input[value="Nam"]');
        if (genderMale) {
          genderMale.checked = true;
          genderMale.dispatchEvent(new Event('change'));
        }

        const diagnosisCheckboxes = document.querySelectorAll('#info-section input[type="checkbox"]');
        if (diagnosisCheckboxes.length > 0) {
          diagnosisCheckboxes[0].checked = true;
          diagnosisCheckboxes[0].dispatchEvent(new Event('change'));
        }

        alert('Đã điền tự động toàn bộ biểu mẫu thông tin thành công!');
      },

      autoCheckRandom() {
        if (!ModuleSurvey || !ModuleSurvey.app) return;

        GROUPS.forEach((group, gi) => {
          group.items.forEach((_, ii) => {
            const isYes = Math.random() > 0.4;
            const option = isYes ? 'yes' : 'no';
            const checkbox = document.getElementById(`opt-${option}-${gi}-${ii}`);
            if (checkbox) {
              checkbox.checked = true;
              ModuleSurvey.toggleItemOption(gi, ii, option, checkbox);
            }
          });
        });
        
        alert('Đã tích chọn ngẫu nhiên toàn bộ 40 câu hỏi checklist thành công!');
      },

      debugViewResult() {
        if (!ModuleChildInfo.getChildName()) {
          this.autoFillForms();
        }
        const scores = ModuleSurvey.calculateScores();
        const hasTicked = scores.some(s => s.ticked > 0);
        if (!hasTicked) {
          this.autoCheckRandom();
        }

        const childName = ModuleChildInfo.getChildName();
        const name = ModuleParentInfo.getParentName() || 'Phụ huynh Test';
        const phone = ModuleParentInfo.getParentPhone() || '0987654321';
        const email = ModuleParentInfo.getParentEmail() || 'test@gmail.com';
        const age = ModuleChildInfo.getChildAge();
        const diagnosis = ModuleChildInfo.getChildDiagnosis();
        const therapy = ModuleChildInfo.getChildTherapy();
        const supplement = ModuleChildInfo.getChildSupplement();
        const concern = ModuleChildInfo.getParentConcern();
        const gender = ModuleChildInfo.getChildGender();
        const height = ModuleChildInfo.getChildHeight();
        const weight = ModuleChildInfo.getChildWeight();

        const latestScores = ModuleSurvey.calculateScores();
        const behaviorsByGroup = {};
        latestScores.forEach(s => {
            if (s.tickedItems && s.tickedItems.length > 0) {
                behaviorsByGroup[s.id] = s.tickedItems;
            }
        });

        const formData = new FormData();
        formData.append('action', 'hieucon_dh_submit_checklist');
        formData.append('user_code', ChecklistApp.state.userCode || Math.floor(10000000 + Math.random() * 90000000).toString());
        formData.append('child_name', childName);
        formData.append('parent_name', name);
        formData.append('parent_phone', phone);
        formData.append('parent_email', email);
        formData.append('child_age', age);
        formData.append('child_diagnosis', diagnosis);
        formData.append('child_gender', gender);
        formData.append('child_height', height);
        formData.append('child_weight', weight);
        formData.append('child_therapy', therapy);
        formData.append('child_supplement', supplement);
        formData.append('parent_concern', concern);
        formData.append('scores_json', JSON.stringify(latestScores));
        formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
        formData.append('time_spent', 120);
        formData.append('device_info', navigator.userAgent);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            const code = (res && res.data && res.data.user_code) ? res.data.user_code : ChecklistApp.state.userCode;
            window.open(`<?php echo site_url('/ket-qua-dh?code='); ?>` + code, '_blank');
        })
        .catch(err => {
            window.open(`<?php echo site_url('/ket-qua-dh?code='); ?>` + ChecklistApp.state.userCode, '_blank');
        });
      },

      previewEmailHtml() {
        const scores = ModuleSurvey.calculateScores();
        let topIssuesHtml = '';
        let count = 0;
        scores.forEach(s => {
          if (count >= 3) return;
          if (s.pct > 0) {
            topIssuesHtml += `
              <li style="margin-bottom: 12px; font-size: 15px; line-height: 1.6;">
                <strong style="color: #be123c;">🚨 \${s.name}:</strong> 
                Ghi nhận <strong>\${s.ticked}/\${s.total}</strong> dấu hiệu (\${s.pct}%)
              </li>`;
            count++;
          }
        });
        if (!topIssuesHtml) {
          topIssuesHtml = '<li style="font-size: 15px; color: #475569; font-style: italic;">Chưa ghi nhận dấu hiệu bất thường nổi bật nào.</li>';
        }

        const userCode = ChecklistApp.state.userCode || '12345678';
        const resultUrl = `${window.location.origin}/ket-qua-dh?code=\${userCode}`;
        const parentName = ModuleParentInfo.getParentName() || 'Nguyễn Văn A';
        const childName = ModuleChildInfo.getChildName() || 'Bé An';
        const childAge = ModuleChildInfo.getChildAge() || '5 tuổi';
        const childGender = ModuleChildInfo.getChildGender() || 'Bé trai';

        const emailHtml = `
          <!DOCTYPE html>
          <html>
          <body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: system-ui, -apple-system, sans-serif;">
            <div style="max-width: 600px; margin: 0 auto 10px; background: #0f172a; padding: 12px; border-radius: 8px; text-align: center; font-weight: bold; color: #fbbf24; font-family: sans-serif; font-size: 13px; border: 1px solid rgba(255,255,255,0.15);">
              📧 ĐANG XEM TRƯỚC GIAO DIỆN EMAIL GỬI KHÁCH HÀNG (MOCKUP)
            </div>
            
            <div class="wrapper" style="width: 100%; background-color: #EBF1FA; padding: 24px 10px; box-sizing: border-box;">
                <table role="presentation" width="100%" style="border-spacing: 0; border-collapse: collapse;">
                    <tr>
                        <td align="center">
                            <div class="main-container" style="background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 580px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(13, 42, 120, 0.08); border: 1px solid #D6E2F5; text-align: left; font-family: sans-serif;">
                                
                                <!-- Header Banner -->
                                <div class="header" style="background: linear-gradient(150deg, #0A2268 0%, #0D2A78 50%, #163CA3 100%); padding: 24px 24px 20px 24px; text-align: center; color: #ffffff;">
                                    <div class="badge-pill" style="display: inline-block; background: rgba(255, 255, 255, 0.15); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #F3BA2F; border: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 10px;">🟡 HIỂU CON TỪ GỐC</div>
                                    <h1 style="margin: 0; font-size: 20px; line-height: 1.35; font-weight: 800; color: #FFFFFF; letter-spacing: 0.5px; text-transform: uppercase;">
                                        CÔNG CỤ ĐÁNH GIÁ
                                        <span class="highlight" style="color: #F3BA2F; display: block;">SỨC KHỎE TOÀN DIỆN</span>
                                    </h1>
                                </div>

                                <!-- Main Content Body -->
                                <div class="content" style="padding: 24px 24px 20px 24px;">
                                    <!-- Code Badge & Greeting -->
                                    <div style="margin-bottom: 14px;">
                                        <span class="profile-badge" style="display: inline-block; background-color: #F0F5FF; border: 1px solid #C7DCFE; color: #163CA3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">Mã hồ sơ: \${userCode}</span>
                                    </div>
                                    <div class="greeting" style="font-size: 15px; line-height: 1.4; color: #0D2A78; font-weight: 700; margin-bottom: 10px;">Xin chào \${parentName},</div>
                                    
                                    <!-- Streamlined Result Link Section -->
                                    <div class="result-compact-box" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px 16px; margin: 16px 0 20px 0; text-align: center;">
                                        <div class="result-compact-text" style="font-size: 13px; line-height: 1.5; color: #334155; margin-bottom: 12px;">
                                            Kết quả đánh giá của bé đã hoàn tất. Ba mẹ có thể xem chi tiết trực tiếp tại đường link: <br>
                                            <a href="\${resultUrl}" target="_blank" style="color: #0284C7; font-weight: 600; word-break: break-all; text-decoration: underline;">\${resultUrl}</a>
                                        </div>
                                        <a href="\${resultUrl}" class="btn-view-report" target="_blank" style="background-color: #0D2A78; color: #ffffff !important; padding: 12px 24px; text-decoration: none; font-size: 14px; font-weight: 700; border-radius: 8px; display: inline-block; box-shadow: 0 3px 10px rgba(13, 42, 120, 0.2); transition: background-color 0.2s ease;">
                                            Kết quả: \${userCode}
                                        </a>
                                    </div>

                                    <!-- Disclaimer Box -->
                                    <div class="disclaimer-box" style="background-color: #FAF5FF; border: 1px solid #E9D5FF; border-radius: 8px; padding: 12px 14px; margin-top: 20px; font-size: 11px; color: #6B21A8; line-height: 1.5;">
                                        <strong style="color: #581C87;">⚠️ Lưu ý:</strong> Kết quả từ bộ công cụ mang tính chất tổng hợp thông tin quan sát nhằm hỗ trợ ba mẹ định hướng theo dõi. Đây không phải là kết luận hay chẩn đoán y khoa chính thức.
                                    </div>

                                </div>

                                <!-- Refined Minimalist Footer with Subtle Nav -->
                                <div class="footer" style="background-color: #0F172A; color: #94A3B8; padding: 22px 20px; text-align: center; font-size: 12px; line-height: 1.5;">
                                    <!-- Subtle Footer Navigation -->
                                    <div class="footer-nav" style="border-bottom: none; padding-bottom: 6px; margin-bottom: 10px;">
                                        <a href="https://zalo.me/0988717107" class="footer-link-btn footer-btn-tuvan" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(255, 107, 0, 0.15); color: #FF9E59 !important; border: 1px solid rgba(255, 107, 0, 0.3);">
                                            Tư vấn
                                        </a>
                                        <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" class="footer-link-btn footer-btn-hoidap" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(56, 189, 248, 0.12); color: #38BDF8 !important; border: 1px solid rgba(56, 189, 248, 0.25);">
                                            Hỏi đáp
                                        </a>
                                        <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" class="footer-link-btn footer-btn-congdong" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(241, 245, 249, 0.1); color: #E2E8F0 !important; border: 1px solid rgba(241, 245, 249, 0.2);">
                                            Cộng đồng
                                        </a>
                                    </div>

                                    <div style="font-size: 11px; color: #94A3B8;">
                                        © 2026 Hiểu Con Từ Gốc | <a href="https://hieucontugoc.online" class="site-link" target="_blank" style="color: #F3BA2F; text-decoration: none; font-weight: 700;">hieucontugoc.online</a>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
          </body>
          </html>`;
        
        const win = window.open("", "_blank");
        win.document.write(emailHtml);
        win.document.close();
      }
    };

    // ==========================================
    // ── DOM READY INITIALIZATION ──
    // ==========================================
    document.addEventListener('DOMContentLoaded', () => {
      ChecklistApp.init();
      // ModuleDebug.init();
    });
  </script>
</div>
<?php get_footer(); ?>
