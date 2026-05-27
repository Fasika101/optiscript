<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription #{{ str_pad($prescription->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #222;
            background: white;
        }

        .clinic-header { text-align: center; padding: 20px 28px 14px; }
        .clinic-name {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #0f766e;
        }
        .clinic-contact { font-size: 11px; color: #555; margin-top: 4px; line-height: 1.5; }

        .divider { height: 2px; background: #0d9488; margin: 0 28px; }

        .rx-title {
            text-align: center;
            padding: 14px 28px 0;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: underline;
            color: #111;
        }

        .patient-row {
            display: table;
            width: 100%;
            padding: 12px 28px 0;
        }
        .patient-left { display: table-cell; }
        .patient-right { display: table-cell; text-align: right; }
        .field { margin-bottom: 3px; font-size: 12px; }
        .field .lbl { color: #555; font-weight: bold; }
        .field .val { font-weight: bold; color: #111; }

        .rx-section { padding: 14px 28px 0; }
        .rx-table { width: 100%; border-collapse: collapse; }
        .rx-table thead th {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 7px 10px;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            color: #374151;
        }
        .rx-table thead th:first-child { text-align: left; }
        .rx-table tbody td {
            border: 1px solid #d1d5db;
            padding: 8px 10px;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #111;
        }
        .rx-table tbody td:first-child { font-weight: bold; text-align: left; background: #fafafa; }
        .neg { color: #dc2626; }
        .pos { color: #059669; }
        .dash { color: #9ca3af; font-weight: normal; }

        .pd-section { padding: 12px 28px 0; font-size: 12px; }
        .pd-label { font-weight: bold; color: #374151; }
        .pd-items { display: table; margin-top: 4px; }
        .pd-item { display: table-cell; padding-right: 24px; text-align: center; }
        .pd-title { font-size: 9px; font-weight: bold; text-transform: uppercase; color: #6b7280; display: block; }
        .pd-num { font-size: 15px; font-weight: bold; color: #111; display: block; }
        .pd-unit { font-size: 9px; color: #9ca3af; }

        .notes-section { padding: 12px 28px 0; }
        .notes-title { font-weight: bold; font-size: 12px; border-bottom: 1px solid #e5e7eb; padding-bottom: 3px; margin-bottom: 5px; color: #374151; }
        .notes-text { font-size: 11.5px; color: #374151; line-height: 1.5; }
        .badge { display: inline-block; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: bold; margin-bottom: 5px; }
        .badge-green { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }

        .validity { text-align: center; font-size: 10.5px; color: #9ca3af; padding: 10px 28px 0; }

        .rx-footer { display: table; width: 100%; padding: 14px 28px 8px; }
        .footer-left { display: table-cell; vertical-align: bottom; }
        .footer-right { display: table-cell; vertical-align: bottom; text-align: right; }
        .printed-on { font-size: 10.5px; color: #9ca3af; }
        .printed-on span { color: #0d9488; font-weight: bold; }
        .sig-line { border-top: 1px solid #374151; width: 150px; margin-left: auto; padding-top: 4px; }
        .sig-name { font-size: 11.5px; font-weight: bold; color: #111; }
        .sig-title { font-size: 10.5px; color: #6b7280; }

        .brand-strip {
            background: #f0fdfa;
            border-top: 1px solid #ccfbf1;
            text-align: center;
            padding: 7px;
            font-size: 10px;
            color: #6b7280;
        }
        .brand-strip strong { color: #0f766e; }
    </style>
</head>
<body>

    {{-- App Name Header --}}
    <div class="clinic-header">
        <div style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:#9ca3af; margin-bottom:4px;">Digital Eye Prescription</div>
        <div style="font-size:22px; font-weight:bold; letter-spacing:1px; color:#0f766e;">Opti<span style="color:#0284c7;">Script</span></div>
    </div>

    <div class="divider"></div>

    {{-- Clinic / Doctor Info --}}
    <div style="text-align:center; padding: 8px 28px 0; font-size:11px; color:#374151;">
        <strong>{{ $prescription->user->clinic_name ?? $prescription->user->name }}</strong>
        <span style="color:#9ca3af;"> · {{ $prescription->user->specialty ?? 'Optometrist' }}</span>
        @if($prescription->user->phone || $prescription->user->email)
        &nbsp;|&nbsp;
        @if($prescription->user->phone)<span style="color:#6b7280;">{{ $prescription->user->phone }}</span>@endif
        @if($prescription->user->phone && $prescription->user->email) &nbsp;·&nbsp; @endif
        @if($prescription->user->email)<span style="color:#6b7280;">{{ $prescription->user->email }}</span>@endif
        @endif
        @if($prescription->user->address)
        <br><span style="color:#9ca3af; font-size:10px;">{{ $prescription->user->address }}</span>
        @endif
    </div>

    <div class="rx-title">Ophthalmic Prescription</div>

    {{-- Patient Info --}}
    <div class="patient-row">
        <div class="patient-left">
            <div class="field"><span class="lbl">Patient: </span><span class="val">{{ $prescription->patient->name }}</span></div>
            @if($prescription->lens_type)
            <div class="field"><span class="lbl">Vision: </span><span class="val">{{ $prescription->lens_type_label }}</span></div>
            @endif
        </div>
        <div class="patient-right">
            <div class="field"><span class="lbl">Date: </span><span class="val">{{ $prescription->prescription_date->format('M d, Y') }}</span></div>
            <div class="field"><span class="lbl">Order #: </span><span class="val">{{ str_pad($prescription->id, 4, '0', STR_PAD_LEFT) }}</span></div>
            @if($prescription->patient->age || $prescription->patient->gender)
            <div class="field"><span class="lbl">Age/Sex: </span>
                <span class="val">
                    {{ $prescription->patient->age ? $prescription->patient->age . ' yrs' : '' }}
                    @if($prescription->patient->gender) / {{ ucfirst($prescription->patient->gender) }} @endif
                </span>
            </div>
            @endif
        </div>
    </div>

    {{-- Rx Table --}}
    <div class="rx-section">
        <table class="rx-table">
            <thead>
                <tr>
                    <th>Eye</th>
                    <th>Sphere (SPH)</th>
                    <th>Cylinder (CYL)</th>
                    <th>Axis</th>
                    <th>Add</th>
                    @if($prescription->od_va || $prescription->os_va)<th>VA</th>@endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Right (OD)</td>
                    <td class="{{ $prescription->od_sphere < 0 ? 'neg' : ($prescription->od_sphere > 0 ? 'pos' : '') }}">
                        {{ $prescription->od_sphere !== null ? $prescription->formatValue($prescription->od_sphere) : '—' }}
                    </td>
                    <td class="{{ $prescription->od_cylinder < 0 ? 'neg' : ($prescription->od_cylinder > 0 ? 'pos' : '') }}">
                        {{ $prescription->od_cylinder !== null ? $prescription->formatValue($prescription->od_cylinder) : '—' }}
                    </td>
                    <td>{{ $prescription->od_axis !== null ? $prescription->od_axis . '°' : '—' }}</td>
                    <td class="{{ $prescription->od_add ? 'pos' : '' }}">{{ $prescription->od_add !== null ? $prescription->formatValue($prescription->od_add) : '—' }}</td>
                    @if($prescription->od_va || $prescription->os_va)<td>{{ $prescription->od_va ?: '—' }}</td>@endif
                </tr>
                <tr>
                    <td>Left (OS)</td>
                    <td class="{{ $prescription->os_sphere < 0 ? 'neg' : ($prescription->os_sphere > 0 ? 'pos' : '') }}">
                        {{ $prescription->os_sphere !== null ? $prescription->formatValue($prescription->os_sphere) : '—' }}
                    </td>
                    <td class="{{ $prescription->os_cylinder < 0 ? 'neg' : ($prescription->os_cylinder > 0 ? 'pos' : '') }}">
                        {{ $prescription->os_cylinder !== null ? $prescription->formatValue($prescription->os_cylinder) : '—' }}
                    </td>
                    <td>{{ $prescription->os_axis !== null ? $prescription->os_axis . '°' : '—' }}</td>
                    <td class="{{ $prescription->os_add ? 'pos' : '' }}">{{ $prescription->os_add !== null ? $prescription->formatValue($prescription->os_add) : '—' }}</td>
                    @if($prescription->od_va || $prescription->os_va)<td>{{ $prescription->os_va ?: '—' }}</td>@endif
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PD --}}
    <div class="pd-section">
        <span class="pd-label">Pupillary Distance (PD):</span>
        @if($prescription->pd_far || $prescription->pd_near || $prescription->pd_right || $prescription->pd_left)
        <div class="pd-items">
            @if($prescription->pd_far)<div class="pd-item"><span class="pd-title">Far PD</span><span class="pd-num">{{ $prescription->pd_far }}</span><span class="pd-unit">mm</span></div>@endif
            @if($prescription->pd_near)<div class="pd-item"><span class="pd-title">Near PD</span><span class="pd-num">{{ $prescription->pd_near }}</span><span class="pd-unit">mm</span></div>@endif
            @if($prescription->pd_right)<div class="pd-item"><span class="pd-title">Right</span><span class="pd-num">{{ $prescription->pd_right }}</span><span class="pd-unit">mm</span></div>@endif
            @if($prescription->pd_left)<div class="pd-item"><span class="pd-title">Left</span><span class="pd-num">{{ $prescription->pd_left }}</span><span class="pd-unit">mm</span></div>@endif
        </div>
        @else
        <span class="dash"> — mm</span>
        @endif
    </div>

    {{-- Notes --}}
    @if($prescription->diagnosis || $prescription->recommendation || $prescription->notes || $prescription->next_visit)
    <div class="notes-section">
        <div class="notes-title">Notes / Recommendations</div>
        @if($prescription->diagnosis)
        <span class="badge badge-green">{{ $prescription->diagnosis }}</span><br>
        @endif
        @if($prescription->recommendation)
        <div class="notes-text">{{ $prescription->recommendation }}</div>
        @endif
        @if($prescription->notes)
        <div class="notes-text" style="color:#6b7280;margin-top:3px;">{{ $prescription->notes }}</div>
        @endif
    </div>
    @endif

    {{-- Footer --}}
    <div class="rx-footer">
        <div class="footer-left">
            <div class="printed-on">Printed on: <span>{{ now()->format('M d, Y') }}</span></div>
        </div>
        <div class="footer-right">
            <div class="sig-line"></div>
            <div class="sig-name">{{ $prescription->user->name }}</div>
            <div class="sig-title">{{ $prescription->user->specialty ?? 'Optometrist' }}</div>
            @if($prescription->user->license_number)<div class="sig-title">Lic. {{ $prescription->user->license_number }}</div>@endif
        </div>
    </div>

    <div class="brand-strip">
        Powered by <strong>New Online Optics</strong> — Giving back to the community, free forever
    </div>

</body>
</html>
