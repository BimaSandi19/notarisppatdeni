<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Contact Us - WebsiteDN</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(135deg, #1a3b6b 0%, #163259 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .email-logo-text {
            color: #d4a017;
            font-size: 36px;
            font-weight: 700;
            margin: 0 0 8px 0;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .email-header-subtitle {
            color: #c7d2fe;
            font-size: 14px;
            margin: 0 0 20px 0;
        }

        .email-header-title {
            color: #ffffff;
            font-size: 28px;
            margin: 0;
            font-weight: 600;
        }

        .email-body {
            padding: 40px 30px;
            line-height: 1.6;
            color: #333333;
        }

        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #1a3b6b;
            margin-bottom: 20px;
        }

        .email-content {
            font-size: 15px;
            margin-bottom: 20px;
            color: #555555;
        }

        .info-box {
            background-color: #fff7e6;
            border-left: 4px solid #d4a017;
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .info-label {
            color: #1a3b6b;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #1a3b6b;
            font-size: 15px;
            margin: 0;
            word-break: break-word;
        }

        .info-section {
            margin-bottom: 16px;
        }

        .message-box {
            background-color: #f3f4f6;
            border-left: 4px solid #3b82f6;
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .message-label {
            color: #1e40af;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .message-content {
            color: #1a3b6b;
            font-size: 15px;
            margin: 0;
            line-height: 1.6;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 25px 0;
        }

        .cta-note {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 14px 18px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .cta-note-text {
            color: #92400e;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .email-footer {
            background-color: #1a3b6b;
            padding: 30px;
            text-align: center;
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
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                width: 100% !important;
                border-radius: 0 !important;
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

            .info-value,
            .message-content {
                font-size: 14px !important;
            }
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f6f9; padding: 20px 0;">
        <tr>
            <td align="center">
                <div class="email-wrapper">
                    <!-- Header -->
                    <div class="email-header">
                        <div class="email-logo-text">WebsiteDN</div>
                        <div class="email-header-subtitle">Sistem Manajemen Tagihan Profesional</div>
                        <h1 class="email-header-title">📬 Pesan Baru dari Contact Us</h1>
                    </div>

                    <!-- Body -->
                    <div class="email-body">
                        <div class="greeting">
                            Halo, Admin WebsiteDN! 👋
                        </div>

                        <div class="email-content">
                            Anda telah menerima pesan baru dari formulir Contact Us di halaman website. Berikut adalah
                            detail lengkapnya:
                        </div>

                        <!-- Information Box -->
                        <div class="info-box">
                            <!-- Name -->
                            <div class="info-section">
                                <div class="info-label">👤 Nama Pengirim</div>
                                <div class="info-value">{{ $data['name'] }}</div>
                            </div>

                            <!-- Email -->
                            <div class="info-section">
                                <div class="info-label">📧 Email</div>
                                <div class="info-value">
                                    <a href="mailto:{{ $data['email'] }}"
                                        style="color: #d4a017; text-decoration: none;">
                                        {{ $data['email'] }}
                                    </a>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="info-section">
                                <div class="info-label">📌 Subjek</div>
                                <div class="info-value">{{ $data['subject'] }}</div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <!-- Message Box -->
                        <div class="message-box">
                            <div class="message-label">💬 Isi Pesan</div>
                            <div class="message-content">{{ $data['message'] }}</div>
                        </div>

                        <!-- Call to Action Note -->
                        <div class="cta-note">
                            <p class="cta-note-text">
                                <strong>💡 Catatan:</strong> Harap segera membalas email dari pengirim untuk memberikan
                                respons profesional.
                            </p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="email-footer">
                        <div class="footer-brand">WebsiteDN</div>
                        <div class="footer-text">Sistem Manajemen Tagihan Profesional</div>
                        <div class="footer-text">Kantor Notaris Deni Nugraha</div>
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