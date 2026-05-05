<?php
/**
 * Page Generator Utility
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hieucon_add_page_generator_menu() {
    add_theme_page(
        'Tạo Trang Mẫu',
        'Tạo Trang Mẫu',
        'manage_options',
        'hieucon-page-generator',
        'hieucon_page_generator_html'
    );
}
add_action( 'admin_menu', 'hieucon_add_page_generator_menu' );

function hieucon_page_generator_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $message = '';

    if ( isset( $_POST['hieucon_generate_pages'] ) && check_admin_referer( 'hieucon_generate_pages_action', 'hieucon_generate_pages_nonce' ) ) {
        $template_dir = HIEUCON_THEME_DIR . '/page-templates/';
        $templates = glob( $template_dir . '*.php' );
        
        $created_count = 0;
        $existing_count = 0;

        foreach ( $templates as $template_file ) {
            $filename = basename( $template_file );
            $template_path = 'page-templates/' . $filename;
            
            // Get template name
            $file_data = get_file_data( $template_file, array( 'Template Name' => 'Template Name' ) );
            $template_name = ! empty( $file_data['Template Name'] ) ? $file_data['Template Name'] : $filename;

            // Check if page already exists with this template
            $existing_pages = get_pages( array(
                'meta_key' => '_wp_page_template',
                'meta_value' => $template_path,
                'post_type' => 'page',
                'post_status' => array('publish', 'draft', 'private'),
                'number' => 1
            ) );

            if ( empty( $existing_pages ) ) {
                // Create page
                $page_id = wp_insert_post( array(
                    'post_title' => $template_name,
                    'post_status' => 'publish',
                    'post_type' => 'page',
                ) );

                if ( ! is_wp_error( $page_id ) ) {
                    update_post_meta( $page_id, '_wp_page_template', $template_path );
                    $created_count++;
                }
            } else {
                $existing_count++;
            }
        }

        $message = sprintf( '<div class="notice notice-success is-dismissible"><p>Đã tạo thành công <strong>%d</strong> trang. (<strong>%d</strong> trang đã tồn tại từ trước).</p></div>', $created_count, $existing_count );
    }

    ?>
    <div class="wrap">
        <h1>Tạo Các Trang Mẫu Từ Theme</h1>
        <?php echo $message; ?>
        <p>Tính năng này sẽ tự động quét tất cả các file mẫu (templates) trong thư mục <code>page-templates</code> của theme <strong>hieucon</strong> và tạo ra các trang tương ứng trong mục Pages (Trang) của WordPress.</p>
        <p>Nếu một trang với mẫu tương ứng đã tồn tại, hệ thống sẽ bỏ qua để tránh tạo trùng lặp.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field( 'hieucon_generate_pages_action', 'hieucon_generate_pages_nonce' ); ?>
            <input type="hidden" name="hieucon_generate_pages" value="1">
            <?php submit_button( 'Kích Hoạt & Tạo Tất Cả Các Trang Mẫu', 'primary', 'submit', false ); ?>
        </form>
    </div>
    <?php
}
