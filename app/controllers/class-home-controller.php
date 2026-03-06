<?php
namespace Hieucon\Controller;

use Hieucon\Model\Post_Model;

/**
 * Điều hướng logic cho trang chủ
 */
class Home_Controller {

    public static function render() {
        // 1. Controller gọi Model lấy data
        $recent_posts = Post_Model::get_recent_posts( 6 );

        // 2. Định hình mảng data truyền sang cho View
        $data = [
            'hero_title'   => 'Chào mừng đến với Hieucon',
            'hero_desc'    => 'Theme WordPress ứng dụng mô hình MVC sạch sẽ.',
            'recent_posts' => $recent_posts,
        ];

        // 3. Gọi View và truyền $data sang
        self::load_view( 'pages/template-home', $data );
    }

    /**
     * Helper Load View (có thể tạo một class riêng cho hàm này nếu to ra)
     */
    private static function load_view( $view, $data = [] ) {
        $view_file = HIEUCON_THEME_DIR . '/views/' . $view . '.php';
        
        if ( file_exists( $view_file ) ) {
            extract( $data ); // Giải nén mảng thành các biến $hero_title, $recent_posts
            require $view_file;
        } else {
            error_log( "Thiếu file view: {$view_file}" );
        }
    }
}
