<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home(){
        return Inertia::render('Home/HomePage');
    }
    public function dashboardPage(Request $request){

     $data= [
        'customer'=>Customer::where('user_id','=',$request->header('id'))->count(),
        'category'=>Category::where('user_id','=',$request->header('id'))->count(),
        'products'=>Product::where('user_id','=',$request->header('id'))->count(),
        'invoice'=>Invoice::where('user_id','=',$request->header('id'))->count(),
        'total'=>Invoice::where('user_id','=',$request->header('id'))->sum('total'),
        'collection'=>Invoice::where('user_id','=',$request->header('id'))->sum('payable'),
        'vat'=>Invoice::where('user_id','=',$request->header('id'))->sum('vat')
        ];

        return Inertia::render('Dashboard/DashboardPage',['data'=>$data]);
    }

    public function salePage(Request $request){
        $userId=$request->header('id');
        $customers=Customer::where('user_id','=',$userId)->get();
        $products=Product::where('user_id','=',$userId)->where('unit','>',0)->get();

        return Inertia::render('Sale/SalePage',['customers'=>$customers,'products'=>$products]);
    }

    public function reportPage(Request $request){

        return Inertia::render('Report/ReportPage');
    }

    public function salesReport(Request $request){
        $userId=$request->header('id');
        $fromDate=date('Y-m-d', strtotime($request->input('fromDate')));
        $toDate=date('Y-m-d', strtotime($request->input('toDate')));

        $total=Invoice::where('user_id',$userId)->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate)->sum('total');
        $vat=Invoice::where('user_id',$userId)->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate)->sum('vat');
        $payable=Invoice::where('user_id',$userId)->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate)->sum('payable');
        $discount=Invoice::where('user_id',$userId)->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate)->sum('discount');

        $list=Invoice::where('user_id',$userId)->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate)->with('customer')->get();

        $data=[
            'total'=>$total,
            'vat'=>$vat,
            'payable'=>$payable,
            'discount'=>$discount,
            'list'=>$list,
            'fromDate'=>$fromDate,
            'toDate'=>$toDate
        ];
        $pdf=Pdf::loadView('Report.sales-report', $data);
        return $pdf->download('sales-report.pdf');

    }

}
