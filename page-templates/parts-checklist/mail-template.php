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
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html($subject); ?></title>
</head>
<body style="margin: 0; padding: 0; background-color: #EBF1FA; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1E293B; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <div class="wrapper" style="width: 100%; background-color: #EBF1FA; padding: 24px 10px; box-sizing: border-box;">
        <table role="presentation" width="100%" style="border-spacing: 0; border-collapse: collapse;">
            <tr>
                <td align="center">
                    <div class="main-container" style="background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 580px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(13, 42, 120, 0.08); border: 1px solid #D6E2F5; text-align: left;">
                        
                        <!-- Header Banner -->
                        <div class="header" style="background: linear-gradient(150deg, #0A2268 0%, #0D2A78 50%, #163CA3 100%); padding: 24px 24px 20px 24px; text-align: center; color: #ffffff;">
                            <div class="badge-pill" style="display: inline-block; background: rgba(255, 255, 255, 0.15); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #F3BA2F; border: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 10px;">🟡 HIỂU CON TỪ GỐC</div>
                            <h1 style="margin: 0; font-size: 20px; line-height: 1.35; font-weight: 800; color: #FFFFFF; letter-spacing: 0.5px; text-transform: uppercase;">
                                CÔNG CỤ ĐÁNH GIÁ
                                <span class="highlight" style="color: #F3BA2F; display: block;">SỨC KHỎE TOÀN DIỆN</span>
                            </h1>
                        </div>

                        <!-- Main Content Body -->
                        <div class="content" style="padding: 24px 24px 20px 24px;">
                            <!-- Code Badge & Greeting -->
                            <div style="margin-bottom: 14px;">
                                <span class="profile-badge" style="display: inline-block; background-color: #F0F5FF; border: 1px solid #C7DCFE; color: #163CA3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">Mã hồ sơ: <?php echo esc_html($user_code); ?></span>
                            </div>
                            <div class="greeting" style="font-size: 15px; line-height: 1.4; color: #0D2A78; font-weight: 700; margin-bottom: 10px;">Xin chào <?php echo esc_html($parent_name); ?>,</div>
                            
                            <!-- Streamlined Result Link Section -->
                            <div class="result-compact-box" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px 16px; margin: 16px 0 20px 0; text-align: center;">
                                <div class="result-compact-text" style="font-size: 13px; line-height: 1.5; color: #334155; margin-bottom: 12px;">
                                    Kết quả đánh giá của bé đã hoàn tất. Cha mẹ có thể xem chi tiết trực tiếp tại đường link: <br>
                                    <a href="<?php echo $result_url; ?>" target="_blank" style="color: #0284C7; font-weight: 600; word-break: break-all; text-decoration: underline;"><?php echo $result_url; ?></a>
                                </div>
                                <a href="<?php echo $result_url; ?>" class="btn-view-report" target="_blank" style="background-color: #0D2A78; color: #ffffff !important; padding: 12px 24px; text-decoration: none; font-size: 14px; font-weight: 700; border-radius: 8px; display: inline-block; box-shadow: 0 3px 10px rgba(13, 42, 120, 0.2); transition: background-color 0.2s ease;">
                                    Kết quả: <?php echo esc_html($user_code); ?>
                                </a>
                            </div>

                            <!-- Top Issues Summary Card -->
                            <div style="background-color: #FFFDF5; border: 1px solid #FFEAA5; border-radius: 12px; padding: 20px 18px; margin: 20px 0;">
                                <div style="font-size: 14px; font-weight: 700; color: #854D0E; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                    📊 TỔNG QUAN DẤU HIỆU GHI NHẬN NỔI BẬT:
                                </div>
                                <ul style="margin: 0; padding-left: 20px; color: #451A03; font-size: 13px; line-height: 1.6;">
                                    <?php echo $top_issues_html; ?>
                                </ul>
                            </div>

                            <!-- Disclaimer Box -->
                            <div class="disclaimer-box" style="background-color: #FAF5FF; border: 1px solid #E9D5FF; border-radius: 8px; padding: 12px 14px; margin-top: 20px; font-size: 11px; color: #6B21A8; line-height: 1.5;">
                                <strong style="color: #581C87;">⚠️ Lưu ý:</strong> Kết quả từ bộ công cụ mang tính chất tổng hợp thông tin quan sát nhằm hỗ trợ cha mẹ định hướng theo dõi. Đây không phải là kết luận hay chẩn đoán y khoa chính thức.
                            </div>

                        </div>

                        <!-- Refined Minimalist Footer with Subtle Nav -->
                        <div class="footer" style="background-color: #0F172A; color: #94A3B8; padding: 22px 20px; text-align: center; font-size: 12px; line-height: 1.5;">
                            <!-- Subtle Footer Navigation -->
                            <div class="footer-nav" style="border-bottom: none; padding-bottom: 6px; margin-bottom: 10px;">
                                <a href="https://zalo.me/0985391881" class="footer-link-btn footer-btn-tuvan" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(255, 107, 0, 0.15); color: #FF9E59 !important; border: 1px solid rgba(255, 107, 0, 0.3);">
                                    Tư vấn
                                </a>
                                <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" class="footer-link-btn footer-btn-hoidap" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(56, 189, 248, 0.12); color: #38BDF8 !important; border: 1px solid rgba(56, 189, 248, 0.25);">
                                    Hỏi đáp
                                </a>
                                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" class="footer-link-btn footer-btn-congdong" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(241, 245, 249, 0.1); color: #E2E8F0 !important; border: 1px solid rgba(241, 245, 249, 0.2);">
                                    Cộng đồng
                                </a>
                            </div>

                            <div style="font-size: 11px; color: #94A3B8;">
                                © <?php echo date('Y'); ?> Hiểu Con Từ Gốc | <a href="https://hieucontugoc.online" class="site-link" target="_blank" style="color: #F3BA2F; text-decoration: none; font-weight: 700;">hieucontugoc.online</a>
                            </div>
                        </div>

                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>