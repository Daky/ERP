<?php

namespace ERP\Http\Controllers;

use ERP\Model\BreadCrumb;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = "";
        $homeBreadCrumb->title = "Home";
        $homeBreadCrumb->fa    = "fa-dashboard";

        $dashboardBreadCrumb        = new BreadCrumb();
        $dashboardBreadCrumb->title = "Dashboard";

        $breadcrumbs = [$homeBreadCrumb, $dashboardBreadCrumb];

        return view('home', ['breadcrumbs' => $breadcrumbs]);
    }
}
