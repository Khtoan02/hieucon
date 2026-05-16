import re

raw_data = """
11 Nhóm Triệu Chứng Tự Kỷ Toàn Thân: Hướng Dẫn Từ A-Z	https://hieucontugoc.online/11-nhom-trieu-chung-tu-ky-toan-than
Vận Động Thô & Tinh Ở Trẻ Tự Kỷ: Dấu Hiệu & Hỗ Trợ	https://hieucontugoc.online/van-dong-tho-tinh-o-tre-tu-ky
Trẻ Tự Kỷ Hay Ngã, Thăng Bằng Kém: Vì Sao & Khắc Phục	https://hieucontugoc.online/tre-tu-ky-hay-nga-thang-bang-kem
Trẻ Tự Kỷ Khó Leo Cầu Thang: Giải Pháp Hỗ Trợ Di Chuyển	https://hieucontugoc.online/tre-tu-ky-kho-leo-cau-thang
Vận Động Tinh Kém Ở Trẻ Tự Kỷ: Cách Giúp Con Cầm Bút	https://hieucontugoc.online/van-dong-tinh-kem-o-tre-tu-ky
Trẻ Tự Kỷ Đi Nhón Gót (Toe Walking): Cần Xử Lý Thế Nào?	https://hieucontugoc.online/tre-tu-ky-di-nhon-got-toe-walking
Trương Lực Cơ Thấp Ở Trẻ Tự Kỷ: Nhận Biết & Can Thiệp	https://hieucontugoc.online/truong-luc-co-thap-o-tre-tu-ky
Trẻ Tự Kỷ Ngồi Kiểu Chữ W: Tác Hại & Hướng Điều Chỉnh	https://hieucontugoc.online/tre-tu-ky-ngoi-kieu-chu-w
Dáng Đi Bất Thường Ở Trẻ Tự Kỷ: Cha Mẹ Cần Lưu Ý Gì?	https://hieucontugoc.online/dang-di-bat-thuong-o-tre-tu-ky
Vật Lý Trị Liệu Trẻ Tự Kỷ: Khi Nào Cần & Kỳ Vọng Gì?	https://hieucontugoc.online/vat-ly-tri-lieu-tre-tu-ky
Trương Lực Cơ Thấp & Tự Kỷ: Mối Liên Hệ Ít Ai Biết	https://hieucontugoc.online/truong-luc-co-thap-tu-ky
Vận Động Miệng Họng Trẻ Tự Kỷ: Dấu Hiệu & Hướng Hỗ Trợ	https://hieucontugoc.online/van-dong-mieng-hong-tre-tu-ky
Trẻ Tự Kỷ Chảy Nước Dãi Nhiều: Nguyên Nhân & Giải Pháp	https://hieucontugoc.online/tre-tu-ky-chay-nuoc-dai-nhieu
Trẻ Tự Kỷ Hay Bị Sặc Khi Ăn: Cảnh Báo & Cách Xử Lý Sớm	https://hieucontugoc.online/tre-tu-ky-hay-bi-sac-khi-an
Trẻ Tự Kỷ Chỉ Ăn Đồ Mềm, Tránh Nhai: Mẹo Dành Cho Mẹ	https://hieucontugoc.online/tre-tu-ky-chi-an-do-mem-tranh-nhai
Trẻ Nhai Không Kỹ, Nhồi Đầy Miệng: Cách Chỉnh Hành Vi	https://hieucontugoc.online/tre-nhai-khong-ky-nhoi-day-mieng
Trẻ Tự Kỷ Phát Âm Không Rõ: Cách Cải Thiện Tại Nhà	https://hieucontugoc.online/tre-tu-ky-phat-am-khong-ro
Chậm Nói Do Vận Động Miệng Yếu: Nhận Biết & Can Thiệp	https://hieucontugoc.online/cham-noi-do-van-dong-mieng-yeu
Oral Motor Therapy Là Gì? Giải Thích Dễ Hiểu Cho Mẹ	https://hieucontugoc.online/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me
Chậm Nói Do Ngôn Ngữ Hay Do Vận Động Miệng Yếu?	https://hieucontugoc.online/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu
Tiêu Hóa Dạ Dày Trẻ Tự Kỷ: Dấu Hiệu & Hướng Hỗ Trợ	https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky
Trẻ Tự Kỷ Táo Bón Mãn Tính: Hiểu Trục Ruột Não Để Trị	https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh
Trẻ Tự Kỷ Tiêu Chảy Mãn Tính: Dấu Hiệu Chớ Chủ Quan	https://hieucontugoc.online/tre-tu-ky-tieu-chay-man-tinh
Trào Ngược Axit Ở Trẻ Tự Kỷ: Mối Liên Hệ & Cách Giảm	https://hieucontugoc.online/trao-nguoc-axit-o-tre-tu-ky
Trẻ Tự Kỷ Kén Ăn Cực Đoan: Giải Pháp Dinh Dưỡng Đúng	https://hieucontugoc.online/tre-tu-ky-ken-an-cuc-doan
Trẻ Tự Kỷ Hay Đau Bụng Không Rõ Nguyên Nhân: Vì Sao?	https://hieucontugoc.online/tre-tu-ky-hay-dau-bung-khong-ro-nguyen-nhan
Phân Bất Thường Ở Trẻ Tự Kỷ: Nhận Biết Sức Khỏe Ruột	https://hieucontugoc.online/phan-bat-thuong-o-tre-tu-ky
Trẻ Tự Kỷ Chậm Tăng Cân: Cách Tăng Cường Hấp Thu Tốt	https://hieucontugoc.online/tre-tu-ky-cham-tang-can
Trẻ Tự Kỷ Từ Chối Uống Nước: Mẹo Cải Thiện Hiệu Quả	https://hieucontugoc.online/tre-tu-ky-tu-choi-uong-nuoc
Trẻ Tự Kỷ Đầy Hơi, Bụng Căng Phình: Cách Xử Lý Nhanh	https://hieucontugoc.online/tre-tu-ky-day-hoi-bung-cang-phinh
Trục Ruột Não & Tự Kỷ: Bí Ẩn Khoa Học Cha Mẹ Cần Biết	https://hieucontugoc.online/truc-ruot-nao-tu-ky
Chế Độ Ăn Không Gluten Casein (GFCF) Cho Trẻ Tự Kỷ	https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky
Dysbiosis Đường Ruột Ở Trẻ Tự Kỷ: Giải Thích Đơn Giản	https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky
Xử Lý Cảm Giác Ở Trẻ Tự Kỷ: Dấu Hiệu & Hướng Hỗ Trợ	https://hieucontugoc.online/xu-ly-cam-giac-o-tre-tu-ky
Trẻ Tự Kỷ Nhạy Cảm Âm Thanh: Cách Giảm Kích Thích	https://hieucontugoc.online/tre-tu-ky-nhay-cam-am-thanh
Trẻ Tự Kỷ Tránh Ôm ấp, Đụng Chạm: Giải Phẫu Bệnh SPD	https://hieucontugoc.online/tre-tu-ky-tranh-om-ap-dung-cham
Trẻ Tự Kỷ Nhạy Cảm Mùi Vị: Cách Vượt Qua Bữa Ăn Khó	https://hieucontugoc.online/tre-tu-ky-nhay-cam-mui-vi
Tìm Kiếm Áp Lực Sâu Ở Trẻ Tự Kỷ: Ý Nghĩa Hành Vi	https://hieucontugoc.online/tim-kiem-ap-luc-sau-o-tre-tu-ky
Trẻ Tự Kỷ Chỉ Ăn Thức Ăn Cùng Kết Cấu: Mẹo Đa Dạng Hóa	https://hieucontugoc.online/tre-tu-ky-chi-an-thuc-an-cung-ket-cau
Trẻ Tự Kỷ Không Sợ Đau, Không Sợ Nguy Hiểm: Làm Gì?	https://hieucontugoc.online/tre-tu-ky-khong-so-dau-khong-so-nguy-hiem
Trẻ Tự Kỷ Dễ Bị Phân Tán: Cách Tăng Cường Tập Trung	https://hieucontugoc.online/tre-tu-ky-de-bi-phan-tan
Sensory Processing Disorder Khác Tự Kỷ Thế Nào?	https://hieucontugoc.online/sensory-processing-disorder-khac-tu-ky-the-nao
Liệu Pháp Tích Hợp Cảm Giác (OT): Thông Tin Cần Biết	https://hieucontugoc.online/lieu-phap-tich-hop-cam-giac-ot
Ngôn Ngữ Giao Tiếp Trẻ Tự Kỷ: Dấu Hiệu & Can Thiệp	https://hieucontugoc.online/ngon-ngu-giao-tiep-tre-tu-ky
Trẻ Tự Kỷ Chưa Có Ngôn Ngữ (Non-verbal): Cách Kết Nối	https://hieucontugoc.online/tre-tu-ky-chua-co-ngon-ngu-non-verbal
Trẻ Tự Kỷ Chậm Nói: Đánh Giá Cột Mốc & Can Thiệp Sớm	https://hieucontugoc.online/tre-tu-ky-cham-noi
Trẻ Tự Kỷ Kéo Tay, Không Thể Lên Tiếng: Cách Dạy Con	https://hieucontugoc.online/tre-tu-ky-keo-tay-khong-the-len-tieng
Trẻ Tự Kỷ Không Hiểu Chỉ Dẫn: Cách Giao Tiếp Hiệu Quả	https://hieucontugoc.online/tre-tu-ky-khong-hieu-chi-dan
Echolalia Ở Trẻ Tự Kỷ: Hội Chứng Nhái Lại Lời Nói	https://hieucontugoc.online/echolalia-o-tre-tu-ky
Cột Mốc Phát Triển Ngôn Ngữ 0-6 Tuổi: Khi Nào Đáng Lo?	https://hieucontugoc.online/cot-moc-phat-trien-ngon-ngu-0-6-tuoi
Trẻ Không Nói Có Phải Tự Kỷ? Phân Biệt Chậm Nói Đơn Thuần	https://hieucontugoc.online/tre-khong-noi-co-phai-tu-ky-phan-biet-cham-noi-don-thuan
AAC (Giao Tiếp Thay Thế) Cho Trẻ Tự Kỷ Không Ngôn Ngữ	https://hieucontugoc.online/aac-giao-tiep-thay-the-cho-tre-tu-ky-khong-ngon-ngu
Nhận Thức & Học Tập Trẻ Tự Kỷ: Dấu Hiệu & Hỗ Trợ Sớm	https://hieucontugoc.online/nhan-thuc-hoc-tap-tre-tu-ky
Trẻ Tự Kỷ Thiếu Tập Trung, Lơ Đãng: Cách Khắc Phục	https://hieucontugoc.online/tre-tu-ky-thieu-tap-trung-lo-dang
Trẻ Tự Kỷ Tăng Động (Hyperactivity): Can Thiệp Đúng	https://hieucontugoc.online/tre-tu-ky-tang-dong-hyperactivity
Trẻ Tự Kỷ Xử Lý Thông Tin Chậm: Mẹo Hỗ Trợ Tiếp Thu	https://hieucontugoc.online/tre-tu-ky-xu-ly-thong-tin-cham
Trẻ Tự Kỷ Khó Giải Quyết Vấn Đề: Rèn Kỹ Năng Cốt Lõi	https://hieucontugoc.online/tre-tu-ky-kho-giai-quyet-van-de
Chậm Phát Triển Toàn Diện Ở Trẻ Tự Kỷ: Cách Đồng Hành	https://hieucontugoc.online/cham-phat-trien-toan-dien-o-tre-tu-ky
ADHD & Tự Kỷ: Phân Biệt Điểm Giống Và Khác Nhau	https://hieucontugoc.online/adhd-tu-ky
Rối Loạn Chức Năng Điều Hành Ở Trẻ Tự Kỷ: Cách Hỗ Trợ	https://hieucontugoc.online/roi-loan-chuc-nang-dieu-hanh-o-tre-tu-ky
Hành Vi Xã Hội Trẻ Tự Kỷ: Dấu Hiệu & Hướng Hỗ Trợ	https://hieucontugoc.online/hanh-vi-xa-hoi-tre-tu-ky
Trẻ Tự Kỷ Không Phản Ứng Khi Gọi Tên: Nguyên Nhân Lõi	https://hieucontugoc.online/tre-tu-ky-khong-phan-ung-khi-goi-ten
Thiếu Giao Tiếp Mắt Ở Trẻ Tự Kỷ: Cách Rèn Tại Nhà	https://hieucontugoc.online/thieu-giao-tiep-mat-o-tre-tu-ky
Trẻ Tự Kỷ Ít Chơi Cùng Bạn: Phát Triển Kỹ Năng Xã Hội	https://hieucontugoc.online/tre-tu-ky-it-choi-cung-ban
Hành Vi Stimming Ở Trẻ Tự Kỷ: Ám Ảnh Lặp Lại Là Gì?	https://hieucontugoc.online/hanh-vi-stimming-o-tre-tu-ky
Trẻ Tự Kỷ Kháng Cự Thay Đổi: Cách Tránh Khủng Hoảng	https://hieucontugoc.online/tre-tu-ky-khang-cu-thay-doi
Trẻ Tự Kỷ Bùng Phát Cảm Xúc: Xử Lý Tantrum Dữ Dội	https://hieucontugoc.online/tre-tu-ky-bung-phat-cam-xuc
Trẻ Tự Kỷ Quan Tâm Cực Đoan 1 Chủ Đề: Cách Điều Chỉnh	https://hieucontugoc.online/tre-tu-ky-quan-tam-cuc-doan-1-chu-de
Meltdown & Tantrum Ở Trẻ Tự Kỷ: Cách Phân Biệt Đúng	https://hieucontugoc.online/meltdown-tantrum-o-tre-tu-ky
Stimming Là Gì? Tại Sao Không Nên Ngăn Trẻ Tự Kỷ?	https://hieucontugoc.online/stimming-la-gi-tai-sao-khong-nen-ngan-tre-tu-ky
Rối Loạn Lo Âu Ở Trẻ Tự Kỷ: Dấu Hiệu Nhận Biết Sớm	https://hieucontugoc.online/roi-loan-lo-au-o-tre-tu-ky
Dị Ứng & Nhạy Cảm Thực Phẩm Trẻ Tự Kỷ: Dấu Hiệu Sớm	https://hieucontugoc.online/di-ung-nhay-cam-thuc-pham-tre-tu-ky
Trẻ Tự Kỷ Đỏ Tai/Má Sau Khi Ăn: Biểu Hiện Dị Ứng Ẩn	https://hieucontugoc.online/tre-tu-ky-do-tai-ma-sau-khi-an
Bệnh Chàm Eczema Ở Trẻ Tự Kỷ: Chăm Sóc Da Viêm Dị Ứng	https://hieucontugoc.online/benh-cham-eczema-o-tre-tu-ky
Trẻ Tự Kỷ Thèm Gluten & Sữa: Hệ Lụy & Cách Cai Nghiện	https://hieucontugoc.online/tre-tu-ky-them-gluten-sua
Hành Vi Trẻ Tự Kỷ Thay Đổi Sau Ăn: Lưu Ý Thực Phẩm	https://hieucontugoc.online/hanh-vi-tre-tu-ky-thay-doi-sau-an
Bụng Căng Phình & Đổi Hành Vi Ở Trẻ Tự Kỷ: Vì Sao?	https://hieucontugoc.online/bung-cang-phinh-doi-hanh-vi-o-tre-tu-ky
Đái Dầm Tái Phát Ở Trẻ Tự Kỷ: Rối Loạn Kìm Nén Là Gì?	https://hieucontugoc.online/dai-dam-tai-phat-o-tre-tu-ky
IgE & IgG: Dị Ứng Và Nhạy Cảm Thực Phẩm Khác Gì Nhau?	https://hieucontugoc.online/ige-igg
Casein & Gluten Ảnh Hưởng Não Bộ Trẻ Tự Kỷ Ra Sao?	https://hieucontugoc.online/casein-gluten-anh-huong-khong-bo-tre-tu-ky-ra-sao
Hệ Miễn Dịch Trẻ Tự Kỷ: Dấu Hiệu Suy Yếu & Hỗ Trợ	https://hieucontugoc.online/he-mien-dich-tre-tu-ky
Trẻ Tự Kỷ Hay Ốm Vặt Lên Tới 6-8 Lần/Năm: Đề Phòng	https://hieucontugoc.online/tre-tu-ky-hay-om-vat-len-toi-6-8-lan-nam
Viêm Tai Giữa Tái Phát Ở Trẻ Tự Kỷ: Mối Liên Hệ Sinh Học	https://hieucontugoc.online/viem-tai-giua-tai-phat-o-tre-tu-ky
Viêm Xoang Tái Phát Ở Trẻ Tự Kỷ: Dấu Hiệu Đề Kháng Kém	https://hieucontugoc.online/viem-xoang-tai-phat-o-tre-tu-ky
Dùng Kháng Sinh Liên Tiếp Ảnh Hưởng Trẻ Tự Kỷ Thế Nào?	https://hieucontugoc.online/dung-khang-sinh-lien-tiep-anh-huong-tre-tu-ky-the-nao
Nhiễm Nấm Candida Tái Phát Ở Trẻ Tự Kỷ: Cách Xử Trí	https://hieucontugoc.online/nhiem-nam-candida-tai-phat-o-tre-tu-ky
Bệnh Tự Miễn Gia Đình Có Liên Quan Trẻ Tự Kỷ Không?	https://hieucontugoc.online/benh-tu-mien-gia-dinh-co-lien-quan-tre-tu-ky-khong
PANDAS/PANS Là Gì? Khi Miễn Dịch Tấn Công Não Trẻ	https://hieucontugoc.online/pandas-pans-la-gi-khi-mien-dich-tan-cong-nao-tre
Probiotics Cho Trẻ Tự Kỷ: Bằng Chứng Y Khoa Đáng Tin	https://hieucontugoc.online/probiotics-cho-tre-tu-ky
Dinh Dưỡng Vi Chất Ở Trẻ Tự Kỷ: Thiếu Hụt & Bổ Sung	https://hieucontugoc.online/dinh-duong-vi-chat-o-tre-tu-ky
Đốm Trắng Móng Tay Ở Trẻ Tự Kỷ: Dấu Hiệu Trẻ Thiếu Kẽm	https://hieucontugoc.online/dom-trang-mong-tay-o-tre-tu-ky
Trẻ Tự Kỷ Tóc Mỏng, Rụng Nhiều: Báo Động Thiếu Vi Chất	https://hieucontugoc.online/tre-tu-ky-toc-mong-rung-nhieu
Trẻ Tự Kỷ Ăn Đầy Đủ Nhưng Không Tăng Cân: Nguyên Nhân	https://hieucontugoc.online/tre-tu-ky-an-day-du-nhung-khong-tang-can
Pica Ở Trẻ Tự Kỷ: Tại Sao Con Thích Nuốt Đồ Bậy Bạ?	https://hieucontugoc.online/pica-o-tre-tu-ky
Bong Tróc Lòng Bàn Chân Ở Trẻ Tự Kỷ: Báo Hiệu Bệnh Lý	https://hieucontugoc.online/bong-troc-long-ban-chan-o-tre-tu-ky
Kẽm, Magie Trong Điều Trị Tự Kỷ: Nghiên Cứu Mới Nhất	https://hieucontugoc.online/kem-magie-trong-dieu-tri-tu-ky
Gen MTHFR & Methylfolate (B9) Ở Trẻ Tự Kỷ Là Gì?	https://hieucontugoc.online/gen-mthfr-methylfolate-b9-o-tre-tu-ky-la-gi
Tại Sao Trẻ Tự Kỷ Thường Thiếu Vi Chất Dù Ăn Nhiều?	https://hieucontugoc.online/tai-sao-tre-tu-ky-thuong-thieu-vi-chat-du-an-nhieu
Năng Lượng Chuyển Hóa Ở Trẻ Tự Kỷ: Dấu Hiệu Cần Biết	https://hieucontugoc.online/nang-luong-chuyen-hoa-o-tre-tu-ky
Trẻ Tự Kỷ Mệt Mỏi, Li Bì Quá Mức: Rối Loạn Năng Lượng	https://hieucontugoc.online/tre-tu-ky-met-moi-li-bi-qua-muc
Trẻ Tự Kỷ Ngủ Khó Dậy: Cảnh Báo Chu Kỳ Giấc Ngủ Kém	https://hieucontugoc.online/tre-tu-ky-ngu-kho-day
Trẻ Tự Kỷ Mất Kỹ Năng Đã Biết (Regression): Mẹo Xử Lý	https://hieucontugoc.online/tre-tu-ky-mat-ky-nang-da-biet-regression
Hành Vi Trẻ Tự Kỷ Đổi Theo Giờ: Giải Phẫu Nhịp Sinh Học	https://hieucontugoc.online/hanh-vi-tre-tu-ky-doi-theo-gio
Trẻ Tự Kỷ Chậm Tăng Chiều Cao Cân Nặng: Can Thiệp Sớm	https://hieucontugoc.online/tre-tu-ky-cham-tang-chieu-cao-can-nang
Rối Loạn Ti Thể Ở Trẻ Tự Kỷ: Vì Sao Não Thiếu Năng Lượng?	https://hieucontugoc.online/roi-loan-ti-the-o-tre-tu-ky
Methyl Hóa (Methylation) Ở Trẻ Tự Kỷ Ảnh Hưởng Gì?	https://hieucontugoc.online/methyl-hoa-methylation-o-tre-tu-ky-anh-huong-gi
Thụt Lùi Kỹ Năng Ở Trẻ Tự Kỷ: Phục Hồi Năng Lượng Sớm	https://hieucontugoc.online/thut-lui-ky-nang-o-tre-tu-ky
"""

lines = raw_data.strip().split('\n')

groups = {
    '01': [],
    '02': [],
    '03': [],
    '04': [],
    '05': [],
    '06': [],
    '07': [],
    '08': [],
    '09': [],
    '10': [],
    '11': []
}

current_group = '00' # The first one is general

for line in lines:
    line = line.strip()
    if not line:
        continue
    parts = line.split('\t')
    if len(parts) >= 2:
        title = parts[0].strip()
        url = parts[1].strip().replace('https://hieucontugoc.online', '')
        
        # Decide which group this belongs to based on the order
        if '11 Nhóm Triệu Chứng' in title:
            continue # General
            
        elif 'Vận Động Thô & Tinh' in title: current_group = '01'
        elif 'Vận Động Miệng Họng' in title: current_group = '02'
        elif 'Tiêu Hóa Dạ Dày' in title: current_group = '03'
        elif 'Xử Lý Cảm Giác Ở' in title: current_group = '04'
        elif 'Ngôn Ngữ Giao Tiếp' in title: current_group = '05'
        elif 'Nhận Thức & Học Tập' in title: current_group = '06'
        elif 'Hành Vi Xã Hội' in title: current_group = '07'
        elif 'Dị Ứng & Nhạy Cảm' in title: current_group = '08'
        elif 'Hệ Miễn Dịch Trẻ Tự Kỷ' in title: current_group = '09'
        elif 'Dinh Dưỡng Vi Chất' in title: current_group = '10'
        elif 'Năng Lượng Chuyển Hóa' in title: current_group = '11'
        
        # Clean title slightly (remove "Ở Trẻ Tự Kỷ:", "Trẻ Tự Kỷ", etc if needed, but the user gave them exactly so let's keep it mostly intact but shorten a bit if possible, or just use as is)
        clean_title = title.split(':')[0] if ':' in title else title
        # Actually it's better to keep it short for mega menu
        
        groups[current_group].append({'title': clean_title, 'url': url})

php_array_code = "$symptom_groups_links = [\n"
for grp, links in groups.items():
    php_array_code += f"    '{grp}' => [\n"
    for l in links:
        safe_title = l['title'].replace("'", "\\'")
        php_array_code += f"        ['url' => '{l['url']}', 'title' => '{safe_title}'],\n"
    php_array_code += "    ],\n"
php_array_code += "];"

php_panes_code = "<!-- Right Pane: Content for Tabs -->\n<div class=\"w-[65%] pl-2 relative z-10 flex flex-col\">\n"
php_panes_code += "    <?php\n    " + php_array_code.replace('\n', '\n    ') + "\n    ?>\n"

for num in ['01','02','03','04','05','06','07','08','09','10','11']:
    is_active = (num == '01')
    hidden_class = '' if is_active else 'hidden '
    pane_id = f"pane-{num}"
    
    group_titles = {
        '01': 'Vận động thô & tinh',
        '02': 'Vận động miệng họng',
        '03': 'Tiêu hóa & dạ dày',
        '04': 'Xử lý cảm giác',
        '05': 'Ngôn ngữ & giao tiếp',
        '06': 'Nhận thức & học tập',
        '07': 'Hành vi & xã hội',
        '08': 'Dị ứng thực phẩm',
        '09': 'Hệ miễn dịch',
        '10': 'Dinh dưỡng & vi chất',
        '11': 'Năng lượng chuyển hóa'
    }
    icons = {
        '01': 'person-standing', '02': 'smile', '03': 'apple', '04': 'eye',
        '05': 'message-circle', '06': 'brain', '07': 'users', '08': 'shield-alert',
        '09': 'shield-plus', '10': 'test-tube', '11': 'zap'
    }
    
    overview_url = f"/trieu-chung/nhom-{num}"
    if num == '03':
        overview_url = "/tieu-hoa-da-day-tre-tu-ky"
        
    php_panes_code += f"""
    <!-- Pane {num} -->
    <div id="{pane_id}" class="symptom-pane {hidden_class}flex flex-col h-full animate-fadeIn">
        <a href="{overview_url}" class="flex items-center gap-3 mb-4 pb-3 border-b border-navy/5 shrink-0 group/paneheader hover:bg-[#f8fafc] p-2 -mx-2 rounded-xl transition-colors">
            <div class="w-10 h-10 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary group-hover/paneheader:bg-secondary group-hover/paneheader:text-white transition-colors"><i data-lucide="{icons[num]}" class="w-5 h-5"></i></div>
            <div>
                <h5 class="font-serif font-bold text-navy text-xl leading-tight group-hover/paneheader:text-secondary transition-colors">Nhóm {num}: {group_titles[num]}</h5>
                <p class="text-[12px] text-navy/60 group-hover/paneheader:text-navy flex items-center gap-1 transition-colors">Bài viết tổng quan chuyên đề <i data-lucide="arrow-right" class="w-3 h-3"></i></p>
            </div>
        </a>
        
        <div class="grid grid-cols-2 gap-x-6 gap-y-2.5 overflow-y-auto no-scrollbar pr-2 pb-4 content-start">
            <?php foreach($symptom_groups_links['{num}'] as $link): ?>
            <a href="<?php echo $link['url']; ?>" class="group/link flex items-center gap-2.5 text-[13px] font-bold text-navy hover:text-secondary transition-colors p-1.5 rounded-lg hover:bg-[#f8fafc]">
                <div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary transition-colors shrink-0"></div>
                <span class="line-clamp-1 leading-tight" title="<?php echo esc_attr($link['title']); ?>"><?php echo $link['title']; ?></span>
            </a>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-auto pt-4 border-t border-navy/5 shrink-0">
            <a href="{overview_url}" class="text-[12px] font-bold text-secondary uppercase tracking-widest flex items-center gap-1.5 hover:text-navy transition-colors">
                Xem bài tổng quan Nhóm {num} <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>
"""

php_panes_code += "</div>\n"

# Replace the content in layout-full.php
file_path = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php'
with open(file_path, 'r') as f:
    content = f.read()

# Also we need to change the default active tab in the left pane to '01' instead of '03'
content = content.replace("$isActive = ($num === '03');", "$isActive = ($num === '01');")

pattern = re.compile(r'<!-- Right Pane: Content for Tabs -->\s*<div class="w-\[65%\] pl-2 relative z-10 flex flex-col">.*?</div>\s*</div>\s*</div>\s*</div>\s*<!-- Mega Menu "Dinh Dưỡng" -->', re.DOTALL)
# Wait, the closing tags.
# Right pane is <div class="w-[65%]..."> ... </div>
# The original code has:
# <!-- Right Pane: Content for Tabs -->
# <div class="w-[65%] pl-2 relative z-10 flex flex-col">
# ...
# </div>
# </div> <!-- mega-bridge -->
# </div> <!-- absolute top-full -->
# </div> <!-- group h-full -->
# <!-- Mega Menu "Dinh Dưỡng" -->

replacement = php_panes_code + "                            </div>\n                        </div>\n                    </div>\n\n                    <!-- Mega Menu \"Dinh Dưỡng\" -->"
content = pattern.sub(replacement, content)

with open(file_path, 'w') as f:
    f.write(content)

print("Done generating symptom panes.")
