<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - WebsiteDN</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .email-header {
            background: linear-gradient(135deg, #1a3b6b 0%, #163259 100%);
            padding: 40px 30px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .email-logo-text {
            color: #d4a017;
            font-size: 36px;
            font-weight: 700;
            margin: 0 0 15px 0;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .email-header-subtitle {
            color: #c7d2fe;
            font-size: 14px;
            font-weight: 400;
            margin: 0 0 20px 0;
            letter-spacing: 0.5px;
        }

        .email-header-title {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .email-body {
            padding: 40px 30px;
            line-height: 1.6;
            color: #333333;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1a3b6b;
            margin-bottom: 20px;
        }

        .email-content {
            font-size: 15px;
            margin-bottom: 30px;
            color: #555555;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .reset-button {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #d4a017 0%, #c9a233 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(212, 160, 23, 0.3);
            transition: all 0.3s ease;
        }

        .reset-button:hover {
            background: linear-gradient(135deg, #c9a233 0%, #d4a017 100%);
            box-shadow: 0 6px 16px rgba(212, 160, 23, 0.4);
            transform: translateY(-2px);
        }

        .expiry-notice {
            background-color: #fff7e6;
            border-left: 4px solid #d4a017;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #856404;
        }

        .manual-link-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .manual-link-title {
            font-size: 13px;
            font-weight: 600;
            color: #666666;
            margin-bottom: 10px;
        }

        .manual-link {
            word-break: break-all;
            font-size: 12px;
            color: #1a3b6b;
            text-decoration: none;
            line-height: 1.5;
        }

        .email-footer {
            background-color: #1a3b6b;
            padding: 25px 30px;
            text-align: center;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer-text {
            color: #c7d2fe;
            font-size: 13px;
            margin: 5px 0;
        }

        .footer-brand {
            color: #d4a017;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 25px 0;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                width: 100% !important;
            }

            .email-header,
            .email-body,
            .email-footer {
                padding: 25px 20px !important;
            }

            .email-header-title {
                font-size: 24px !important;
            }

            .email-logo-text {
                font-size: 30px !important;
            }

            .email-header-subtitle {
                font-size: 12px !important;
            }

            .reset-button {
                padding: 14px 30px !important;
                font-size: 15px !important;
            }
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 20px 0;">
        <tr>
            <td align="center">
                <div class="email-wrapper">
                    <!-- Header -->
                    <div class="email-header">
                        <div class="email-logo-text">WebsiteDN</div>
                        <div class="email-header-subtitle">Sistem Manajemen Tagihan Profesional</div>
                        <h1 class="email-header-title">Reset Password</h1>
                    </div>

                    <!-- Body -->
                    <div class="email-body">
                        <div class="greeting">
                            Halo, <strong>{{ $name }}</strong>!
                        </div>

                        <div class="email-content">
                            Kami menerima permintaan untuk mereset password akun Anda di <strong>WebsiteDN</strong>.
                        </div>

                        <div class="email-content">
                            Silakan klik tombol di bawah ini untuk membuat password baru:
                        </div>

                        <div class="button-container">
                            <a href="{{ $resetUrl }}" class="reset-button">Reset Password</a>
                        </div>

                        <div class="expiry-notice">
                            <strong>⏰ Perhatian:</strong> Link ini akan kadaluarsa dalam <strong>60 menit</strong>
                            setelah email ini dikirim.
                        </div>

                        <div class="divider"></div>

                        <div class="email-content" style="font-size: 14px;">
                            Jika Anda <strong>tidak melakukan</strong> permintaan reset password, abaikan email ini.
                            Tidak ada perubahan yang akan terjadi pada akun Anda.
                        </div>

                        <div class="manual-link-section">
                            <div class="manual-link-title">
                                Jika Anda mengalami kesulitan mengklik tombol "Reset Password", salin dan tempel URL
                                berikut ke browser Anda:
                            </div>
                            <a href="{{ $resetUrl }}" class="manual-link">{{ $resetUrl }}</a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="email-footer">
                        <div class="footer-brand">WebsiteDN</div>
                        <div class="footer-text">Sistem Manajemen Tagihan Profesional</div>
                        <div class="footer-text" style="margin-top: 15px; font-size: 12px;">
                            © {{ date('Y') }} WebsiteDN. All rights reserved.
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
