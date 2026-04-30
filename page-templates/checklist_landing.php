<?php
/**
 * Template Name: Check List tổng quan hành vi của trẻ
 * 
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng Kiểm Tra Toàn Diện - Nam Khánh</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
    rel="stylesheet">
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
      font-family: 'Be Vietnam Pro', sans-serif;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      color: var(--navy);
      margin-bottom: 16px;
    }

    .intro-card p {
      font-size: 15px;
      color: #555;
      margin-bottom: 12px;
    }

    .intro-steps {
      display: flex;
      gap: 20px;
      margin-top: 28px;
      flex-wrap: wrap;
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
      font-family: 'Playfair Display', serif;
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
      padding: 12px 16px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-family: 'Be Vietnam Pro', sans-serif;
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

    .checklist-section.active {
      display: block;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Be Vietnam Pro', sans-serif;
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
      font-family: 'Be Vietnam Pro', sans-serif;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Playfair Display', serif;
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
      font-family: 'Be Vietnam Pro', sans-serif;
      font-size: 14px;
      outline: none;
    }

    .cta-form button {
      padding: 14px 28px;
      background: var(--yellow);
      color: var(--navy);
      border: none;
      border-radius: 12px;
      font-family: 'Be Vietnam Pro', sans-serif;
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

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {

      .form-section,
      .checklist-section {
        padding: 28px 20px;
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
  </style>

  <?php wp_head(); ?>
</head>

<body>

  <!-- HERO -->
  <div class="hero" id="hero-section">
    <div class="hero-badge">🧩 Công cụ đánh giá miễn phí</div>
    <h1>Bảng Kiểm Tra Toàn Diện<br><span>Sức Khỏe Toàn Thân</span> Của Con</h1>
    <p>Được xây dựng dựa trên tài liệu tham khảo từ Documenting Hope. </br>Giúp cha mẹ nhìn rõ bức tranh toàn thân về con trong 10 phút.</p>
    <div class="hero-stats">
      <div class="stat"><span class="stat-num">11</span><span class="stat-label">Nhóm triệu chứng</span></div>
      <div class="stat"><span class="stat-num">100+</span><span class="stat-label">Dấu hiệu cụ thể</span></div>
      <div class="stat"><span class="stat-num">10'</span><span class="stat-label">Thời gian hoàn thành</span></div>
    </div>
  </div>

  <!-- INTRO CARD -->
  <div style="max-width:820px;margin:0 auto;padding:0 24px;" id="intro-section">
    <div class="intro-card">
      <h2>Cách sử dụng bảng kiểm tra này</h2>
      <p>Đây là công cụ hỗ trợ cha mẹ nhận diện các dấu hiệu cần chú ý ở con. Kết quả sẽ giúp chuyên gia tư vấn hiểu
        được bức tranh tổng thể và định hướng hỗ trợ phù hợp nhất cho con.</p>
      <div class="intro-steps">
        <div class="intro-step">
          <div class="intro-step-num">1</div>
          <p>Điền thông tin cơ bản về con</p>
        </div>
        <div class="intro-step">
          <div class="intro-step-num">2</div>
          <p>Tick các dấu hiệu quan sát được ở con</p>
        </div>
        <div class="intro-step">
          <div class="intro-step-num">3</div>
          <p>Nhận kết quả & đặt lịch tư vấn miễn phí</p>
        </div>
      </div>
    </div>
  </div>

  <!-- MAIN FORM -->
  <div id="main-form">

    <!-- THÔNG TIN CƠ BẢN -->
    <div class="form-section" id="info-section">
      <div class="section-header">
        <div class="section-icon">👤</div>
        <div>
          <div class="section-title">Thông tin về con</div>
          <div class="section-subtitle">Giúp chuyên gia tư vấn hiểu ngữ cảnh trước buổi gặp</div>
        </div>
      </div>
      <!-- GROUP 1: Liên hệ -->
      <div style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">1. Thông tin liên hệ</div>
      <div class="form-row" style="margin-bottom:24px;">
        <div class="form-group">
          <label>Tên cha / mẹ *</label>
          <input type="text" id="parent-name" placeholder="Họ và tên">
        </div>
        <div class="form-group">
          <label>Số điện thoại / Zalo *</label>
          <input type="tel" id="parent-phone" placeholder="0xxx xxx xxx">
        </div>
      </div>

      <!-- GROUP 2: Thông tin của con -->
      <div style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">2. Thông tin của con</div>
      <div class="form-row">
        <div class="form-group" style="position:relative;">
          <label style="margin-bottom:2px;">Ngày sinh của con *</label>
          <div style="font-size:12px; color:var(--gray); margin-bottom:10px; font-weight:400;">(Để tính chính xác độ tuổi)</div>
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
          <label style="margin-bottom:2px;">Giới tính *</label>
          <div style="font-size:12px; color:var(--gray); margin-bottom:10px; font-weight:400;">(Dùng cho chỉ số phát triển)</div>
          <div style="display:flex; gap:12px; height: 49.5px;">
            <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
              <input type="radio" name="child-gender" value="Bé trai" onchange="calculateBMI()" style="width:16px; height:16px; margin:0;"> Bé trai
            </label>
            <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
              <input type="radio" name="child-gender" value="Bé gái" onchange="calculateBMI()" style="width:16px; height:16px; margin:0;"> Bé gái
            </label>
          </div>
        </div>
      </div>

      <div class="form-row" style="margin-bottom: 24px;">
        <div class="form-group" style="position:relative;">
          <label>Chiều cao (cm) *</label>
          <input type="number" id="child-height" oninput="calculateBMI()" placeholder="Ví dụ: 105" required style="padding:14px 16px; font-size:15px; font-weight:600;">
        </div>
        <div class="form-group" style="position:relative;">
          <label>Cân nặng (kg) *</label>
          <input type="number" step="0.1" id="child-weight" oninput="calculateBMI()" placeholder="Ví dụ: 18.5" required style="padding:14px 16px; font-size:15px; font-weight:600;">
        </div>
        <div id="calculated-bmi" style="grid-column: 1 / -1; font-size: 14px; color: var(--navy); margin-top: -10px; font-weight: 600; text-align:left; background: var(--yellow-soft); padding: 12px 16px; border-radius: 8px; border-left: 4px solid var(--yellow); display:none;"></div>
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
      <div class="nav-buttons" style="justify-content:flex-end;">
        <button class="btn btn-primary" onclick="startChecklist()">Bắt đầu kiểm tra →</button>
      </div>
    </div>

    <!-- PROGRESS -->
    <div class="progress-wrap" id="progress-wrap" style="display:none;">
      <div class="progress-header">
        <span class="progress-label">Tiến trình hoàn thành</span>
        <span class="progress-count" id="progress-count">0 / 11 nhóm</span>
      </div>
      <div class="progress-bar">
        <div class="progress-fill" id="progress-fill"></div>
      </div>
      <div class="progress-steps" id="progress-steps"></div>
    </div>

    <!-- CHECKLIST DATA -->
    <div id="checklist-container"></div>

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
      <h3>Đặt lịch tư vấn miễn phí</h3>
      <p>Chuyên gia sẽ phân tích kết quả kiểm tra và đưa ra định hướng hỗ trợ cụ thể cho con - hoàn toàn miễn phí, không
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
      chuyên gia có chuyên môn phù hợp. Tài liệu tham khảo: Documenting Hope
    </div>
  </div>

  <script>
    // ── DỮ LIỆU CHECKLIST ──
    const GROUPS = [
      {
        id: 'vanDongThoTinh',
        name: 'Vận động thô & tinh',
        icon: '🏃',
        desc: 'Khả năng di chuyển, giữ thăng bằng và vận động tay',
        items: [
          { main: 'Con dễ bị ngã khi chạy, leo cầu thang hoặc di chuyển', example: 'Cha mẹ thấy con vấp té thường xuyên hơn bạn cùng tuổi' },
          { main: 'Con giữ thăng bằng kém - hay lảo đảo, không đứng vững trên một chân', example: 'Khi đứng một chân hoặc đi trên bề mặt không bằng phẳng' },
          { main: 'Con gặp khó khăn khi đi trên bề mặt gồ ghề, cầu thang, vỉa hè', example: 'Cần người dắt tay mỗi khi lên xuống cầu thang' },
          { main: 'Con khéo léo tay kém - khó cầm bút, cắt kéo, xếp hình', example: 'Bút rớt nhiều, không tô màu đúng viền được' },
          { main: 'Con đi nhón gót (toe walking) thường xuyên', example: 'Đi bằng đầu ngón chân thay vì cả bàn chân' },
          { main: 'Cơ bắp con yếu, trương lực cơ thấp - con hay ngồi dựa, khòm lưng', example: 'Khó giữ lưng thẳng khi ngồi học hoặc ngồi ăn' },
          { main: 'Con hay ngồi kiểu chữ W (hai gót ra ngoài, hai đầu gối vào trong)', example: 'Tư thế ngồi chơi quen thuộc của con trên sàn' },
          { main: 'Dáng đi của con trông khác biệt so với bạn bè cùng tuổi', example: 'Đi bước ngắn, không xoay hông, cứng người' },
        ]
      },
      {
        id: 'miengHong',
        name: 'Vận động miệng - họng',
        icon: '👄',
        desc: 'Khả năng nhai, nuốt, nói và phát âm',
        items: [
          { main: 'Con chảy nước dãi nhiều dù đã qua giai đoạn mọc răng', example: 'Áo con thường bị ướt vì dãi, nhất là khi tập trung' },
          { main: 'Con hay bị sặc hoặc ho khi ăn uống', example: 'Sặc nước, ho khi uống sữa hoặc ăn thức ăn lỏng' },
          { main: 'Con khó khăn khi nuốt - có vẻ sợ hoặc tránh nuốt', example: 'Ngậm thức ăn lâu trong miệng, chần chừ trước khi nuốt' },
          { main: 'Con né tránh thức ăn cần nhai nhiều - thích thức ăn mềm, xay nhuyễn', example: 'Từ chối thịt, rau sống; chỉ ăn cháo, súp, bánh mềm' },
          { main: 'Con nhai không kỹ hoặc nhồi đầy miệng khi ăn', example: 'Nhét nhiều thức ăn vào cùng lúc, nuốt vội' },
          { main: 'Con phát âm không rõ, khó hiểu khi nói chuyện', example: 'Người ngoài gia đình khó hiểu con đang nói gì' },
          { main: 'Con chậm nói hoặc vốn từ ít hơn so với bạn cùng tuổi', example: 'Ít hơn 50 từ lúc 2 tuổi, hoặc không ghép được câu 2 từ lúc 2,5 tuổi' },
        ]
      },
      {
        id: 'tieuHoa',
        name: 'Tiêu hóa & dạ dày',
        icon: '🫁',
        desc: 'Tình trạng đường ruột và tiêu hóa hàng ngày',
        items: [
          { main: 'Con hay nôn hoặc buồn nôn không rõ nguyên nhân', example: 'Nôn sau ăn hoặc buổi sáng sớm dù không bị bệnh' },
          { main: 'Con bị trào ngược axit - hay ợ chua, khó chịu vùng thượng vị', example: 'Hay đặt tay lên ngực, cáu kỉnh sau khi ăn' },
          { main: 'Con táo bón mãn tính - đi cầu ít hơn 3 lần/tuần', example: 'Phân cứng, khó đi, thường đau khi đi' },
          { main: 'Con tiêu chảy mãn tính hoặc phân lỏng thường xuyên', example: 'Tiêu chảy kéo dài nhiều tuần, không liên quan đến bệnh cấp tính' },
          { main: 'Con cực kỳ kén ăn - chỉ ăn được dưới 10 loại thức ăn', example: 'Từ chối thử bất kỳ món mới nào, ăn đi ăn lại một vài món nhất định' },
          { main: 'Con hay đau bụng, ôm bụng hoặc tỏ ra khó chịu vùng bụng', example: 'Cong người, không chịu ngồi yên, cáu kỉnh khi đụng vào bụng' },
          { main: 'Phân của con có chất nhầy hoặc thức ăn chưa tiêu hóa', example: 'Nhìn thấy rõ mảnh rau, thịt nguyên vẹn trong phân' },
          { main: 'Phân của con có màu bất thường (trắng, vàng mù tạt, đen)', example: 'Màu phân thay đổi không giải thích được' },
          { main: 'Phân có mùi rất khai hoặc khó chịu bất thường', example: 'Người nhà nhận ra ngay mùi khác lạ' },
          { main: 'Con từ chối uống nước, ít uống nước trong ngày', example: 'Uống dưới 500ml/ngày, phải ép mới uống' },
          { main: 'Con tăng cân rất chậm hoặc không tăng cân dù ăn bình thường', example: 'Cân nặng dưới đường chuẩn trên biểu đồ tăng trưởng' },
        ]
      },
      {
        id: 'camGiac',
        name: 'Xử lý cảm giác',
        icon: '🎯',
        desc: 'Cách con phản ứng với thế giới xung quanh qua các giác quan',
        items: [
          { main: 'Con quá nhạy cảm với âm thanh - bịt tai, khóc hoặc hoảng loạn khi nghe tiếng ồn', example: 'Hoảng sợ với tiếng máy hút bụi, tiếng còi xe, tiếng đông người' },
          { main: 'Con tránh tiếp xúc cơ thể - không muốn được ôm, hôn hoặc chạm vào', example: 'Giật mình hoặc đẩy ra khi người khác chạm vào' },
          { main: 'Con nhạy cảm quá mức với mùi - từ chối ăn hoặc rời khỏi phòng vì mùi', example: 'Bịt mũi, nôn ói hoặc không vào bếp khi đang nấu ăn' },
          { main: 'Con tìm kiếm áp lực sâu - thích được bóp chặt, leo trèo, đè lên đồ vật', example: 'Tự lăn vào gối, chui dưới nệm, thích đeo ba lô nặng' },
          { main: 'Con dễ bị phân tán chú ý bởi âm thanh hoặc hình ảnh xung quanh', example: 'Không giữ được chú ý quá 2-3 phút khi có yếu tố xung quanh' },
          { main: 'Con chỉ ăn những kết cấu thức ăn nhất định - từ chối thức ăn có kết cấu khác', example: 'Chỉ ăn đồ giòn hoặc chỉ ăn đồ mềm, không thể trộn kết cấu' },
          { main: 'Con dường như không cảm nhận được đau - bị ngã, bị thương nhưng không khóc', example: 'Đầu gối chảy máu nhưng con vẫn tiếp tục chơi như không có chuyện' },
          { main: 'Con không có phản xạ sợ nguy hiểm tự nhiên', example: 'Không sợ độ cao, không sợ lửa nóng, chạy ra đường không nhìn xe' },
        ]
      },
      {
        id: 'ngonNgu',
        name: 'Ngôn ngữ & giao tiếp',
        icon: '💬',
        desc: 'Khả năng nói, hiểu và diễn đạt của con',
        items: [
          { main: 'Con chưa có ngôn ngữ lời nói hoặc rất ít từ', example: 'Trên 2 tuổi nhưng không nói được từ nào rõ ràng' },
          { main: 'Con nói chậm so với bạn cùng tuổi', example: 'Ít từ hơn hoặc chưa ghép được câu theo cột mốc phát triển' },
          { main: 'Con không thể diễn đạt nhu cầu bằng lời - phải kéo tay, chỉ hoặc khóc', example: 'Muốn nước nhưng không nói được, chỉ kéo tay cha mẹ ra tủ lạnh' },
          { main: 'Con không hiểu những chỉ dẫn đơn giản', example: 'Nói "cầm áo lên" hoặc "đi lấy giày" nhưng con không phản ứng' },
          { main: 'Con khó để người khác hiểu khi nói - phát âm không rõ', example: 'Người ngoài gia đình không hiểu được con đang nói gì' },
          { main: 'Con nhắc lại từ hoặc câu vừa nghe thay vì trả lời (echolalia)', example: 'Hỏi "con có muốn ăn không?" - con nhắc lại "con có muốn ăn không?"' },
        ]
      },
      {
        id: 'nhanThuc',
        name: 'Nhận thức & học tập',
        icon: '🧠',
        desc: 'Khả năng tập trung, ghi nhớ và tiếp thu của con',
        items: [
          { main: 'Con thiếu tập trung, không chú ý - ánh mắt hay lơ đãng', example: 'Gọi tên nhiều lần mới quay lại, dễ quên chỉ dẫn vừa nói' },
          { main: 'Con luôn trong trạng thái chuyển động - không ngồi yên được', example: 'Chạy, nhảy, leo trèo liên tục ngay cả khi cần ngồi yên' },
          { main: 'Con khó tập trung làm một việc trong thời gian dài', example: 'Bỏ dở hoạt động sau 1-2 phút để chuyển sang việc khác' },
          { main: 'Con xử lý thông tin chậm - cần nhiều thời gian để phản ứng', example: 'Hỏi xong phải đợi 10-15 giây con mới trả lời hoặc phản ứng' },
          { main: 'Con gặp khó khăn khi giải quyết vấn đề đơn giản', example: 'Không biết mở hộp, không biết xếp hình đơn giản theo tuổi' },
          { main: 'Con chậm phát triển toàn diện so với cột mốc chuẩn', example: 'Nhiều kỹ năng chậm hơn bạn cùng tuổi 6 tháng trở lên' },
          { main: 'Con đã từng có biểu hiện động kinh hoặc co giật', example: 'Dù chỉ một lần, kể cả dạng vắng ý thức nhẹ' },
        ]
      },
      {
        id: 'hanhViXaHoi',
        name: 'Hành vi & xã hội',
        icon: '🤝',
        desc: 'Cách con kết nối với người khác và điều tiết cảm xúc',
        items: [
          { main: 'Con không phản ứng khi được gọi tên - như không nghe thấy', example: 'Gọi tên 3-4 lần ở khoảng cách gần con mới quay lại' },
          { main: 'Con thu mình vào thế giới riêng, ít tương tác với xung quanh', example: 'Chơi một mình trong góc riêng, không quan tâm đến người xung quanh' },
          { main: 'Con tránh giao tiếp mắt hoặc nhìn lướt qua rất nhanh', example: 'Khi nói chuyện, ánh mắt con nhìn ra chỗ khác thay vì nhìn vào mắt người đối diện' },
          { main: 'Con ít hoặc không có nhu cầu chơi cùng bạn bè', example: 'Thích chơi một mình hơn, không tìm đến bạn để chơi' },
          { main: 'Con có hành vi ám ảnh lặp đi lặp lại (xoay đồ vật, lắc người, vỗ tay)', example: 'Quay bánh xe, xếp đồ vật thành hàng, lắc người liên tục' },
          { main: 'Con gắn bó bất thường với một đồ vật cụ thể', example: 'Không thể rời bỏ một món đồ nhất định, khóc dữ dội khi mất món đó' },
          { main: 'Con cực kỳ kháng cự với thay đổi - khó chuyển từ hoạt động này sang hoạt động khác', example: 'Khủng hoảng dữ dội khi thay đổi lịch sinh hoạt, đường đi, bàn ăn' },
          { main: 'Con có cơn bùng phát cảm xúc dữ dội không tương xứng với nguyên nhân', example: 'Khóc ăn vạ kéo dài 30-60 phút vì những lý do nhỏ' },
          { main: 'Con quan tâm cực đoan đến một chủ đề cụ thể', example: 'Chỉ nói về xe lửa / khủng long / con số và không quan tâm chủ đề khác' },
        ]
      },
      {
        id: 'diUngThucPham',
        name: 'Dị ứng & nhạy cảm thực phẩm',
        icon: '🥗',
        desc: 'Phản ứng của con với thức ăn và môi trường',
        items: [
          { main: 'Tai hoặc má con đỏ, nóng sau khi ăn một số loại thức ăn', example: 'Đặc biệt sau khi ăn sữa, gluten, thực phẩm có màu nhân tạo' },
          { main: 'Bụng con hay phình to, căng tròn sau khi ăn', example: 'Bụng to hơn sau bữa ăn dù ăn không nhiều' },
          { main: 'Con bị chàm (eczema), nổi mề đay hoặc viêm da tái phát', example: 'Mẩn đỏ, ngứa ở tay, mặt, bụng tái đi tái lại' },
          { main: 'Con thèm muốn mạnh một loại thức ăn cụ thể và đòi ăn mỗi ngày', example: 'Chỉ đòi ăn sữa / bánh mì / mì tôm và từ chối mọi thứ khác' },
          { main: 'Hành vi con thay đổi rõ ràng sau khi ăn một số thực phẩm', example: 'Tăng động, hung hăng hoặc thu mình hơn sau khi ăn đường, bánh kẹo' },
          { main: 'Con bị hăm tã đau đớn tái phát dù đã qua tuổi mặc tã', example: 'Da vùng kín đỏ tấy thường xuyên không rõ nguyên nhân' },
          { main: 'Con đái dầm ban đêm hoặc khó kiểm soát bàng quang dù đã lớn', example: 'Trên 5 tuổi vẫn đái dầm ban đêm thường xuyên' },
        ]
      },
      {
        id: 'mienDich',
        name: 'Hệ miễn dịch',
        icon: '🛡️',
        desc: 'Khả năng chống đỡ bệnh tật và các dấu hiệu miễn dịch bất thường',
        items: [
          { main: 'Con hay bị chảy nước mũi mãn tính dù không bị cảm', example: 'Mũi chảy hoặc nghẹt quanh năm, không liên quan đến bệnh cụ thể' },
          { main: 'Con ốm liên tục - bị bệnh nhiều hơn 6-8 lần/năm', example: 'Hầu như tháng nào cũng phải nghỉ học vì bệnh' },
          { main: 'Con bị viêm tai giữa tái phát nhiều lần', example: 'Viêm tai 3 lần trở lên trong một năm' },
          { main: 'Con bị nhiễm liên cầu khuẩn (viêm họng liên cầu) tái phát', example: 'Viêm họng có mủ điều trị khỏi rồi lại tái phát' },
          { main: 'Con bị viêm xoang tái phát nhiều lần trong năm', example: 'Điều trị khỏi rồi lại tái phát trong vài tuần' },
          { main: 'Con bị hen suyễn hoặc khó thở tái phát', example: 'Đã được chẩn đoán hen hoặc thở khò khè tái đi tái lại' },
          { main: 'Gia đình có tiền sử bệnh tự miễn (lupus, viêm khớp, bệnh tuyến giáp...)', example: 'Cha, mẹ, anh chị em, ông bà mắc bệnh tự miễn' },
          { main: 'Con đã dùng nhiều đợt kháng sinh liên tiếp', example: 'Dùng kháng sinh hơn 3-4 đợt trong một năm' },
          { main: 'Con hay bị nhiễm nấm (nấm da, nấm miệng, hăm kẽ tái phát)', example: 'Thường xuyên phải dùng thuốc chống nấm' },
        ]
      },
      {
        id: 'dinhDuong',
        name: 'Dinh dưỡng & vi chất',
        icon: '🥦',
        desc: 'Các dấu hiệu thiếu hụt vi chất quan trọng',
        items: [
          { main: 'Móng tay con có đốm trắng hoặc gợn ngang bất thường', example: 'Đốm trắng xuất hiện nhiều trên một hoặc nhiều móng tay' },
          { main: 'Lòng bàn chân con bị bong tróc da thường xuyên', example: 'Da bàn chân bong vảy không liên quan đến nấm' },
          { main: 'Tóc con mỏng, thưa hoặc rụng nhiều bất thường', example: 'Gội đầu thấy rụng nhiều hoặc tóc không mọc dày bình thường' },
          { main: 'Con sụt cân hoặc không tăng cân dù ăn uống đầy đủ', example: 'Cân nặng không tăng trong 2-3 tháng dù chế độ ăn bình thường' },
          { main: 'Con có xu hướng ăn đồ vật không phải thức ăn (pica)', example: 'Hay cắn, nhai hoặc nuốt giấy, đất, bút, vải...' },
        ]
      },
      {
        id: 'chuyenHoa',
        name: 'Năng lượng & chuyển hóa',
        icon: '⚡',
        desc: 'Các dấu hiệu liên quan đến năng lượng tế bào và chức năng ti thể',
        items: [
          { main: 'Con mệt mỏi, li bì quá mức - không tương xứng với hoạt động trong ngày', example: 'Ngủ xong vẫn mệt, không có năng lượng chơi như bạn bè' },
          { main: 'Con ngủ rất nhiều hoặc rất khó thức dậy buổi sáng', example: 'Phải lay gọi rất lâu, cáu kỉnh và mất định hướng sau khi thức dậy' },
          { main: 'Con mất đi kỹ năng đã biết - ngôn ngữ, vận động, xã hội', example: 'Từng nói được 10 từ nay không nói nữa; từng biết đi nay đi lại khó' },
          { main: 'Tâm trạng và hành vi con thay đổi rõ ràng theo thời điểm trong ngày', example: 'Buổi sáng tốt, buổi chiều hoặc tối lại kém hơn nhiều và không giải thích được' },
          { main: 'Con được chẩn đoán hoặc nghi ngờ có vấn đề tuyến giáp, rối loạn tâm trạng', example: 'Chẩn đoán lưỡng cực, rối loạn cảm xúc từ nhỏ' },
          { main: 'Trong gia đình có 2 con trở lên có dấu hiệu tự kỷ hoặc chậm phát triển', example: 'Anh chị em ruột cũng có chẩn đoán tương tự' },
          { main: 'Con có vòng đầu nhỏ hơn chuẩn hoặc giảm tương đối theo thời gian', example: 'Bác sĩ đã nhận xét về kích thước đầu khi khám' },
          { main: 'Con phát triển chậm về chiều cao và cân nặng - dưới đường chuẩn kéo dài', example: 'Biểu đồ tăng trưởng dưới -2 SD trong nhiều lần đo' },
          { main: 'Con từng có phản ứng bất thường với gây mê hoặc gây tê', example: 'Tỉnh dậy sau phẫu thuật khó khăn hơn bình thường hoặc có biểu hiện lạ' },
          { main: 'Kết quả xét nghiệm máu của con có chỉ số bất thường không rõ nguyên nhân', example: 'Bác sĩ có đề cập đến chỉ số bất thường nhưng chưa giải thích được' },
        ]
      }
    ];

    // ── STATE ──
    let currentGroup = 0;
    let answers = {};
    let completedGroups = new Set();
    let userCode = Math.floor(10000000 + Math.random() * 90000000).toString(); // 8 digits
    let startTime = Date.now();

    // ── DEEP ANALYTICS TRACKER ──
    const deepTracker = {
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
    };
    
    let currentGroupStartTime = Date.now();
    let currentGroupFirstClickRecorded = false;

    // UTMs
    const params = new URLSearchParams(window.location.search);
    for (const [key, value] of params.entries()) {
      if (key.startsWith('utm_')) deepTracker.utms[key] = value;
    }

    // Tính tuổi tự động
    function calculateAge() {
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
      
      // Kiểm tra ngày hợp lệ (ví dụ tháng 2 không có ngày 30)
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
    }

    // Tính BMI tự động
    function calculateBMI() {
      const heightCm = document.getElementById('child-height').value;
      const weightKg = document.getElementById('child-weight').value;
      const displayDiv = document.getElementById('calculated-bmi');
      const genderEl = document.querySelector('input[name="child-gender"]:checked');
      
      if (!heightCm || !weightKg || heightCm <= 0 || weightKg <= 0 || !genderEl) {
        displayDiv.innerHTML = '';
        displayDiv.style.display = 'none';
        return;
      }
      
      const gender = genderEl.value;
      const heightM = parseFloat(heightCm) / 100;
      const weight = parseFloat(weightKg);
      
      if (heightM > 0 && heightM < 3 && weight > 0 && weight < 300) {
        const bmi = (weight / (heightM * heightM)).toFixed(1);
        
        // Tính tuổi theo năm
        const dobY = document.getElementById('child-dob-year').value;
        let ageYears = 2; // Default to 2 if not filled
        if (dobY) {
           ageYears = new Date().getFullYear() - parseInt(dobY);
           if (ageYears < 2) ageYears = 2;
        }

        // Bảng Percentiles BMI (WHO/CDC) - 5th, 85th, 95th
        const cdc = {
          'Bé trai': {
             2: [14.8, 18.2, 19.3], 3: [14.4, 17.4, 18.3], 4: [14.0, 16.9, 17.8], 5: [13.8, 16.8, 18.0], 6: [13.7, 17.0, 18.5], 7: [13.7, 17.4, 19.2], 8: [13.8, 18.0, 20.1], 9: [14.0, 18.8, 21.2], 10: [14.2, 19.6, 22.4], 11: [14.6, 20.6, 23.6], 12: [15.0, 21.5, 24.8], 13: [15.5, 22.5, 25.9], 14: [16.0, 23.3, 26.9], 15: [16.5, 24.1, 27.7], 16: [17.0, 24.8, 28.3], 17: [17.5, 25.4, 28.8], 18: [17.9, 25.9, 29.2], 19: [18.3, 26.4, 29.5]
          },
          'Bé gái': {
             2: [14.4, 18.0, 19.1], 3: [14.0, 17.2, 18.3], 4: [13.7, 16.8, 18.0], 5: [13.5, 16.8, 18.2], 6: [13.4, 17.1, 18.8], 7: [13.4, 17.6, 19.6], 8: [13.5, 18.3, 20.6], 9: [13.8, 19.1, 21.7], 10: [14.0, 20.0, 22.9], 11: [14.4, 21.0, 24.1], 12: [14.8, 22.0, 25.3], 13: [15.3, 22.9, 26.3], 14: [15.8, 23.8, 27.2], 15: [16.3, 24.5, 28.0], 16: [16.8, 25.1, 28.6], 17: [17.1, 25.5, 29.1], 18: [17.4, 25.9, 29.5], 19: [17.7, 26.2, 29.8]
          }
        };

        let p5 = 18.5, p85 = 23.0, p95 = 25.0; // Default adult WPRO
        if (ageYears <= 19 && cdc[gender]) {
           let bounds = cdc[gender][ageYears];
           if (!bounds) bounds = cdc[gender][19];
           p5 = bounds[0]; p85 = bounds[1]; p95 = bounds[2];
        }

        let status = '';
        let color = '';
        
        if (bmi < p5) {
          status = 'Thiếu cân';
          color = '#d97706';
        } else if (bmi >= p5 && bmi < p85) {
          status = 'Bình thường';
          color = '#15803d';
        } else if (bmi >= p85 && bmi < p95) {
          status = 'Thừa cân';
          color = '#c2410c';
        } else {
          status = 'Béo phì';
          color = '#b91c1c';
        }
        
        displayDiv.style.display = 'block';
        displayDiv.innerHTML = '⚡ Chỉ số BMI của con là <strong>' + bmi + '</strong>, hiện tại đang ở mức <strong style="color:' + color + ';">' + status + '</strong>.<br><span style="font-size:11px; color:var(--gray); font-weight:400; display:block; margin-top:4px;">Nguồn tham khảo trực tiếp: WHO BMI Classification, CDC BMI for Children.</span>';
      } else {
        displayDiv.innerHTML = 'Chỉ số không hợp lệ';
        displayDiv.style.color = '#e11d48';
        displayDiv.style.display = 'block';
      }
    }

    // Lấy IP & Vị trí
    fetch('https://api.db-ip.com/v2/free/self')
      .then(res => res.json())
      .then(data => {
          deepTracker.location = data.city + ', ' + data.countryName;
          deepTracker.ip = data.ipAddress;
      }).catch(e => {
          deepTracker.location = 'Không xác định';
      });

    // Active Time
    window.addEventListener('blur', () => { deepTracker.activeTime += (Date.now() - deepTracker.lastFocus); });
    window.addEventListener('focus', () => { deepTracker.lastFocus = Date.now(); });
    window.addEventListener('visibilitychange', () => {
      if (document.hidden) deepTracker.activeTime += (Date.now() - deepTracker.lastFocus);
      else deepTracker.lastFocus = Date.now();
    });

    // Text selection
    document.addEventListener('mouseup', () => {
      const selection = window.getSelection().toString().trim();
      if (selection.length > 3 && selection.length < 50) deepTracker.highlighted.add(selection);
    });

    // Input deletions
    document.addEventListener('keydown', (e) => {
      if ((e.key === 'Backspace' || e.key === 'Delete') && e.target.tagName === 'TEXTAREA') {
        deepTracker.deletedChars++;
      }
    });

    function pingServerDropOff() {
      const phone = document.getElementById('parent-phone').value.trim();
      if (!phone) return;
      deepTracker.activeTime += (Date.now() - deepTracker.lastFocus);
      deepTracker.lastFocus = Date.now();

      const timeSpent = Math.floor((Date.now() - startTime) / 1000);
      const da = { ...deepTracker, highlighted: Array.from(deepTracker.highlighted), activeTime: Math.floor(deepTracker.activeTime / 1000) };

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', userCode);
      formData.append('parent_name', document.getElementById('parent-name').value.trim());
      formData.append('parent_phone', phone);
      formData.append('child_age', document.getElementById('child-age').value);
      
      const genderElDrop = document.querySelector('input[name="child-gender"]:checked');
      formData.append('child_gender', genderElDrop ? genderElDrop.value : '');
      
      formData.append('child_diagnosis', document.getElementById('child-diagnosis').value);
      formData.append('child_height', document.getElementById('child-height').value.trim());
      formData.append('child_weight', document.getElementById('child-weight').value.trim());
      formData.append('time_spent', timeSpent);
      formData.append('device_info', navigator.userAgent);
      formData.append('deep_analytics', JSON.stringify(da));

      fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData }).catch(()=>{});
    }

    // ── INIT ──
    function startChecklist() {
      const name = document.getElementById('parent-name').value.trim();
      const phone = document.getElementById('parent-phone').value.trim();
      const age = document.getElementById('child-age').value;
      const diagnosis = document.getElementById('child-diagnosis').value;
      const height = document.getElementById('child-height').value.trim();
      const weight = document.getElementById('child-weight').value.trim();
      const genderEl = document.querySelector('input[name="child-gender"]:checked');
      const gender = genderEl ? genderEl.value : '';
      if (!name || !phone || !age || !diagnosis || !height || !weight || !gender) {
        alert('Cha mẹ vui lòng điền đầy đủ các thông tin có dấu * trước khi tiếp tục.');
        return;
      }
      document.getElementById('info-section').style.display = 'none';
      document.getElementById('hero-section').style.display = 'none';
      document.getElementById('intro-section').style.display = 'none';
      document.getElementById('progress-wrap').style.display = 'block';
      buildChecklist();
      buildProgressSteps();
      showGroup(0);

      // Theo dõi sự kiện bắt đầu
      if (typeof fbq !== 'undefined') {
        fbq('track', 'ViewContent', { content_name: 'Start DH Checklist', content_category: 'Checklist' });
      }

      deepTracker.drop_point = `Nhóm 1 / ${GROUPS.length}: ${GROUPS[0].name}`;
      pingServerDropOff();
    }

    function buildProgressSteps() {
      const wrap = document.getElementById('progress-steps');
      wrap.innerHTML = GROUPS.map((g, i) =>
        `<span class="progress-step" id="pstep-${i}" onclick="jumpToGroup(${i})">${g.icon} ${g.name}</span>`
      ).join('');
    }

    function buildChecklist() {
      const container = document.getElementById('checklist-container');
      container.innerHTML = '';
      GROUPS.forEach((group, gi) => {
        if (!answers[group.id]) answers[group.id] = Array(group.items.length).fill(false);
        const sec = document.createElement('div');
        sec.className = 'checklist-section';
        sec.id = `group-${gi}`;
        sec.innerHTML = `
      <div class="section-header">
        <div class="section-icon">${group.icon}</div>
        <div>
          <div class="section-title">Nhóm ${gi + 1} / ${GROUPS.length}: ${group.name}</div>
          <div class="section-subtitle">${group.desc}</div>
        </div>
      </div>
      <div class="group-score">
        <span class="group-score-label">Đã chọn:</span>
        <span class="group-score-value" id="gscore-${gi}">0 / ${group.items.length}</span>
        <div class="group-score-bar"><div class="group-score-fill" id="gbar-${gi}"></div></div>
      </div>
      <div class="checklist-items">
        ${group.items.map((item, ii) => `
          <label class="check-item" id="ci-${gi}-${ii}">
            <input type="checkbox" onchange="toggleItem(${gi},${ii},this)">
            <div class="check-box"></div>
            <div class="check-text">
              <div class="check-main">${item.main}</div>
              <div class="check-example">Ví dụ: ${item.example}</div>
            </div>
          </label>
        `).join('')}
      </div>
      ${gi === GROUPS.length - 1 ? `
        <div class="open-section">
          <label>Triệu chứng khác cha mẹ muốn chia sẻ thêm (không bắt buộc)</label>
          <textarea id="extra-symptoms" placeholder="Ghi thêm bất kỳ dấu hiệu nào cha mẹ quan sát được ở con..."></textarea>
        </div>
      ` : ''}
      <div class="nav-buttons">
        ${gi > 0 ? `<button class="btn btn-secondary" onclick="showGroup(${gi - 1})">← Quay lại</button>` : '<span></span>'}
        ${gi < GROUPS.length - 1
            ? `<button class="btn btn-primary" onclick="showGroup(${gi + 1})">Tiếp theo →</button>`
            : `<button class="btn btn-submit" onclick="showResult()">✅ Xem kết quả</button>`}
      </div>
    `;
        container.appendChild(sec);
      });
    }

    function toggleItem(gi, ii, cb) {
      const groupName = GROUPS[gi].name;
      const itemName = GROUPS[gi].items[ii].main;
      
      if (!currentGroupFirstClickRecorded) {
          const thinkSeconds = Math.floor((Date.now() - currentGroupStartTime) / 1000);
          deepTracker.thinkTimes[groupName] = thinkSeconds;
          currentGroupFirstClickRecorded = true;
      }
      
      const itemKey = groupName + ' - ' + itemName;
      deepTracker.toggles[itemKey] = (deepTracker.toggles[itemKey] || 0) + 1;

      answers[GROUPS[gi].id][ii] = cb.checked;
      const label = document.getElementById(`ci-${gi}-${ii}`);
      label.classList.toggle('checked', cb.checked);
      updateGroupScore(gi);
    }

    function updateGroupScore(gi) {
      const group = GROUPS[gi];
      const ticked = answers[group.id].filter(Boolean).length;
      const total = group.items.length;
      document.getElementById(`gscore-${gi}`).textContent = `${ticked} / ${total}`;
      document.getElementById(`gbar-${gi}`).style.width = `${(ticked / total) * 100}%`;
    }

    function showGroup(gi) {
      if (currentGroup !== undefined) {
        const prev = document.getElementById(`group-${currentGroup}`);
        if (prev) { prev.classList.remove('active'); completedGroups.add(currentGroup); }
      }
      currentGroup = gi;
      currentGroupStartTime = Date.now();
      currentGroupFirstClickRecorded = false;
      document.querySelectorAll('.checklist-section').forEach(s => s.classList.remove('active'));
      document.getElementById(`group-${gi}`).classList.add('active');
      
      if (gi > 0 && gi < GROUPS.length) {
          deepTracker.drop_point = `Nhóm ${gi + 1} / ${GROUPS.length}: ${GROUPS[gi].name}`;
          pingServerDropOff();
      }

      updateProgress();
      window.scrollTo({ top: document.getElementById('progress-wrap').offsetTop - 20, behavior: 'smooth' });
    }

    function jumpToGroup(gi) { showGroup(gi); }

    function updateProgress() {
      const done = completedGroups.size;
      const total = GROUPS.length;
      document.getElementById('progress-fill').style.width = `${(done / total) * 100}%`;
      document.getElementById('progress-count').textContent = `${done} / ${total} nhóm`;
      GROUPS.forEach((_, i) => {
        const el = document.getElementById(`pstep-${i}`);
        el.classList.remove('active', 'done');
        if (i === currentGroup) el.classList.add('active');
        else if (completedGroups.has(i)) el.classList.add('done');
      });
    }

    // ── RESULT ──
    function showResult() {
      completedGroups.add(currentGroup);
      document.getElementById('main-form').style.display = 'none';
      document.getElementById('progress-wrap').style.display = 'none';

      // Tính điểm
      const scores = GROUPS.map(g => {
        const ticked = answers[g.id].filter(Boolean).length;
        const total = g.items.length;
        const pct = Math.round((ticked / total) * 100);
        const tickedItems = g.items.filter((_, i) => answers[g.id][i]).map(x => x.main);
        return { id: g.id, name: g.name, icon: g.icon, ticked, total, pct, tickedItems };
      }).sort((a, b) => b.pct - a.pct);

      // Gửi dữ liệu về Server và chuyển trang
      submitDataToServer(scores);
    }

    function submitDataToServer(scores) {
      const name = document.getElementById('parent-name').value.trim();
      const phone = document.getElementById('parent-phone').value.trim();
      const age = document.getElementById('child-age').value;
      const diagnosis = document.getElementById('child-diagnosis').value;
      const therapy = document.getElementById('child-therapy').value.trim();
      const supplement = document.getElementById('child-supplement').value.trim();
      const concern = document.getElementById('parent-concern').value.trim();
      const extra = document.getElementById('extra-symptoms') ? document.getElementById('extra-symptoms').value.trim() : '';
      const genderEl = document.querySelector('input[name="child-gender"]:checked');
      const gender = genderEl ? genderEl.value : '';

      const behaviorsByGroup = {};
      scores.forEach(s => {
          if (s.tickedItems && s.tickedItems.length > 0) {
              behaviorsByGroup[s.id] = s.tickedItems;
          }
      });

      const timeSpent = Math.floor((Date.now() - startTime) / 1000);
      const deviceInfo = navigator.userAgent;

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', userCode);
      formData.append('parent_name', name);
      formData.append('parent_phone', phone);
      formData.append('child_age', age);
      formData.append('child_diagnosis', diagnosis);
      formData.append('child_gender', gender);
      formData.append('child_height', document.getElementById('child-height').value.trim());
      formData.append('child_weight', document.getElementById('child-weight').value.trim());
      formData.append('child_therapy', therapy);
      formData.append('child_supplement', supplement);
      formData.append('parent_concern', concern);
      formData.append('extra_symptoms', extra);
      formData.append('scores_json', JSON.stringify(scores));
      formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
      deepTracker.drop_point = 'Hoàn thành 100%';
      deepTracker.activeTime += (Date.now() - deepTracker.lastFocus);
      deepTracker.lastFocus = Date.now();
      const da = { ...deepTracker, highlighted: Array.from(deepTracker.highlighted), activeTime: Math.floor(deepTracker.activeTime / 1000) };

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
          // Theo dõi sự kiện hoàn thành
          if (typeof fbq !== 'undefined') {
            fbq('track', 'Lead', { content_name: 'Complete DH Checklist' });
          }
          // Chuyển sang trang kết quả
          window.location.href = '<?php echo site_url('/ket-qua-dh?code='); ?>' + userCode;
      })
      .catch(err => {
          console.error(err);
          // Vẫn chuyển trang dù lỗi kết nối phụ
          window.location.href = '<?php echo site_url('/ket-qua-dh?code='); ?>' + userCode;
      });
    }

    function submitCTA() {
      const phone = document.getElementById('cta-phone').value.trim();
      if (!phone) { alert('Vui lòng nhập số điện thoại để đặt lịch.'); return; }
      alert(`Cảm ơn cha mẹ! Chuyên gia sẽ liên hệ qua số ${phone} trong vòng 24 giờ để tư vấn miễn phí. Mã hồ sơ của con là: ${userCode}`);
      
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Contact');
      }
    }
  </script>
  <?php wp_footer(); ?>
</body>

</html>