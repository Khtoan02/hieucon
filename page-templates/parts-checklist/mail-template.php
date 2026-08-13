<?php
/**
 * HTML Email Template for Hieu Con Tu Goc Checklist Results.
 * 
 * Available variables:
 * - $user_code
 * - $parent_name
 * - $parent_email
 * - $child_name
 * - $child_age
 * - $child_gender
 * - $scores
 * - $top_issues_html
 * - $result_url
 * - $subject
 */
?>
<!DOCTYPE html>
<html lang="vi" style="color-scheme: light; supported-color-schemes: light;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title><?php echo esc_html($subject); ?></title>
    <style>
        :root {
            color-scheme: light;
            supported-color-schemes: light;
        }

        /* Override dark mode dynamic colors for email clients */
        @media (prefers-color-scheme: dark) {

            body,
            .wrapper-bg {
                background-color: #EBF1FA !important;
            }

            .main-container {
                background-color: #ffffff !important;
                border-color: #D6E2F5 !important;
            }

            .content-area {
                background-color: #ffffff !important;
            }

            .greeting-text {
                color: #0D2A78 !important;
            }

            .body-paragraph {
                color: #334155 !important;
            }

            .issues-card {
                background-color: #F0F4FA !important;
                border-color: rgba(13, 42, 120, 0.15) !important;
            }

            .issues-card-title {
                color: #0D2A78 !important;
            }

            .issue-item-title {
                color: #0D2A78 !important;
            }

            .issue-item-desc {
                color: #475569 !important;
            }

            .disclaimer-box {
                background-color: #FAF5FF !important;
                border-color: #E9D5FF !important;
                color: #6B21A8 !important;
            }

            .disclaimer-box strong {
                color: #581C87 !important;
            }
        }
    </style>
</head>

<body
    style="margin: 0; padding: 0; background-color: #EBF1FA; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1E293B; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; color-scheme: light; supported-color-schemes: light;">
    <div class="wrapper-bg"
        style="width: 100%; background-color: #EBF1FA; padding: 24px 10px; box-sizing: border-box; color-scheme: light; supported-color-schemes: light;">
        <table role="presentation" width="100%" style="border-spacing: 0; border-collapse: collapse;">
            <tr>
                <td align="center">
                    <div class="main-container"
                        style="background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 580px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(13, 42, 120, 0.08); border: 1px solid #D6E2F5; text-align: left; color-scheme: light; supported-color-schemes: light;">

                        <!-- Header Banner -->
                        <div class="header"
                            style="background: linear-gradient(150deg, #0A2268 0%, #0D2A78 50%, #163CA3 100%); padding: 24px 24px 20px 24px; text-align: center; color: #ffffff;">
                            <div class="badge-pill"
                                style="display: inline-block; background: rgba(255, 255, 255, 0.15); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #F3BA2F; border: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 10px;">
                                HIỂU CON TỪ GỐC</div>
                            <h1
                                style="margin: 0; font-size: 18px; line-height: 1.35; font-weight: 800; color: #FFFFFF; letter-spacing: 0.5px; text-transform: uppercase;">
                                KẾT QUẢ BỘ CÔNG CỤ NHẬN DIỆN
                                <span class="highlight" style="color: #F3BA2F; display: block;">CÁC VẤN ĐỀ SỨC KHỎE
                                    THƯỜNG GẶP</span>
                            </h1>
                        </div>

                        <!-- Main Content Body -->
                        <div class="content-area" style="padding: 24px 24px 20px 24px; background-color: #ffffff;">
                            <div class="greeting-text"
                                style="font-size: 15px; line-height: 1.5; color: #0D2A78; font-weight: 700; margin-bottom: 8px;">
                                Kính gửi Quý phụ huynh <?php echo esc_html($parent_name); ?>,</div>

                            <p class="body-paragraph"
                                style="font-size: 14px; line-height: 1.6; color: #334155; margin: 0 0 16px 0; padding: 0;">
                                Kết quả nhận diện các vấn đề sức khỏe của con đã được tổng hợp. Quý phụ huynh vui lòng
                                nhấn vào nút dưới đây để xem chi tiết báo cáo:
                            </p>

                            <div style="margin: 0 0 24px 0; text-align: left;">
                                <a href="<?php echo $result_url; ?>" class="btn-view-report" target="_blank"
                                    style="background-color: #0D2A78; color: #ffffff !important; padding: 12px 28px; text-decoration: none; font-size: 14px; font-weight: 700; border-radius: 8px; display: inline-block; box-shadow: 0 3px 10px rgba(13, 42, 120, 0.2); transition: background-color 0.2s ease;">
                                    Xem kết quả
                                </a>
                            </div>

                            <!-- Top Issues Summary Card -->
                            <div class="issues-card"
                                style="background-color: #F0F4FA; border: 1px solid rgba(13, 42, 120, 0.15); border-radius: 12px; padding: 20px 18px; margin: 20px 0;">
                                <div class="issues-card-title"
                                    style="font-size: 15px; font-weight: 700; color: #0D2A78; margin-bottom: 16px;">
                                    Ba vấn đề sức khoẻ cần quan tâm:
                                </div>
                                <div style="margin: 0; color: #334155; font-size: 14px; line-height: 1.6;">
                                    <?php echo $top_issues_html; ?>
                                </div>
                            </div>

                            <!-- Disclaimer Box -->
                             <div class="disclaimer-box"
                                style="background-color: #FAF5FF; border: 1px solid #E9D5FF; border-radius: 8px; padding: 12px 14px; margin-top: 20px; font-size: 12px; color: #6B21A8; line-height: 1.5;">
                                <strong style="color: #581C87;">⚠️ Lưu ý:</strong> Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn phù hợp.
                            </div>

                        </div>

                        <!-- Refined Minimalist Footer with Subtle Nav -->
                        <div class="footer"
                            style="background-color: #0F172A; color: #94A3B8; padding: 22px 20px; text-align: center; font-size: 12px; line-height: 1.5;">
                            <!-- Subtle Footer Navigation -->
                            <div class="footer-nav"
                                style="border-bottom: none; padding-bottom: 6px; margin-bottom: 10px;">
                                <a href="<?php echo home_url('/zalo'); ?>" class="footer-link-btn footer-btn-tuvan"
                                    target="_blank"
                                    style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(255, 107, 0, 0.15); color: #FF9E59 !important; border: 1px solid rgba(255, 107, 0, 0.3);">
                                    Tư vấn
                                </a>
                                <a href="<?php echo home_url('/zalo-group'); ?>"
                                    class="footer-link-btn footer-btn-hoidap" target="_blank"
                                    style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(56, 189, 248, 0.12); color: #38BDF8 !important; border: 1px solid rgba(56, 189, 248, 0.25);">
                                    Góc chia sẻ
                                </a>
                                <a href="<?php echo home_url('/facebook-group'); ?>"
                                    class="footer-link-btn footer-btn-congdong" target="_blank"
                                    style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(241, 245, 249, 0.1); color: #E2E8F0 !important; border: 1px solid rgba(241, 245, 249, 0.2);">
                                    Cộng đồng
                                </a>
                            </div>

                            <div style="font-size: 12px; color: #94A3B8;">
                                © <?php echo date('Y'); ?> Hiểu Con Từ Gốc | <a href="https://hieucontugoc.online"
                                    class="site-link" target="_blank"
                                    style="color: #F3BA2F; text-decoration: none; font-weight: 700;">hieucontugoc.online</a>
                            </div>
                        </div>

                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>