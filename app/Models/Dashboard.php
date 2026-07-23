<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PlaneBuyer;
use App\Models\Plane;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Contact;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Review;

class Dashboard
{
    public static function contactsCount(): int
    {
        return Contact::count();
    }

    public static function usersCount(): int
    {
        return User::count();
    }

    public static function unregisteredAccountsCount(): int
    {
        return UserAccount::count();
    }

    public static function totalWithdraw(): float
    {
        // Use the approved scope from Withdrawal model
        return (float) Withdrawal::approved()->sum('amount');
    }

    public static function totalDeposit(): float
    {
        // Use the approved scope from Deposit model
        return (float) Deposit::approved()->sum('amount');
    }

    public static function ordersCount(): int
    {
        return PlaneBuyer::count();
    }

    public static function ordersByPlane(): array
    {
        $grouped = PlaneBuyer::selectRaw('plane_id, COUNT(*) as total')
            ->groupBy('plane_id')
            ->pluck('total', 'plane_id');

        if ($grouped->isEmpty()) {
            return ['labels' => ['No orders'], 'data' => [1]];
        }

        $planeIds = $grouped->keys()->toArray();

        $planes = Plane::whereIn('id', $planeIds)->pluck('name', 'id');

        $labels = [];
        $data = [];
        foreach ($grouped as $planeId => $count) {
            $labels[] = $planes[$planeId] ?? 'Plane #' . $planeId;
            $data[] = $count;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Deposit trends – uses 'created_at' for approved deposits
     */
    public static function depositTrends(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        // Get approved deposits grouped by date
        $deposits = Deposit::selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->where('status', 'approved')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('total', 'date');

        $labels = [];
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('M d');
            $data[] = (float) ($deposits->get($date, 0));
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Withdrawal trends – uses 'created_at' for approved withdrawals
     */
    public static function withdrawalTrends(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        // Get approved withdrawals grouped by date
        $withdrawals = Withdrawal::selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->where('status', 'approved')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('total', 'date');

        $labels = [];
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('M d');
            $data[] = (float) ($withdrawals->get($date, 0));
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public static function userSignupsOverTime(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $signups = User::selectRaw('DATE(created_at) as signup_date, COUNT(*) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('signup_date')
            ->pluck('total', 'signup_date');

        $labels = [];
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('M d');
            $data[] = $signups->get($date, 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public static function getStats(): array
    {
        $signupChart = self::userSignupsOverTime(30);
        $orderChart  = self::ordersByPlane();
        $depositChart = self::depositTrends(30);
        $withdrawalChart = self::withdrawalTrends(30);

        return [
            'contactsCount'             => self::contactsCount(),
            'usersCount'                => self::usersCount(),
            'unregisteredAccountsCount' => self::unregisteredAccountsCount(),

            'signupChartLabels' => $signupChart['labels'],
            'signupChartData'   => $signupChart['data'],

            'orderStatusLabels' => $orderChart['labels'],
            'orderStatusData'   => $orderChart['data'],

            'depositChartLabels' => $depositChart['labels'],
            'depositChartData'   => $depositChart['data'],

            'withdrawalChartLabels' => $withdrawalChart['labels'],
            'withdrawalChartData'   => $withdrawalChart['data'],

            'withdrawTotal' => self::totalWithdraw(),
            'depositTotal'  => self::totalDeposit(),
            'ordersCount'   => self::ordersCount(),
            'reviewsCount'  => Review::count(),
        ];
    }
}