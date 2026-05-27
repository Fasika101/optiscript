<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription — {{ $prescription->patient->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #222;
            background: #e5e7eb;
        }

        /* ── Print Controls (screen only) ── */
        .print-controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            padding: 16px;
        }
        .btn {
            padding: 9px 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-print { background: #0d9488; color: white; }
        .btn-pdf   { background: #2563eb; color: white; }
        .btn-close { background: #d1d5db; color: #374151; }

        /* ── Paper ── */
        .paper {
            max-width: 680px;
            margin: 0 auto 24px;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
        }

        /* ── Clinic Header ── */
        .clinic-header {
            text-align: center;
            padding: 28px 36px 20px;
        }
        .clinic-name {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #0f766e;
        }
        .clinic-contact {
            font-size: 11.5px;
            color: #555;
            margin-top: 5px;
        }
        .clinic-contact a { color: #555; text-decoration: none; }
        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #0d9488, transparent);
            margin: 0 36px;
        }

        /* ── Rx Title ── */
        .rx-title {
            text-align: center;
            padding: 18px 36px 0;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: underline;
            color: #111;
        }

        /* ── Patient Row ── */
        .patient-row {
            display: flex;
            justify-content: space-between;
            padding: 14px 36px 4px;
            font-size: 13px;
            gap: 16px;
        }
        .patient-row .field { display: flex; gap: 6px; align-items: baseline; }
        .patient-row .label { color: #555; font-weight: 600; }
        .patient-row .value { font-weight: 700; color: #111; }

        /* ── Prescription Table ── */
        .rx-section { padding: 16px 36px 0; }
        .rx-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .rx-table thead th {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            text-align: center;
            font-weight: 700;
            font-size: 12px;
            color: #374151;
        }
        .rx-table thead th:first-child { text-align: left; }
        .rx-table tbody td {
            border: 1px solid #d1d5db;
            padding: 9px 12px;
            text-align: center;
            font-size: 13.5px;
            font-weight: 600;
            color: #111;
        }
        .rx-table tbody td:first-child { font-weight: 700; text-align: left; background: #fafafa; }
        .rx-table .negative { color: #dc2626; }
        .rx-table .positive { color: #059669; }
        .dash { color: #9ca3af; font-weight: 400; }

        /* ── PD Section ── */
        .pd-section {
            padding: 14px 36px 0;
        }
        .pd-label {
            font-size: 12.5px;
            font-weight: 700;
            color: #374151;
        }
        .pd-values {
            display: flex;
            gap: 28px;
            margin-top: 6px;
        }
        .pd-item { text-align: center; }
        .pd-item .pd-title { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; }
        .pd-item .pd-num { font-size: 16px; font-weight: 800; color: #111; }
        .pd-item .pd-unit { font-size: 10px; color: #9ca3af; }

        /* ── Notes ── */
        .notes-section {
            padding: 14px 36px 0;
        }
        .notes-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
            margin-bottom: 6px;
        }
        .notes-text {
            font-size: 12.5px;
            color: #374151;
            line-height: 1.5;
        }
        .diagnosis-badge {
            display: inline-block;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 11.5px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .lens-badge {
            display: inline-block;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 11.5px;
            font-weight: 600;
            margin-left: 6px;
        }

        /* ── Footer ── */
        .rx-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 20px 36px 10px;
        }
        .printed-on {
            font-size: 11px;
            color: #9ca3af;
        }
        .printed-on span { color: #0d9488; font-weight: 600; }
        .signature-block { text-align: right; }
        .sig-line {
            border-top: 1px solid #374151;
            width: 160px;
            margin-left: auto;
            padding-top: 4px;
        }
        .sig-name { font-size: 12px; font-weight: 700; color: #111; }
        .sig-title { font-size: 11px; color: #6b7280; }

        /* ── Branding Strip ── */
        .brand-strip {
            background: #f0fdfa;
            border-top: 1px solid #ccfbf1;
            text-align: center;
            padding: 8px;
            font-size: 11px;
            color: #6b7280;
        }
        .brand-strip strong { color: #0f766e; }
        .brand-strip .free { color: #059669; font-weight: 600; }

        .validity-note {
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
            padding: 8px 36px 0;
        }

        /* ── Print Media ── */
        @media print {
            body { background: white; }
            .print-controls { display: none; }
            .paper {
                margin: 0;
                border: none;
                border-radius: 0;
                box-shadow: none;
            }
            @page { margin: 12mm 10mm; size: A5 portrait; }
        }
    </style>
</head>
<body>

    {{-- Screen-only controls --}}
    <div class="print-controls">
        <button onclick="window.print()" class="btn btn-print">🖨 Print</button>
        <a href="{{ route('prescriptions.download', $prescription) }}" class="btn btn-pdf">⬇ Save as PDF</a>
        <button onclick="window.close()" class="btn btn-close">✕ Close</button>
    </div>

    <div class="paper">

        {{-- App Name Header --}}
        <div class="clinic-header">
            <div style="font-size:11px; letter-spacing:3px; text-transform:uppercase; color:#9ca3af; margin-bottom:6px;">Digital Eye Prescription</div>
            <div style="font-size:26px; font-weight:900; letter-spacing:1px; color:#0f766e;">Opti<span style="color:#0284c7;">Script</span></div>
        </div>

        <div class="divider"></div>

        {{-- Clinic / Doctor Info (below divider) --}}
        <div style="text-align:center; padding: 10px 36px 0; font-size:12px; color:#374151;">
            <span style="font-weight:700;">{{ $prescription->user->clinic_name ?? $prescription->user->name }}</span>
            <span style="color:#9ca3af;"> · {{ $prescription->user->specialty ?? 'Optometrist' }}</span>
            @if($prescription->user->phone || $prescription->user->email)
            <span style="color:#d1d5db;"> | </span>
            @if($prescription->user->phone)<span style="color:#6b7280;">{{ $prescription->user->phone }}</span>@endif
            @if($prescription->user->phone && $prescription->user->email)<span style="color:#d1d5db;"> · </span>@endif
            @if($prescription->user->email)<span style="color:#6b7280;">{{ $prescription->user->email }}</span>@endif
            @endif
            @if($prescription->user->address)
            <br><span style="color:#9ca3af; font-size:11px;">{{ $prescription->user->address }}</span>
            @endif
        </div>

        {{-- Rx Title --}}
        <div class="rx-title">Ophthalmic Prescription</div>

        {{-- Patient Info --}}
        <div class="patient-row">
            <div class="field">
                <span class="label">Patient:</span>
                <span class="value">{{ $prescription->patient->name }}</span>
            </div>
            <div class="field">
                <span class="label">Date:</span>
                <span class="value">{{ $prescription->prescription_date->format('M d, Y') }}</span>
            </div>
        </div>
        <div class="patient-row" style="padding-top:4px;">
            @if($prescription->lens_type)
            <div class="field">
                <span class="label">Vision:</span>
                <span class="value">{{ $prescription->lens_type_label }}</span>
            </div>
            @endif
            @if($prescription->patient->age || $prescription->patient->gender)
            <div class="field">
                <span class="label">Age/Sex:</span>
                <span class="value">
                    {{ $prescription->patient->age ? $prescription->patient->age . ' yrs' : '' }}
                    @if($prescription->patient->gender) / {{ ucfirst($prescription->patient->gender) }} @endif
                </span>
            </div>
            @endif
            <div class="field">
                <span class="label">Order #:</span>
                <span class="value">{{ str_pad($prescription->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        {{-- Prescription Table --}}
        <div class="rx-section">
            <table class="rx-table">
                <thead>
                    <tr>
                        <th style="width:110px;">Eye</th>
                        <th>Sphere (SPH)</th>
                        <th>Cylinder (CYL)</th>
                        <th>Axis</th>
                        <th>Add</th>
                        @if($prescription->od_va || $prescription->os_va)
                        <th>VA</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Right (OD)</td>
                        <td @if($prescription->od_sphere && $prescription->od_sphere < 0) class="negative" @elseif($prescription->od_sphere && $prescription->od_sphere > 0) class="positive" @endif>
                            {{ $prescription->od_sphere !== null ? $prescription->formatValue($prescription->od_sphere) : '<span class="dash">—</span>' }}
                        </td>
                        <td @if($prescription->od_cylinder && $prescription->od_cylinder < 0) class="negative" @elseif($prescription->od_cylinder && $prescription->od_cylinder > 0) class="positive" @endif>
                            {{ $prescription->od_cylinder !== null ? $prescription->formatValue($prescription->od_cylinder) : '<span class="dash">—</span>' }}
                        </td>
                        <td>{{ $prescription->od_axis !== null ? $prescription->od_axis . '°' : '<span class="dash">—</span>' }}</td>
                        <td @if($prescription->od_add) class="positive" @endif>
                            {{ $prescription->od_add !== null ? $prescription->formatValue($prescription->od_add) : '<span class="dash">—</span>' }}
                        </td>
                        @if($prescription->od_va || $prescription->os_va)
                        <td>{{ $prescription->od_va ?: '<span class="dash">—</span>' }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Left (OS)</td>
                        <td @if($prescription->os_sphere && $prescription->os_sphere < 0) class="negative" @elseif($prescription->os_sphere && $prescription->os_sphere > 0) class="positive" @endif>
                            {{ $prescription->os_sphere !== null ? $prescription->formatValue($prescription->os_sphere) : '<span class="dash">—</span>' }}
                        </td>
                        <td @if($prescription->os_cylinder && $prescription->os_cylinder < 0) class="negative" @elseif($prescription->os_cylinder && $prescription->os_cylinder > 0) class="positive" @endif>
                            {{ $prescription->os_cylinder !== null ? $prescription->formatValue($prescription->os_cylinder) : '<span class="dash">—</span>' }}
                        </td>
                        <td>{{ $prescription->os_axis !== null ? $prescription->os_axis . '°' : '<span class="dash">—</span>' }}</td>
                        <td @if($prescription->os_add) class="positive" @endif>
                            {{ $prescription->os_add !== null ? $prescription->formatValue($prescription->os_add) : '<span class="dash">—</span>' }}
                        </td>
                        @if($prescription->od_va || $prescription->os_va)
                        <td>{{ $prescription->os_va ?: '<span class="dash">—</span>' }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- PD Section --}}
        <div class="pd-section">
            <span class="pd-label">Pupillary Distance (PD):</span>
            @if($prescription->pd_far || $prescription->pd_near || $prescription->pd_right || $prescription->pd_left)
            <div class="pd-values">
                @if($prescription->pd_far)
                <div class="pd-item">
                    <div class="pd-title">Far PD</div>
                    <div class="pd-num">{{ $prescription->pd_far }}</div>
                    <div class="pd-unit">mm</div>
                </div>
                @endif
                @if($prescription->pd_near)
                <div class="pd-item">
                    <div class="pd-title">Near PD</div>
                    <div class="pd-num">{{ $prescription->pd_near }}</div>
                    <div class="pd-unit">mm</div>
                </div>
                @endif
                @if($prescription->pd_right)
                <div class="pd-item">
                    <div class="pd-title">Right</div>
                    <div class="pd-num">{{ $prescription->pd_right }}</div>
                    <div class="pd-unit">mm</div>
                </div>
                @endif
                @if($prescription->pd_left)
                <div class="pd-item">
                    <div class="pd-title">Left</div>
                    <div class="pd-num">{{ $prescription->pd_left }}</div>
                    <div class="pd-unit">mm</div>
                </div>
                @endif
            </div>
            @else
            <span style="color:#9ca3af;"> — mm</span>
            @endif
        </div>

        {{-- Diagnosis & Notes --}}
        @if($prescription->diagnosis || $prescription->recommendation || $prescription->notes || $prescription->next_visit)
        <div class="notes-section">
            <div class="notes-title">Notes / Recommendations</div>
            @if($prescription->diagnosis)
            <span class="diagnosis-badge">{{ $prescription->diagnosis }}</span>
            @endif
            @if($prescription->lens_type && !$prescription->lens_type)
            <span class="lens-badge">{{ $prescription->lens_type_label }}</span>
            @endif
            @if($prescription->recommendation)
            <div class="notes-text">{{ $prescription->recommendation }}</div>
            @endif
            @if($prescription->notes)
            <div class="notes-text" style="margin-top:4px; color:#6b7280;">{{ $prescription->notes }}</div>
            @endif
        </div>
        @endif

        {{-- Footer --}}
        <div class="rx-footer">
            <div class="printed-on">
                Printed on: <span>{{ now()->format('M d, Y H:i') }}</span>
            </div>
            <div class="signature-block">
                <div class="sig-line"></div>
                <div class="sig-name">{{ $prescription->user->name }}</div>
                <div class="sig-title">{{ $prescription->user->specialty ?? 'Optometrist' }}</div>
                @if($prescription->user->license_number)
                <div class="sig-title">Lic. {{ $prescription->user->license_number }}</div>
                @endif
            </div>
        </div>

        <div class="brand-strip">
            Powered by <strong>New Online Optics</strong> — Giving back to the community,
            <span class="free">free forever</span>
        </div>

    </div>

</body>
</html>
