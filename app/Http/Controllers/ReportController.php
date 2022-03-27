<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Retorn;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ReportView()
    {
        return view('report.report_view');
    }


    public function ReportByDate(Request $request)
    {
        // return $request->all();
        $rday = $request->date;
        $date = new DateTime($request->date);
        $formatDate = $date;/*->format('d F Y');*/
        // return $formatDate;
        $orders = Order::/*with('orderItem.product')->*/ with('user')->with('customer')->whereDate('created_at', $formatDate)->latest()->get();
        $returns_amount = Retorn::whereDate('order_date', $formatDate)->latest()->sum('amount');
        return view('report.report_show', compact('orders', 'rday', 'returns_amount'));
    } // end mehtod


    public function ReportByMonth(Request $request)
    {
        /*return $request;*/
        $rmonth = $request->month;
        $date = new DateTime($request->month);
        $month = $date->format('m');
        $year = $date->format('Y');
        $orders = Order::/*with('orderItem.product')->*/ with('user')->with('customer')->whereMonth('created_at', $month)->whereYear('created_at', $year)->latest()->get();
        $returns_amount = Retorn::whereMonth('order_date', $month)->whereYear('order_date', $year)->latest()->sum('amount');
        return view('report.report_show', compact('orders', 'rmonth', 'returns_amount'));
    } // end mehtod


    public function ReportByYear(Request $request)
    {
        $year = $request->year;
        $ryear = $year;
        $orders = Order::with('user')->with('customer')->whereYear('created_at', $year)->latest()->get();
        $returns_amount = Retorn::whereYear('order_date', $year)->latest()->sum('amount');
        return view('report.report_show', compact('orders', 'ryear', 'returns_amount'));
    } // end mehtod

    public function PrintDate($day)
    {
        $through = $day;
        $date = new DateTime($day);
        $formatDate = $date;
        $orders = Order::with('orderItem')->with('user')->with('customer')->whereDate('created_at', $formatDate)->latest()->get();
//        return $orders;
        $returns_amount = Retorn::whereDate('order_date', $formatDate)->latest()->sum('amount');
        return view('report.print', compact('orders', 'through', 'returns_amount'));
    }

    public function PrintMonth($month)
    {
        $through = $month;
        $date = new DateTime($month);
        $month = $date->format('m');
        $year = $date->format('Y');
        $orders = Order::with('orderItem')->with('user')->with('customer')->whereMonth('created_at', $month)->whereYear('created_at', $year)->latest()->get();
        $returns_amount = Retorn::whereMonth('order_date', $month)->whereYear('order_date', $year)->latest()->sum('amount');
        return view('report.print', compact('orders', 'through', 'returns_amount'));
    }

    public function PrintYear($year)
    {
        $through = $year;
        $orders = Order::with('orderItem')->with('user')->with('customer')->whereYear('created_at', $year)->latest()->get();
        $returns_amount = Retorn::whereYear('order_date', $year)->latest()->sum('amount');
        return view('report.print', compact('orders', 'through', 'returns_amount'));
    }
}
