<style>
    /* ===== Benefits comparison table â€” self-contained styles ===== */

    .benefits-section {
        padding: 90px 0;
    }

    .benefits-section .wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .benefits-section .sec-head {
        margin-bottom: 60px;
    }

    .benefits-heading {
        font-size: 56px;
    }

    .benefits-sub {
        margin-top: 20px;
        color: var(--cream-dim);
        font-size: 18px;
    }

    .benefits-table {
        overflow-x: auto;
        border: 1px solid var(--navy-line);
        background: rgba(15, 27, 40, 0.5);
        border-radius: 8px;
    }

    .benefits-table table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .benefits-table thead tr {
        border-bottom: 2px solid var(--navy-line);
    }

    .benefits-table th {
        padding: 24px;
        text-align: center;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 12px;
        color: var(--gold);
        letter-spacing: 0.1em;
    }

    .benefits-table thead th:first-child {
        text-align: left;
    }

    .benefits-table tbody tr {
        transition: background 0.3s ease;
    }

    .benefits-table tbody tr:hover {
        background: rgba(201, 166, 98, 0.05);
    }

    .benefits-table tbody th {
        padding: 28px 24px;
        text-align: left;
        color: var(--cream);
        font-weight: 500;
        font-size: 16px;
    }

    .benefits-table tbody td {
        padding: 28px 24px;
        text-align: center;
        font-size: 20px;
    }

    .benefit-yes {
        color: var(--gold-bright);
    }

    .benefit-no {
        color: var(--navy-mid);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .benefits-section {
            padding: 64px 0;
        }

        .benefits-section .wrap {
            padding: 0 24px;
        }

        .benefits-heading {
            font-size: 44px;
        }
    }

    @media (max-width: 768px) {
        .benefits-section {
            padding: 48px 0;
        }

        .benefits-section .wrap {
            padding: 0 20px;
        }

        .benefits-section .sec-head {
            margin-bottom: 40px;
        }

        .benefits-heading {
            font-size: 32px;
        }

        .benefits-sub {
            font-size: 16px;
        }

        .benefits-table table {
            min-width: 680px;
        }

        .benefits-table th {
            padding: 16px 14px;
            font-size: 11px;
        }

        .benefits-table tbody th {
            padding: 18px 14px;
            font-size: 14px;
        }

        .benefits-table tbody td {
            padding: 18px 14px;
            font-size: 17px;
        }
    }

    @media (max-width: 480px) {
        .benefits-section {
            padding: 32px 0;
        }

        .benefits-section .wrap {
            padding: 0 16px;
        }

        .benefits-heading {
            font-size: 24px;
        }

        .benefits-table {
            border-radius: 6px;
        }

        .benefits-table table {
            min-width: 560px;
        }

        .benefits-table th {
            padding: 12px 10px;
            font-size: 10px;
        }

        .benefits-table tbody th {
            padding: 14px 10px;
            font-size: 13px;
        }

        .benefits-table tbody td {
            padding: 14px 10px;
            font-size: 15px;
        }
    }
</style>

<section class="pad benefits-section">
    <div class="wrap">
        <div class="sec-head">
            <div class="host-label">Comparison</div>
            <h2 class="benefits-heading">What each tier unlocks.</h2>
            <p class="benefits-sub">
                A side-by-side look at the privileges attached to each level of membership.
            </p>
        </div>

        <div class="benefits-table">
            <table>
                <thead>
                    <tr>
                        <th>Benefit</th>
                        @foreach(['Ember', 'Silver', 'Gold', 'Platinum', 'Obsidian'] as $tier)
                            <th>{{ $tier }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $benefits = [
                            ['name' => 'Dedicated host', 'vals' => [false, false, true, true, true]],
                            ['name' => 'Weekly cashback', 'vals' => [false, true, true, true, true]],
                            ['name' => 'Priority withdrawals', 'vals' => [false, true, true, true, true]],
                            ['name' => 'Raised table limits', 'vals' => [false, false, true, true, true]],
                            ['name' => 'Event invitations', 'vals' => [false, false, false, true, true]],
                            ['name' => 'Custom terms', 'vals' => [false, false, false, false, true]]
                        ];
                      @endphp

                    @foreach($benefits as $b)
                        <tr>
                            <th>{{ $b['name'] }}</th>
                            @foreach($b['vals'] as $val)
                                <td class="{{ $val ? 'benefit-yes' : 'benefit-no' }}">
                                    {!! $val ? '&#10003;' : '&#10007;' !!}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>