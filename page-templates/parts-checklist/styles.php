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

    #survey-sidebar.show-mobile-overlay>div {
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
      display: flex !important;
      flex-direction: column !important;
      background: var(--white) !important;
      padding: 16px 14px !important;
      gap: 14px !important;
      border-radius: 12px !important;
      border: 1px solid #e2e8f0 !important;
      box-sizing: border-box !important;
      width: 100% !important;
    }

    .check-main {
      font-size: 14px !important;
      font-weight: 600 !important;
      line-height: 1.45 !important;
    }

    .check-options {
      display: flex !important;
      gap: 10px !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    .check-opt-label {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 10px 12px !important;
      font-size: 13px !important;
      font-weight: 700 !important;
      border: 1.5px solid #cbd5e1 !important;
      border-radius: 10px !important;
      background: #ffffff !important;
      color: #334155 !important;
      cursor: pointer !important;
      flex: 1 !important;
      min-width: 80px !important;
      text-align: center !important;
      box-sizing: border-box !important;
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
    display: none;
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
    bottom: 130%;
    /* Trực quan hóa nằm trên nút i */
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

  /* ── QUIZ PILL BUTTONS & ROWS LAYOUT (Vanilla CSS fallbacks) ── */
  .check-item-row {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 16px !important;
    padding: 16px 24px !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 16px !important;
    background-color: #faf9f6 !important;
    margin-bottom: 12px !important;
    box-sizing: border-box !important;
    width: 100% !important;
  }

  .check-text {
    flex: 1 !important;
    box-sizing: border-box !important;
  }

  .check-options {
    display: flex !important;
    gap: 12px !important;
    align-items: center !important;
    box-sizing: border-box !important;
  }

  .check-opt-label {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 10px 20px !important;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 12px !important;
    background-color: #ffffff !important;
    color: #334155 !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    user-select: none !important;
    min-width: 90px !important;
    text-align: center !important;
    box-sizing: border-box !important;
    transition: all 0.2s !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02) !important;
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
    box-shadow: 0 10px 20px rgba(0, 39, 149, 0.15) !important;
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
    box-shadow: 0 4px 12px rgba(0, 39, 149, 0.15) !important;
  }

  .check-opt-label[id^="label-no-"].checked {
    background: #475569 !important;
    border-color: #475569 !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(71, 85, 105, 0.15) !important;
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

  /* Global box-sizing reset (fallback if Tailwind fails) */
  *,
  *::before,
  *::after {
    box-sizing: border-box !important;
  }

  html,
  body {
    max-width: 100% !important;
    overflow-x: hidden !important;
  }

  /* ── RESPONSIVE HELPERS & GRID LAYOUT (Vanilla CSS replacements for Tailwind) ── */
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

  .survey-page-grid {
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

    .survey-page-grid {
      grid-template-columns: 1fr 3fr;
    }

    #right-form-column {
      grid-column: auto !important;
    }

    .survey-sidebar-sticky {
      position: sticky !important;
      top: 96px !important;
      align-self: start !important;
    }
  }

  /* Robust Sidebar Card fallbacks */
  .sidebar-widget-card {
    background-color: var(--navy) !important;
    color: #ffffff !important;
    border-radius: 16px !important;
    padding: 24px !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    box-shadow: 0 10px 25px rgba(0, 39, 149, 0.15) !important;
    position: relative !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
    width: 100% !important;
    max-width: 100% !important;
    text-align: left !important;
  }

  .sidebar-widget-card-yellow {
    background-color: #fefce8 !important;
    color: #713f12 !important;
    border-radius: 16px !important;
    padding: 24px !important;
    border: 1px solid #fef08a !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02) !important;
    box-sizing: border-box !important;
    width: 100% !important;
    max-width: 100% !important;
    text-align: left !important;
  }

  .sidebar-widget-card-white {
    background: #ffffff !important;
    border-radius: 16px !important;
    padding: 24px !important;
    border: 1px solid rgba(0, 39, 149, 0.12) !important;
    box-shadow: 0 4px 20px rgba(0, 39, 149, 0.05) !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    width: 100% !important;
    box-sizing: border-box !important;
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

  .survey-page-grid {
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

    .survey-page-grid {
      grid-template-columns: 1fr 3fr;
    }

    #right-form-column {
      grid-column: auto !important;
    }

    .survey-sidebar-sticky {
      position: sticky !important;
      top: 96px !important;
      align-self: start !important;
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
    box-shadow: 0 14px 28px rgba(255, 209, 84, 0.45) !important;
    background-color: #ffe082 !important;
  }

  .btn-hero-start:active {
    transform: translateY(-1px) scale(1);
  }

  <?php if ($is_start): ?>
    #main-header,
    #colophon {
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

/* Hide progress wrap as requested */
#progress-wrap {
  display: none !important;
}

  .checklist-section.active {
    display: block !important;
  }

  .slide-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
    gap: 16px;
  }

  .btn-prev-slide {
    padding: 12px 24px;
    background: #f1f5f9;
    color: #334155;
    font-weight: 700;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
    font-family: 'Quicksand', sans-serif;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .btn-prev-slide:hover {
    background: #e2e8f0;
    color: #0f172a;
  }

  .btn-next-slide {
    padding: 12px 28px;
    background: var(--navy);
    color: var(--white);
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
    font-family: 'Quicksand', sans-serif;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 10px rgba(0, 39, 149, 0.15);
  }

  .btn-next-slide:hover {
    background: #1e3a8a;
    box-shadow: 0 6px 14px rgba(0, 39, 149, 0.25);
  }

  /* ── CUSTOM SURVEY CHECKBOX ── */
  .custom-survey-checkbox {
    display: none !important;
  }

  .custom-checkbox-box {
    width: 24px;
    height: 24px;
    border: 2px solid #cbd5e1;
    border-radius: 6px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
  }

  .checkmark-icon {
    width: 14px;
    height: 14px;
    color: #ffffff;
    stroke-dasharray: 24;
    stroke-dashoffset: 24;
    transition: stroke-dashoffset 0.2s ease;
  }

  /* When checked state */
  .check-item-row.checked {
    border-color: rgba(0, 39, 149, 0.4) !important;
    background: rgba(0, 39, 149, 0.02) !important;
  }

  .custom-survey-checkbox:checked + .custom-checkbox-box {
    background: var(--navy) !important;
    border-color: var(--navy) !important;
  }

  .custom-survey-checkbox:checked + .custom-checkbox-box .checkmark-icon {
    stroke-dashoffset: 0;
  }
</style>
