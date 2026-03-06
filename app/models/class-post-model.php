<?php
namespace Hieucon\Model;

/**
 * Tập trung xử lý lấy dữ liệu (Model) cho bài viết
 */
class Post_Model {

    /**
     * Hàm lấy bài viết mới nhất
     */
    public static function get_recent_posts( $count = 5 ) {
        // Có thể áp dụng Caching hoặc Redis ở đây
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
        );

        $query = new \WP_Query( $args );
        return $query->have_posts() ? $query->posts : [];
    }
}
