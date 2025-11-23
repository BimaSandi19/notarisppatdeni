<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Tagihan Jatuh Tempo</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f4f6f9;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation"
                    style="max-width: 600px; width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">

                    {{-- Header --}}
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #1a3b6b 0%, #163259 100%); padding: 40px 30px; text-align: center;">
                            <div class="email-logo-text"
                                style="color: #d4a017; font-size: 36px; font-weight: 700; letter-spacing: 1px; margin-bottom: 8px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                WebsiteDN
                            </div>
                            <div class="email-header-subtitle"
                                style="color: #c7d2fe; font-size: 14px; margin-bottom: 20px;">
                                Sistem Manajemen Tagihan Profesional
                            </div>
                            <h1 style="color: #ffffff; font-size: 28px; margin: 0; font-weight: 600;">
                                ⏰ Pengingat Tagihan Jatuh Tempo
                            </h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 40px 30px;">
                            {{-- Greeting --}}
                            <p style="color: #1a3b6b; font-size: 16px; margin: 0 0 20px 0; font-weight: 600;">
                                Halo, {{ $admin->nama ?? $admin->username }}! 👋
                            </p>

                            {{-- Summary Info --}}
                            <div
                                style="background-color: #fff7e6; border-left: 4px solid #d4a017; padding: 16px 20px; margin-bottom: 30px; border-radius: 4px;">
                                <p style="margin: 0 0 8px 0; color: #1a3b6b; font-size: 15px;">
                                    <strong>📋 Ringkasan:</strong>
                                </p>
                                <p style="margin: 0 0 4px 0; color: #1a3b6b; font-size: 14px;">
                                    • Jumlah Tagihan: <strong>{{ $count }} tagihan</strong>
                                </p>
                                <p style="margin: 0; color: #1a3b6b; font-size: 14px;">
                                    • Total Nominal: <strong>Rp {{ number_format($totalNominal, 0, ',', '.') }}</strong>
                                </p>
                            </div>

                            {{-- Main Message --}}
                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;">
                                Sistem mendeteksi <strong style="color: #d4a017;">{{ $count }} tagihan</strong> yang
                                akan <strong>jatuh tempo besok</strong>.
                                Berikut adalah detail lengkapnya:
                            </p>

                            {{-- Bills Table --}}
                            <table role="presentation"
                                style="width: 100%; border-collapse: collapse; margin: 20px 0; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #1a3b6b;">
                                        <th
                                            style="padding: 12px; text-align: left; color: #ffffff; font-size: 13px; font-weight: 600; border-bottom: 2px solid #d4a017;">
                                            Nama Nasabah
                                        </th>
                                        <th
                                            style="padding: 12px; text-align: left; color: #ffffff; font-size: 13px; font-weight: 600; border-bottom: 2px solid #d4a017;">
                                            No. Kwitansi
                                        </th>
                                        <th
                                            style="padding: 12px; text-align: right; color: #ffffff; font-size: 13px; font-weight: 600; border-bottom: 2px solid #d4a017;">
                                            Nominal
                                        </th>
                                        <th
                                            style="padding: 12px; text-align: center; color: #ffffff; font-size: 13px; font-weight: 600; border-bottom: 2px solid #d4a017;">
                                            Jatuh Tempo
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dueBills as $index => $bill)
                                        <tr style="background-color: {{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }};">
                                            <td
                                                style="padding: 12px; color: #1f2937; font-size: 14px; border-bottom: 1px solid #e5e7eb;">
                                                <strong>{{ $bill->nama_nasabah }}</strong>
                                            </td>
                                            <td
                                                style="padding: 12px; color: #4b5563; font-size: 13px; border-bottom: 1px solid #e5e7eb;">
                                                {{ $bill->nomor_kwitansi }}
                                            </td>
                                            <td
                                                style="padding: 12px; color: #d4a017; font-size: 14px; font-weight: 600; text-align: right; border-bottom: 1px solid #e5e7eb;">
                                                Rp {{ number_format($bill->nominal_tagihan, 0, ',', '.') }}
                                            </td>
                                            <td
                                                style="padding: 12px; color: #dc2626; font-size: 13px; font-weight: 600; text-align: center; border-bottom: 1px solid #e5e7eb;">
                                                {{ \Carbon\Carbon::parse($bill->tanggal_tagihan)->format('d M Y') }}
                                            </td>
                                        </tr>
                                        @if($bill->keterangan)
                                            <tr style="background-color: {{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }};">
                                                <td colspan="4"
                                                    style="padding: 8px 12px 12px 12px; color: #6b7280; font-size: 12px; font-style: italic; border-bottom: 1px solid #e5e7eb;">
                                                    💬 Keterangan: {{ $bill->keterangan }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Total Summary --}}
                            <div
                                style="background-color: #f3f4f6; padding: 16px 20px; border-radius: 6px; margin: 20px 0;">
                                <p
                                    style="margin: 0; color: #1a3b6b; font-size: 15px; font-weight: 600; text-align: right;">
                                    Total Keseluruhan: <span style="color: #d4a017; font-size: 18px;">Rp
                                        {{ number_format($totalNominal, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            {{-- CTA Button --}}
                            <div style="text-align: center; margin: 30px 0 20px 0;">
                                <a href="{{ url('https://notarisdeni.web.id/admin/reminder') }}"
                                    style="display: inline-block; background: linear-gradient(135deg, #d4a017 0%, #c9a233 100%); color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 6px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 12px rgba(212, 160, 23, 0.3); transition: all 0.3s; line-height: 1.5;">
                                    <span style="display: inline-block; vertical-align: middle; margin-left: 6px;">📋
                                        Lihat Detail di Sistem</span>
                                </a>
                            </div>

                            {{-- Note --}}
                            <div
                                style="background-color: #f0f9ff; border-left: 4px solid #3b82f6; padding: 14px 18px; margin: 25px 0 0 0; border-radius: 4px;">
                                <p style="margin: 0; color: #1e40af; font-size: 13px; line-height: 1.5;">
                                    <strong>💡 Catatan:</strong> Email ini dikirim secara otomatis setiap hari jam 09:00
                                    pagi untuk mengingatkan tagihan yang akan jatuh tempo besok (H-1).
                                </p>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #1a3b6b; padding: 30px; text-align: center;">
                            <p
                                style="color: #d4a017; font-size: 18px; font-weight: 700; margin: 0 0 8px 0; letter-spacing: 0.5px;">
                                WebsiteDN
                            </p>
                            <p style="color: #9ca3af; font-size: 13px; margin: 0 0 15px 0; line-height: 1.5;">
                                Sistem Manajemen Tagihan Profesional<br>
                                Kantor Notaris Deni Nugraha
                            </p>
                            <p style="color: #6b7280; font-size: 12px; margin: 0;">
                                © {{ date('Y') }} WebsiteDN. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

    {{-- Responsive Styles --}}
    <style>
        @media only screen and (max-width: 600px) {
            .email-logo-text {
                font-size: 30px !important;
            }

            .email-header-subtitle {
                font-size: 12px !important;
            }

            table[role="presentation"] {
                width: 100% !important;
            }

            td {
                padding: 20px !important;
            }

            h1 {
                font-size: 24px !important;
            }

            table thead th {
                font-size: 11px !important;
                padding: 10px 8px !important;
            }

            table tbody td {
                font-size: 12px !important;
                padding: 10px 8px !important;
            }
        }
    </style>
</body>

</html>