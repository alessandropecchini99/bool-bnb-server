<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller {
    public function index(int $apartmentId) {
        $apartment = Apartment::findOrFail($apartmentId);
        $views = Apartment::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(views.date) as month_name"))
            ->where('apartment_id', $apartmentId)
            ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
            ->whereYear('views.date', date('Y'))
            ->groupBy(DB::raw("MONTH(views.date)"), DB::raw("MONTHNAME(views.date)"))
            ->pluck('count', 'month_name');

        $monthsLabels = $views->keys();
        $monthValues = $views->values();

        $months = $this->viewsByMonthAndDay($apartmentId)->values();

        // Calculate the maximum month views
        $maxMonthViews = $months->max(function ($collection) {
            return $collection->flatten()->sum();
        });

        return view('admin.apartments.statistics.index',
            compact('apartment', 'monthsLabels', 'monthValues', 'months', 'maxMonthViews'));
    }

    public function viewsByMonthAndDay($apartmentId)
    {
        $views = DB::table('views')
            ->where('apartment_id', $apartmentId)
            ->selectRaw('YEAR(date) as year, MONTH(date) as month, DAY(date) as day, COUNT(*) as count')
            ->groupBy(DB::raw('YEAR(date), MONTH(date), DAY(date)'))
            ->get();
        $viewsByMonthAndDay = collect([]);
        foreach ($views as $view) {
            $year = $view->year;
            $month = $view->month;
            $day = $view->day;
            $count = $view->count;
            $monthName = date('F', mktime(0, 0, 0, $month, 1, $year)); // Get month name from the numeric month
            // Initialize the month data if it doesn't exist
            if (!$viewsByMonthAndDay->has($monthName)) {
                $viewsByMonthAndDay[$monthName] = collect([]);
            }
            // Add the daily views to the month's collection
            $viewsByMonthAndDay[$monthName][$day] = $count;
        }
        return $viewsByMonthAndDay;
    }
}
