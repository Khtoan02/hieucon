<?php
/**
 * Template Name: Trang Check List
 * 
 * @package Hieucon
 */
?>
<?php get_header(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link
  href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Lora:ital,wght@0,400;0,600;1,400;1,600&display=swap"
  rel="stylesheet">

<style>
  :root {
    --cream: #faf7f2;
    --warm-white: #fffef9;
    --sand: #f0e9dc;
    --tc: #c97a55;
    --tc-light: #e8a882;
    --tc-dark: #a85e3a;
    --sage: #7a9e87;
    --sage-light: #a8c4b0;
    --deep: #2d3a35;
    --mid: #4a5e57;
    --soft: #8a9e97;
    --hl: #f5e6d3;
    --border: #e2d8cc;
    --shadow: rgba(45, 58, 53, 0.08);
    --r: 16px;
    --rsm: 10px;
    --rlg: 24px;
  }

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  html {
    scroll-behavior: smooth
  }

  body {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: var(--cream);
    color: var(--deep);
    line-height: 1.7;
    font-size: 16px;
    overflow-x: hidden
  }

  /* HERO */
  .hero {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px 24px 80px;
    position: relative;
    background: linear-gradient(160deg, #fffef9 0%, #f5ede0 60%, #eaddd0 100%);
    overflow: hidden
  }

  .hero::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(122, 158, 135, .12) 0%, transparent 70%);
    top: -100px;
    right: -200px;
    pointer-events: none
  }

  .hero::after {
    content: '';
    position: absolute;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201, 122, 85, .10) 0%, transparent 70%);
    bottom: 0;
    left: -100px;
    pointer-events: none
  }

  .hero-inner {
    max-width: 640px;
    margin: 0 auto;
    position: relative;
    z-index: 1
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(122, 158, 135, .15);
    border: 1px solid rgba(122, 158, 135, .3);
    color: var(--sage);
    font-size: 12.5px;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 100px;
    margin-bottom: 28px;
    animation: fadeUp .6s ease both
  }

  .badge::before {
    content: '●';
    font-size: 8px
  }

  h1 {
    font-family: 'Lora', serif;
    font-size: clamp(28px, 5vw, 44px);
    font-weight: 600;
    line-height: 1.3;
    margin-bottom: 20px;
    animation: fadeUp .6s .1s ease both
  }

  h1 em {
    font-style: italic;
    color: var(--tc)
  }

  .hero-sub {
    font-size: 16.5px;
    color: var(--mid);
    margin-bottom: 36px;
    max-width: 520px;
    animation: fadeUp .6s .2s ease both;
    line-height: 1.75
  }

  .btn-main {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--tc);
    color: white;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 16px;
    font-weight: 600;
    padding: 16px 32px;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .3s ease;
    box-shadow: 0 8px 24px rgba(201, 122, 85, .3);
    animation: fadeUp .6s .3s ease both
  }

  .btn-main:hover {
    background: var(--tc-dark);
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(201, 122, 85, .4)
  }

  .btn-main svg {
    width: 18px;
    height: 18px
  }

  .hero-note {
    margin-top: 16px;
    font-size: 13px;
    color: var(--soft);
    animation: fadeUp .6s .4s ease both;
    display: flex;
    align-items: center;
    gap: 6px
  }

  .hero-visual {
    margin-top: 48px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    animation: fadeUp .6s .5s ease both
  }

  .mini-card {
    background: white;
    border-radius: var(--rsm);
    padding: 12px 16px;
    font-size: 13.5px;
    color: var(--mid);
    border: 1px solid var(--border);
    box-shadow: 0 2px 12px var(--shadow);
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    min-width: 140px
  }

  .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0
  }

  .ds {
    background: #7aafc2
  }

  .db {
    background: #c9906a
  }

  .dg {
    background: #7aa87a
  }

  .da {
    background: #c2a07a
  }

  /* LAYOUT */
  section {
    padding: 72px 24px
  }

  .container {
    max-width: 680px;
    margin: 0 auto
  }

  .section-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--tc);
    margin-bottom: 8px
  }

  .section-title {
    font-family: 'Lora', serif;
    font-size: clamp(22px, 4vw, 30px);
    color: var(--deep);
    margin-bottom: 10px
  }

  .section-body {
    font-size: 15.5px;
    color: var(--mid);
    line-height: 1.75;
    margin-bottom: 8px
  }

  /* EMPATHY */
  .empathy {
    background: var(--warm-white);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border)
  }

  .empathy-list {
    list-style: none;
    margin: 32px 0 28px
  }

  .empathy-list li {
    font-family: 'Lora', serif;
    font-size: 18px;
    font-style: italic;
    color: var(--mid);
    padding: 12px 0 12px 28px;
    border-bottom: 1px solid var(--border);
    position: relative;
    opacity: 0;
    transform: translateX(-12px);
    transition: all .5s ease
  }

  .empathy-list li.visible {
    opacity: 1;
    transform: translateX(0)
  }

  .empathy-list li::before {
    content: '↳';
    position: absolute;
    left: 0;
    color: var(--tc-light)
  }

  .empathy-close {
    font-size: 17px;
    font-weight: 600;
    color: var(--deep);
    border-left: 3px solid var(--tc);
    padding-left: 16px;
    line-height: 1.5
  }

  /* INTRO BOX */
  .intro-box {
    background: var(--hl);
    border-radius: var(--r);
    padding: 32px;
    margin-top: 32px;
    border: 1px solid var(--border)
  }

  .intro-box h3 {
    font-family: 'Lora', serif;
    font-size: 20px;
    margin-bottom: 16px
  }

  .intro-box p {
    font-size: 15px;
    color: var(--mid);
    margin-bottom: 10px
  }

  .meta-tags {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    flex-wrap: wrap
  }

  .meta-tag {
    background: white;
    border: 1px solid var(--border);
    border-radius: 100px;
    padding: 6px 14px;
    font-size: 13px;
    color: var(--mid)
  }

  /* CHECKLIST */
  #checklist-section {
    background: var(--cream)
  }

  .progress-wrap {
    background: white;
    border-radius: var(--r);
    padding: 20px 24px;
    margin-bottom: 32px;
    border: 1px solid var(--border);
    box-shadow: 0 2px 16px var(--shadow);
    position: sticky;
    top: 0;
    z-index: 10
  }

  .progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--mid)
  }

  .progress-bar {
    height: 6px;
    background: var(--sand);
    border-radius: 100px;
    overflow: hidden
  }

  .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--sage), var(--tc));
    border-radius: 100px;
    transition: width .5s ease
  }

  .group-step {
    display: none
  }

  .group-step.active {
    display: block;
    animation: fadeUp .4s ease both
  }

  .group-card {
    background: white;
    border-radius: var(--r);
    padding: 32px 28px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 24px var(--shadow)
  }

  .group-tag {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--tc);
    margin-bottom: 6px
  }

  .group-card h3 {
    font-family: 'Lora', serif;
    font-size: 22px;
    color: var(--deep);
    margin-bottom: 8px
  }

  .group-desc {
    font-size: 14px;
    color: var(--soft);
    margin-bottom: 28px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 20px
  }

  .check-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    cursor: pointer;
    transition: background .2s;
    border-radius: 8px;
    padding: 14px 10px;
    margin: 0 -10px
  }

  .check-item:hover {
    background: var(--hl)
  }

  .check-item input[type=checkbox] {
    display: none
  }

  .check-box {
    width: 24px;
    height: 24px;
    border: 2px solid var(--border);
    border-radius: 6px;
    flex-shrink: 0;
    margin-top: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s ease;
    background: white
  }

  .check-item.checked .check-box {
    background: var(--sage);
    border-color: var(--sage)
  }

  .check-item.checked .check-box::after {
    content: '';
    display: block;
    width: 6px;
    height: 10px;
    border-right: 2px solid white;
    border-bottom: 2px solid white;
    transform: rotate(45deg) translateY(-1px)
  }

  .check-label {
    font-size: 15.5px;
    color: var(--mid);
    line-height: 1.6;
    flex: 1;
    transition: color .2s
  }

  .check-item.checked .check-label {
    color: var(--deep);
    font-weight: 500
  }

  .group-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 32px;
    gap: 12px
  }

  .btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1.5px solid var(--border);
    color: var(--mid);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 15px;
    font-weight: 500;
    padding: 12px 20px;
    border-radius: 100px;
    cursor: pointer;
    transition: all .2s
  }

  .btn-back:hover {
    border-color: var(--mid);
    color: var(--deep)
  }

  .btn-next {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--deep);
    color: white;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 15px;
    font-weight: 600;
    padding: 13px 28px;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    transition: all .3s ease;
    flex: 1;
    justify-content: center;
    max-width: 220px
  }

  .btn-next:hover {
    background: var(--mid)
  }

  /* ════════════════════════════════
   RESULT MODAL
════════════════════════════════ */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(20, 30, 25, .65);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    z-index: 200;
    align-items: flex-start;
    justify-content: center;
    padding: 20px 16px 40px;
    overflow-y: auto
  }

  .modal-overlay.open {
    display: flex
  }

  .modal-card {
    background: var(--warm-white);
    border-radius: var(--rlg);
    width: 100%;
    max-width: 580px;
    margin: auto;
    box-shadow: 0 32px 80px rgba(0, 0, 0, .25);
    animation: modalIn .4s cubic-bezier(.34, 1.56, .64, 1) both;
    overflow: hidden;
    position: relative
  }

  .modal-view {
    display: none
  }

  .modal-view.active {
    display: block
  }

  /* View 1 – Results */
  .mv-header {
    background: linear-gradient(135deg, var(--deep) 0%, #3d5249 100%);
    padding: 32px 32px 28px;
    position: relative
  }

  .mv-close {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .12);
    border: none;
    color: rgba(255, 255, 255, .7);
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s
  }

  .mv-close:hover {
    background: rgba(255, 255, 255, .22);
    color: white
  }

  .r-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px
  }

  .bl {
    background: rgba(120, 200, 150, .2);
    color: #8fd4ab;
    border: 1px solid rgba(120, 200, 150, .3)
  }

  .bm {
    background: rgba(255, 180, 80, .2);
    color: #f5c167;
    border: 1px solid rgba(255, 180, 80, .3)
  }

  .bh {
    background: rgba(220, 100, 70, .2);
    color: #f5967a;
    border: 1px solid rgba(220, 100, 70, .3)
  }

  .mv-title {
    font-family: 'Lora', serif;
    font-size: 22px;
    font-weight: 600;
    color: white;
    line-height: 1.35;
    margin-bottom: 10px
  }

  .mv-sub {
    font-size: 14px;
    color: rgba(255, 255, 255, .6);
    line-height: 1.6
  }

  .mv-body {
    padding: 28px 32px
  }

  .r-text {
    font-size: 15px;
    color: var(--mid);
    line-height: 1.75;
    margin-bottom: 24px;
    padding: 16px 20px;
    background: var(--hl);
    border-radius: var(--rsm);
    border-left: 3px solid var(--tc-light)
  }

  .score-rows {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 22px
  }

  .srow {
    display: grid;
    grid-template-columns: 110px 1fr 38px;
    align-items: center;
    gap: 10px
  }

  .sl {
    font-size: 12.5px;
    color: var(--mid);
    font-weight: 500;
    text-align: right
  }

  .sbw {
    height: 8px;
    background: var(--sand);
    border-radius: 100px;
    overflow: hidden
  }

  .sb {
    height: 100%;
    border-radius: 100px;
    transition: width .9s ease
  }

  .sc {
    font-size: 11.5px;
    color: var(--soft);
    text-align: right;
    white-space: nowrap
  }

  .total-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: var(--deep);
    border-radius: var(--rsm);
    margin-bottom: 26px
  }

  .total-row .tl {
    font-size: 14px;
    color: rgba(255, 255, 255, .65)
  }

  .total-row .tv {
    font-size: 18px;
    font-weight: 700;
    color: white
  }

  .total-row .ts {
    font-size: 12px;
    color: rgba(255, 255, 255, .4);
    text-align: right
  }

  .modal-actions {
    display: flex;
    flex-direction: column;
    gap: 10px
  }

  .act-btn {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 22px;
    border-radius: var(--rsm);
    border: 1.5px solid var(--border);
    background: white;
    cursor: pointer;
    transition: all .25s ease;
    font-family: 'Be Vietnam Pro', sans-serif;
    text-align: left
  }

  .act-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px var(--shadow)
  }

  .act-btn.pri {
    background: var(--tc);
    border-color: var(--tc);
    color: white
  }

  .act-btn.pri:hover {
    background: var(--tc-dark);
    box-shadow: 0 8px 24px rgba(201, 122, 85, .35)
  }

  .act-btn.sec {
    background: var(--deep);
    border-color: var(--deep);
    color: white
  }

  .act-btn.sec:hover {
    background: var(--mid);
    box-shadow: 0 8px 24px rgba(45, 58, 53, .25)
  }

  .act-btn.ghost {
    color: var(--soft);
    font-size: 14px
  }

  .act-btn.ghost:hover {
    color: var(--mid)
  }

  .ai {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0
  }

  .ai.w {
    background: rgba(255, 255, 255, .2)
  }

  .ai.d {
    background: rgba(255, 255, 255, .15)
  }

  .ai.g {
    background: var(--sand)
  }

  .at {
    flex: 1
  }

  .at-title {
    font-size: 15px;
    font-weight: 700;
    display: block;
    margin-bottom: 2px
  }

  .at-sub {
    font-size: 12.5px;
    opacity: .75
  }

  /* View 2 – Info form */
  .mv-info {
    padding: 36px 32px
  }

  .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: none;
    border: none;
    color: var(--soft);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    margin-bottom: 24px;
    font-family: 'Be Vietnam Pro', sans-serif;
    transition: color .2s
  }

  .back-btn:hover {
    color: var(--mid)
  }

  .mv-info h3 {
    font-family: 'Lora', serif;
    font-size: 22px;
    color: var(--deep);
    margin-bottom: 8px
  }

  .info-ctx {
    font-size: 14.5px;
    color: var(--soft);
    margin-bottom: 22px;
    line-height: 1.65
  }

  .ibadge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 16px;
    border-radius: 100px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px
  }

  .ipdf {
    background: #e8f0fe;
    color: #3d5af1
  }

  .isend {
    background: #e6f4ea;
    color: #1e7e34
  }

  .field-group {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 20px
  }

  .fw {
    display: flex;
    flex-direction: column;
    gap: 6px
  }

  .fw label {
    font-size: 13px;
    font-weight: 700;
    color: var(--mid);
    text-transform: uppercase;
    letter-spacing: .06em
  }

  .fw input {
    background: var(--cream);
    border: 1.5px solid var(--border);
    border-radius: var(--rsm);
    padding: 13px 16px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 15px;
    color: var(--deep);
    outline: none;
    transition: border-color .2s
  }

  .fw input:focus {
    border-color: var(--sage);
    background: white
  }

  .fw input::placeholder {
    color: var(--soft)
  }

  .fw input.err {
    border-color: #e05c3a
  }

  .sub-btn {
    width: 100%;
    padding: 16px;
    border-radius: 100px;
    border: none;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all .3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px
  }

  .sub-pdf {
    background: #3d5af1;
    color: white;
    box-shadow: 0 8px 24px rgba(61, 90, 241, .3)
  }

  .sub-pdf:hover {
    background: #2d47d4;
    transform: translateY(-2px)
  }

  .sub-send {
    background: var(--sage);
    color: white;
    box-shadow: 0 8px 24px rgba(122, 158, 135, .35)
  }

  .sub-send:hover {
    background: #648a72;
    transform: translateY(-2px)
  }

  .field-legal {
    text-align: center;
    font-size: 12px;
    color: var(--soft);
    margin-top: 12px;
    line-height: 1.6
  }

  /* View 3 – Success */
  .mv-success {
    padding: 56px 32px;
    text-align: center
  }

  .sicon {
    font-size: 56px;
    margin-bottom: 20px;
    display: block
  }

  .mv-success h3 {
    font-family: 'Lora', serif;
    font-size: 24px;
    color: var(--deep);
    margin-bottom: 12px
  }

  .mv-success p {
    font-size: 15px;
    color: var(--mid);
    line-height: 1.7;
    margin-bottom: 28px
  }

  .sactions {
    display: flex;
    flex-direction: column;
    gap: 10px
  }

  /* Spinner overlay inside modal */
  .gen-overlay {
    position: absolute;
    inset: 0;
    background: rgba(250, 247, 242, .92);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 16px;
    z-index: 10;
    border-radius: var(--rlg)
  }

  .gen-overlay.show {
    display: flex
  }

  .spinner {
    width: 44px;
    height: 44px;
    border: 3px solid var(--border);
    border-top-color: var(--tc);
    border-radius: 50%;
    animation: spin .8s linear infinite
  }

  .gen-text {
    font-size: 15px;
    color: var(--mid);
    font-weight: 500
  }

  /* POST-CHECKLIST SECTIONS */
  .post {
    display: none
  }

  .post.on {
    display: block;
    animation: fadeUp .5s ease both
  }

  .closing {
    background: var(--warm-white);
    padding: 64px 24px;
    border-top: 1px solid var(--border)
  }

  .closing blockquote {
    font-family: 'Lora', serif;
    font-size: 19px;
    font-style: italic;
    color: var(--mid);
    border-left: 3px solid var(--tc-light);
    padding-left: 24px;
    line-height: 1.75;
    margin: 24px 0
  }

  .next-steps {
    background: var(--cream);
    padding: 72px 24px
  }

  .next-grid {
    display: grid;
    gap: 16px;
    grid-template-columns: 1fr 1fr
  }

  .ncard {
    background: white;
    border-radius: var(--r);
    padding: 24px;
    border: 1px solid var(--border);
    transition: transform .3s ease, box-shadow .3s ease
  }

  .ncard:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px var(--shadow)
  }

  .nicon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 14px
  }

  .ifb {
    background: #e8eeff
  }

  .iza {
    background: #e8f5ff
  }

  .img {
    background: #fdf0e8
  }

  .iph {
    background: #edf5ed
  }

  .ncard h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--deep);
    margin-bottom: 6px
  }

  .ncard p {
    font-size: 13.5px;
    color: var(--soft);
    margin-bottom: 16px;
    line-height: 1.6
  }

  .btn-ch {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--tc);
    text-decoration: none;
    border: 1.5px solid var(--tc);
    padding: 8px 16px;
    border-radius: 100px;
    transition: all .2s
  }

  .btn-ch:hover {
    background: var(--tc);
    color: white
  }

  footer.post {
    background: var(--deep);
    color: rgba(255, 255, 255, .4);
    font-size: 13px;
    padding: 36px 24px;
    line-height: 1.8
  }

  footer strong {
    color: rgba(255, 255, 255, .65)
  }

  /* PRINT AREA (screen: hidden) */
  #print-area {
    display: none;
  }


  /* PRINT STYLES */
  @media print {
    body>*:not(#print-area) {
      display: none !important;
    }

    #print-area {
      display: block !important;
      font-family: 'Be Vietnam Pro', Georgia, serif;
      color: #2d3a35;
      background: white;
      padding: 0;
      margin: 0;
    }

    .pp {
      padding: 40px 48px;
      background: white;
    }

    .ph {
      border-bottom: 2px solid #e2d8cc;
      padding-bottom: 20px;
      margin-bottom: 24px;
    }

    .plr {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .plogo {
      font-size: 11px;
      color: #8a9e97;
      font-style: italic;
    }

    .pdate {
      font-size: 10px;
      color: #8a9e97;
    }

    .ptitle {
      font-size: 22px;
      font-weight: 700;
      color: #2d3a35;
      margin-bottom: 5px;
    }

    .psub {
      font-size: 12px;
      color: #4a5e57;
    }

    .pinforow {
      display: flex;
      gap: 20px;
      margin: 14px 0;
      padding: 12px 14px;
      background: #f5f5f5;
      border-radius: 6px;
      font-size: 12px;
    }

    .pbadge {
      display: inline-block;
      margin: 14px 0 5px;
      padding: 4px 14px;
      border-radius: 100px;
      font-size: 12px;
      font-weight: 700;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .pbadge.low {
      background: #e8f5ec !important;
      color: #3a7a50 !important;
    }

    .pbadge.mid {
      background: #fff3e8 !important;
      color: #c07a35 !important;
    }

    .pbadge.high {
      background: #fdeee8 !important;
      color: #b85a35 !important;
    }

    .prtitle {
      font-size: 17px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .prbody {
      font-size: 12.5px;
      color: #4a5e57;
      line-height: 1.7;
      margin-bottom: 20px;
      padding: 12px 14px;
      background: #f5e6d3 !important;
      border-radius: 6px;
      border-left: 3px solid #e8a882;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .pstitle {
      font-size: 13px;
      font-weight: 700;
      color: #2d3a35;
      margin-bottom: 10px;
      padding-bottom: 6px;
      border-bottom: 1px solid #e2d8cc;
    }

    .psrow {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 8px;
    }

    .pslab {
      width: 110px;
      font-size: 11px;
      color: #4a5e57;
      flex-shrink: 0;
      text-align: right;
    }

    .psbg {
      flex: 1;
      height: 8px;
      background: #f0e9dc !important;
      border-radius: 4px;
      overflow: hidden;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .psfill {
      height: 100%;
      border-radius: 4px;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .psct {
      width: 40px;
      font-size: 10px;
      color: #8a9e97;
      text-align: right;
    }

    .pgname {
      font-size: 12.5px;
      font-weight: 700;
      color: #2d3a35;
      margin: 14px 0 5px;
    }

    .pitem {
      font-size: 11.5px;
      color: #4a5e57;
      padding: 3px 0 3px 18px;
      position: relative;
    }

    .pitem::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: #7a9e87;
      font-weight: 700;
    }

    .pfooter {
      margin-top: 32px;
      padding-top: 16px;
      border-top: 1px solid #e2d8cc;
      font-size: 10.5px;
      color: #8a9e97;
      line-height: 1.6;
    }
  }

  /* ANIMATIONS */
  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(20px)
    }

    to {
      opacity: 1;
      transform: translateY(0)
    }
  }

  @keyframes modalIn {
    from {
      opacity: 0;
      transform: scale(.93) translateY(20px)
    }

    to {
      opacity: 1;
      transform: scale(1) translateY(0)
    }
  }

  @keyframes spin {
    to {
      transform: rotate(360deg)
    }
  }

  @media(max-width:520px) {
    .next-grid {
      grid-template-columns: 1fr
    }

    .srow {
      grid-template-columns: 80px 1fr 32px
    }

    .sl {
      font-size: 11px
    }

    .mv-header,
    .mv-body,
    .mv-info {
      padding-left: 20px;
      padding-right: 20px
    }

    .modal-overlay {
      padding: 10px 10px 32px
    }
  }
</style>
<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <div class="badge">Công cụ tự đối chiếu cho cha mẹ</div>
    <h1>Trẻ tự kỷ — Điều gì đang diễn ra trong <em>hệ thần kinh</em> của con?</h1>
    <p class="hero-sub">Con tăng động hơn, ngủ kém hơn, dễ kích thích, có lúc như thoái lui…<br>nhưng cha mẹ vẫn chưa
      thật sự hiểu vì sao?<br><br>Thực hiện checklist 2–3 phút để đối chiếu những dấu hiệu thường bị bỏ qua khi nghi ngờ
      con có tình trạng <strong>viêm trong hệ thần kinh</strong>.</p>
    <a href="#checklist-section" class="btn-main" onclick="startCL()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
      </svg>
      Bắt đầu checklist
    </a>
    <p class="hero-note">Không dùng để chẩn đoán · Chỉ giúp nhận ra các nhóm dấu hiệu đáng lưu ý</p>
    <div class="hero-visual">
      <div class="mini-card">
        <div class="dot ds"></div>Giấc ngủ
      </div>
      <div class="mini-card">
        <div class="dot db"></div>Hành vi
      </div>
      <div class="mini-card">
        <div class="dot dg"></div>Tiêu hóa
      </div>
      <div class="mini-card">
        <div class="dot da"></div>Dị ứng & da
      </div>
    </div>
  </div>
</section>

<!-- EMPATHY -->
<section class="empathy">
  <div class="container">
    <div class="section-label">Cha mẹ đang thấy gì?</div>
    <div class="section-title">Những điều cha mẹ thường thấy nhưng khó lý giải</div>
    <ul class="empathy-list">
      <li>Càng về tối, con càng khó yên?</li>
      <li>Con ngủ chập chờn, dễ thức giữa đêm, sáng dậy vật vã?</li>
      <li>Có lúc con tăng động rõ hơn, dễ bùng hơn, khó học hơn?</li>
      <li>Có giai đoạn con tiến bộ rồi lại tụt xuống rất khó hiểu?</li>
      <li>Tiêu hóa, dị ứng, da, giấc ngủ và hành vi như đang rối cùng lúc?</li>
    </ul>
    <p class="empathy-close">Có thể những điều cha mẹ đang thấy không hề rời rạc.</p>
  </div>
</section>

<!-- INTRO -->
<section style="background:var(--warm-white);padding:64px 24px">
  <div class="container">
    <div class="section-label">Checklist này dành cho ai?</div>
    <div class="section-title">Checklist này giúp cha mẹ nhận ra điều gì?</div>
    <p class="section-body">Checklist được thiết kế để cha mẹ tự đối chiếu những <strong>nhóm dấu hiệu thường xuất hiện
        cùng nhau</strong> khi nghi ngờ con có tình trạng viêm trong hệ thần kinh.</p>
    <p class="section-body">Mục đích là giúp cha mẹ nhìn con theo một <strong>bức tranh toàn diện hơn</strong> — không
      phải từng mảnh rời rạc.</p>
    <div class="intro-box">
      <h3>Trước khi bắt đầu</h3>
      <p>Đây là công cụ hỗ trợ tự nhận diện, <strong>không phải công cụ chẩn đoán y tế</strong>.</p>
      <div class="meta-tags">
        <span class="meta-tag">⏱ 2–3 phút</span>
        <span class="meta-tag">✓ Tick chọn nhanh</span>
        <span class="meta-tag">📊 Kết quả ngay sau khi hoàn thành</span>
      </div>
    </div>
  </div>
</section>

<!-- CHECKLIST -->
<section id="checklist-section">
  <div class="container">
    <div class="progress-wrap">
      <div class="progress-label">
        <span id="p-text">Nhóm 1 / 6</span>
        <span id="p-pct">0%</span>
      </div>
      <div class="progress-bar">
        <div class="progress-fill" id="p-fill" style="width:0%"></div>
      </div>
    </div>

    <!-- Step 0 -->
    <div class="group-step active" id="s0">
      <div class="group-card">
        <div class="group-tag">Nhóm 1 / 6</div>
        <h3>Giấc ngủ & Nhịp sinh học</h3>
        <p class="group-desc">Đánh dấu những biểu hiện cha mẹ nhận thấy ở con trong 1–3 tháng gần đây</p>
        <div id="g0">
          <div class="check-item"><input type="checkbox" data-g="0" data-lb="Con khó vào giấc.">
            <div class="check-box"></div><span class="check-label">Con khó vào giấc.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="0" data-lb="Con ngủ nông, dễ tỉnh giữa đêm.">
            <div class="check-box"></div><span class="check-label">Con ngủ nông, dễ tỉnh giữa đêm.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="0"
              data-lb="Con càng về tối càng tăng động hoặc khó dịu xuống.">
            <div class="check-box"></div><span class="check-label">Con càng về tối càng tăng động hoặc khó dịu
              xuống.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="0" data-lb="Con ngủ dậy vẫn mệt, vật vã hoặc cáu gắt.">
            <div class="check-box"></div><span class="check-label">Con ngủ dậy vẫn mệt, vật vã hoặc cáu gắt.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="0" data-lb="Giấc ngủ của con thất thường kéo dài.">
            <div class="check-box"></div><span class="check-label">Giấc ngủ của con thất thường kéo dài.</span>
          </div>
        </div>
        <div class="group-nav">
          <div></div><button class="btn-next" onclick="nxt(0)">Tiếp theo →</button>
        </div>
      </div>
    </div>

    <!-- Step 1 -->
    <div class="group-step" id="s1">
      <div class="group-card">
        <div class="group-tag">Nhóm 2 / 6</div>
        <h3>Hành vi & Tâm trạng</h3>
        <p class="group-desc">Đánh dấu những biểu hiện cha mẹ nhận thấy ở con trong 1–3 tháng gần đây</p>
        <div id="g1">
          <div class="check-item"><input type="checkbox" data-g="1" data-lb="Con tăng động rõ, khó ngồi yên.">
            <div class="check-box"></div><span class="check-label">Con tăng động rõ, khó ngồi yên.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="1" data-lb="Con dễ kích thích hoặc cáu gắt.">
            <div class="check-box"></div><span class="check-label">Con dễ kích thích hoặc cáu gắt.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="1" data-lb="Con bồn chồn, khó dịu lại.">
            <div class="check-box"></div><span class="check-label">Con bồn chồn, khó dịu lại.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="1"
              data-lb="Có lúc con như tụt đi, chững lại hoặc thoái lui.">
            <div class="check-box"></div><span class="check-label">Có lúc con như tụt đi, chững lại hoặc thoái
              lui.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="1"
              data-lb="Mức độ biểu hiện của con lúc nặng lúc nhẹ rất khó hiểu.">
            <div class="check-box"></div><span class="check-label">Mức độ biểu hiện của con lúc nặng lúc nhẹ rất khó
              hiểu.</span>
          </div>
        </div>
        <div class="group-nav"><button class="btn-back" onclick="prv(1)">← Quay lại</button><button class="btn-next"
            onclick="nxt(1)">Tiếp theo →</button></div>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="group-step" id="s2">
      <div class="group-card">
        <div class="group-tag">Nhóm 3 / 6</div>
        <h3>Tiêu hóa & Đường ruột</h3>
        <p class="group-desc">Đánh dấu những biểu hiện cha mẹ nhận thấy ở con trong 1–3 tháng gần đây</p>
        <div id="g2">
          <div class="check-item"><input type="checkbox" data-g="2" data-lb="Con hay bụng chướng, đầy hơi.">
            <div class="check-box"></div><span class="check-label">Con hay bụng chướng, đầy hơi.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="2" data-lb="Con táo bón hoặc đi tiêu khó.">
            <div class="check-box"></div><span class="check-label">Con táo bón hoặc đi tiêu khó.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="2" data-lb="Con kén ăn hoặc ăn rất giới hạn.">
            <div class="check-box"></div><span class="check-label">Con kén ăn hoặc ăn rất giới hạn.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="2" data-lb="Con có vẻ khó chịu sau ăn.">
            <div class="check-box"></div><span class="check-label">Con có vẻ khó chịu sau ăn.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="2"
              data-lb="Vấn đề tiêu hóa của con kéo dài hoặc lặp đi lặp lại.">
            <div class="check-box"></div><span class="check-label">Vấn đề tiêu hóa của con kéo dài hoặc lặp đi lặp
              lại.</span>
          </div>
        </div>
        <div class="group-nav"><button class="btn-back" onclick="prv(2)">← Quay lại</button><button class="btn-next"
            onclick="nxt(2)">Tiếp theo →</button></div>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="group-step" id="s3">
      <div class="group-card">
        <div class="group-tag">Nhóm 4 / 6</div>
        <h3>Dị ứng – Da – Histamine</h3>
        <p class="group-desc">Đánh dấu những biểu hiện cha mẹ nhận thấy ở con trong 1–3 tháng gần đây</p>
        <div id="g3">
          <div class="check-item"><input type="checkbox" data-g="3" data-lb="Con có eczema, viêm da hoặc da dễ đỏ.">
            <div class="check-box"></div><span class="check-label">Con có eczema, viêm da hoặc da dễ đỏ.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="3" data-lb="Con hay nghẹt mũi, chảy mũi, hắt hơi.">
            <div class="check-box"></div><span class="check-label">Con hay nghẹt mũi, chảy mũi, hắt hơi.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="3"
              data-lb="Con dễ nổi mẩn, ngứa hoặc có biểu hiện dị ứng.">
            <div class="check-box"></div><span class="check-label">Con dễ nổi mẩn, ngứa hoặc có biểu hiện dị ứng.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="3"
              data-lb="Một số biểu hiện nặng hơn theo mùa hoặc theo thức ăn.">
            <div class="check-box"></div><span class="check-label">Một số biểu hiện nặng hơn theo mùa hoặc theo thức
              ăn.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="3"
              data-lb="Da, mũi, dị ứng và hành vi có vẻ liên quan đến nhau.">
            <div class="check-box"></div><span class="check-label">Da, mũi, dị ứng và hành vi có vẻ liên quan đến
              nhau.</span>
          </div>
        </div>
        <div class="group-nav"><button class="btn-back" onclick="prv(3)">← Quay lại</button><button class="btn-next"
            onclick="nxt(3)">Tiếp theo →</button></div>
      </div>
    </div>

    <!-- Step 4 -->
    <div class="group-step" id="s4">
      <div class="group-card">
        <div class="group-tag">Nhóm 5 / 6</div>
        <h3>Những điều cha mẹ thấy nhưng khó lý giải</h3>
        <p class="group-desc">Đánh dấu những điều cha mẹ cảm nhận trong quá trình theo dõi con</p>
        <div id="g4">
          <div class="check-item"><input type="checkbox" data-g="4"
              data-lb="Sau ốm, sau dị ứng hoặc rối loạn tiêu hóa, hành vi của con nặng hơn.">
            <div class="check-box"></div><span class="check-label">Sau ốm, sau dị ứng hoặc rối loạn tiêu hóa, hành vi
              của con nặng hơn.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="4"
              data-lb="Có lúc con như rất khó chịu nhưng không nói ra được.">
            <div class="check-box"></div><span class="check-label">Có lúc con như rất khó chịu nhưng không nói ra
              được.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="4" data-lb="Con học không ổn định.">
            <div class="check-box"></div><span class="check-label">Con học không ổn định.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="4" data-lb="Con tiến bộ rồi lại tụt xuống.">
            <div class="check-box"></div><span class="check-label">Con tiến bộ rồi lại tụt xuống.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="4"
              data-lb="Cha mẹ luôn cảm thấy có gì đó không ổn nhưng chưa ghép lại được.">
            <div class="check-box"></div><span class="check-label">Cha mẹ luôn cảm thấy "có gì đó không ổn" nhưng chưa
              ghép lại được.</span>
          </div>
        </div>
        <div class="group-nav"><button class="btn-back" onclick="prv(4)">← Quay lại</button><button class="btn-next"
            onclick="nxt(4)">Tiếp theo →</button></div>
      </div>
    </div>

    <!-- Step 5 -->
    <div class="group-step" id="s5">
      <div class="group-card">
        <div class="group-tag">Nhóm 6 / 6</div>
        <h3>Bức tranh tổng thể</h3>
        <p class="group-desc">Nhóm cuối — đánh dấu những nhận định tổng quan của cha mẹ về con</p>
        <div id="g5">
          <div class="check-item"><input type="checkbox" data-g="5" data-lb="Con có dấu hiệu ở nhiều nhóm cùng lúc.">
            <div class="check-box"></div><span class="check-label">Con có dấu hiệu ở nhiều nhóm cùng lúc.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="5"
              data-lb="Vấn đề hành vi đi kèm vấn đề ruột, da, dị ứng hoặc giấc ngủ.">
            <div class="check-box"></div><span class="check-label">Vấn đề hành vi đi kèm vấn đề ruột, da, dị ứng hoặc
              giấc ngủ.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="5"
              data-lb="Nhiều biểu hiện của con không giống các vấn đề hành vi đơn thuần.">
            <div class="check-box"></div><span class="check-label">Nhiều biểu hiện của con không giống các vấn đề hành
              vi đơn thuần.</span>
          </div>
          <div class="check-item"><input type="checkbox" data-g="5"
              data-lb="Cha mẹ muốn nhìn con theo một góc nhìn toàn diện hơn.">
            <div class="check-box"></div><span class="check-label">Cha mẹ muốn nhìn con theo một góc nhìn toàn diện
              hơn.</span>
          </div>
        </div>
        <div class="group-nav">
          <button class="btn-back" onclick="prv(5)">← Quay lại</button>
          <button class="btn-next" onclick="showModal()" style="background:var(--tc)">Xem kết quả ✓</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════
     RESULT MODAL
════════════════════════════════ -->
<div class="modal-overlay" id="modal">
  <div class="modal-card">

    <!-- Spinner -->
    <div class="gen-overlay" id="gen">
      <div class="spinner"></div>
      <div class="gen-text" id="gen-msg">Đang xử lý…</div>
    </div>

    <!-- VIEW 1: RESULTS -->
    <div class="modal-view active" id="v-result">
      <div class="mv-header">
        <button class="mv-close" onclick="closeModal()" title="Đóng">✕</button>
        <div class="r-badge" id="rb"></div>
        <div class="mv-title" id="rt"></div>
        <div class="mv-sub" id="rs"></div>
      </div>
      <div class="mv-body">
        <div class="r-text" id="rbody"></div>
        <div class="score-rows" id="score-rows"></div>
        <div class="total-row">
          <div class="tl">Tổng dấu hiệu ghi nhận</div>
          <div style="text-align:right">
            <div class="tv" id="rtotal"></div>
            <div class="ts" id="rgs"></div>
          </div>
        </div>
        <div class="modal-actions">
          <button class="act-btn pri" onclick="toInfo('pdf')">
            <div class="ai w">📥</div>
            <div class="at"><span class="at-title">Tải kết quả dạng PDF</span><span class="at-sub">Lưu kết quả</span>
            </div>
          </button>
          <button class="act-btn sec" onclick="toInfo('send')">
            <div class="ai d">📨</div>
            <div class="at"><span class="at-title">Gửi kết quả để được tư vấn</span><span class="at-sub">Nhận tư vấn và
                hỗ trợ trực tiếp</span></div>
          </button>
          <button class="act-btn ghost" onclick="ghostView()">
            <div class="ai g">👁</div>
            <div class="at"><span class="at-title">Chỉ xem trên trang</span><span class="at-sub">Không cần để lại thông
                tin — xem ngay bên dưới</span></div>
          </button>
        </div>
      </div>
    </div>

    <!-- VIEW 2: INFO FORM -->
    <div class="modal-view" id="v-info">
      <div class="mv-info">
        <button class="back-btn" onclick="toView('result')">← Quay lại kết quả</button>
        <div class="ibadge" id="ib"></div>
        <h3 id="iform-title"></h3>
        <p class="info-ctx" id="iform-ctx"></p>
        <div class="field-group">
          <div class="fw"><label>Họ và tên cha / mẹ</label><input type="text" id="fn"
              placeholder="Ví dụ: Nguyễn Thị Lan"></div>
          <div class="fw"><label>Số điện thoại / Zalo</label><input type="tel" id="fp"
              placeholder="Ví dụ: 0912 345 678"></div>
        </div>
        <button class="sub-btn" id="sbtn" onclick="doSubmit()"></button>
        <p class="field-legal">Thông tin được bảo mật · Không dùng cho mục đích quảng cáo</p>
      </div>
    </div>

    <!-- VIEW 3: SUCCESS -->
    <div class="modal-view" id="v-success">
      <div class="mv-success">
        <span class="sicon" id="sicon"></span>
        <h3 id="stitle"></h3>
        <p id="sbody"></p>
        <div class="sactions">
          <button class="act-btn pri" onclick="closeModal()" style="justify-content:center">
            <div class="at" style="text-align:center"><span class="at-title">Xem hướng đi tiếp theo</span></div>
          </button>
          <button class="act-btn ghost" onclick="closeModal()" style="justify-content:center">
            <div class="at" style="text-align:center"><span class="at-title">Đóng</span></div>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- POST SECTIONS -->
<section class="closing post" id="pc">
  <div class="container">
    <div class="section-label">Sau checklist</div>
    <div class="section-title">Điều quan trọng không phải là hoang mang</div>
    <blockquote>Mà là bắt đầu nhìn con đầy đủ hơn.</blockquote>
    <p class="section-body">Nếu con có nhiều dấu hiệu xuất hiện cùng lúc — đặc biệt ở các nhóm như tăng động, mất ngủ,
      thoái lui, tiêu hóa, dị ứng hoặc da — cha mẹ không nên chỉ nhìn từng biểu hiện riêng lẻ nữa.</p>
    <p class="section-body" style="margin-top:12px">Có thể con không chỉ đang có vấn đề về hành vi.<br>Mà cơ thể và hệ
      thần kinh của con đang cần được nhìn sâu hơn.</p>
  </div>
</section>

<section class="next-steps post" id="pn">
  <div class="container">
    <div class="section-label">Hướng đi tiếp theo</div>
    <div class="section-title">Cha mẹ muốn đi tiếp từ đây?</div>
    <p style="font-size:15px;color:var(--soft);margin-bottom:32px">Chọn kênh phù hợp nhất với cha mẹ lúc này</p>
    <div class="next-grid">
      <div class="ncard">
        <div class="nicon ifb">📘</div>
        <h4>Đọc thêm kiến thức nền tảng</h4>
        <p>Cộng đồng Facebook<br><strong>Hiểu con từ Gốc</strong><br>Tự kỷ là Rối loạn toàn thân</p><a href="#"
          class="btn-ch">Tham gia cộng đồng →</a>
      </div>
      <div class="ncard">
        <div class="nicon iza">💬</div>
        <h4>Theo dõi cập nhật gần hơn</h4>
        <p>Group Zalo<br><strong>Hiểu con từ Gốc</strong><br>Tự kỷ là Rối loạn toàn thân</p><a href="#"
          class="btn-ch">Vào Group Zalo →</a>
      </div>
      <div class="ncard">
        <div class="nicon img">✉️</div>
        <h4>Nhắn tin để được hỗ trợ</h4>
        <p>Hỗ trợ trực tiếp qua Page</p><a href="https://m.me/884864428052710?ref=1002533683" target="_blank"
          class="btn-ch">Nhắn Page →</a>
      </div>
      <div class="ncard">
        <div class="nicon iph">📞</div>
        <h4>Trao đổi nhanh qua Zalo</h4>
        <p>Hotline / Zalo<br><strong>0988.71.71.07</strong></p><a href="tel:0988717107" class="btn-ch">Liên hệ ngay
          →</a>
      </div>
    </div>
  </div>
</section>

<footer class="post" id="pf">
  <div style="max-width:680px;margin:0 auto">
    <p><strong>Lưu ý quan trọng:</strong> Đây không phải công cụ chẩn đoán. Nội dung mang tính hỗ trợ nhận diện và định
      hướng theo dõi.</p><br>
    <p>Nội dung checklist được xây dựng từ góc nhìn về viêm thần kinh trong rối loạn phổ tự kỷ, dựa trên bài nói chuyện
      <em>"Neuro-inflammation in Autism Spectrum Disorders"</em> của <strong>Michael W. Elice, MD</strong>.</p><br>
    <p style="color:rgba(255,255,255,.2)">© 2025 – Hiểu con từ Gốc · Tự kỷ là Rối loạn toàn thân</p>
  </div>
</footer>

<script>
  /* ── Cookie helpers ── */
  function setCookie(name, val, days) { const d = new Date(); d.setTime(d.getTime() + days * 864e5); document.cookie = name + '=' + encodeURIComponent(val) + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax' }
  function getCookie(name) { const m = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)'); return m ? decodeURIComponent(m.pop()) : '' }

  /* ── Constants ── */
  const GN = ['Giấc ngủ & Nhịp sinh học', 'Hành vi', 'Tiêu hóa & Đường ruột', 'Dị ứng – Da – Histamine', 'Quan sát của cha mẹ', 'Bức tranh tổng thể'];
  const GC = ['#7aafc2', '#c9906a', '#7aa87a', '#c2a07a', '#a07ac2', '#7a8ec2'];
  const GM = [5, 5, 5, 5, 5, 4];
  const TMAX = 29;

  let step = 0, scores = [], action = null, uName = '', uPhone = '';

  /* ── Checkboxes ── */
  document.querySelectorAll('.check-item').forEach(el => {
    el.addEventListener('click', function (e) {
      if (e.target.tagName === 'INPUT') return;
      const cb = this.querySelector('input');
      cb.checked = !cb.checked;
      this.classList.toggle('checked', cb.checked);
    });
  });
  document.querySelectorAll('.check-item input').forEach(cb => {
    cb.addEventListener('change', function () { this.closest('.check-item').classList.toggle('checked', this.checked) });
  });

  /* ── Nav ── */
  function nxt(f) { document.getElementById('s' + f).classList.remove('active'); step = f + 1; document.getElementById('s' + step).classList.add('active'); prog(); sc('#checklist-section') }
  function prv(f) { document.getElementById('s' + f).classList.remove('active'); step = f - 1; document.getElementById('s' + step).classList.add('active'); prog(); sc('#checklist-section') }
  function prog() { const p = Math.round(step / 6 * 100); document.getElementById('p-fill').style.width = p + '%'; document.getElementById('p-text').textContent = 'Nhóm ' + (step + 1) + ' / 6'; document.getElementById('p-pct').textContent = p + '%' }
  function sc(sel) { setTimeout(() => document.querySelector(sel)?.scrollIntoView({ behavior: 'smooth', block: 'start' }), 60) }
  function startCL() { setTimeout(() => document.getElementById('checklist-section').scrollIntoView({ behavior: 'smooth', block: 'start' }), 100) }

  /* ── Compute & show modal ── */
  function showModal() {
    scores = []; let tot = 0, sig = 0;
    for (let g = 0; g < 6; g++) {
      const mx = GM[g], ch = document.querySelectorAll('#g' + g + ' input:checked').length, pt = Math.round(ch / mx * 100);
      scores.push({ ch, mx, pt }); tot += ch; if (ch >= 2) sig++;
    }
    let lv, bc, ti, su, bo;
    if (sig <= 1) { lv = '🌱 Ít dấu hiệu'; bc = 'bl'; ti = 'Cha mẹ ghi nhận ít dấu hiệu đáng lưu ý'; su = 'Con có thể đang ở trạng thái ổn định hơn lúc này'; bo = 'Con có thể đang ổn định hơn trong giai đoạn này. Nếu trong tương lai cha mẹ nhận thấy nhiều biểu hiện hơn xuất hiện cùng lúc, hãy quay lại đối chiếu lần nữa.' }
    else if (sig <= 3) { lv = '⚠️ Dấu hiệu ở vài nhóm'; bc = 'bm'; ti = 'Có một số nhóm dấu hiệu đáng chú ý'; su = 'Dấu hiệu xuất hiện ở ' + sig + '/6 nhóm — nên nhìn tổng thể hơn'; bo = 'Cha mẹ đang ghi nhận các dấu hiệu ở nhiều nhóm khác nhau. Khi một số hệ như giấc ngủ, hành vi hoặc tiêu hóa cùng bị ảnh hưởng, rất có thể có một yếu tố nền đang tác động lên toàn thân và hệ thần kinh của con.' }
    else { lv = '🔍 Nhiều nhóm cùng lúc'; bc = 'bh'; ti = 'Cha mẹ ghi nhận nhiều dấu hiệu ở nhiều nhóm'; su = 'Dấu hiệu xuất hiện ở ' + sig + '/6 nhóm — cần nhìn con toàn diện hơn'; bo = 'Khi tăng động, mất ngủ, tiêu hóa, dị ứng và tiến triển chậm cùng xuất hiện, rất có thể cơ thể và hệ thần kinh của con đang cần được nhìn sâu hơn. Cha mẹ không nên tự xử lý một mình.' }

    document.getElementById('rb').className = 'r-badge ' + bc;
    document.getElementById('rb').textContent = lv;
    document.getElementById('rt').textContent = ti;
    document.getElementById('rs').textContent = su;
    document.getElementById('rbody').textContent = bo;
    document.getElementById('rtotal').textContent = tot + '/' + TMAX + ' dấu hiệu';
    document.getElementById('rgs').textContent = sig + '/6 nhóm có dấu hiệu rõ';
    document.getElementById('score-rows').innerHTML = scores.map((s, i) => `<div class="srow"><div class="sl">${GN[i].split(' & ')[0].split(' – ')[0]}</div><div class="sbw"><div class="sb" style="width:0%;background:${GC[i]}" data-pt="${s.pt}"></div></div><div class="sc">${s.ch}/${s.mx}</div></div>`).join('');

    document.getElementById('p-fill').style.width = '100%';
    document.getElementById('p-text').textContent = 'Hoàn thành ✓';
    document.getElementById('p-pct').textContent = '100%';

    tr_result_level  = lv;
    tr_result_score  = tot + '/' + TMAX;
    tr_result_groups = sig + '/6';
    tr_result_title  = ti;
    tr_result_body   = bo;
    tr_result_badge  = bc;
    tr_scores_json   = JSON.stringify(scores.map((s, i) => ({ g: GN[i], ch: s.ch, mx: s.mx, pt: s.pt, color: GC[i] })));

    // Build behaviors by group (dùng cho /ket-qua?p= page)
    var bgGroups = [];
    for (var _g = 0; _g < 6; _g++) {
      var _its = document.querySelectorAll('#g' + _g + ' input:checked');
      if (_its.length) {
        var _items = [];
        _its.forEach(function(cb) { _items.push(cb.dataset.lb); });
        bgGroups.push({ group: GN[_g], items: _items });
      }
    }

    // Full snapshot — đủ để render lại y hệt modal
    tr_snapshot = JSON.stringify({
      level: lv, badge: bc,
      title: ti, subtitle: su, body: bo,
      score: tot + '/' + TMAX, total: tot, groups_sig: sig,
      scores: scores.map((s, i) => ({ g: GN[i], ch: s.ch, mx: s.mx, pt: s.pt, color: GC[i] })),
      behaviors_by_group: bgGroups
    });

    updateTracker();

    toView('result');
    document.getElementById('modal').classList.add('open');
    document.body.style.overflow = 'hidden';

    setTimeout(() => document.querySelectorAll('.sb').forEach(b => { b.style.transition = 'width .9s ease'; b.style.width = b.dataset.pt + '%' }), 220);
  }

  function toView(v) {
    document.querySelectorAll('.modal-view').forEach(e => e.classList.remove('active'));
    document.getElementById('v-' + v).classList.add('active');
    document.querySelector('.modal-card').scrollTop = 0;
  }

  function toInfo(act) {
    action = act;
    if (act === 'pdf') {
      document.getElementById('ib').className = 'ibadge ipdf'; document.getElementById('ib').textContent = '📥 Tải kết quả PDF';
      document.getElementById('iform-title').textContent = 'Để tải file kết quả';
      document.getElementById('iform-ctx').textContent = 'Cha mẹ để lại thông tin để tải file PDF kết quả checklist — có thể in và mang theo khi gặp bác sĩ hoặc chuyên gia.';
      const b = document.getElementById('sbtn'); b.textContent = '📥 Tải PDF ngay'; b.className = 'sub-btn sub-pdf';
    } else {
      document.getElementById('ib').className = 'ibadge isend'; document.getElementById('ib').textContent = '📨 Gửi cho trợ lý';
      document.getElementById('iform-title').textContent = 'Để gửi kết quả để được tư vấn';
      document.getElementById('iform-ctx').textContent = 'Cha mẹ để lại thông tin để nhận kết quả và hỗ trợ, tư vấn trực tiếp qua Zalo.';
      const b = document.getElementById('sbtn'); b.textContent = '📨 Gửi kết quả'; b.className = 'sub-btn sub-send';
    }
    document.getElementById('fn').value = ''; document.getElementById('fp').value = '';
    toView('info');
  }

  async function doSubmit() {
    const n = document.getElementById('fn').value.trim(), p = document.getElementById('fp').value.trim();
    if (!n) { errField('fn'); return }
    if (!p) { errField('fp'); return }
    uName = n; uPhone = p;
    // Lưu cookie 1 năm để auto-fill lần sau
    setCookie('hieucon_name', n, 365);
    setCookie('hieucon_phone', p, 365);

    // Cập nhật kết quả cuối cùng vào các biến tracking
    tr_method = action;
    tr_result_level = document.getElementById('rb').textContent;
    tr_result_score = document.getElementById('rtotal').textContent;
    tr_result_groups = document.getElementById('rgs').textContent;

    document.getElementById('gen-msg').textContent = 'Đang lưu kết quả...';
    document.getElementById('gen').classList.add('show');

    try {
      // Gửi dữ liệu tracking quan trọng (Tên, SĐT, Kết quả)
      await updateTracker(false);
    } catch (e) { console.error('Tracking failed', e); }

    if (action === 'pdf') {
      document.getElementById('gen-msg').textContent = 'Đang tạo báo cáo kết quả...';
      setTimeout(() => { genPDF(n, p); }, 400);
    } else {
      fakeSend(n, p);
    }
  }
  function errField(id) { const e = document.getElementById(id); e.classList.add('err'); e.focus(); setTimeout(() => e.classList.remove('err'), 2000) }

  /* ── PDF: sử dụng window.print() với #print-area đã có sẵn ── */
  function genPDF(name, phone) {
    var badge = document.getElementById('rb');
    var bc = badge.className.includes('bl') ? 'low' : badge.className.includes('bm') ? 'mid' : 'high';
    var btext = badge.textContent;
    var rtitle = document.getElementById('rt').textContent;
    var rbody = document.getElementById('rbody').textContent;
    var rtotal = document.getElementById('rtotal').textContent;
    var rgs = document.getElementById('rgs').textContent;
    var now = new Date().toLocaleDateString('vi-VN');

    // Score rows HTML (dùng print CSS classes)
    var scRows = '';
    for (var i = 0; i < scores.length; i++) {
      var s = scores[i];
      var lbl = GN[i].split(' & ')[0].split(' – ')[0];
      scRows += '<div class="psrow"><div class="pslab">' + lbl + '</div><div class="psbg"><div class="psfill" style="width:' + s.pt + '%;background-color:' + GC[i] + ' !important"></div></div><div class="psct">' + s.ch + '/' + s.mx + '</div></div>';
    }

    // Danh sách dấu hiệu đã tick
    var blistH = '';
    for (var g = 0; g < 6; g++) {
      var its = document.querySelectorAll('#g' + g + ' input:checked');
      if (its.length) {
        blistH += '<div class="pgname">' + GN[g] + '</div>';
        for (var j = 0; j < its.length; j++) {
          blistH += '<div class="pitem">' + its[j].dataset.lb + '</div>';
        }
      }
    }
    if (!blistH) blistH = '<p style="color:#8a9e97;font-style:italic;font-size:12px">Chưa có dấu hiệu nào được ghi nhận.</p>';

    // Fill #pdf-content
    document.getElementById('pdf-content').innerHTML =
      '<div class="ph">' +
      '<div class="plr"><span class="plogo">Hiểu con từ Gốc</span><span class="pdate">Ngày: ' + now + '</span></div>' +
      '<div class="ptitle">Báo cáo Kết quả Checklist</div>' +
      '<div class="psub">Dấu hiệu Viêm hệ thần kinh ở trẻ tự kỷ</div>' +
      '<div class="pinforow"><div>Phụ huynh: <strong>' + name + '</strong></div><div>SĐT: <strong>' + phone + '</strong></div></div>' +
      '<span class="pbadge ' + bc + '">' + btext + '</span>' +
      '<div class="prtitle">' + rtitle + '</div>' +
      '<div class="prbody">' + rbody + '</div>' +
      '</div>' +
      '<div class="pstitle">Tổng quan theo từng nhóm <span style="float:right;font-weight:400;color:#8a9e97">' + rtotal + ' · ' + rgs + '</span></div>' +
      scRows +
      '<div style="margin-top:16px">' +
      '<div class="pstitle">Chi tiết dấu hiệu ghi nhận</div>' +
      blistH +
      '</div>' +
      '<div class="pfooter">' +
      '<strong>Lưu ý:</strong> Kết quả mang tính tham khảo, không thay thế chẩn đoán y tế chuyên môn.<br>' +
      'Hỗ trợ: 0988.71.71.07 | dawnbridge.care' +
      '</div>';

    // Ẩn spinner, đóng modal trước khi print
    document.getElementById('gen').classList.remove('show');
    document.getElementById('modal').classList.remove('open');
    document.body.style.overflow = '';

    // Gọi print sau 200ms để DOM kip render
    setTimeout(function () {
      window.print();
      // Sau khi print xong, xóa nội dung và hiện post sections
      setTimeout(function () {
        document.getElementById('pdf-content').innerHTML = '';
        ['pc', 'pn', 'pf'].forEach(function (id) { document.getElementById(id).classList.add('on') });
        showSuccess('pdf');
      }, 1000);
    }, 200);
  }

  function fakeSend(name, phone) {
    document.getElementById('gen-msg').textContent = 'Đang chuyển hướng đến Messenger…';
    document.getElementById('gen').classList.add('show');
    setTimeout(() => {
      document.getElementById('gen').classList.remove('show');
      window.location.href = 'https://m.me/884864428052710?ref=1002533683';
    }, 1800);
  }

  function showSuccess(type) {
    if (type === 'pdf') {
      document.getElementById('sicon').textContent = '📥';
      document.getElementById('stitle').textContent = 'File PDF đã tải xuống!';
      document.getElementById('sbody').innerHTML = `File <strong>PDF kết quả</strong> đã được tải về máy của cha mẹ.<br><br>Cảm ơn <strong>${uName}</strong> đã dành thời gian đối chiếu! Cha mẹ có thể in file này để mang theo khi gặp bác sĩ hoặc chuyên gia.`;
    } else {
      document.getElementById('sicon').textContent = '✅';
      document.getElementById('stitle').textContent = 'Đã gửi kết quả thành công!';
      document.getElementById('sbody').innerHTML = `Trợ lý Nam Khánh đã nhận được kết quả của <strong>${uName}</strong>.<br><br>Sẽ liên hệ lại qua <strong>${uPhone}</strong> trong thời gian sớm nhất để hỗ trợ cha mẹ.`;
    }
    toView('success');
  }

  function closeModal() {
    document.getElementById('modal').classList.remove('open');
    document.body.style.overflow = '';
    ['pc', 'pn', 'pf'].forEach(id => document.getElementById(id).classList.add('on'));
    setTimeout(() => document.getElementById('pc').scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
  }

  document.getElementById('modal').addEventListener('click', function (e) { if (e.target === this) closeModal() });

  function ghostView() {
    tr_method = 'just_viewed';
    updateTracker();
    closeModal();
  }

  /* ── Empathy animation ── */
  const lis = document.querySelectorAll('.empathy-list li');
  const empObs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { lis.forEach((li, i) => setTimeout(() => li.classList.add('visible'), i * 130)); empObs.disconnect() } });
  }, { threshold: .3 });
  if (lis[0]) empObs.observe(lis[0].closest('ul'));

  /* ── Tracking Logic ── */
  const sessionId = 'track_' + Math.random().toString(36).substr(2, 9) + Date.now();
  const ajaxUrl = '<?php echo admin_url("admin-ajax.php"); ?>';
  let timeSpent = 0;
  let tr_readAll = 0;
  let tr_method = '';
  let tr_nextAction = '';
  let checkedBehaviors = [];
  let tr_furthest_step = 0;
  let tr_result_level  = '';
  let tr_result_score  = '';
  let tr_result_groups = '';
  let tr_result_title  = '';
  let tr_result_body   = '';
  let tr_result_badge  = '';
  let tr_scores_json   = '';
  let tr_snapshot      = '';  // Full JSON snapshot — behaviors theo group, scores, đánh giá
  let tr_device_info   = navigator.userAgent;

  // Auto-fill form từ cookie nếu khách đã từng điền thông tin
  (function () {
    const _cn = getCookie('hieucon_name'), _cp = getCookie('hieucon_phone');
    if (_cn) { document.getElementById('fn').value = _cn; uName = _cn; }
    if (_cp) { document.getElementById('fp').value = _cp; uPhone = _cp; }
  })();

  // Track furthest step based on the nav buttons
  // setTimeout(0) ensures step variable is read AFTER nxt()/prv() updates it
  document.querySelectorAll('.btn-next, .btn-back').forEach(btn => {
    btn.addEventListener('click', () => {
      setTimeout(() => {
        if (step > tr_furthest_step) tr_furthest_step = step;
        updateTracker();
      }, 0);
    });
  });

  setInterval(() => { timeSpent += 5; updateTracker(); }, 5000);

  window.addEventListener('beforeunload', () => updateTracker(true));

  const footerObs = new IntersectionObserver(ent => {
    if (ent[0].isIntersecting) { tr_readAll = 1; updateTracker(); footerObs.disconnect(); }
  });
  footerObs.observe(document.getElementById('pf'));

  document.querySelectorAll('.check-item input').forEach(cb => {
    cb.addEventListener('change', function () {
      if (this.checked) {
        if (!checkedBehaviors.includes(this.dataset.lb)) checkedBehaviors.push(this.dataset.lb);
      } else {
        checkedBehaviors = checkedBehaviors.filter(item => item !== this.dataset.lb);
      }
      updateTracker();
    });
  });

  // Xoá bỏ wrapper ở đây vì đã xử lý trực tiếp trong doSubmit gốc để đảm bảo thứ tự thực thi


  document.querySelectorAll('.ncard .btn-ch').forEach(btn => {
    btn.addEventListener('click', function () {
      tr_nextAction = this.textContent.trim();
      updateTracker();
    });
  });

  function updateTracker(sync = false) {
    const params = new URLSearchParams();
    params.append('action', 'hieucon_track_checklist');
    params.append('session_id', sessionId);
    params.append('parent_name', uName || '');
    params.append('parent_phone', uPhone || '');
    params.append('read_all', tr_readAll);
    params.append('behaviors', JSON.stringify(checkedBehaviors));
    params.append('contact_method', tr_method);
    params.append('next_action', tr_nextAction);
    params.append('time_spent', timeSpent);
    params.append('furthest_step', tr_furthest_step);
    params.append('result_level', tr_result_level);
    params.append('result_score', tr_result_score);
    params.append('result_groups', tr_result_groups);
    params.append('result_title',    tr_result_title);
    params.append('result_body',     tr_result_body);
    params.append('result_badge',    tr_result_badge);
    params.append('scores_json',     tr_scores_json);
    params.append('result_snapshot', tr_snapshot);
    params.append('device_info',     tr_device_info);

    const bodyString = params.toString();
    if (sync && navigator.sendBeacon) {
      navigator.sendBeacon(ajaxUrl, new Blob([bodyString], { type: 'application/x-www-form-urlencoded' }));
    } else {
      return fetch(ajaxUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: bodyString
      });
    }
  }
</script>
</div><!-- #page -->

<!-- PDF TEMPLATE: phải ở ngoài #page để @media print hiển thị được -->
<div id="print-area">
  <div class="pp" id="pdf-content"></div>
</div>

<?php wp_footer(); ?>
</body>

</html>