TÀI LIỆU ĐẶC TẢ YÊU CẦU KỸ THUẬT & LUỒNG NGHIỆP VỤ (SRS)

HỆ THỐNG E-LEARNING (WORDPRESS - THEME & CUSTOM PLUGIN)

Tài liệu này đóng vai trò là kim chỉ nam kỹ thuật dành cho đội ngũ phát triển (Developers). Yêu cầu lập trình viên tuân thủ nghiêm ngặt các quy định về phân tách dữ liệu, luồng nghiệp vụ và các biện pháp bảo mật được mô tả dưới đây.

PHẦN I: KIẾN TRÚC DỮ LIỆU & QUAN HỆ (DATABASE SCHEMA & RELATIONSHIPS)

Để đảm bảo hiệu năng và khả năng mở rộng, toàn bộ phần khai báo dữ liệu và xử lý logic nghiệp vụ nặng phải nằm trong Custom Plugin. Theme chỉ chịu trách nhiệm truy vấn hiển thị (View) và gửi nhận tương tác qua AJAX/REST API.

1. Custom Post Type: Khóa học (course)

Mục đích: Lưu trữ thông tin thương mại và giới thiệu của khóa học.

Trường dữ liệu tiêu chuẩn (WP Core):

post_title: Tiêu đề khóa học.

post_content: Mô tả chi tiết (Hỗ trợ HTML/Gutenberg cho trang Landing Page).

thumbnail (Featured Image): Ảnh đại diện khóa học.

Trường dữ liệu tùy biến (Post Meta):

_course_price (Kiểu: Float/Int): Giá bán của khóa học (Ví dụ: 500000 đại diện cho 500,000 VND. Giá trị 0 đại diện cho khóa học miễn phí).

_course_level (Kiểu: Select): Cấp độ khóa học (basic, intermediate, advanced).

_course_intro_video (Kiểu: URL): Link video giới thiệu (Youtube/Vimeo/Bunny).

_course_duration (Kiểu: Text): Tổng thời lượng hiển thị (Ví dụ: "12 giờ 30 phút").

2. Custom Post Type: Bài học (lesson)

Mục đích: Lưu trữ nội dung bài học video cụ thể.

Trường dữ liệu tiêu chuẩn (WP Core):

post_title: Tiêu đề bài học.

post_content: Tài liệu đính kèm, văn bản hướng dẫn bài học (Hỗ trợ định dạng HTML).

Trường dữ liệu tùy biến (Post Meta):

_belong_to_course (Kiểu: ID - Mối quan hệ 1-N): Lưu trữ duy nhất một ID của Post Type course mà bài học này thuộc về. Bắt buộc phải có để thực hiện truy vấn ngược.

_video_url (Kiểu: URL): Đường dẫn trực tiếp hoặc mã nhúng của video (Bunny.net Stream, Vimeo, YouTube).

_lesson_duration (Kiểu: Text): Thời lượng video (Ví dụ: "15:20").

_lesson_order (Kiểu: Int): Số thứ tự sắp xếp bài học trong khóa học để hiển thị Playlist (Ví dụ: 1, 2, 3...).

3. Custom Database Table: Mã Kích Hoạt (wp_elearning_redeem_codes)

Không sử dụng Post Type cho mã kích hoạt để tối ưu hóa truy xuất và bảo mật thông tin nhạy cảm. Hệ thống sẽ tự động tạo bảng này khi kích hoạt Plugin.

Tên trường

Kiểu dữ liệu

Ràng buộc

Mô tả

id

BIGINT(20)

PRIMARY KEY, AUTO_INCREMENT

Khóa chính

code

VARCHAR(100)

UNIQUE, NOT NULL, INDEX

Chuỗi mã kích hoạt (Ví dụ: SALE100-XYZ)

course_id

BIGINT(20)

NOT NULL, INDEX

ID của khóa học được liên kết

status

TINYINT(1)

DEFAULT 0

Trạng thái: 0 (Chưa sử dụng), 1 (Đã sử dụng)

used_by

BIGINT(20)

NULL, DEFAULT NULL, INDEX

ID của User đã kích hoạt mã này

used_at

DATETIME

NULL, DEFAULT NULL

Thời gian thực hiện kích hoạt

4. Dữ liệu Người dùng (User Meta & Roles)

Hệ thống sử dụng các trường dữ liệu sau để phân quyền người dùng:

_enrolled_courses (Kiểu: Array): Mảng chứa danh sách ID của các khóa học mà người dùng này đã sở hữu/kích hoạt thành công. Ví dụ: [12, 45, 102].

User Roles (Nhóm quyền):

administrator / teacher: Nhóm quản trị hoặc giảng viên sở hữu quyền xem mọi video mà không cần mã kích hoạt, đồng thời nhận diện để gắn thẻ đặc biệt trong bình luận.

subscriber / customer: Học viên thông thường, cần kiểm tra quyền sở hữu qua _enrolled_courses.

PHẦN II: THIẾT KẾ CHI TIẾT CÁC TRANG & LOGIC NGHIỆP VỤ

1. Trang Tất Cả Khóa Học (Public Archive Page)

Nhiệm vụ: Hiển thị danh sách toàn bộ các khóa học đang có trên hệ thống dưới dạng lưới (Grid).

Logic Truy vấn (WP Query):

Query toàn bộ các Post thuộc post type course với trạng thái publish.

Hỗ trợ phân trang mặc định (Ví dụ: 9 hoặc 12 khóa học trên một trang).

Khối SEO Chuẩn Chỉ (Nội dung quan trọng):

Vị trí hiển thị: Nằm ở dưới cùng của trang, bên dưới danh sách và thanh phân trang.

Logic hoạt động: Lập trình viên thiết kế một trang tĩnh trong Admin (ví dụ đặt tên trang là "Tất cả khóa học"). Khi viết code cho file template này, sử dụng hàm gọi nội dung của trang tĩnh đó (get_post_field('post_content', $page_id_config_in_options)) để in ra ngoài. Điều này cho phép quản trị viên thoải mái viết bài viết chuẩn SEO, chèn ảnh, đề mục (H2, H3) thông qua trình soạn thảo của WordPress mà không cần can thiệp vào code.

2. Trang Danh Mục Khóa Học (Public Taxonomy Archive Page)

Nhiệm vụ: Hiển thị danh sách khóa học thuộc về một danh mục chuyên môn cụ thể.

Logic Truy vấn (WP Query):

Tương tự trang Tất cả khóa học, nhưng bổ sung tham số lọc tax_query để chỉ lấy các khóa học thuộc danh mục hiện tại đang xem.

Khối SEO Chuẩn Chỉ:

Vị trí hiển thị: Dưới cùng của danh sách khóa học.

Logic hoạt động: WordPress hỗ trợ mặc định trường Description (Mô tả) cho mỗi danh mục (Term Description). Quản trị viên sẽ soạn thảo bài viết SEO dài (hỗ trợ HTML) vào ô Mô tả của danh mục trong Admin. Lập trình viên gọi hàm term_description() để in nội dung này ra ngoài.

3. Trang Chi Tiết Khóa Học - Landing Page (Public/Mixed)

Nhiệm vụ: Giới thiệu chi tiết lợi ích khóa học để thuyết phục khách hàng đăng ký hoặc nhập mã.

Logic Hiển thị Nội dung:

Phần 1: Giới thiệu chung: Tiêu đề, mô tả chi tiết, video intro (phát trực tiếp không cần đăng nhập).

Phần 2: Syllabus (Mục lục khóa học):

Thực hiện truy vấn ngược: Tìm toàn bộ lesson có trường _belong_to_course bằng ID của khóa học hiện tại. Sắp xếp theo thứ tự trường _lesson_order tăng dần hoặc theo ngày đăng tăng dần.

Hiển thị danh sách bài học dưới dạng danh sách tiêu đề kèm thời lượng (_lesson_duration).

Ràng buộc bảo mật: Tuyệt đối không đặt link liên kết đến bài học tại đây nếu người dùng chưa mua khóa học (Khóa link click, chỉ hiển thị text thường kèm icon ổ khóa).

Logic Nút Kêu Gọi Hành Động (CTA Button) - Trái tim hệ thống:

BẮT ĐẦU: Kiểm tra trạng thái người dùng
|
+---> KHÁCH CHƯA ĐĂNG NHẬP:
|     - Hiển thị nút: "Đăng ký để học ngay"
|     - Hành động khi Click: Kích hoạt Popup Đăng Nhập/Đăng Ký (AJAX).
|
+---> ĐÃ ĐĂNG NHẬP:
      |
      +---> Trường hợp 1: User là Admin/Giáo viên HOẶC ID khóa học nằm trong mảng '_enrolled_courses' của User Meta.
      |     - Hiển thị nút: "VÀO HỌC NGAY" (Nổi bật nhất).
      |     - Hành động khi Click: Chuyển hướng trực tiếp đến trang của "Bài học đầu tiên" trong khóa học.
      |
      +---> Trường hợp 2: Khóa học chưa được mua/kích hoạt.
            - Hiển thị nút: "Đăng ký khóa học / Kích hoạt mã"
            - Hành động khi Click: Chuyển hướng người dùng tới "Trang Nhập Mã Kích Hoạt".


4. Giao Diện Học Tập - Video Workspace (Private & Locked)

Giao diện này áp dụng cho trang chi tiết của từng bài học (single-lesson.php). Thiết kế bố cục tràn màn hình không chứa sidebar của theme chính.

Phần 1: Kiểm tra Quyền Truy Cập (Security Gate) - Chạy ở đầu file template:

Lấy ID khóa học gốc mà bài học này thuộc về thông qua trường _belong_to_course.

Nếu người dùng chưa đăng nhập -> Chuyển hướng (Redirect 302) về trang Chi tiết khóa học gốc kèm thông báo yêu cầu đăng nhập.

Nếu người dùng đã đăng nhập, kiểm tra: Nếu User không có quyền Admin/Teacher VÀ ID khóa học gốc không nằm trong mảng _enrolled_courses của User -> Chuyển hướng về trang Chi tiết khóa học và hiển thị thông báo "Bạn chưa có quyền truy cập bài học này".

Nếu thỏa mãn điều kiện sở hữu -> Cho phép tải giao diện.

Phần 2: Bố cục Giao diện (2 Cột):

Cột Trái (Phát Video - Chiếm 70% chiều rộng):

Hiển thị Trình phát video (Video Player): Lấy mã nhúng hoặc link từ _video_url.

Phía dưới video: Tiêu đề bài học, mô tả bằng chữ của bài học đó, và Khu vực bình luận/Hỏi đáp của bài học.

Cột Phải (Playlist Danh sách bài - Chiếm 30% chiều rộng):

Truy vấn toàn bộ danh sách lesson thuộc cùng một khóa học gốc (_belong_to_course).

Hiển thị danh sách này dưới dạng các hàng dọc.

Hiệu ứng: Bài học đang học (đang xem hiện tại) phải được thêm class CSS hoạt họa nổi bật (Highlight) và tự động cuộn đến vị trí của bài đó trên playlist.

Học viên click vào tiêu đề bài nào sẽ chuyển hướng mượt mà sang trang xem của bài học đó.

5. Trang Nhập Mã Kích Hoạt (Private Page)

Nhiệm vụ: Nơi học viên nhập mã quà tặng/mã mua từ đại lý để tự kích hoạt khóa học vào tài khoản.

Logic Hoạt Động & Xác Thực (AJAX Workflow):

Hiển thị 1 ô nhập văn bản (Input Text) và 1 nút "Kích hoạt khóa học". Chỉ cho phép tài khoản đã đăng nhập truy cập trang này.

Khi người dùng click nút "Kích hoạt" -> Gửi request AJAX kèm theo mã code lên Server.

Xử lý ở Server (PHP Custom Plugin):

Bước 3.1: Kiểm tra tính hợp lệ sơ bộ: Check xem mã code gửi lên có bị trống không.

Bước 3.2: Truy vấn cơ sở dữ liệu: Tìm kiếm dòng dữ liệu trong bảng wp_elearning_redeem_codes nơi trường code bằng giá trị người dùng nhập VÀ trường status = 0 (Chưa sử dụng).

Bước 3.3 (Trường hợp sai): Nếu không tìm thấy hoặc mã đã dùng (status = 1) -> Trả về JSON thông báo lỗi: {"success": false, "message": "Mã kích hoạt không đúng hoặc đã được sử dụng trước đó."}.

Bước 3.4 (Trường hợp đúng): Nếu mã hợp lệ:

Lấy ID khóa học liên kết (course_id) từ dòng dữ liệu đó.

Lấy danh sách _enrolled_courses hiện tại của User đang đăng nhập. Nếu chưa có thì khởi tạo mảng rỗng.

Thêm ID khóa học mới vào mảng này. Lưu ngược lại vào User Meta bằng hàm update_user_meta().

Cập nhật trạng thái của mã kích hoạt trong bảng wp_elearning_redeem_codes: Đổi status thành 1, điền ID người dùng vào trường used_by, điền thời gian hiện tại vào used_at.

Trả về kết quả JSON thành công kèm URL dẫn tới trang Dashboard hoặc khóa học vừa mở: {"success": true, "redirect_url": "[Link trang khóa học]"}.

Xử lý ở Frontend (AJAX Response):

Nếu thành công: Hiển thị thông báo chúc mừng đẹp mắt bằng hiệu ứng Popup, sau 2 giây tự động chuyển hướng người dùng tới trang khóa học họ vừa mở để họ vào học ngay.

Nếu thất bại: Hiển thị dòng thông báo lỗi màu đỏ ngay dưới ô Input mà không tải lại trang.

6. Trang Dashboard Học Viên (Private Dashboard)

Nhiệm vụ: Khu vực quản lý cá nhân dành riêng cho người dùng đã đăng nhập.

Logic Hiển thị Tab "Khóa học của tôi" (My Courses Tab):

Hệ thống đọc mảng _enrolled_courses từ User Meta của người dùng hiện tại.

Nếu mảng trống hoặc không tồn tại: Hiển thị thông báo "Bạn chưa đăng ký khóa học nào" kèm nút dẫn sang trang "Tất cả khóa học".

Nếu mảng chứa danh sách ID khóa học: Thực hiện truy vấn WP_Query lấy các bài viết thuộc post type course có ID nằm trong mảng này (Sử dụng tham số 'post__in' => $enrolled_courses).

Hiển thị danh sách khóa học dưới dạng lưới (Grid), mỗi khóa học đi kèm nút "Vào học ngay".

PHẦN III: CÁC TÍNH NĂNG TƯƠNG TÁC ĐẶC THÙ (ENGAGEMENT SYSTEMS)

1. Hệ thống Bình luận & Đánh dấu Vai trò (Role Badge)

Để tạo uy tín tối đa cho câu trả lời của giáo viên, hệ thống bình luận tại trang học tập (single-lesson.php) và trang chi tiết khóa học (single-course.php) sẽ hoạt động theo logic sau:

Hạ tầng: Tận dụng hệ thống Comment mặc định của WordPress để đảm bảo tốc độ và tính tương thích cao.

Bộ lọc hiển thị (Comment Template Override):

Lập trình viên viết hàm lọc lồng vào luồng hiển thị bình luận (wp_list_comments hoặc hook comment_text).

Trong vòng lặp in bình luận, lấy ID của người gửi bình luận (comment_author_email hoặc user_id).

Kiểm tra Role của User ID này:

Nếu user có quyền administrator: Tự động chèn thêm đoạn HTML dạng badge nổi bật bên cạnh tên hiển thị: <span class="badge admin-badge">Quản trị viên</span>.

Nếu user có quyền teacher (Giảng viên): Chèn badge: <span class="badge teacher-badge">Giảng viên</span>.

Nếu user thông thường: Chỉ hiển thị tên bình thường.

Yêu cầu CSS: Các Badge của Admin và Giáo viên phải có màu sắc nổi bật (Ví dụ: Đỏ hoặc Cam đất), bo góc tròn, cỡ chữ nhỏ gọn để học viên nhìn phát biết ngay đây là câu trả lời chính thức từ ban tổ chức.

2. Hệ thống Thả tim / Yêu thích Không Tải Lại Trang (AJAX Like System)

Học viên có thể bấm "Thả tim" cho Khóa học hoặc cho từng Bài học video cụ thể.

Logic lưu trữ cơ sở dữ liệu:

Mỗi khi có người thả tim, hệ thống sẽ lưu ID của User đó vào một mảng Post Meta có tên là _liked_by_users của chính bài viết/khóa học đó.

Số lượng tim tổng cộng sẽ bằng số lượng phần tử có trong mảng này (Sử dụng hàm đếm count($liked_by_users)).

Luồng hoạt động AJAX (Frontend <-> Backend):

Trạng thái nút hiển thị: Khi tải trang, hệ thống kiểm tra xem User hiện tại đã đăng nhập chưa, và ID của họ có nằm trong mảng _liked_by_users của bài viết này hay không.

Nếu có: Hiển thị Icon trái tim màu đỏ (Trạng thái: Đã thích).

Nếu chưa: Hiển thị Icon trái tim rỗng nét viền xám (Trạng thái: Chưa thích).

Hành động Click: Khi người dùng click vào Icon trái tim:

Trường hợp chưa đăng nhập: Kích hoạt popup Đăng nhập.

Trường hợp đã đăng nhập: Gửi request AJAX lên Server chứa ID bài viết và một mã bảo mật chống tấn công giả mạo (WP Nonce).

Xử lý ở Server:

Xác minh mã bảo mật (Nonce).

Lấy mảng _liked_by_users hiện tại của bài viết đó từ Post Meta.

Kiểm tra:

Nếu ID người dùng chưa có trong mảng: Thêm ID người dùng vào mảng. Hệ thống hiểu đây là hành động Thả tim.

Nếu ID người dùng đã có trong mảng: Xóa ID người dùng khỏi mảng. Hệ thống hiểu đây là hành động Bỏ thả tim.

Lưu mảng đã cập nhật ngược lại vào Post Meta.

Tính toán lại tổng số tim mới: count($updated_array).

Trả về JSON: {"success": true, "total_likes": [Số tim mới], "status": "liked/unliked"}.

Phản hồi hiển thị (UI Update):

Frontend nhận dữ liệu JSON, lập tức thay đổi màu sắc của Icon trái tim (Chuyển đỏ nếu liked, chuyển xám nếu unliked) và cập nhật số lượng tim hiển thị trên màn hình bằng hiệu ứng chuyển động mượt mà, hoàn toàn không cần load lại trang.

PHẦN IV: CÁC BIỆN PHÁP BẢO MẬT & TRÁNH XUNG ĐỘT (SECURITY & COMPATIBILITY)

Chống trùng lặp và Race Condition khi Nhập Mã Kích Hoạt:
Trong quá trình viết mã xử lý kích hoạt code, lập trình viên bắt buộc phải sử dụng cơ chế khóa dữ liệu (Database Transactions hoặc Row Locking) hoặc kiểm tra trạng thái cực kỳ nghiêm ngặt trước khi cập nhật. Ngay khi tìm thấy mã hợp lệ, phải cập nhật trạng thái status = 1 của mã đó ngay lập tức trước khi thực hiện ghi mảng _enrolled_courses cho User để tránh trường hợp người dùng bấm Click liên tục gửi hàng loạt request cùng lúc dẫn đến mã bị kích hoạt cho nhiều tài khoản.

Bảo vệ liên kết Video (Video URL Protection):

Tuyệt đối không hiển thị đường dẫn video trực tiếp (Direct Link MP4) trên mã nguồn HTML của trang web để tránh học viên copy link tải về.

Khuyên dùng phương án mã hóa mã nhúng (ví dụ: Sử dụng thẻ Iframe bảo mật của Bunny.net hoặc Vimeo Pro kèm tính năng Domain Restriction - Chỉ cho phép phát video khi chạy trên tên miền của website bạn).

Hệ Thống Đăng Ký / Đăng Nhập AJAX chuẩn WordPress Core:
Hệ thống form Auth được đặt ở Theme (trong file template hoặc Popup) nhưng khi gửi thông tin xử lý phải gọi thông qua file xử lý AJAX của WordPress (wp-admin/admin-ajax.php) hoặc REST API chuẩn của WordPress. Điều này đảm bảo toàn bộ hệ thống Cookie, Session hoạt động đồng bộ với hệ thống Core, giúp mọi Plugin khác (như plugin phân quyền, lưu cache...) nhận diện tài khoản chuẩn xác và đồng nhất.