<?php
/**
 * Course Admin Columns Enhancement
 * Thêm cột tùy chỉnh vào WP Admin list của CPT course & lesson
 * (CPT, Taxonomy, Metabox đã được đăng ký bởi plugin hieucon-elearning)
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// 1. Thêm cột tùy chỉnh vào danh sách bài học (lesson)
// ============================================================
function hieucon_lesson_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['belong_to_course'] = 'Khóa học';
            $new['lesson_order']     = 'Thứ tự';
            $new['lesson_duration']  = 'Thời lượng';
        }
    }
    return $new;
}
add_filter( 'manage_lesson_posts_columns', 'hieucon_lesson_columns' );

function hieucon_lesson_column_content( $col, $post_id ) {
    if ( $col === 'belong_to_course' ) {
        $course_id = get_post_meta( $post_id, '_belong_to_course', true );
        if ( $course_id ) {
            $course = get_post( intval( $course_id ) );
            if ( $course ) {
                echo '<a href="' . get_edit_post_link( $course->ID ) . '" style="font-weight:600;">' . esc_html( $course->post_title ) . '</a>';
            } else {
                echo '<span style="color:#999;">—</span>';
            }
        } else {
            echo '<span style="color:#ef4444;font-size:11px;font-weight:600;">⚠ Chưa gán khóa học</span>';
        }
    }
    if ( $col === 'lesson_order' ) {
        $order = get_post_meta( $post_id, '_lesson_order', true );
        echo $order
            ? '<strong style="font-size:14px;">' . intval( $order ) . '</strong>'
            : '<span style="color:#9ca3af;">—</span>';
    }
    if ( $col === 'lesson_duration' ) {
        $dur = get_post_meta( $post_id, '_lesson_duration', true );
        echo $dur
            ? '<span style="background:#f0fdf4;color:#15803d;padding:2px 8px;border-radius:999px;font-size:11px;font-weight:700;">' . esc_html( $dur ) . '</span>'
            : '<span style="color:#9ca3af;">—</span>';
    }
}
add_action( 'manage_lesson_posts_custom_column', 'hieucon_lesson_column_content', 10, 2 );

// Cho phép sort theo cột thứ tự
add_filter( 'manage_edit-lesson_sortable_columns', function( $cols ) {
    $cols['lesson_order'] = '_lesson_order';
    return $cols;
} );

// ============================================================
// 2. Thêm cột tùy chỉnh vào danh sách khóa học (course)
// ============================================================
function hieucon_course_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['lesson_count']   = 'Bài học';
            $new['enrolled_count'] = 'Đã đăng ký';
        }
    }
    return $new;
}
add_filter( 'manage_course_posts_columns', 'hieucon_course_columns' );

function hieucon_course_column_content( $col, $post_id ) {
    if ( $col === 'lesson_count' ) {
        $q = new WP_Query( [
            'post_type'      => 'lesson',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => [ [ 'key' => '_belong_to_course', 'value' => $post_id, 'compare' => '=' ] ],
        ] );
        wp_reset_postdata();
        echo '<span style="background:#eff6ff;color:#1d4ed8;padding:2px 10px;border-radius:999px;font-weight:700;font-size:12px;">' . $q->found_posts . ' bài</span>';
    }
    if ( $col === 'enrolled_count' ) {
        global $wpdb;
        // Tìm kiếm trong wp_options — PHP serialization: a:N:{i:0;i:COURSE_ID;
        $count = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s AND option_value LIKE %s",
            'hieucon_enrolled_courses_%',
            '%:' . $post_id . ';%'
        ) );
        $color = $count > 0 ? '#065f46' : '#6b7280';
        $bg    = $count > 0 ? '#f0fdf4'  : '#f9fafb';
        echo '<span style="background:' . $bg . ';color:' . $color . ';padding:2px 10px;border-radius:999px;font-weight:700;font-size:12px;">' . $count . ' người</span>';
    }
}
add_action( 'manage_course_posts_custom_column', 'hieucon_course_column_content', 10, 2 );
