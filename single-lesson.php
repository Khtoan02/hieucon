<?php
/**
 * Single Template: Bài học (lesson)
 *
 * @package Hieucon
 */

// 1. SECURITY GATE: CHECK ACCESS RIGHTS
$belong_to_course_id = get_post_meta( get_the_ID(), '_belong_to_course', true );

if ( ! $belong_to_course_id ) {
    wp_redirect( home_url( '/courses/' ) );
    exit;
}

$course_url = get_permalink( $belong_to_course_id );
$current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;

if ( ! $current_member ) {
    // Redirect guest with login required notice
    wp_redirect( add_query_arg( 'error', 'login_required', $course_url ) );
    exit;
}

$has_access = false;
$member_id = intval( $current_member->id );

if ( $current_member->role === 'administrator' || $current_member->role === 'teacher' || $current_member->role === 'expert' ) {
    $has_access = true;
} else {
    $enrolled = hieucon_get_member_enrolled_courses( $member_id );
    if ( is_array( $enrolled ) && in_array( $belong_to_course_id, $enrolled ) ) {
        $has_access = true;
    }
}

if ( ! $has_access ) {
    // Redirect unauthorized user with error
    wp_redirect( add_query_arg( 'error', 'not_enrolled', $course_url ) );
    exit;
}

get_header();

// Fetch Lesson Fields
$video_url = get_post_meta( get_the_ID(), '_video_url', true );
$duration  = get_post_meta( get_the_ID(), '_lesson_duration', true );
$order     = get_post_meta( get_the_ID(), '_lesson_order', true );

// Fetch all lessons for playlist sidebar
$playlist_query = new WP_Query( [
    'post_type'      => 'lesson',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => '_belong_to_course',
            'value'   => $belong_to_course_id,
            'compare' => '='
        ]
    ],
    'meta_key'       => '_lesson_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC'
] );

// Like status check
$liked_by = get_post_meta( get_the_ID(), '_liked_by_users', true );
if ( ! is_array( $liked_by ) ) {
    $liked_by = [];
}
$is_liked   = in_array( $member_id, $liked_by );
$like_count = count( $liked_by );
$like_nonce = wp_create_nonce( 'hieucon_like_nonce' );

// Fetch member lesson progress list
$progress_list = function_exists( 'hieucon_get_member_lesson_progress' ) ? hieucon_get_member_lesson_progress( $member_id ) : [];

// Calculate total course completion progress
$playlist_lessons = $playlist_query->posts;
$total_lessons_count = count( $playlist_lessons );
$completed_lessons_count = 0;
$total_progress_percent = 0;

if ( $total_lessons_count > 0 ) {
    $sum_percent = 0;
    foreach ( $playlist_lessons as $p_les ) {
        $p_les_id = $p_les->ID;
        $p_les_percent = isset( $progress_list[ $p_les_id ] ) ? intval( $progress_list[ $p_les_id ] ) : 0;
        $sum_percent += $p_les_percent;
        if ( $p_les_percent >= 100 ) {
            $completed_lessons_count++;
        }
    }
    $total_progress_percent = round( $sum_percent / $total_lessons_count );
}

// PHP Next Lesson Finder logic
$next_lesson_url = '';
$next_lesson_title = '';
$found_current = false;
foreach ( $playlist_lessons as $p_les ) {
    if ( $found_current ) {
        $next_lesson_url = get_permalink( $p_les->ID );
        $next_lesson_title = $p_les->post_title;
        break;
    }
    if ( $p_les->ID === get_the_ID() ) {
        $found_current = true;
    }
}
?>

<style>
/* ==========================================================================
   PREMIUM COZY LMS REDESIGN SYSTEM - COZY HEALING THEME (DAWNBRIDGE VISUALS)
   ========================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap');

/* Make sure global footer is beautifully integrated at the bottom of classroom */
#colophon, .site-footer {
    display: block !important;
    z-index: 10 !important;
    position: relative !important;
}

/* 1. Global Page Layout and Scrolling Style */
@media (min-width: 1024px) {
    html, body {
        overflow: auto !important;
        height: auto !important;
    }
    #page {
        display: block !important;
        height: auto !important;
        max-height: none !important;
        overflow: visible !important;
    }
    #primary {
        min-height: calc(100vh - 92px) !important;
        height: auto !important;
        max-height: none !important;
        overflow: visible !important;
    }
}

.font-serif {
    font-family: 'Lora', serif !important;
}
.font-sans {
    font-family: 'Nunito', sans-serif !important;
}

/* 2. Cozy Healing Design Tokens */
.bg-healing-gradient {
    background: linear-gradient(135deg, #FFF9F0 0%, #FFD6C0 50%, #B4C8BB 100%) !important;
    background-attachment: fixed !important;
}

.glass-panel {
    background: rgba(255, 255, 255, 0.98) !important;
    border: 1px solid rgba(255, 214, 192, 0.45) !important;
    box-shadow: 0 10px 40px -10px rgba(10, 25, 49, 0.04) !important;
}

.solid-panel {
    background: #ffffff !important;
    border: 1px solid rgba(255, 214, 192, 0.45) !important;
    box-shadow: 0 4px 20px -2px rgba(10, 25, 49, 0.04) !important;
}

.glass-card {
    background: #ffffff !important;
    border: 1px solid rgba(255, 214, 192, 0.4) !important;
    box-shadow: 0 4px 20px -2px rgba(10, 25, 49, 0.03) !important;
}

/* Blur glowing spheres background */
@keyframes floatSphere {
    0%, 100% { transform: translateY(0) scale(1) translate3d(0,0,0); }
    50% { transform: translateY(-20px) scale(1.05) translate3d(0,0,0); }
}
@keyframes floatSphereDelay {
    0%, 100% { transform: translateY(0) scale(1) translate3d(0,0,0); }
    50% { transform: translateY(20px) scale(0.95) translate3d(0,0,0); }
}
.animate-sphere-slow {
    animation: floatSphere 12s ease-in-out infinite;
    will-change: transform;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transform: translate3d(0, 0, 0);
}
.animate-sphere-delay {
    animation: floatSphereDelay 15s ease-in-out infinite;
    will-change: transform;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transform: translate3d(0, 0, 0);
}

/* Slim Premium Scrollbars */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(180, 200, 187, 0.5);
    border-radius: 99px;
    transition: all 0.3s ease;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(13, 148, 136, 0.65);
}

/* 3. Three-Column Workspace Architecture */
.sidebar-left-transition {
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.5s, padding 0.5s !important;
}
.sidebar-right-transition {
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.5s, padding 0.5s !important;
}
.collapsed-sidebar {
    opacity: 0 !important;
    overflow: hidden !important;
}

/* Desktop styles for Left Sidebar (Playlist) */
@media (min-width: 1280px) {
    .playlist-workspace {
        position: sticky !important;
        top: 110px !important;
        align-self: start !important;
        width: 280px !important;
        z-index: 20 !important;
        opacity: 1 !important;
        height: fit-content !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        will-change: width, opacity;
    }
    .playlist-workspace.collapsed-sidebar {
        width: 0 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        overflow: hidden !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
}

/* Desktop styles for Right Sidebar (Discussion) */
@media (min-width: 1024px) {
    .sidebar-workspace {
        position: sticky !important;
        top: 110px !important;
        align-self: start !important;
        width: 320px !important;
        z-index: 20 !important;
        opacity: 1 !important;
        height: fit-content !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        will-change: width, opacity;
    }
    .sidebar-workspace.collapsed-sidebar {
        width: 0 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        overflow: hidden !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Elegant, automatic flex layout for center learning zone */
    .center-learning-workspace {
        width: 100% !important;
        max-width: 1100px !important;
        flex: 1 1 auto !important;
        min-width: 0 !important;
        transition: max-width 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    
    /* Left sidebar collapsed, right sidebar open */
    #playlist-sidebar.collapsed-sidebar ~ .center-learning-workspace {
        max-width: 1380px !important;
    }
    
    /* Left sidebar open, right sidebar collapsed */
    .center-learning-workspace:has(~ #qa-sidebar.collapsed-sidebar) {
        max-width: 1380px !important;
    }
    
    /* Both sidebars collapsed */
    #playlist-sidebar.collapsed-sidebar ~ .center-learning-workspace:has(~ #qa-sidebar.collapsed-sidebar) {
        max-width: 1400px !important;
    }
    
    .theater-active .center-learning-workspace {
        max-width: 1400px !important;
    }
}

/* Responsive sidebars to mobile drawers overrides */
@media (max-width: 1023px) {
    .sidebar-workspace {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 85vh !important;
        width: 100% !important;
        max-width: 100% !important;
        z-index: 150 !important;
        border-top-left-radius: 1.75rem !important;
        border-top-right-radius: 1.75rem !important;
        border-left: none !important;
        border-top: 1px solid rgba(255, 214, 192, 0.6) !important;
        transform: translateY(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s;
        background: #FFF9F0 !important;
        box-shadow: 0 -10px 40px rgba(10, 25, 49, 0.15) !important;
        display: none;
    }
    .sidebar-workspace.open {
        transform: translateY(0) !important;
        display: flex !important;
        opacity: 1 !important;
    }
}
@media (max-width: 1279px) {
    .playlist-workspace {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 85vh !important;
        width: 100% !important;
        max-width: 100% !important;
        z-index: 150 !important;
        border-top-left-radius: 1.75rem !important;
        border-top-right-radius: 1.75rem !important;
        border-right: none !important;
        border-top: 1px solid rgba(255, 214, 192, 0.6) !important;
        transform: translateY(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s;
        background: #FFF9F0 !important;
        box-shadow: 0 -10px 40px rgba(10, 25, 49, 0.15) !important;
        display: none;
    }
    .playlist-workspace.open {
        transform: translateY(0) !important;
        display: flex !important;
        opacity: 1 !important;
    }
}

/* 4. Safe aspect-ratio 16:9 YouTube Edge-Cropping (1.12x) */
#custom-video-player-container {
    aspect-ratio: 16 / 9 !important;
    overflow: hidden !important;
    position: relative !important;
    border-radius: 1.75rem !important;
    background: #000;
    border: 1px solid rgba(255, 255, 255, 0.6) !important;
    box-shadow: 0 20px 50px -12px rgba(10, 25, 49, 0.12) !important;
}

.player-crop-wrapper {
    position: absolute !important;
    inset: 0 !important;
    width: 100% !important;
    height: 100% !important;
    overflow: hidden !important;
    pointer-events: none !important;
}

#youtube-player-mount {
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    width: 112% !important;  /* Safe crop to completely hide all YT UI */
    height: 112% !important; 
    transform: translate(-50%, -50%) !important;
    transform-origin: center center !important;
    pointer-events: none !important;
}

#youtube-player-mount iframe {
    width: 100% !important;
    height: 100% !important;
    border: 0 !important;
    pointer-events: none !important;
}

/* Control Bar styling */
#player-timeline-container {
    background: rgba(255, 255, 255, 0.15) !important;
}
#player-timeline-progress {
    background: linear-gradient(to right, #0d9488, #14b8a6) !important;
}
#player-timeline-handle {
    border-color: #0d9488 !important;
    box-shadow: 0 0 10px rgba(13, 148, 136, 0.8) !important;
}

#custom-video-player-container:hover #player-custom-controls,
#custom-video-player-container.paused #player-custom-controls,
#custom-video-player-container.controls-active #player-custom-controls {
    transform: translateY(0) !important;
    opacity: 1 !important;
}

#player-volume-slider::-webkit-slider-runnable-track {
    background: rgba(255, 255, 255, 0.2);
    height: 4px;
    border-radius: 99px;
}
#player-volume-slider::-webkit-slider-thumb {
    background: #0d9488;
    height: 10px;
    width: 10px;
    border-radius: 99px;
    margin-top: -3px;
    -webkit-appearance: none;
    transition: all 0.2s;
}
#player-volume-slider::-webkit-slider-thumb:hover {
    background: #14b8a6;
    transform: scale(1.25);
}

/* 5. Giao diện Thảo luận iOS Bubble Chat - Premium Solid Color Coding */
.comment-bubble-glass {
    background: #ffffff !important;
    border: 1px solid rgba(255, 214, 192, 0.45) !important; /* soft warm sand border */
    box-shadow: 0 4px 15px -3px rgba(10, 25, 49, 0.03) !important;
    border-radius: 1.25rem !important; /* 20px smooth corners */
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.comment-bubble-glass:hover {
    border-color: rgba(13, 148, 136, 0.35) !important;
    box-shadow: 0 6px 18px -3px rgba(10, 25, 49, 0.05) !important;
}

/* Custom Role-Based Bubble Color Themes */
.comment-role-administrator .comment-bubble-glass,
.comment-role-teacher .comment-bubble-glass {
    background: #FFF9F2 !important; /* Cozy Warm Peach Cream */
    border: 1px solid rgba(249, 115, 22, 0.2) !important; /* Premium Warm Apricot Border */
}
.comment-role-administrator .comment-bubble-glass:hover,
.comment-role-teacher .comment-bubble-glass:hover {
    border-color: rgba(249, 115, 22, 0.4) !important;
}

.comment-role-expert .comment-bubble-glass {
    background: #F3FAF6 !important; /* Cozy Calming Green Cream */
    border: 1px solid rgba(16, 185, 129, 0.2) !important; /* Sage Jade Border */
}
.comment-role-expert .comment-bubble-glass:hover {
    border-color: rgba(16, 185, 129, 0.4) !important;
}

.comment-role-assistant .comment-bubble-glass {
    background: #F3F8FB !important; /* Quiet Sky Blue Cream */
    border: 1px solid rgba(14, 165, 233, 0.2) !important; /* Soft Blue Border */
}
.comment-role-assistant .comment-bubble-glass:hover {
    border-color: rgba(14, 165, 233, 0.4) !important;
}

.comment-role-member .comment-bubble-glass {
    background: #ffffff !important;
    border: 1px solid rgba(13, 148, 136, 0.15) !important; /* Soft Teal Border for Active Members */
}
.comment-role-member .comment-bubble-glass:hover {
    border-color: rgba(13, 148, 136, 0.35) !important;
}

/* Text visibility controls on light glass backdrop - guarantees deep readability */
.comment-node span.text-white {
    color: #0A1931 !important;
    font-weight: 800 !important;
    font-family: 'Nunito', sans-serif !important;
}
.comment-node div.text-slate-200 {
    color: #2d3748 !important; /* Dark Slate Gray for comfortable reading */
    font-weight: 500 !important;
    font-size: 0.8rem !important;
    line-height: 1.65 !important;
}
.comment-node .bg-slate-800,
.comment-node .bg-slate-750 {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

/* High Contrast Roles Badges with sharp borders */
.comment-node span.bg-emerald-500\/15 {
    background: rgba(16, 185, 129, 0.12) !important;
    color: #047857 !important;
    border: 1px solid rgba(16, 185, 129, 0.25) !important;
}
.comment-node span.bg-sky-500\/15 {
    background: rgba(14, 165, 233, 0.12) !important;
    color: #0369a1 !important;
    border: 1px solid rgba(14, 165, 233, 0.25) !important;
}
.comment-node span.bg-teal-500\/15 {
    background: rgba(20, 184, 166, 0.12) !important;
    color: #0f766e !important;
    border: 1px solid rgba(20, 184, 166, 0.25) !important;
}
.comment-node span.bg-red-500\/15 {
    background: rgba(239, 68, 68, 0.12) !important;
    color: #b91c1c !important;
    border: 1px solid rgba(239, 68, 68, 0.25) !important;
}
.comment-node span.bg-orange-500\/15 {
    background: rgba(249, 115, 22, 0.12) !important;
    color: #c2410c !important;
    border: 1px solid rgba(249, 115, 22, 0.25) !important;
}
.comment-node span.bg-slate-500\/15 {
    background: rgba(100, 116, 139, 0.1) !important;
    color: #475569 !important;
    border: 1px solid rgba(100, 116, 139, 0.2) !important;
}

.comment-node > div > div.rounded-full {
    color: white !important;
    border: none !important;
}

/* Thread connector line gradients */
.thread-line::before {
    content: '' !important;
    position: absolute !important;
    left: -19px !important;
    top: 0 !important;
    bottom: 0 !important;
    width: 2px !important;
    background: linear-gradient(to bottom, rgba(13, 148, 136, 0.35) 0%, rgba(249, 115, 22, 0.1) 100%) !important;
    border-radius: 99px !important;
}

/* Comment inputs warm focus borders */
#comment-textarea:focus,
.comment-node textarea:focus {
    border-color: #f97316 !important;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15) !important;
    outline: none !important;
}

/* Liked hearts pulsing */
.liked-heart-glow {
    filter: drop-shadow(0 0 4px rgba(239, 68, 68, 0.65));
    animation: heartBeat 0.3s ease-in-out;
}
@keyframes heartBeat {
    0% { transform: scale(1); }
    50% { transform: scale(1.25); }
    100% { transform: scale(1); }
}

/* Segmented Tabs (Used inside playlist progress widgets) */
.segmented-tabs-wrapper {
    background: rgba(226, 232, 240, 0.45) !important;
    border: 1px solid rgba(226, 232, 240, 0.6) !important;
    border-radius: 0.85rem !important;
    padding: 3px !important;
}
.segmented-tab-btn {
    border-radius: 0.7rem !important;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    border: none !important;
    outline: none !important;
}
.segmented-tab-btn.active {
    background: #0d9488 !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2) !important;
}
.segmented-tab-btn.inactive {
    background: transparent !important;
    color: #64748b !important;
}
.segmented-tab-btn.inactive:hover {
    background: rgba(226, 232, 240, 0.3) !important;
    color: #0A1931 !important;
}

/* Premium micro-animations */
.btn-premium-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%) !important;
    box-shadow: 0 4px 14px 0 rgba(13, 148, 136, 0.25);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.btn-premium-gradient:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px 0 rgba(13, 148, 136, 0.45);
    filter: brightness(1.05);
}

.btn-secondary-gradient {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%) !important;
    box-shadow: 0 4px 14px 0 rgba(249, 115, 22, 0.25);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.btn-secondary-gradient:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px 0 rgba(249, 115, 22, 0.45);
    filter: brightness(1.05);
}

.animate-pulse-slow {
    animation: pulseSlow 3.5s infinite;
}
@keyframes pulseSlow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.9; transform: scale(0.985); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Formatting for editorial book document style */
.prose-editorial {
    font-family: 'Nunito', sans-serif !important;
}

/* Cozy Healing Core Palette overrides & Tailwind Fallbacks */
.text-primary, .text-teal-600 { color: #0d9488 !important; }
.bg-primary, .bg-teal-600 { background-color: #0d9488 !important; }
.border-primary, .border-teal-600 { border-color: #0d9488 !important; }
.border-l-primary { border-left-color: #0d9488 !important; }
.hover\:text-primary:hover { color: #0d9488 !important; }
.hover\:bg-primary\/90:hover { background-color: #0f766e !important; }
.disabled\:bg-primary\/50:disabled { background-color: rgba(13, 148, 136, 0.5) !important; }

.text-secondary, .text-orange-500 { color: #f97316 !important; }
.bg-secondary, .bg-orange-500 { background-color: #f97316 !important; }
.border-secondary, .border-orange-500 { border-color: #f97316 !important; }
.hover\:text-secondary:hover { color: #f97316 !important; }

/* Dark text contrast overrides */
.text-navy, .text-\[\#0A1931\] { color: #0A1931 !important; }
.text-slate-800 { color: #2D3748 !important; }
.text-slate-700 { color: #374151 !important; }

/* Custom specific classes to fix potential Tailwind gaps */
.text-teal-650 { color: #0f766e !important; }
.text-teal-655 { color: #0d9488 !important; }
.text-teal-700 { color: #0f766e !important; }
.text-teal-600 { color: #0d9488 !important; }
.text-teal-500 { color: #14b8a6 !important; }
.text-teal-350 { color: #99f6e4 !important; }
.text-teal-50 { color: #0f766e !important; }
.bg-teal-50 { background-color: #f0fdfa !important; }
.bg-teal-500\/5 { background-color: rgba(13, 148, 136, 0.05) !important; }
.bg-teal-500\/10 { background-color: rgba(13, 148, 136, 0.1) !important; }
.bg-teal-500\/20 { background-color: rgba(13, 148, 136, 0.2) !important; }

/* High contrast badges in comments list */
.comment-node span.bg-emerald-500\/15 {
    background: rgba(16, 185, 129, 0.12) !important;
    color: #047857 !important;
    border: 1px solid rgba(16, 185, 129, 0.25) !important;
}
.comment-node span.bg-sky-500\/15 {
    background: rgba(14, 165, 233, 0.12) !important;
    color: #0369a1 !important;
    border: 1px solid rgba(14, 165, 233, 0.25) !important;
}
.comment-node span.bg-teal-500\/15 {
    background: rgba(20, 184, 166, 0.12) !important;
    color: #0f766e !important;
    border: 1px solid rgba(20, 184, 166, 0.25) !important;
}
.comment-node span.bg-red-500\/15 {
    background: rgba(239, 68, 68, 0.12) !important;
    color: #b91c1c !important;
    border: 1px solid rgba(239, 68, 68, 0.25) !important;
}
.comment-node span.bg-orange-500\/15 {
    background: rgba(249, 115, 22, 0.12) !important;
    color: #c2410c !important;
    border: 1px solid rgba(249, 115, 22, 0.25) !important;
}
.comment-node span.bg-slate-500\/15 {
    background: rgba(100, 116, 139, 0.10) !important;
    color: #475569 !important;
    border: 1px solid rgba(100, 116, 139, 0.20) !important;
}

/* Custom Premium Dark Video Controls */
.player-custom-controls-dark {
    background: rgba(10, 25, 49, 0.96) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3) !important;
}
.player-custom-controls-dark button {
    color: rgba(255, 255, 255, 0.8) !important;
    transition: all 0.2s ease !important;
}
.player-custom-controls-dark button:hover {
    color: #ffffff !important;
    transform: scale(1.05);
}
.player-custom-controls-dark i {
    stroke: currentColor !important;
}
.player-custom-controls-dark #player-play-btn i {
    fill: currentColor !important;
}
.player-custom-controls-dark #player-current-time,
.player-custom-controls-dark #player-total-time {
    color: rgba(255, 255, 255, 0.9) !important;
}
.player-custom-controls-dark .text-slate-600 {
    color: rgba(255, 255, 255, 0.3) !important;
}
.player-custom-controls-dark .bg-teal-500\/20 {
    background-color: rgba(20, 184, 166, 0.18) !important;
    border-color: rgba(20, 184, 166, 0.35) !important;
    color: #2dd4bf !important;
}
.player-custom-controls-dark .text-teal-350 {
    color: #2dd4bf !important;
}

/* Custom Speed Dropdown active state */
#player-speed-dropdown.active-dropdown {
    opacity: 1 !important;
    transform: translateY(0) !important;
    pointer-events: auto !important;
}
#player-speed-dropdown::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    height: 12px;
    background: transparent;
}

/* ==========================================================================
   PREMIUM EDITORIAL GUIDE & INTERACTIVE ZEN READING MODE
   ========================================================================== */
.editorial-doc-card {
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.4s !important;
}
.editorial-doc-card:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 20px 35px -10px rgba(13, 148, 136, 0.08), 0 0 0 1px rgba(13, 148, 136, 0.08) !important;
    border-color: rgba(13, 148, 136, 0.25) !important;
}

/* Beautiful custom toolbar styling */
.reading-tool-btn {
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.reading-tool-btn:hover {
    background-color: rgba(13, 148, 136, 0.08) !important;
    color: #0d9488 !important;
    transform: scale(1.05) !important;
}
.reading-tool-btn:active {
    transform: scale(0.95) !important;
}

/* Typography styles for premium content flow */
.prose-editorial {
    --reading-font-size: 14px;
    font-size: var(--reading-font-size) !important;
    transition: font-size 0.25s ease !important;
}
.prose-editorial .prose p {
    color: #334155 !important; /* slate-700 */
    font-size: 1em !important;
    line-height: 1.85 !important;
    margin-bottom: 1.35rem !important;
    letter-spacing: -0.01em !important;
}
.prose-editorial .prose h2 {
    font-family: 'Lora', serif !important;
    color: #0A1931 !important;
    font-size: 1.35em !important;
    font-weight: 700 !important;
    margin-top: 2rem !important;
    margin-bottom: 0.85rem !important;
    letter-spacing: -0.015em !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    border-bottom: none !important;
    padding-bottom: 0 !important;
}
.prose-editorial .prose h2::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 18px;
    background: #0d9488; /* teal-600 */
    border-radius: 99px;
    flex-shrink: 0;
}
.prose-editorial .prose h3 {
    font-family: 'Lora', serif !important;
    color: #0A1931 !important;
    font-size: 1.15em !important;
    font-weight: 600 !important;
    margin-top: 1.6rem !important;
    margin-bottom: 0.6rem !important;
    letter-spacing: -0.01em !important;
}
.prose-editorial .prose ul {
    list-style-type: none !important;
    padding-left: 0 !important;
    margin-bottom: 1.25rem !important;
}
.prose-editorial .prose ul > li {
    position: relative !important;
    padding-left: 1.35rem !important;
    color: #475569 !important; /* slate-600 */
    font-size: 0.96em !important;
    line-height: 1.75 !important;
    margin-bottom: 0.5rem !important;
}
.prose-editorial .prose ul > li::before {
    content: '';
    position: absolute !important;
    left: 0.25rem !important;
    top: 0.65em !important;
    width: 6px;
    height: 6px;
    border-radius: 50% !important;
    background-color: #0d9488 !important;
    opacity: 0.85;
}
.prose-editorial .prose ol {
    list-style-type: decimal !important;
    padding-left: 1.25rem !important;
    margin-bottom: 1.25rem !important;
}
.prose-editorial .prose ol > li {
    color: #475569 !important;
    font-size: 0.96em !important;
    line-height: 1.75 !important;
    margin-bottom: 0.5rem !important;
    padding-left: 0.25rem !important;
}
.prose-editorial .prose blockquote {
    border-left: 4px solid #0d9488 !important;
    background: rgba(13, 148, 136, 0.03) !important;
    padding: 1.15rem 1.35rem !important;
    border-radius: 0 16px 16px 0 !important;
    margin: 1.5rem 0 !important;
    font-style: italic !important;
    color: #0f766e !important;
}

/* Zen Reading Mode Overlay System */
.zen-modal-overlay {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.zen-modal-overlay.zen-active {
    opacity: 1 !important;
    pointer-events: auto !important;
}
.zen-modal-container {
    transform: scale(0.96) translateY(20px);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease !important;
}
.zen-modal-overlay.zen-active .zen-modal-container {
    transform: scale(1) translateY(0) !important;
}

/* Zen Reading Mode Color Themes */
.zen-theme-sepia {
    background-color: #FFF9F0 !important;
    color: #2d3748 !important;
    border-color: rgba(255, 214, 192, 0.4) !important;
}
.zen-theme-sepia .prose-editorial .prose p {
    color: #334155 !important;
}
.zen-theme-sepia .prose-editorial .prose h2,
.zen-theme-sepia .prose-editorial .prose h3 {
    color: #0A1931 !important;
}

.zen-theme-white {
    background-color: #FFFFFF !important;
    color: #1A202C !important;
    border-color: rgba(226, 232, 240, 0.8) !important;
}
.zen-theme-white .prose-editorial .prose p {
    color: #2D3748 !important;
}
.zen-theme-white .prose-editorial .prose h2,
.zen-theme-white .prose-editorial .prose h3 {
    color: #000000 !important;
}

.zen-theme-dark {
    background-color: #0F172A !important; /* slate-900 */
    color: #E2E8F0 !important; /* slate-200 */
    border-color: rgba(51, 65, 85, 0.6) !important;
}
.zen-theme-dark .prose-editorial .prose p {
    color: #94A3B8 !important; /* slate-400 */
}
.zen-theme-dark .prose-editorial .prose h2,
.zen-theme-dark .prose-editorial .prose h3 {
    color: #F8FAFC !important; /* slate-50 */
}
.zen-theme-dark .prose-editorial .prose ul > li,
.zen-theme-dark .prose-editorial .prose ol > li {
    color: #CBD5E1 !important;
}
.zen-theme-dark .prose-editorial .prose blockquote {
    background: rgba(20, 184, 166, 0.05) !important;
    color: #2dd4bf !important;
}
</style>



<main id="primary" class="site-main min-h-[calc(100vh-92px)] bg-healing-gradient text-slate-800 flex flex-col font-sans relative z-10 pb-10 pt-4 md:pt-6">
    
    <!-- 2. Main Workspace 3-Column Grid -->
    <div class="workspace-grid w-full max-w-[1740px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row justify-center items-start gap-5 relative z-10">
        
        <!-- COLUMN 1: Playlist Workspace (Left Sidebar) -->
        <aside id="playlist-sidebar" class="playlist-workspace sidebar-left-transition w-[280px] shrink-0 bg-transparent flex flex-col z-20">
            <div class="flex flex-col w-full h-full lg:h-auto lg:max-h-[calc(100vh-170px)] bg-white/95 border-0 lg:border border-[#FFD6C0]/40 rounded-none lg:rounded-3xl shadow-none lg:shadow-soft overflow-hidden">
                <!-- Sidebar Header -->
                <div class="px-5 pt-5 pb-3 border-b border-[#FFD6C0]/25 bg-[#FFF9F0]/70 select-none shrink-0">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-serif font-bold text-navy uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="list-video" class="w-4 h-4 text-teal-650"></i> Danh sách bài học
                    </h3>
                    <!-- Close button for mobile -->
                    <button onclick="closeAllMobileDrawers()" class="lg:hidden text-slate-400 hover:text-slate-600 transition-colors p-1 bg-transparent border-0 cursor-pointer flex items-center justify-center">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Mini Progress Dashboard Widget -->
            <div class="px-5 py-4.5 shrink-0 select-none bg-[#FFF9F0]/30 border-b border-[#FFD6C0]/20">
                <div class="solid-panel rounded-2xl p-4.5 relative overflow-hidden group bg-white border border-[#FFD6C0]/35 shadow-soft transition-all duration-300 hover:shadow-md">
                    <!-- Subtle premium background ambient glow -->
                    <div class="absolute -top-12 -right-12 w-28 h-28 bg-teal-500/5 blur-2xl rounded-full transition-transform duration-500 group-hover:scale-110"></div>
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-amber-500/5 blur-xl rounded-full"></div>
                    
                    <div class="flex items-center justify-between mb-3.5 relative z-10">
                        <div class="flex items-center gap-3">
                            <!-- Trophy container - extremely premium -->
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500/15 to-amber-500/5 border border-amber-500/25 flex items-center justify-center text-amber-600 shrink-0 shadow-sm">
                                <i data-lucide="trophy" class="w-5 h-5 text-amber-500 stroke-[2.2]"></i>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[9px] text-slate-400 font-extrabold tracking-wider uppercase block">Tiến trình học tập</span>
                                <span id="course-completed-text" class="text-xs font-serif font-bold text-[#0A1931] leading-tight">Đã học <?php echo esc_html( $completed_lessons_count ); ?> / <?php echo esc_html( $total_lessons_count ); ?> bài</span>
                            </div>
                        </div>
                        
                        <!-- Premium contrast percentage badge -->
                        <span id="course-overall-percent-label" class="text-[11px] font-mono font-extrabold text-teal-650 px-2.5 py-0.5 rounded-lg bg-teal-500/10 border border-teal-500/20 shadow-sm shrink-0"><?php echo esc_html( $total_progress_percent ); ?>%</span>
                    </div>
                    
                    <!-- ProgressBar - clean, padded, glowing, and beautifully contained -->
                    <div class="mt-3 relative z-10 px-0.5">
                        <div class="w-full h-2 bg-slate-100/90 rounded-full overflow-hidden border border-slate-200/15 shadow-inner">
                            <div id="course-overall-progress-bar" class="h-full bg-gradient-to-r from-teal-500 to-emerald-400 rounded-full shadow-[0_0_10px_rgba(13,148,136,0.3)] transition-all duration-1000" style="width: <?php echo esc_attr( $total_progress_percent ); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Playlist items query list -->
            <div id="sidebar-playlist-items" class="flex-initial overflow-y-auto custom-scrollbar select-none bg-white divide-y divide-slate-100/70 max-h-[calc(100vh-340px)]">
                <?php if ( $playlist_query->have_posts() ) : ?>
                    <?php $p_idx = 1; while ( $playlist_query->have_posts() ) : $playlist_query->the_post(); 
                        $is_current      = ( get_the_ID() === get_queried_object_id() );
                        $item_duration   = get_post_meta( get_the_ID(), '_lesson_duration', true );
                        $lesson_percent  = isset( $progress_list[ get_the_ID() ] ) ? intval( $progress_list[ get_the_ID() ] ) : 0;
                        
                        $active_classes  = $is_current ? 'bg-teal-50 border-l-4 border-l-primary text-teal-900 font-extrabold shadow-soft' : 'hover:bg-slate-50 text-slate-600 hover:text-slate-900';
                        $li_id           = $is_current ? 'id="active-playlist-item"' : '';
                    ?>
                        <a href="<?php the_permalink(); ?>" <?php echo $li_id; ?> class="block p-4 transition-all group <?php echo $active_classes; ?>">
                            <div class="flex items-center gap-3.5">
                                <!-- Dynamic Progress Rings -->
                                <div <?php echo $is_current ? 'id="active-playlist-item-badge"' : ''; ?> class="w-7 h-7 flex items-center justify-center shrink-0 relative mt-0.5 select-none">
                                    <?php if ( $lesson_percent >= 100 ) : ?>
                                        <div class="w-6.5 h-6.5 rounded-full bg-emerald-500/15 border border-emerald-500/40 text-emerald-600 flex items-center justify-center shadow-[0_0_10px_rgba(16,185,129,0.2)] animate-pulse-slow">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 stroke-[3]"></i>
                                        </div>
                                    <?php elseif ( $lesson_percent > 0 ) : ?>
                                        <svg class="absolute w-7 h-7 -rotate-90" viewBox="0 0 36 36">
                                            <circle class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                                            <circle class="text-teal-500 transition-all duration-500 animate-pulse-slow" stroke-width="3" stroke-dasharray="<?php echo $lesson_percent; ?>, 100" stroke-linecap="round" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                                        </svg>
                                        <span class="text-[8px] font-bold font-mono text-teal-650 z-10"><?php echo $lesson_percent; ?>%</span>
                                    <?php else : ?>
                                        <div class="w-6.5 h-6.5 rounded-full bg-slate-100 text-slate-400 text-[9px] font-bold flex items-center justify-center border border-slate-200/80 transition-colors group-hover:border-slate-350">
                                            <?php echo $p_idx; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex-1 min-w-0 space-y-1 ml-0.5">
                                    <span class="text-xs md:text-sm font-semibold block leading-tight truncate">
                                        <?php the_title(); ?>
                                    </span>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-450 font-semibold">
                                        <?php if ( ! empty( $item_duration ) ) : ?>
                                            <span class="flex items-center gap-1 select-none">
                                                <i data-lucide="play" class="w-3 h-3 text-slate-400"></i>
                                                <?php echo esc_html( $item_duration ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php $p_idx++; endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="p-6 text-center text-slate-400 text-xs italic">Không tìm thấy bài học nào khác.</div>
                <?php endif; ?>
            </div>
            </div> <!-- Closes inner card wrapper -->
        </aside>

        <!-- COLUMN 2: Center Learning Zone (Main content area, matches Header container alignment) -->
        <div id="center-learning-workspace" class="center-learning-workspace transition-all duration-500 bg-transparent">
            
            <div class="w-full py-6 space-y-6">
                
                <!-- 1. Floating Header Bar Capsule (Moved inside for perfect alignment & no overlap) -->
                <div class="w-full select-none">
                    <div class="glass-panel rounded-2xl px-6 py-3.5 flex items-center justify-between z-10 shadow-elegant bg-white border border-[#FFD6C0]/50 min-w-0 w-full">
                        <div class="flex items-center gap-3 md:gap-4.5 min-w-0 flex-1">
                            <a href="<?php echo esc_url( $course_url ); ?>" class="p-2.5 bg-white hover:bg-[#FFD6C0]/30 rounded-xl transition-all text-slate-500 hover:text-teal-650 shadow-soft border border-slate-200/40 shrink-0" title="Quay lại Landing Page">
                                <i data-lucide="arrow-left" class="w-4 h-4 shrink-0"></i>
                            </a>
                            
                            <!-- Toggle Left Sidebar Button -->
                            <button type="button" id="toggle-left-sidebar" onclick="toggleSidebar('left')" class="hidden xl:flex p-2.5 bg-teal-50 text-teal-600 hover:bg-[#FFD6C0]/30 rounded-xl transition-all shadow-soft border border-slate-200/40 cursor-pointer shrink-0" title="Ẩn/Hiện Danh sách bài học">
                                <i data-lucide="panel-left" class="w-4 h-4 shrink-0"></i>
                            </button>
                            
                            <div class="min-w-0 flex-1">
                                <h1 class="text-xs md:text-sm font-serif font-extrabold text-[#0A1931] leading-tight hover:text-teal-650 transition-colors truncate" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></h1>
                                <div class="flex items-center gap-2 mt-0.5 min-w-0">
                                    <span class="text-[9px] text-teal-600 font-extrabold tracking-wider uppercase shrink-0">Bài học <?php echo esc_html( $order ); ?></span>
                                    <span class="text-[9px] text-slate-300 shrink-0">•</span>
                                    <a href="<?php echo esc_url( $course_url ); ?>" class="text-[9px] text-slate-500 hover:text-teal-650 font-bold transition-colors truncate max-w-[120px] md:max-w-xs"><?php echo get_the_title( $belong_to_course_id ); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0 ml-4">
                            <div class="hidden sm:flex items-center gap-2 px-3.5 py-1 bg-teal-50 border border-teal-100/50 rounded-full shrink-0">
                                <div class="w-2 h-2 rounded-full bg-teal-500 animate-pulse shrink-0"></div>
                                <span class="text-[9px] font-bold text-teal-700 tracking-wide whitespace-nowrap">Tiến độ: <?php echo esc_html( $total_progress_percent ); ?>%</span>
                            </div>
                            
                            <a href="<?php echo esc_url( home_url( '/tai-khoan/' ) ); ?>" class="px-4 py-2 bg-white hover:bg-slate-50 text-[#0A1931] rounded-xl text-xs font-bold transition-all border border-slate-200/85 shadow-soft hover:shadow-soft whitespace-nowrap shrink-0">
                                Bảng điều khiển
                            </a>

                            <!-- Toggle Right Sidebar Button -->
                            <button type="button" id="toggle-right-sidebar" onclick="toggleSidebar('right')" class="hidden lg:flex p-2.5 bg-teal-50 text-teal-600 hover:bg-[#FFD6C0]/30 rounded-xl transition-all shadow-soft border border-slate-200/40 cursor-pointer shrink-0" title="Ẩn/Hiện Thảo luận">
                                <i data-lucide="panel-right" class="w-4 h-4 shrink-0"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Learning main column (Video & Info) -->
                <div class="w-full space-y-6">
                
                <!-- Aspect Ratio 16:9 Frame with crop boundary overlays -->
                <div id="custom-video-player-container" class="group select-none transition-all duration-500 shrink-0 paused relative w-full">
                    <?php if ( ! empty( $video_url ) ) : ?>
                        <!-- Transparent Touch intercept overlay to lock Safari iOS interactions -->
                        <div id="player-click-overlay" class="absolute inset-0 z-10 cursor-pointer pointer-events-auto" style="background: rgba(255,255,255,0.01) !important;"></div>
                        
                        <!-- Pulsating Center indicator -->
                        <div id="player-center-play-btn" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 rounded-full flex items-center justify-center bg-teal-500/10 border border-teal-500/30 text-teal-400 backdrop-blur-md shadow-[0_0_30px_rgba(13,148,136,0.25)] transition-all duration-350 scale-90 opacity-0 pointer-events-none z-20">
                            <i data-lucide="play" class="w-8 h-8 fill-teal-400 translate-x-0.5" id="center-play-icon"></i>
                        </div>
                        
                        <!-- Tầng 1: Frosted Loading Buffering screen (100% Opaque Sand-Beige) -->
                        <div id="player-loading-overlay" class="absolute inset-0 bg-[#FFF9F0] flex flex-col items-center justify-center z-25 transition-opacity duration-300">
                            <div class="relative w-16 h-16 mb-4 flex items-center justify-center">
                                <div class="absolute inset-0 border-4 border-teal-500/20 rounded-full"></div>
                                <div class="absolute inset-0 border-4 border-teal-500 border-t-transparent rounded-full animate-spin"></div>
                                <i data-lucide="graduation-cap" class="w-6 h-6 text-teal-650 animate-pulse"></i>
                            </div>
                            <h4 class="text-xs font-serif font-bold text-navy uppercase tracking-widest animate-pulse-slow">Dawnbridge Academy</h4>
                            <p class="text-[10px] text-teal-700 font-extrabold tracking-wider uppercase mt-1">Đang tải tài liệu bài học...</p>
                        </div>

                        <!-- Tầng 1.5: Premium Start Cover Overlay (100% Opaque Brand Screen) -->
                        <div id="player-cover-overlay" class="absolute inset-0 bg-gradient-to-tr from-[#FFF9F0] via-[#FFF5E6] to-[#E6EFEA] flex flex-col items-center justify-center z-24 transition-opacity duration-350">
                            <div class="text-center px-6 max-w-[85%] select-none flex flex-col items-center">
                                <div class="w-14 h-14 rounded-2xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-655 mb-5 shadow-soft">
                                    <i data-lucide="graduation-cap" class="w-6.5 h-6.5 text-teal-650"></i>
                                </div>
                                <span class="text-[10px] text-teal-655 font-extrabold tracking-wider uppercase mb-2 block">Dawnbridge Academy</span>
                                <h3 class="text-lg md:text-xl font-serif font-bold text-[#0A1931] mb-2 leading-tight"><?php the_title(); ?></h3>
                                <p class="text-[11px] text-slate-500 font-semibold mb-6 flex items-center gap-1.5 justify-center">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 text-teal-650"></i> Thời lượng: <span class="text-slate-800 font-bold"><?php echo esc_html( $duration ? $duration : 'Không xác định' ); ?></span>
                                </p>
                                
                                <!-- Custom pulse play trigger -->
                                <button type="button" onclick="startLearning()" class="px-7 py-3 bg-gradient-to-r from-secondary to-secondary_dark hover:scale-105 text-white font-extrabold text-xs uppercase tracking-widest rounded-2xl shadow-[0_4px_20px_rgba(249,115,22,0.35)] transition-all duration-300 flex items-center gap-2 border-0 cursor-pointer animate-pulse-slow">
                                    Bắt đầu học ngay <i data-lucide="play" class="w-4 h-4 fill-current"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tầng 2: Paused Navy Frosted overlay (100% Opaque to fully hide YouTube pause screens) -->
                        <div id="player-pause-overlay" onclick="playVideoFromPauseOverlay()" class="absolute inset-0 bg-[#0A1931] flex flex-col items-center justify-center text-white opacity-0 pointer-events-none transition-all duration-300 z-23 cursor-pointer select-none">
                            <button type="button" class="w-20 h-20 rounded-full flex items-center justify-center bg-gradient-to-tr from-secondary to-secondary_dark hover:scale-110 text-white shadow-[0_0_40px_rgba(249,115,22,0.45)] transition-all duration-300 scale-100 mb-5 border-0">
                                <i data-lucide="play" class="w-8 h-8 fill-white translate-x-0.5"></i>
                            </button>
                            <h3 class="text-base md:text-lg font-serif font-bold mb-1.5 text-center px-6 leading-tight max-w-[85%]"><?php the_title(); ?></h3>
                            <p class="text-[10px] text-[#ffedd5] font-extrabold mb-5 uppercase tracking-widest">Đang tạm dừng bài học</p>
                            <div class="px-4 py-2 bg-white/10 hover:bg-white/15 rounded-full text-[10px] font-bold text-teal-350 flex items-center gap-2 border border-white/10 shadow-soft">
                                <i data-lucide="sparkles" class="w-4 h-4 animate-pulse text-teal-350"></i> Nhấp chuột vào bất cứ đâu để học tiếp
                            </div>
                        </div>

                        <!-- Tầng 3: Ended Congratulations screen (100% Opaque navy gradient to fully hide YouTube ends) -->
                        <div id="player-ended-overlay" class="absolute inset-0 bg-gradient-to-tr from-[#0A1931] via-[#0A1931] to-[#0f766e] flex flex-col items-center justify-center text-white opacity-0 pointer-events-none transition-all duration-300 z-26 select-none">
                            <div class="w-16 h-16 rounded-full bg-emerald-500/25 border border-emerald-500/40 flex items-center justify-center text-emerald-400 mb-4 shadow-[0_0_35px_rgba(16,185,129,0.35)] animate-pulse-slow">
                                <i data-lucide="trophy" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-base md:text-lg font-serif font-bold text-center px-6 mb-1.5">Tuyệt vời! Bạn đã hoàn thành bài học này.</h3>
                            <p class="text-[10px] text-slate-400 font-bold mb-7 uppercase tracking-wider text-center px-6">Tiến độ bài học đã đạt 100%</p>
                            
                            <div class="flex flex-col sm:flex-row gap-3.5">
                                <button type="button" onclick="replayVideo()" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl font-bold text-[10px] transition-all flex items-center justify-center gap-2 border border-white/20 cursor-pointer shadow-soft">
                                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Học lại bài này
                                </button>
                                <?php if ( ! empty( $next_lesson_url ) ) : ?>
                                    <a href="<?php echo esc_url( $next_lesson_url ); ?>" class="px-5 py-2.5 bg-teal-500 hover:bg-teal-400 text-white rounded-xl font-bold text-[10px] shadow-md transition-all flex items-center justify-center gap-2 btn-premium-gradient border-0">
                                        Bài học kế tiếp: <?php echo esc_html( $next_lesson_title ); ?> <i data-lucide="arrow-right" class="w-4 h-4 animate-pulse"></i>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $course_url ); ?>" class="px-5 py-2.5 bg-teal-500 hover:bg-teal-400 text-white rounded-xl font-bold text-[10px] shadow-md transition-all flex items-center justify-center gap-2 btn-premium-gradient border-0">
                                        Quay lại trang chính khóa học <i data-lucide="home" class="w-4 h-4"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- YouTube Proportional Cropping Mount Area -->
                        <div class="player-crop-wrapper">
                            <div id="youtube-player-mount"></div>
                        </div>

                        <!-- Custom Floating Controls Bottom Capsule -->
                        <div id="player-custom-controls" class="absolute bottom-4 left-4 right-4 p-4 player-custom-controls-dark backdrop-blur-md rounded-2xl flex flex-col gap-3.5 transition-all duration-500 translate-y-8 opacity-0 z-20 pointer-events-auto shadow-elegant">
                            <!-- timeline seekbar -->
                            <div id="player-timeline-container" class="relative w-full h-1 hover:h-2 group/timeline cursor-pointer rounded-full overflow-visible transition-all bg-white/10">
                                <!-- buffered bar -->
                                <div id="player-timeline-buffered" class="absolute top-0 left-0 h-full bg-white/20 rounded-full w-0 transition-all duration-300"></div>
                                <!-- Spent seek bar -->
                                <div id="player-timeline-progress" class="absolute top-0 left-0 h-full rounded-full w-0 transition-all duration-75 bg-gradient-to-r from-teal-500 to-teal-400"></div>
                                <!-- handle indicator -->
                                <div id="player-timeline-handle" class="absolute top-1/2 -translate-y-1/2 w-3.5 h-3.5 bg-white rounded-full border border-teal-500 shadow-lg scale-0 group-hover/timeline:scale-100 transition-transform duration-200 pointer-events-none" style="left: 0%;"></div>
                            </div>
                            
                            <!-- Toolbar Controls -->
                            <div class="flex items-center justify-between font-sans select-none text-white text-xs">
                                <div class="flex items-center gap-5">
                                    <!-- play button toggle -->
                                    <button type="button" id="player-play-btn" class="text-slate-350 hover:text-white transition-colors cursor-pointer bg-transparent border-0 p-0 flex items-center justify-center">
                                        <i data-lucide="play" class="w-4.5 h-4.5 fill-current"></i>
                                    </button>
                                    
                                    <!-- Hover Volume track -->
                                    <div class="flex items-center gap-2 group/volume">
                                        <button type="button" id="player-volume-btn" class="text-slate-350 hover:text-white transition-colors cursor-pointer bg-transparent border-0 p-0 flex items-center justify-center">
                                            <i data-lucide="volume-2" class="w-4.5 h-4.5"></i>
                                        </button>
                                        <div class="w-0 overflow-hidden group-hover/volume:w-20 transition-all duration-350 flex items-center">
                                            <input type="range" id="player-volume-slider" min="0" max="100" value="100" class="w-full h-1 bg-white/30 rounded-lg appearance-none cursor-pointer accent-teal-500 focus:outline-none">
                                        </div>
                                    </div>
                                    
                                    <!-- duration time stamp -->
                                    <div class="text-[10px] font-mono text-slate-300 font-bold select-none flex items-center gap-1.5">
                                        <span id="player-current-time">00:00</span>
                                        <span class="text-slate-600">/</span>
                                        <span id="player-total-time">00:00</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4.5">
                                    <div class="hidden sm:flex px-3.5 py-1.5 bg-teal-500/20 border border-teal-500/30 text-teal-350 font-extrabold text-[9px] tracking-widest uppercase rounded-full shadow-sm items-center gap-1.5 animate-pulse-slow">
                                        <div class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping"></div>
                                        <span id="player-progress-badge-text"><?php echo isset( $progress_list[ get_the_ID() ] ) ? intval( $progress_list[ get_the_ID() ] ) : 0; ?>% Hoàn thành</span>
                                    </div>

                                    <!-- Speed Scaling Dropdown -->
                                    <div class="relative group/speed">
                                        <button type="button" id="player-speed-btn" class="flex items-center gap-1 px-3 py-1.5 text-[9px] font-bold text-white/80 hover:text-white hover:bg-white/10 border border-white/10 hover:border-white/20 rounded-xl transition-all cursor-pointer bg-transparent">
                                            <span id="player-speed-label">1.0x</span>
                                            <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-white/60"></i>
                                        </button>
                                        <div id="player-speed-dropdown" class="absolute bottom-full right-0 mb-0.5 w-20 py-1.5 bg-[#0A1931]/95 backdrop-blur-md border border-white/10 rounded-xl shadow-2xl opacity-0 translate-y-2 pointer-events-none group-hover/speed:opacity-100 group-hover/speed:translate-y-0 group-hover/speed:pointer-events-auto transition-all duration-300 flex flex-col shrink-0 overflow-hidden z-30">
                                            <button type="button" onclick="setPlayerSpeed(0.75)" class="px-3.5 py-2 text-left text-[9px] font-bold text-white/70 hover:text-white hover:bg-white/10 transition-colors w-full border-0 bg-transparent cursor-pointer">0.75x</button>
                                            <button type="button" onclick="setPlayerSpeed(1)" class="px-3.5 py-2 text-left text-[9px] font-bold text-teal-350 bg-teal-500/20 hover:text-white hover:bg-white/10 transition-colors w-full border-0 bg-transparent cursor-pointer">1.0x</button>
                                            <button type="button" onclick="setPlayerSpeed(1.25)" class="px-3.5 py-2 text-left text-[9px] font-bold text-white/70 hover:text-white hover:bg-white/10 transition-colors w-full border-0 bg-transparent cursor-pointer">1.25x</button>
                                            <button type="button" onclick="setPlayerSpeed(1.5)" class="px-3.5 py-2 text-left text-[9px] font-bold text-white/70 hover:text-white hover:bg-white/10 transition-colors w-full border-0 bg-transparent cursor-pointer">1.5x</button>
                                            <button type="button" onclick="setPlayerSpeed(2)" class="px-3.5 py-2 text-left text-[9px] font-bold text-white/70 hover:text-white hover:bg-white/10 transition-colors w-full border-0 bg-transparent cursor-pointer">2.0x</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Theater Toggle -->
                                    <button type="button" id="player-theater-btn" class="text-slate-355 hover:text-white transition-colors cursor-pointer bg-transparent border-0 p-0 flex items-center justify-center" title="Chế độ Rạp chiếu (Ẩn thanh bên)">
                                        <i data-lucide="panel-right" class="w-4.5 h-4.5"></i>
                                    </button>
                                    
                                    <!-- Fullscreen Toggle -->
                                    <button type="button" id="player-fullscreen-btn" class="text-slate-355 hover:text-white transition-colors cursor-pointer bg-transparent border-0 p-0 flex items-center justify-center" title="Toàn màn hình">
                                        <i data-lucide="maximize" class="w-4.5 h-4.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-950 rounded-3xl min-h-[350px]">
                            <i data-lucide="video-off" class="w-16 h-16 mb-2 text-slate-650"></i>
                            <span class="text-xs font-semibold">Bài học này hiện chưa đính kèm Video.</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Title & Likes Row Capsule -->
                <div class="glass-panel rounded-3xl p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-6 shrink-0 select-none">
                    <div>
                        <h2 class="text-base md:text-lg font-serif font-bold text-[#0A1931] tracking-tight leading-tight"><?php the_title(); ?></h2>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2.5">
                            <p class="text-[10px] text-slate-500 font-semibold flex items-center gap-1.5 opacity-95">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-teal-655"></i> Thời lượng: <span class="text-slate-800 font-bold"><?php echo esc_html( $duration ? $duration : 'Không xác định' ); ?></span>
                            </p>
                            <span class="w-1 h-1 bg-slate-300 rounded-full hidden md:inline"></span>
                            <p class="text-[10px] text-slate-500 font-semibold flex items-center gap-1.5 opacity-95">
                                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-teal-655"></i> Khóa học: <span class="text-slate-800 font-bold"><?php echo get_the_title( $belong_to_course_id ); ?></span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Like Actions -->
                    <div class="flex items-center gap-4">
                        <button type="button" onclick="handleLikeAction()" id="btn-like" class="px-5 py-3 rounded-2xl bg-white hover:bg-[#FFF9F0] border border-[#FFD6C0]/50 hover:border-red-500/30 transition-all flex items-center gap-2.5 group font-bold text-xs text-slate-750 shadow-soft <?php echo $is_liked ? 'shadow-[0_4px_15px_rgba(239,68,68,0.08)] border-red-500/20 bg-red-50/20' : ''; ?>">
                            <i data-lucide="heart" id="like-icon" class="w-4.5 h-4.5 transition-transform duration-300 group-hover:scale-110 <?php echo $is_liked ? 'text-red-500 fill-red-500 liked-heart-glow' : 'text-slate-455'; ?>"></i>
                            <span class="group-hover:text-[#0A1931] transition-colors">Thích</span>
                            <span id="like-count" class="bg-slate-50 px-2 py-0.5 rounded-lg text-slate-650 font-bold border border-slate-200/50"><?php echo esc_html( $like_count ); ?></span>
                        </button>
                    </div>
                </div>

                <!-- Editorial Book-Style Document -->
                <div id="main-editorial-card" class="editorial-doc-card solid-panel rounded-3xl overflow-hidden bg-white border border-[#FFD6C0]/40 shadow-soft flex-1 flex flex-col min-h-0 relative">
                    <div class="border-b border-[#FFD6C0]/35 bg-gradient-to-r from-[#FFF9F0]/80 via-white to-[#FFF9F0]/80 px-4 md:px-6 py-3.5 border-l-4 border-l-teal-500 shrink-0 flex items-center justify-between select-none">
                        <!-- Left Side: Title and Badges -->
                        <div class="flex items-center gap-3">
                            <h3 class="text-xs md:text-sm font-bold text-[#0A1931] flex items-center gap-2.5 tracking-wide uppercase font-serif">
                                <div class="w-8.5 h-8.5 rounded-xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-655 shrink-0 shadow-sm transition-transform duration-300 hover:rotate-6">
                                    <i data-lucide="book-open" class="w-4.5 h-4.5 stroke-[2.2]"></i>
                                </div>
                                <span class="hidden sm:inline">Tài liệu hướng dẫn</span>
                                <span class="sm:hidden">Tài liệu</span>
                            </h3>
                            
                            <!-- Cozy Pill Badges -->
                            <span class="hidden md:inline-flex items-center gap-1 bg-teal-50 text-[10px] text-teal-655 px-2.5 py-0.5 rounded-full font-bold tracking-wider font-sans border border-teal-100/50">
                                HỌC LIỆU TỪ GỐC
                            </span>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500 font-sans bg-slate-50 border border-slate-100/60 px-2 py-0.5 rounded-full">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i> 5 phút đọc
                            </span>
                        </div>
                        
                        <!-- Right Side: Access Controls Toolbar -->
                        <div class="flex items-center gap-1.5">
                            <!-- Font size controls -->
                            <div class="flex items-center bg-slate-50 border border-slate-100 rounded-xl p-0.5 select-none shadow-sm">
                                <button onclick="changeFontSize(-1)" type="button" class="reading-tool-btn w-7.5 h-7.5 rounded-lg flex items-center justify-center text-xs font-bold text-slate-550 border-0 bg-transparent cursor-pointer" title="Giảm cỡ chữ">
                                    A-
                                </button>
                                <div class="w-px h-4 bg-slate-200"></div>
                                <button onclick="changeFontSize(1)" type="button" class="reading-tool-btn w-7.5 h-7.5 rounded-lg flex items-center justify-center text-xs font-bold text-slate-550 border-0 bg-transparent cursor-pointer" title="Tăng cỡ chữ">
                                    A+
                                </button>
                            </div>
                            
                            <!-- Zen mode button -->
                            <button onclick="openZenMode()" type="button" class="reading-tool-btn px-3 py-1.5 bg-teal-50 hover:bg-teal-100/80 text-teal-655 font-bold text-xs rounded-xl flex items-center gap-1.5 border border-teal-100 shadow-sm cursor-pointer" title="Mở chế độ đọc rộng">
                                <i data-lucide="maximize-2" class="w-3.5 h-3.5 stroke-[2.2]"></i>
                                <span class="hidden md:inline">Đọc rộng</span>
                            </button>
                        </div>
                    </div>
                    <div class="p-6 md:p-8 overflow-y-auto custom-scrollbar flex-1 bg-gradient-to-br from-white via-white/95 to-[#FFF9F0]/30 prose-editorial">
                        <div class="prose max-w-none text-[#2d3748] leading-relaxed">
                            <?php if ( ! empty( get_the_content() ) ) : ?>
                                <?php the_content(); ?>
                            <?php else : ?>
                                <div class="flex flex-col items-center justify-center py-10 text-slate-455">
                                    <i data-lucide="file-text" class="w-12 h-12 mb-2 text-slate-300 animate-pulse"></i>
                                    <span class="text-xs font-bold italic text-center">Không có tài liệu văn bản đi kèm cho bài học này.</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Interactive Zen Reading Modal Overlay -->
                <div id="zen-reader-overlay" class="zen-modal-overlay fixed inset-0 z-[99999] bg-slate-950/45 backdrop-blur-md hidden flex items-center justify-center p-4 md:p-6 select-none">
                    <div id="zen-reader-container" class="zen-modal-container max-w-4xl w-full h-[90vh] rounded-[32px] shadow-[0_30px_70px_rgba(10,25,49,0.25)] flex flex-col overflow-hidden border zen-theme-sepia">
                        <!-- Modal Control Bar -->
                        <div class="px-4 md:px-6 py-4 border-b border-[#FFD6C0]/25 bg-white/80 backdrop-blur-sm shrink-0 flex items-center justify-between select-none">
                            <!-- Left: Title info -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-2xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-655 shrink-0 shadow-sm">
                                    <i data-lucide="book-open" class="w-5 h-5 stroke-[2.2]"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="text-sm font-bold text-[#0A1931] tracking-wide font-serif">Chế độ đọc rộng</h4>
                                    <span class="text-[10.5px] text-slate-500 font-sans font-semibold uppercase tracking-wider">Học liệu chuyên sâu từ gốc</span>
                                </div>
                            </div>
                            
                            <!-- Right: Font sizer + Exit button -->
                            <div class="flex items-center gap-2">
                                <!-- Font Sizer -->
                                <div class="flex items-center bg-slate-100 rounded-xl p-0.5 border border-slate-200/60 shadow-sm">
                                    <button onclick="changeFontSize(-1)" type="button" class="reading-tool-btn w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-slate-600 border-0 bg-transparent cursor-pointer" title="Giảm cỡ chữ">
                                        A-
                                    </button>
                                    <div class="w-px h-4 bg-slate-200"></div>
                                    <button onclick="changeFontSize(1)" type="button" class="reading-tool-btn w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-slate-600 border-0 bg-transparent cursor-pointer" title="Tăng cỡ chữ">
                                        A+
                                    </button>
                                </div>
                                
                                <!-- Exit button -->
                                <button onclick="closeZenMode()" type="button" class="w-9 h-9 rounded-full bg-slate-50 hover:bg-red-50 text-slate-400 hover:text-red-500 flex items-center justify-center border border-slate-200/50 hover:border-red-200 shadow-sm cursor-pointer transition-all" title="Thoát chế độ đọc">
                                    <i data-lucide="x" class="w-5 h-5 stroke-[2.2]"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Modal Content Scroll Area -->
                        <div class="p-6 md:p-12 overflow-y-auto custom-scrollbar flex-1 prose-editorial select-text">
                            <div class="max-w-2xl mx-auto py-4 md:py-8">
                                <h1 class="text-2xl md:text-3xl font-bold font-serif text-[#0A1931] tracking-tight mb-8 leading-tight text-center md:text-left">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="prose max-w-none">
                                    <?php if ( ! empty( get_the_content() ) ) : ?>
                                        <?php the_content(); ?>
                                    <?php else : ?>
                                        <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                                            <i data-lucide="file-text" class="w-12 h-12 mb-2 text-slate-300 animate-pulse"></i>
                                            <span class="text-xs font-bold italic text-center">Không có tài liệu văn bản đi kèm cho bài học này.</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div> <!-- Closes w-full max-w-[1100px] mx-auto -->
            </div> <!-- Closes w-full py-6 space-y-6 -->
        </div> <!-- Closes #center-learning-workspace -->

        <!-- COLUMN 3: Live Discussion / Comments (Right Sidebar) -->
        <aside id="qa-sidebar" class="sidebar-workspace sidebar-right-transition w-[320px] shrink-0 bg-transparent flex flex-col z-20">
            <div class="flex flex-col w-full h-full lg:h-auto lg:max-h-[calc(100vh-170px)] bg-white/95 border-0 lg:border border-[#FFD6C0]/40 rounded-none lg:rounded-3xl shadow-none lg:shadow-soft overflow-hidden">
                <!-- Sidebar Header -->
                <div class="px-5 pt-5 pb-3 border-b border-[#FFD6C0]/25 bg-[#FFF9F0]/70 select-none shrink-0">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-serif font-bold text-navy uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="messages-square" class="w-4 h-4 text-teal-655"></i> Thảo luận & Hỏi đáp
                    </h3>
                    <!-- Close button for mobile -->
                    <button onclick="closeAllMobileDrawers()" class="lg:hidden text-slate-400 hover:text-slate-600 transition-colors p-1 bg-transparent border-0 cursor-pointer flex items-center justify-center">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Tab content directly (Live Q&A) -->
            <div class="p-4 flex-initial flex flex-col min-h-0 space-y-4">
                <!-- Realtime Ajax comments list mount -->
                <div class="flex-initial flex flex-col min-h-0 relative z-10">
                    <div id="realtime-comments-list" class="space-y-4 overflow-y-auto pr-1.5 custom-scrollbar flex-initial max-h-[calc(100vh-380px)]">
                        <div class="text-center py-10 text-slate-455 text-xs select-none">
                            <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                            Đang tải thảo luận...
                        </div>
                    </div>
                </div>

                <!-- Q&A submit form -->
                <div class="mt-2 pt-4 border-t border-[#FFD6C0]/25 space-y-3 shrink-0 select-none">
                    <h4 class="text-xs font-bold text-[#0A1931] flex items-center gap-1.5 tracking-wide">
                        <i data-lucide="message-square-plus" class="w-4 h-4 text-teal-655"></i> Gửi câu hỏi / Thảo luận
                    </h4>
                    <form id="ajax-comment-form" onsubmit="submitAjaxComment(event)" class="space-y-3">
                        <textarea id="comment-textarea" name="comment" required rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Hãy viết thắc mắc hoặc thảo luận của bạn..."></textarea>
                        <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
                        <input type="hidden" name="comment_parent" id="ajax_comment_parent" value="0">
                        <?php wp_nonce_field( 'hieucon_comment_nonce', 'comment_nonce' ); ?>
                        
                        <div class="flex justify-end">
                            <button type="submit" id="submit-comment-btn" class="px-5 py-2 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-xl font-bold text-xs shadow-md hover:shadow-lg transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                                Gửi câu hỏi <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div> <!-- Closes inner card wrapper -->
        </aside>

    </div>

    <!-- Synchronous state recovery to prevent visual layout shifts (anti-FOUC) -->
    <script>
        (function() {
            if (localStorage.getItem('left_sidebar_collapsed') === '1') {
                var sb = document.getElementById('playlist-sidebar');
                if (sb) sb.classList.add('collapsed-sidebar');
            }
            if (localStorage.getItem('right_sidebar_collapsed') === '1') {
                var sb = document.getElementById('qa-sidebar');
                if (sb) sb.classList.add('collapsed-sidebar');
            }
        })();
    </script>

    <!-- 3. Smart Auto-Resume Alert Toast Banner (Restructured into viewport bottom-center) -->
    <div id="smart-resume-banner" class="fixed bottom-20 left-1/2 -translate-x-1/2 z-45 max-w-sm w-[90%] glass-panel rounded-2xl py-3 px-4 shadow-elegant border border-orange-200/50 bg-[#FFF9F0]/95 flex items-center justify-between gap-3 transform translate-y-12 opacity-0 pointer-events-none transition-all duration-400 select-none">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 shrink-0">
                <i data-lucide="sparkles" class="w-4 h-4 text-orange-500 animate-pulse"></i>
            </div>
            <div>
                <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Tiếp tục bài học</span>
                <p id="smart-resume-text" class="text-[10px] font-bold text-[#0A1931] leading-tight">Đang tải tiến trình học cũ...</p>
            </div>
        </div>
        <div class="flex items-center gap-1 shrink-0">
            <button type="button" onclick="player.seekTo(0, true); dismissResumeBanner();" class="px-2 py-1 hover:bg-slate-100 text-slate-500 hover:text-slate-800 transition-colors text-[9px] font-bold border-0 bg-transparent cursor-pointer rounded-lg">
                Xem từ đầu
            </button>
            <button type="button" onclick="dismissResumeBanner()" class="text-slate-400 hover:text-slate-600 transition-colors p-1 bg-transparent border-0 cursor-pointer flex items-center justify-center rounded-lg">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

    <!-- 4. Mobile Bottom Dock Navigation Bar -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-[#FFD6C0]/40 px-4 py-2.5 flex items-center justify-around shadow-lg select-none">
        <button onclick="toggleMobileDrawer('playlist')" class="flex flex-col items-center gap-1 text-slate-500 hover:text-teal-650 transition-colors bg-transparent border-0 cursor-pointer">
            <i data-lucide="list-video" class="w-5 h-5"></i>
            <span class="text-[10px] font-bold font-sans">Danh sách bài</span>
        </button>
        <button onclick="toggleMobileDrawer('qa')" class="flex flex-col items-center gap-1 text-slate-500 hover:text-teal-650 transition-colors bg-transparent border-0 cursor-pointer">
            <i data-lucide="messages-square" class="w-5 h-5"></i>
            <span class="text-[10px] font-bold font-sans">Thảo luận</span>
        </button>
    </div>

    <!-- 5. Mobile Drawer Backdrop Overlay -->
    <div id="mobile-drawer-backdrop" onclick="closeAllMobileDrawers()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[140] opacity-0 pointer-events-none transition-all duration-350 select-none"></div>

</main>

<!-- JS Interactions Logic Section -->
<script>
    const ajaxUrlLike = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const currentPostId = <?php echo get_the_ID(); ?>;
    const likeNonce = '<?php echo esc_attr( $like_nonce ); ?>';

    let isFetching = false;
    let pollingTimer = null;
    let expandedRepliesCache = []; // Expanded nested replies tracking
    let visibleTopLevelCount = 5;
    let expandedRepliesFullCache = []; // Fully expanded replies tracks
    let lastCommentsHtmlCache = ""; // Polling cache to prevent layout thrashing

    // --- SIDEBAR TOGGLE & MOBILE DRAWERS LOGIC ---
    function toggleSidebar(direction) {
        if (direction === 'left') {
            const sidebar = document.getElementById('playlist-sidebar');
            const btn = document.getElementById('toggle-left-sidebar');
            sidebar.classList.toggle('collapsed-sidebar');
            const isCollapsed = sidebar.classList.contains('collapsed-sidebar');
            localStorage.setItem('left_sidebar_collapsed', isCollapsed ? '1' : '0');
            if (btn) {
                if (isCollapsed) {
                    btn.classList.remove('bg-teal-50', 'text-teal-600');
                    btn.classList.add('bg-white', 'text-slate-500');
                } else {
                    btn.classList.add('bg-teal-50', 'text-teal-600');
                    btn.classList.remove('bg-white', 'text-slate-500');
                }
            }
        } else if (direction === 'right') {
            const sidebar = document.getElementById('qa-sidebar');
            const btn = document.getElementById('toggle-right-sidebar');
            sidebar.classList.toggle('collapsed-sidebar');
            const isCollapsed = sidebar.classList.contains('collapsed-sidebar');
            localStorage.setItem('right_sidebar_collapsed', isCollapsed ? '1' : '0');
            if (btn) {
                if (isCollapsed) {
                    btn.classList.remove('bg-teal-50', 'text-teal-600');
                    btn.classList.add('bg-white', 'text-slate-500');
                } else {
                    btn.classList.add('bg-teal-50', 'text-teal-600');
                    btn.classList.remove('bg-white', 'text-slate-500');
                }
            }
        }
    }

    function toggleMobileDrawer(type) {
        closeAllMobileDrawers(false); // Close first without fading backdrop
        
        const backdrop = document.getElementById('mobile-drawer-backdrop');
        if (type === 'playlist') {
            const drawer = document.getElementById('playlist-sidebar');
            if (drawer) {
                drawer.classList.add('open');
                drawer.style.display = 'flex';
                if (backdrop) {
                    backdrop.classList.add('opacity-100', 'pointer-events-auto');
                    backdrop.classList.remove('opacity-0', 'pointer-events-none');
                }
            }
        } else if (type === 'qa') {
            const drawer = document.getElementById('qa-sidebar');
            if (drawer) {
                drawer.classList.add('open');
                drawer.style.display = 'flex';
                if (backdrop) {
                    backdrop.classList.add('opacity-100', 'pointer-events-auto');
                    backdrop.classList.remove('opacity-0', 'pointer-events-none');
                }
                fetchComments(true); // Fetch latest comments on drawer open
            }
        }
    }

    function closeAllMobileDrawers(fadeBackdrop = true) {
        const playlist = document.getElementById('playlist-sidebar');
        const qa = document.getElementById('qa-sidebar');
        
        if (playlist) {
            playlist.classList.remove('open');
            setTimeout(() => {
                if (!playlist.classList.contains('open') && window.innerWidth < 1280) {
                    playlist.style.display = 'none';
                }
            }, 400);
        }
        if (qa) {
            qa.classList.remove('open');
            setTimeout(() => {
                if (!qa.classList.contains('open') && window.innerWidth < 1024) {
                    qa.style.display = 'none';
                }
            }, 400);
        }
        
        if (fadeBackdrop) {
            const backdrop = document.getElementById('mobile-drawer-backdrop');
            if (backdrop) {
                backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            // Set stroke width to 1.5 matching Dawnbridge thin brand style
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        // Restore sidebar collapsed states
        if (localStorage.getItem('left_sidebar_collapsed') === '1') {
            const sidebar = document.getElementById('playlist-sidebar');
            const btn = document.getElementById('toggle-left-sidebar');
            if (sidebar) sidebar.classList.add('collapsed-sidebar');
            if (btn) {
                btn.classList.remove('bg-teal-50', 'text-teal-600');
                btn.classList.add('bg-white', 'text-slate-500');
            }
        } else {
            const btn = document.getElementById('toggle-left-sidebar');
            if (btn) {
                btn.classList.add('bg-teal-50', 'text-teal-600');
                btn.classList.remove('bg-white', 'text-slate-500');
            }
        }

        if (localStorage.getItem('right_sidebar_collapsed') === '1') {
            const sidebar = document.getElementById('qa-sidebar');
            const btn = document.getElementById('toggle-right-sidebar');
            if (sidebar) sidebar.classList.add('collapsed-sidebar');
            if (btn) {
                btn.classList.remove('bg-teal-50', 'text-teal-600');
                btn.classList.add('bg-white', 'text-slate-500');
            }
        } else {
            const btn = document.getElementById('toggle-right-sidebar');
            if (btn) {
                btn.classList.add('bg-teal-50', 'text-teal-600');
                btn.classList.remove('bg-white', 'text-slate-500');
            }
        }

        // Playlist active item auto-scroll
        const activeItem = document.getElementById('active-playlist-item');
        const playlistContainer = document.getElementById('sidebar-playlist-items');
        if (activeItem && playlistContainer) {
            setTimeout(() => {
                activeItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        }

        // Fetch comments on start
        fetchComments(false);

        // Start discussion background poll every 10 seconds
        startPolling();

        // Listen for beforeunload to sync progress immediately
        window.addEventListener('beforeunload', function() {
            saveProgressToDatabase();
        });
        window.addEventListener('pagehide', function() {
            saveProgressToDatabase();
        });
    });

    // --- YOUTUBE PLAYER API CONTROLLER ---
    let player;
    let progressInterval = null;
    let maxPercentWatched = 0;
    let syncCounter = 0;
    const lessonId = <?php echo get_the_ID(); ?>;
    const totalLessonsCount = <?php echo intval( $total_lessons_count ); ?>;
    let lessonProgresses = <?php echo json_encode( empty( $progress_list ) ? new stdClass() : $progress_list ); ?>;
    const courseLessonIds = <?php echo json_encode( array_map( function( $l ) { return $l->ID; }, $playlist_lessons ) ); ?>;
    let isResumeReady = false;
    let resumeTimeSeconds = 0;

    // Load API scripts
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    function onYouTubeIframeAPIReady() {
        <?php
        $video_id = '';
        if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video_url, $match ) ) {
            $video_id = $match[1];
        }
        ?>
        
        player = new YT.Player('youtube-player-mount', {
            height: '100%',
            width: '100%',
            videoId: '<?php echo esc_attr( $video_id ); ?>',
            playerVars: {
                'controls': 0,          // Hide YouTube native control bar
                'modestbranding': 1,   // Hide YouTube watermark logo
                'rel': 0,              // Disable related videos at end
                'showinfo': 0,         // Hide titles
                'iv_load_policy': 3,   // Disable annotations
                'fs': 0,               // Disable native fullscreen button
                'disablekb': 1,        // Disable keyboard interactions
                'playsinline': 1,      // Play inline on mobile browsers
                'autohide': 1          // Auto-hide native panels
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        // Dismiss loading buffering screen, show custom Cover Screen
        const loader = document.getElementById('player-loading-overlay');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 300);
        }

        const totalSecs = player.getDuration();
        document.getElementById('player-total-time').innerText = formatTime(totalSecs);

        setupPlayerControls();

        // --- SMART AUTO-RESUME PREPARATION ---
        const savedPercent = parseInt(lessonProgresses[lessonId]) || 0;
        if (savedPercent > 0 && savedPercent < 100 && totalSecs > 0) {
            resumeTimeSeconds = Math.floor((savedPercent / 100) * totalSecs);
            if (resumeTimeSeconds > 2) {
                isResumeReady = true;
                // Update start cover button label
                const coverBtn = document.querySelector('#player-cover-overlay button');
                if (coverBtn) {
                    coverBtn.innerHTML = `Học tiếp từ ${formatTime(resumeTimeSeconds)} <i data-lucide="play" class="w-4 h-4 fill-current text-white"></i>`;
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            }
        }
    }

    // Triggered when clicking "Bắt đầu học" on cover page
    function startLearning() {
        const cover = document.getElementById('player-cover-overlay');
        if (cover) {
            cover.style.opacity = '0';
            setTimeout(() => cover.style.display = 'none', 350);
        }

        if (player) {
            if (isResumeReady && resumeTimeSeconds > 0) {
                player.seekTo(resumeTimeSeconds, true);
                
                // Show Smart Auto-Resume Alert Banner
                const banner = document.getElementById('smart-resume-banner');
                const bannerText = document.getElementById('smart-resume-text');
                const savedPercent = parseInt(lessonProgresses[lessonId]) || 0;
                if (banner && bannerText) {
                    bannerText.innerText = 'Đang tiếp tục tự động từ giây thứ ' + formatTime(resumeTimeSeconds) + ' (' + savedPercent + '%)';
                    banner.classList.remove('translate-y-12', 'opacity-0', 'pointer-events-none');
                    
                    // Auto-hide after 4 seconds
                    setTimeout(dismissResumeBanner, 4000);
                }
            }
            player.playVideo();
        }
    }

    function dismissResumeBanner() {
        const banner = document.getElementById('smart-resume-banner');
        if (banner) {
            banner.classList.add('translate-y-12', 'opacity-0', 'pointer-events-none');
        }
    }

    function onPlayerStateChange(event) {
        const playBtn = document.getElementById('player-play-btn');
        const container = document.getElementById('custom-video-player-container');
        const pauseOverlay = document.getElementById('player-pause-overlay');
        const endedOverlay = document.getElementById('player-ended-overlay');
        const loadingOverlay = document.getElementById('player-loading-overlay');
        const coverOverlay = document.getElementById('player-cover-overlay');

        if (event.data === YT.PlayerState.PLAYING) {
            playBtn.innerHTML = '<i data-lucide="pause" class="w-4.5 h-4.5 fill-current text-white"></i>';
            container.classList.remove('paused');
            
            // Instantly clear all overlays
            if (pauseOverlay) pauseOverlay.classList.add('opacity-0', 'pointer-events-none');
            if (endedOverlay) endedOverlay.classList.add('opacity-0', 'pointer-events-none');
            if (loadingOverlay) {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => loadingOverlay.style.display = 'none', 200);
            }
            if (coverOverlay) coverOverlay.style.display = 'none';
            
            lucide.createIcons({ strokeWidth: 1.5 });
            triggerCenterPulse('pause');
            startProgressInterval();
        } else if (event.data === YT.PlayerState.PAUSED) {
            playBtn.innerHTML = '<i data-lucide="play" class="w-4.5 h-4.5 fill-current text-white"></i>';
            container.classList.add('paused');
            
            // Show custom 100% Opaque Paused overlay
            if (pauseOverlay) pauseOverlay.classList.remove('opacity-0', 'pointer-events-none');
            
            lucide.createIcons({ strokeWidth: 1.5 });
            triggerCenterPulse('play');
            stopProgressInterval();
            saveProgressToDatabase(); // Auto-save on pause
        } else if (event.data === YT.PlayerState.ENDED) {
            playBtn.innerHTML = '<i data-lucide="play" class="w-4.5 h-4.5 fill-current text-white"></i>';
            container.classList.add('paused');
            
            // Show custom 100% Opaque ended congratulations card
            if (endedOverlay) endedOverlay.classList.remove('opacity-0', 'pointer-events-none');
            
            lucide.createIcons({ strokeWidth: 1.5 });
            
            maxPercentWatched = 100;
            document.getElementById('player-timeline-progress').style.width = '100%';
            document.getElementById('player-timeline-handle').style.left = '100%';
            document.getElementById('player-progress-badge-text').innerText = '100% Hoàn thành';
            
            updateRealtimeProgressUI(100);
            stopProgressInterval();
            saveProgressToDatabase();
        } else if (event.data === YT.PlayerState.BUFFERING) {
            // Trap Buffering event to show loading spinner to mask YT native spinner
            if (loadingOverlay) {
                loadingOverlay.style.display = 'flex';
                loadingOverlay.style.opacity = '1';
            }
        }
    }

    function triggerCenterPulse(state) {
        const centerPlayBtn = document.getElementById('player-center-play-btn');
        if (!centerPlayBtn) return;
        
        const iconHtml = state === 'play' 
            ? '<i data-lucide="play" class="w-8 h-8 fill-teal-400 translate-x-0.5"></i>'
            : '<i data-lucide="pause" class="w-8 h-8 fill-teal-400 text-teal-450 animate-pulse"></i>';
        
        centerPlayBtn.innerHTML = iconHtml;
        lucide.createIcons({ strokeWidth: 1.5 });

        centerPlayBtn.classList.remove('opacity-0', 'scale-90');
        centerPlayBtn.classList.add('opacity-100', 'scale-110');
        
        setTimeout(() => {
            centerPlayBtn.classList.remove('opacity-100', 'scale-110');
            centerPlayBtn.classList.add('opacity-0', 'scale-90');
        }, 450);
    }

    function formatTime(seconds) {
        if (isNaN(seconds) || seconds === Infinity) return "00:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
    }

    function startProgressInterval() {
        if (progressInterval) clearInterval(progressInterval);
        progressInterval = setInterval(() => {
            if (!player || typeof player.getCurrentTime !== 'function') return;

            const current = player.getCurrentTime();
            const duration = player.getDuration();
            
            if (duration > 0) {
                const percent = (current / duration) * 100;
                
                // Seekbar progress
                document.getElementById('player-timeline-progress').style.width = percent + '%';
                document.getElementById('player-timeline-handle').style.left = percent + '%';
                
                // Loaded buffered bar
                const loaded = player.getVideoLoadedFraction();
                document.getElementById('player-timeline-buffered').style.width = (loaded * 100) + '%';

                document.getElementById('player-current-time').innerText = formatTime(current);
                
                const completionPercent = Math.min(100, Math.floor(percent));
                if (completionPercent > maxPercentWatched) {
                    maxPercentWatched = completionPercent;
                    document.getElementById('player-progress-badge-text').innerText = maxPercentWatched + '% Hoàn thành';
                    updateRealtimeProgressUI(maxPercentWatched);
                }

                syncCounter++;
                if (syncCounter >= 50) { // Sync database every 10 seconds of playback
                    syncCounter = 0;
                    saveProgressToDatabase();
                }
            }
        }, 200);
    }

    function stopProgressInterval() {
        if (progressInterval) {
            clearInterval(progressInterval);
            progressInterval = null;
        }
    }

    let lastSavedPercent = <?php echo isset( $progress_list[ get_the_ID() ] ) ? intval( $progress_list[ get_the_ID() ] ) : 0; ?>;
    maxPercentWatched = lastSavedPercent;

    async function saveProgressToDatabase() {
        if (maxPercentWatched <= lastSavedPercent) return;
        
        const tempPercent = maxPercentWatched;
        lastSavedPercent = tempPercent; // Optimistic caching

        const formData = new FormData();
        formData.append('action', 'hieucon_save_lesson_progress');
        formData.append('lesson_id', lessonId);
        formData.append('percent', tempPercent);
        formData.append('nonce', likeNonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success && data.data.updated) {
                console.log('Tiến độ học tập tự động đồng bộ:', tempPercent + '%');
            }
        } catch (e) {
            console.error('Không thể đồng bộ tiến trình học:', e);
        }
    }

    function playVideoFromPauseOverlay() {
        if (player) {
            player.playVideo();
        }
    }

    function replayVideo() {
        if (player) {
            const endedOverlay = document.getElementById('player-ended-overlay');
            if (endedOverlay) endedOverlay.classList.add('opacity-0', 'pointer-events-none');
            
            player.seekTo(0, true);
            player.playVideo();
        }
    }

    function setupPlayerControls() {
        const overlay = document.getElementById('player-click-overlay');
        const playBtn = document.getElementById('player-play-btn');
        const volumeBtn = document.getElementById('player-volume-btn');
        const volumeSlider = document.getElementById('player-volume-slider');
        const timeline = document.getElementById('player-timeline-container');
        const theaterBtn = document.getElementById('player-theater-btn');
        const fullscreenBtn = document.getElementById('player-fullscreen-btn');
        const container = document.getElementById('custom-video-player-container');

        overlay.addEventListener('click', togglePlayPause);
        playBtn.addEventListener('click', togglePlayPause);

        function togglePlayPause() {
            if (!player) return;
            const state = player.getPlayerState();
            if (state === YT.PlayerState.PLAYING) {
                player.pauseVideo();
            } else {
                player.playVideo();
            }
        }

        overlay.addEventListener('dblclick', toggleFullscreen);
        fullscreenBtn.addEventListener('click', toggleFullscreen);

        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen(); // Safari
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        document.addEventListener('fullscreenchange', () => {
            const icon = fullscreenBtn.querySelector('i');
            if (document.fullscreenElement) {
                icon.setAttribute('data-lucide', 'minimize');
            } else {
                icon.setAttribute('data-lucide', 'maximize');
            }
            lucide.createIcons({ strokeWidth: 1.5 });
        });

        volumeSlider.addEventListener('input', (e) => {
            const vol = e.target.value;
            player.setVolume(vol);
            updateVolumeIcon(vol);
        });

        volumeBtn.addEventListener('click', () => {
            if (player.isMuted()) {
                player.unMute();
                volumeSlider.value = player.getVolume();
                updateVolumeIcon(player.getVolume());
            } else {
                player.mute();
                volumeSlider.value = 0;
                updateVolumeIcon(0);
            }
        });

        function updateVolumeIcon(vol) {
            const icon = volumeBtn.querySelector('i');
            if (vol == 0) {
                icon.setAttribute('data-lucide', 'volume-x');
            } else if (vol < 50) {
                icon.setAttribute('data-lucide', 'volume-1');
            } else {
                icon.setAttribute('data-lucide', 'volume-2');
            }
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        timeline.addEventListener('click', (e) => {
            if (!player || typeof player.getDuration !== 'function' || player.getDuration() <= 0) return;
            const rect = timeline.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            const targetSec = pos * player.getDuration();
            player.seekTo(targetSec, true);
            
            document.getElementById('player-timeline-progress').style.width = (pos * 100) + '%';
            document.getElementById('player-timeline-handle').style.left = (pos * 100) + '%';
        });

        let isDraggingTimeline = false;
        timeline.addEventListener('mousedown', () => isDraggingTimeline = true);
        document.addEventListener('mouseup', () => isDraggingTimeline = false);
        document.addEventListener('mousemove', (e) => {
            if (!isDraggingTimeline || !player || typeof player.getDuration !== 'function' || player.getDuration() <= 0) return;
            const rect = timeline.getBoundingClientRect();
            let pos = (e.clientX - rect.left) / rect.width;
            pos = Math.max(0, Math.min(1, pos));
            const targetSec = pos * player.getDuration();
            player.seekTo(targetSec, true);
            
            document.getElementById('player-timeline-progress').style.width = (pos * 100) + '%';
            document.getElementById('player-timeline-handle').style.left = (pos * 100) + '%';
        });

        theaterBtn.addEventListener('click', () => {
            const workspace = document.getElementById('primary');
            const icon = theaterBtn.querySelector('i');
            if (workspace.classList.contains('theater-active')) {
                workspace.classList.remove('theater-active');
                icon.setAttribute('data-lucide', 'layout-sidebar-right');
                
                // Show both sidebars
                const leftSb = document.getElementById('playlist-sidebar');
                if (leftSb) leftSb.classList.remove('collapsed-sidebar');
                const rightSb = document.getElementById('qa-sidebar');
                if (rightSb) rightSb.classList.remove('collapsed-sidebar');
                
                // Update toggles state
                const leftBtn = document.getElementById('toggle-left-sidebar');
                if (leftBtn) {
                    leftBtn.classList.add('bg-teal-50', 'text-teal-600');
                    leftBtn.classList.remove('bg-white', 'text-slate-500');
                }
                const rightBtn = document.getElementById('toggle-right-sidebar');
                if (rightBtn) {
                    rightBtn.classList.add('bg-teal-50', 'text-teal-600');
                    rightBtn.classList.remove('bg-white', 'text-slate-500');
                }
            } else {
                workspace.classList.add('theater-active');
                icon.setAttribute('data-lucide', 'layout-sidebar');
                
                // Hide both sidebars
                const leftSb = document.getElementById('playlist-sidebar');
                if (leftSb) leftSb.classList.add('collapsed-sidebar');
                const rightSb = document.getElementById('qa-sidebar');
                if (rightSb) rightSb.classList.add('collapsed-sidebar');
                
                // Update toggles state
                const leftBtn = document.getElementById('toggle-left-sidebar');
                if (leftBtn) {
                    leftBtn.classList.remove('bg-teal-50', 'text-teal-600');
                    leftBtn.classList.add('bg-white', 'text-slate-500');
                }
                const rightBtn = document.getElementById('toggle-right-sidebar');
                if (rightBtn) {
                    rightBtn.classList.remove('bg-teal-50', 'text-teal-600');
                    rightBtn.classList.add('bg-white', 'text-slate-500');
                }
            }
            lucide.createIcons({ strokeWidth: 1.5 });
        });

        let activeControlsTimer = null;
        container.addEventListener('mousemove', () => {
            container.classList.add('controls-active');
            if (activeControlsTimer) clearTimeout(activeControlsTimer);
            activeControlsTimer = setTimeout(() => {
                const state = player ? player.getPlayerState() : -1;
                if (state === YT.PlayerState.PLAYING) {
                    container.classList.remove('controls-active');
                }
            }, 3000);
        });
        
        container.addEventListener('mouseleave', () => {
            const state = player ? player.getPlayerState() : -1;
            if (state === YT.PlayerState.PLAYING) {
                container.classList.remove('controls-active');
            }
        });

        // Speed dropdown click to toggle for mobile & robust desktop use
        const speedBtn = document.getElementById('player-speed-btn');
        const speedDropdown = document.getElementById('player-speed-dropdown');
        if (speedBtn && speedDropdown) {
            speedBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                speedDropdown.classList.toggle('active-dropdown');
            });
            document.addEventListener('click', (e) => {
                if (!speedBtn.contains(e.target) && !speedDropdown.contains(e.target)) {
                    speedDropdown.classList.remove('active-dropdown');
                }
            });
        }
    }

    function setPlayerSpeed(speed) {
        if (!player || typeof player.setPlaybackRate !== 'function') return;
        player.setPlaybackRate(speed);
        document.getElementById('player-speed-label').innerText = speed + 'x';
        
        // Highlight active speed and reset others
        const speedDropdown = document.getElementById('player-speed-dropdown');
        if (speedDropdown) {
            const buttons = speedDropdown.querySelectorAll('button');
            buttons.forEach(btn => {
                if (parseFloat(btn.innerText) === speed) {
                    btn.classList.add('text-teal-350', 'bg-teal-500/20');
                    btn.classList.remove('text-white/70');
                } else {
                    btn.classList.remove('text-teal-350', 'bg-teal-500/20');
                    btn.classList.add('text-white/70');
                }
            });
            // Close dropdown after selection
            speedDropdown.classList.remove('active-dropdown');
        }
    }

    function updateRealtimeProgressUI(percent) {
        const badgeContainer = document.getElementById('active-playlist-item-badge');
        if (badgeContainer) {
            if (percent >= 100) {
                badgeContainer.innerHTML = `
                    <div class="w-6.5 h-6.5 rounded-full bg-emerald-500/15 border border-emerald-500/40 text-emerald-600 flex items-center justify-center shadow-[0_0_10px_rgba(16,185,129,0.2)] animate-pulse-slow">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 stroke-[3]"></i>
                    </div>
                `;
                lucide.createIcons({ strokeWidth: 1.5 });
            } else if (percent > 0) {
                badgeContainer.innerHTML = `
                    <svg class="absolute w-7 h-7 -rotate-90" viewBox="0 0 36 36">
                        <circle class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                        <circle class="text-teal-500 transition-all duration-500 animate-pulse-slow" stroke-width="3" stroke-dasharray="` + percent + `, 100" stroke-linecap="round" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                    </svg>
                    <span class="text-[8px] font-bold font-mono text-teal-650 z-10">` + percent + `%</span>
                `;
            }
        }

        let progressObj = Array.isArray(lessonProgresses) ? {} : lessonProgresses;
        progressObj[lessonId] = percent;
        lessonProgresses = progressObj;

        let sumPercent = 0;
        let completedCount = 0;
        courseLessonIds.forEach(id => {
            const p = parseInt(lessonProgresses[id]) || 0;
            sumPercent += p;
            if (p >= 100) {
                completedCount++;
            }
        });

        const overallPercent = Math.round(sumPercent / totalLessonsCount);

        const courseCompletedText = document.getElementById('course-completed-text');
        if (courseCompletedText) {
            courseCompletedText.innerText = 'Đã học ' + completedCount + ' / ' + totalLessonsCount + ' bài';
        }

        const courseOverallPercentLabel = document.getElementById('course-overall-percent-label');
        if (courseOverallPercentLabel) {
            courseOverallPercentLabel.innerText = overallPercent + '%';
        }

        const courseOverallProgressBar = document.getElementById('course-overall-progress-bar');
        if (courseOverallProgressBar) {
            courseOverallProgressBar.style.width = overallPercent + '%';
        }
    }

    // --- AJAX DISCUSSION Realtime comments ---
    function cacheActiveReplyStates() {
        const states = {};
        const wraps = document.querySelectorAll('[id^="reply-form-wrap-"]');
        wraps.forEach(wrap => {
            if (!wrap.classList.contains('hidden')) {
                const commentId = wrap.id.replace('reply-form-wrap-', '');
                const textarea = document.getElementById(`reply-textarea-${commentId}`);
                states[commentId] = textarea ? textarea.value : '';
            }
        });
        return states;
    }

    function restoreReplyStates(states, activeElementId, selectionStart, selectionEnd) {
        Object.keys(states).forEach(commentId => {
            showReplyForm(parseInt(commentId), true);
            const textarea = document.getElementById(`reply-textarea-${commentId}`);
            if (textarea) {
                textarea.value = states[commentId];
            }
        });

        if (activeElementId) {
            const focusedElem = document.getElementById(activeElementId);
            if (focusedElem) {
                focusedElem.focus();
                if (selectionStart !== null && selectionEnd !== null && typeof focusedElem.setSelectionRange === 'function') {
                    focusedElem.setSelectionRange(selectionStart, selectionEnd);
                }
            }
        }
    }

    function cacheExpandedReplies() {
        const expandedIds = [...expandedRepliesCache];
        const containers = document.querySelectorAll('[id^="replies-container-"]');
        containers.forEach(container => {
            if (!container.classList.contains('hidden')) {
                const commentId = parseInt(container.id.replace('replies-container-', ''));
                if (!expandedIds.includes(commentId)) {
                    expandedIds.push(commentId);
                }
            }
        });
        return expandedIds;
    }

    function restoreExpandedReplies(expandedIds) {
        expandedIds.forEach(commentId => {
            toggleReplies(commentId, true);
        });
    }

    async function fetchComments(silent = false, force = false) {
        if (isFetching && !force) return;

        // Skip background polling if the user is actively typing inside the Q&A sidebar (but never skip on forced manual updates)
        const qaSidebar = document.getElementById('qa-sidebar');
        if (silent && !force && qaSidebar && qaSidebar.contains(document.activeElement)) {
            return;
        }

        isFetching = true;

        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) {
            isFetching = false;
            return;
        }

        const activeStates = cacheActiveReplyStates();
        const expandedReplies = cacheExpandedReplies();
        
        const activeElement = document.activeElement;
        const activeElementId = activeElement ? activeElement.id : null;
        let selectionStart = null;
        let selectionEnd = null;

        if (activeElement && (activeElement.tagName === 'TEXTAREA' || activeElement.tagName === 'INPUT')) {
            selectionStart = activeElement.selectionStart;
            selectionEnd = activeElement.selectionEnd;
        }

        if (!silent && !listContainer.querySelector('.comment-node')) {
            listContainer.innerHTML = `
                <div class="text-center py-10 text-[#334155] text-xs select-none">
                    <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                    Đang tải thảo luận...
                </div>
            `;
        }

        try {
            const url = `${ajaxUrlLike}?action=hieucon_fetch_comments&post_id=${currentPostId}&t=${Date.now()}`;
            const res = await fetch(url);
            const data = await res.json();

            if (data.success) {
                // If polled HTML is exactly the same as cached HTML, return early to prevent lag
                if (lastCommentsHtmlCache === data.data.html) {
                    isFetching = false;
                    return;
                }
                lastCommentsHtmlCache = data.data.html;
                listContainer.innerHTML = data.data.html;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }

                restoreExpandedReplies(expandedReplies);
                applyTopLevelPagination();
                applyNestedRepliesPagination();
                restoreReplyStates(activeStates, activeElementId, selectionStart, selectionEnd);
                if (!silent) {
                    setTimeout(() => {
                        listContainer.scrollTop = listContainer.scrollHeight;
                    }, 100);
                }
            }
        } catch (err) {
            console.error('Lỗi khi tải thảo luận:', err);
        } finally {
            isFetching = false;
        }
    }

    function showReplyForm(commentId, forceOpen = false) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (!wrap) return;

        if (!forceOpen && !wrap.classList.contains('hidden')) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
            return;
        }

        wrap.innerHTML = `
            <form onsubmit="submitAjaxComment(event, ${commentId})" class="mt-2 space-y-2 solid-panel p-3.5 rounded-2xl shadow-soft animate-fadeIn bg-white border border-[#FFD6C0]/35 select-none text-left">
                <textarea id="reply-textarea-${commentId}" required rows="2" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Viết phản hồi của bạn..."></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cancelReplyForm(${commentId})" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-650 rounded-lg font-bold text-[10px] transition-colors border border-slate-200/80 cursor-pointer">Hủy</button>
                    <button type="submit" id="submit-reply-${commentId}-btn" class="px-3 py-1.5 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-lg font-bold text-[10px] shadow-sm transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                        Gửi phản hồi <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                    </button>
                </div>
            </form>
        `;
        wrap.classList.remove('hidden');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        if (!forceOpen) {
            const textarea = document.getElementById(`reply-textarea-${commentId}`);
            if (textarea) {
                textarea.focus();
            }
        }
    }

    function cancelReplyForm(commentId) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (wrap) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
        }
    }

    function toggleReplies(commentId, forceOpen = false) {
        const container = document.getElementById(`replies-container-${commentId}`);
        const toggleWrap = document.getElementById(`reply-toggle-wrap-${commentId}`);
        if (!container || !toggleWrap) return;

        const isHidden = container.classList.contains('hidden');

        if (forceOpen || isHidden) {
            container.classList.remove('hidden');
            if (!expandedRepliesCache.includes(commentId)) {
                expandedRepliesCache.push(commentId);
            }

            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-slate-500 hover:text-slate-450 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-455"></i> Ẩn phản hồi
                </button>
            `;

            applyNestedRepliesPagination();
        } else {
            container.classList.add('hidden');
            expandedRepliesCache = expandedRepliesCache.filter(id => id !== commentId);
            expandedRepliesFullCache = expandedRepliesFullCache.filter(id => id !== commentId);

            const replyCount = container.querySelectorAll('.comment-node[data-reply-index]').length;
            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-primary"></i> Xem ${replyCount} câu trả lời
                </button>
            `;

            applyNestedRepliesPagination();
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    async function submitAjaxComment(event, parentId = 0) {
        event.preventDefault();

        let content = '';
        let submitBtn = null;
        let textarea = null;

        if (parentId === 0) {
            textarea = document.getElementById('comment-textarea');
            submitBtn = document.getElementById('submit-comment-btn');
        } else {
            textarea = document.getElementById(`reply-textarea-${parentId}`);
            submitBtn = document.getElementById(`submit-reply-${parentId}-btn`);
        }

        if (!textarea || !textarea.value.trim()) return;
        content = textarea.value.trim();

        // --- OPTIMISTIC UI UPDATE ---
        const listContainer = document.getElementById('realtime-comments-list');
        if (listContainer) {
            const escapedContent = content.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>");
            const optimisticHtml = `
                <div class="comment-node group/comment relative animate-pulse mt-3 opacity-60 transition-all duration-300">
                    <div class="flex items-start gap-2.5 relative z-10">
                        <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-[10px] text-slate-500 shadow-sm shrink-0">
                            <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="inline-block comment-bubble-glass px-4 py-2.5 rounded-2xl max-w-full border border-slate-200/50">
                                <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                    <span class="text-xs font-extrabold text-slate-500">Đang gửi...</span>
                                </div>
                                <div class="text-[12px] md:text-xs text-slate-600 leading-relaxed break-words font-semibold">
                                    ${escapedContent}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (parentId === 0) {
                listContainer.insertAdjacentHTML('beforeend', optimisticHtml);
                setTimeout(() => {
                    listContainer.scrollTop = listContainer.scrollHeight;
                }, 10);
            } else {
                const repliesContainer = document.getElementById(`replies-container-${parentId}`);
                if (repliesContainer) {
                    repliesContainer.classList.remove('hidden');
                    repliesContainer.insertAdjacentHTML('beforeend', optimisticHtml);
                }
            }
            
            try {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } catch (e) {}
        }
        
        // Immediately clear the textarea to give a fast, responsive feel
        textarea.value = '';

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_submit_comment');
        formData.append('post_id', currentPostId);
        formData.append('comment_parent', parentId);
        formData.append('content', content);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                if (parentId !== 0) {
                    cancelReplyForm(parentId);
                    if (!expandedRepliesCache.includes(parentId)) {
                        expandedRepliesCache.push(parentId);
                    }
                    if (!expandedRepliesFullCache.includes(parentId)) {
                        expandedRepliesFullCache.push(parentId);
                    }
                } else {
                    visibleTopLevelCount = 999;
                }

                // Force fresh HTML render by bypassing polling cache
                lastCommentsHtmlCache = "";

                await fetchComments(true, true);
                if (parentId === 0) {
                    const listContainer = document.getElementById('realtime-comments-list');
                    if (listContainer) {
                        setTimeout(() => {
                            listContainer.scrollTop = listContainer.scrollHeight;
                        }, 100);
                    }
                }
            } else {
                textarea.value = content; // Restore text on failure
                alert(data.data.message || 'Lỗi khi gửi thảo luận.');
            }
        } catch (err) {
            textarea.value = content; // Restore text on failure
            console.error('Lỗi khi gửi thảo luận:', err);
            alert('Lỗi kết nối máy chủ. Vui lòng thử lại.');
        }
    }

    async function handleCommentLike(commentId) {
        const btn = document.getElementById(`comment-like-btn-${commentId}`);
        if (!btn) return;
        btn.disabled = true;

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_like_comment');
        formData.append('comment_id', commentId);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                const isLiked = data.data.status === 'liked';
                const count = data.data.total_likes;

                btn.className = `text-[10px] font-bold transition-colors flex items-center gap-1 ${isLiked ? 'text-red-500' : 'text-slate-500 hover:text-primary'} bg-transparent border-0 cursor-pointer p-0 select-none`;
                
                const heartIcon = isLiked ? '<i data-lucide="heart" class="w-3 h-3 fill-red-500 text-red-500 liked-heart-glow"></i>' : '<i data-lucide="heart" class="w-3 h-3 text-slate-500"></i>';
                const countSpan = count > 0 ? `<span id="comment-like-count-${commentId}" class="bg-red-50 px-1.5 py-0.5 rounded text-red-500 font-bold ml-0.5 border border-red-200/50">${count}</span>` : '';
                
                btn.innerHTML = `${heartIcon} Thích ${countSpan}`;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } else {
                alert(data.data.message || 'Lỗi khi thích bình luận.');
            }
        } catch (err) {
            console.error('Lỗi khi thích bình luận:', err);
        } finally {
            btn.disabled = false;
        }
    }

    function startPolling() {
        if (pollingTimer) clearInterval(pollingTimer);
        pollingTimer = setInterval(() => {
            const qaTab = document.getElementById('qa-sidebar');
            if (qaTab && !qaTab.classList.contains('collapsed-sidebar') && window.innerWidth >= 1024) {
                fetchComments(true);
            }
        }, 10000);
    }

    // --- AJAX POST LIKE RATING ---
    async function handleLikeAction() {
        const likeIcon = document.getElementById('like-icon');
        const likeCountElem = document.getElementById('like-count');
        const btnLike = document.getElementById('btn-like');

        if (!btnLike) return;
        btnLike.disabled = true;

        const formData = new FormData();
        formData.append('action', 'hieucon_like_post');
        formData.append('post_id', currentPostId);
        formData.append('nonce', likeNonce);

        try {
            const res = await fetch(ajaxUrlLike, { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                likeCountElem.innerText = data.data.total_likes;
                if (data.data.status === 'liked') {
                    likeIcon.className = 'w-4.5 h-4.5 text-red-500 fill-red-500 liked-heart-glow';
                    btnLike.classList.add('shadow-[0_4px_15px_rgba(239,68,68,0.08)]', 'border-red-500/20', 'bg-red-50/20');
                } else {
                    likeIcon.className = 'w-4.5 h-4.5 text-slate-455';
                    btnLike.classList.remove('shadow-[0_4px_15px_rgba(239,68,68,0.08)]', 'border-red-500/20', 'bg-red-50/20');
                }
            } else {
                alert(data.data.message);
            }
        } catch (e) {
            console.error('Lỗi kết nối máy chủ khi Thả tim.', e);
        } finally {
            btnLike.disabled = false;
        }
    }

    // --- FACEBOOK PAGINATION SYSTEM ---
    function applyTopLevelPagination() {
        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) return;

        const topComments = Array.from(listContainer.querySelectorAll(':scope > .comment-node'));
        const total = topComments.length;
        const startIndex = Math.max(0, total - visibleTopLevelCount);
        
        topComments.forEach((comment, index) => {
            if (index >= startIndex) {
                comment.classList.remove('hidden');
            } else {
                comment.classList.add('hidden');
            }
        });

        const oldBtn = document.getElementById('load-more-comments-btn-wrap');
        if (oldBtn) oldBtn.remove();

        if (startIndex > 0) {
            const remaining = startIndex;
            const btnHtml = `
                <div id="load-more-comments-btn-wrap" class="pb-3 select-none">
                    <button type="button" onclick="loadMoreTopComments()" class="w-full py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 rounded-xl font-bold text-xs text-primary transition-all flex items-center justify-center gap-1.5 cursor-pointer shadow-sm border-0">
                        <i data-lucide="history" class="w-3.5 h-3.5 text-primary"></i> Xem bình luận cũ hơn (${remaining})
                    </button>
                </div>
            `;
            listContainer.insertAdjacentHTML('afterbegin', btnHtml);
            
            try {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } catch (e) {}
        }
    }

    function loadMoreTopComments() {
        visibleTopLevelCount += 10;
        applyTopLevelPagination();
        applyNestedRepliesPagination(); 
    }

    function applyNestedRepliesPagination() {
        const containers = document.querySelectorAll('.replies-container');
        containers.forEach(container => {
            const parentId = parseInt(container.id.replace('replies-container-', ''));
            const replyNodes = container.querySelectorAll(':scope > .comment-node');
            
            const oldPaginator = document.getElementById(`load-more-replies-wrap-${parentId}`);
            if (oldPaginator) oldPaginator.remove();

            if (replyNodes.length > 2) {
                if (expandedRepliesFullCache.includes(parentId)) {
                    replyNodes.forEach(node => node.classList.remove('hidden'));
                } else {
                    replyNodes.forEach((node, idx) => {
                        if (idx < 2) {
                            node.classList.remove('hidden');
                        } else {
                            node.classList.add('hidden');
                        }
                    });

                    const remaining = replyNodes.length - 2;
                    const paginatorHtml = `
                        <div id="load-more-replies-wrap-${parentId}" class="reply-toggle-wrap mt-2 ml-10 select-none text-left">
                            <button type="button" onclick="loadMoreReplies(${parentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0">
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-primary animate-pulse"></i> Xem thêm ${remaining} câu trả lời khác
                            </button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', paginatorHtml);
                }
            } else {
                replyNodes.forEach(node => node.classList.remove('hidden'));
            }
        });

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    function loadMoreReplies(parentId) {
        if (!expandedRepliesFullCache.includes(parentId)) {
            expandedRepliesFullCache.push(parentId);
        }
        applyNestedRepliesPagination();
    }

    // ==========================================================================
    // PREMIUM INTERACTIVE READING & ZEN MODE LOGIC
    // ==========================================================================
    let currentReadingFontSize = 14; // default base size
    
    function changeFontSize(delta) {
        currentReadingFontSize = Math.max(12, Math.min(22, currentReadingFontSize + delta));
        
        // Target all .prose-editorial containers
        const editorContainers = document.querySelectorAll('.prose-editorial');
        editorContainers.forEach(container => {
            container.style.setProperty('--reading-font-size', `${currentReadingFontSize}px`);
        });
    }
    

    function openZenMode() {
        const overlay = document.getElementById('zen-reader-overlay');
        if (!overlay) return;
        
        // Move overlay to document.body to escape any stacking context
        if (overlay.parentElement !== document.body) {
            document.body.appendChild(overlay);
        }
        
        // Hide site header completely so it cannot appear above the overlay
        const siteHeader = document.getElementById('main-header') || document.querySelector('header#main-header, .site-header, header[role="banner"]');
        if (siteHeader) {
            siteHeader.dataset.zenHidden = 'true';
            siteHeader.style.visibility = 'hidden';
            siteHeader.style.pointerEvents = 'none';
        }
        
        // Prevent body scrolling
        document.body.style.overflow = 'hidden';
        
        overlay.classList.remove('hidden');
        // Force reflow
        overlay.offsetHeight;
        
        overlay.classList.add('zen-active');
        
        // Sync font size to all prose-editorial containers
        const editorContainers = document.querySelectorAll('.prose-editorial');
        editorContainers.forEach(container => {
            container.style.setProperty('--reading-font-size', `${currentReadingFontSize}px`);
        });
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }
    
    function closeZenMode() {
        const overlay = document.getElementById('zen-reader-overlay');
        if (!overlay) return;
        
        overlay.classList.remove('zen-active');
        
        // Restore site header visibility
        const siteHeader = document.querySelector('[data-zen-hidden="true"]');
        if (siteHeader) {
            siteHeader.style.visibility = '';
            siteHeader.style.pointerEvents = '';
            delete siteHeader.dataset.zenHidden;
        }
        
        // Wait for transition animation to complete
        setTimeout(() => {
            overlay.classList.add('hidden');
            // Re-enable body scroll
            document.body.style.overflow = '';
        }, 300);
    }

    // Export all scoped interactive functions to the global window object to prevent ReferenceErrors from inline onclick events
    window.setPlayerSpeed = setPlayerSpeed;
    window.submitAjaxComment = submitAjaxComment;
    window.startLearning = startLearning;
    window.playVideoFromPauseOverlay = playVideoFromPauseOverlay;
    window.replayVideo = replayVideo;
    window.handleLikeAction = handleLikeAction;
    window.dismissResumeBanner = dismissResumeBanner;
    window.loadMoreTopComments = loadMoreTopComments;
    window.loadMoreReplies = loadMoreReplies;
    window.showReplyForm = showReplyForm;
    window.cancelReplyForm = cancelReplyForm;
    window.toggleReplies = toggleReplies;
    window.handleCommentLike = handleCommentLike;
    window.toggleSidebar = toggleSidebar;
    window.toggleMobileDrawer = toggleMobileDrawer;
    window.closeAllMobileDrawers = closeAllMobileDrawers;
    window.changeFontSize = changeFontSize;
    window.openZenMode = openZenMode;
    window.closeZenMode = closeZenMode;
</script>

<?php
get_footer();
