<?php
/**
 * Template để hiển thị Custom Post Type "Trang HTML"
 */

// Lấy nội dung HTML đã dán trong Admin (từ Meta Box)
$html_content = get_post_meta(get_the_ID(), '_hieucon_html_content', true);

// Nếu có tham số raw=1, xuất trực tiếp mã HTML để render trong Iframe (Cách ly 100% khỏi Theme)
if (isset($_GET['raw']) && $_GET['raw'] === '1') {
    if (!empty($html_content)) {
        echo $html_content;
    } else {
        echo '<p style="text-align: center; font-family: sans-serif; padding: 50px;">Trang này chưa có nội dung HTML nào.</p>';
    }
    exit;
}

get_header();
?>

<main id="primary" class="site-main" style="margin: 0; padding: 0;">
    <div class="custom-html-wrapper" style="width: 100%; position: relative;">
        <!-- Sử dụng Iframe để cách ly hoàn toàn HTML/CSS/JS của người dùng khỏi Theme -->
        <iframe id="html-page-iframe" src="<?php echo esc_url(add_query_arg('raw', '1', get_permalink())); ?>" style="width: 100%; border: none; display: block; overflow: hidden; min-height: 500px;" scrolling="no"></iframe>
    </div>
</main><!-- #primary -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var iframe = document.getElementById('html-page-iframe');
        
        iframe.onload = function() {
            var resizeIframe = function() {
                try {
                    // Cập nhật chiều cao Iframe bằng chiều cao thật của nội dung bên trong
                    var body = iframe.contentWindow.document.body;
                    var html = iframe.contentWindow.document.documentElement;
                    var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
                    iframe.style.height = height + 'px';
                } catch(e) {
                    console.error('Không thể auto-resize Iframe:', e);
                }
            };
            
            // Chạy lần đầu sau khi load
            resizeIframe();
            
            // Xử lý các link click bên trong iframe để tự động điều hướng ở cửa sổ cha thay vì bị kẹt trong Iframe
            try {
                var iframeDoc = iframe.contentWindow.document;
                var links = iframeDoc.querySelectorAll('a');
                links.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        var href = link.getAttribute('href');
                        // Bỏ qua các link anchor (#) cuộn trang nội bộ
                        if(href && href.startsWith('#')) return; 
                        
                        // Mở ở cửa sổ hiện tại (parent) nếu không có target="_blank"
                        if (link.getAttribute('target') !== '_blank') {
                            e.preventDefault();
                            window.top.location.href = link.href;
                        }
                    });
                });

                // Lắng nghe sự thay đổi kích thước DOM bên trong iframe (vd như người dùng mở dropdown, accordion, ảnh load chậm...)
                if (typeof ResizeObserver !== 'undefined') {
                    var ro = new ResizeObserver(function() {
                        resizeIframe();
                    });
                    ro.observe(iframeDoc.body);
                }
            } catch(e) {}
        };
    });
</script>

<?php
get_footer();
?>
