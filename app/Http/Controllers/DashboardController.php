<?php

namespace App\Http\Controllers;

use App\Category;
use App\Clas;
use App\Department;
use App\Donar;
use App\Employee;
use App\Handover;
use App\Location;
use App\Stock;
use App\Product;
use App\Project;
use App\Status;
use App\Unit;
use Auth;
use Charts;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $assets = \Lava::DataTable();
        $total_items_in_stock = \Lava::DataTable();
        $new_total_items_in_stock = \Lava::DataTable();
        $used_total_items_in_stock = \Lava::DataTable();
        $damaged_total_items_in_stock = \Lava::DataTable();
        $group_values = \Lava::DataTable();


        $assets->addDateColumn('Date')
                    ->addNumberColumn('Stocked')
                    ->addNumberColumn('Handovered')
                    ->addNumberColumn('Returned');

            $startDate = Carbon::parse(Carbon::now())->startOfMonth();
            $endDate = Carbon::parse(Carbon::now())->endOfMonth();
            for($i=$startDate->day; $i<=$endDate->day; $i++){
                $stocked_assets = \DB::table('stock')->whereDate('created_at', $startDate)->count();
                $handovered_assets = \DB::table('handover')->whereDate('created_at', $startDate)->count();
                $returned_assets = \DB::table('returns')->whereDate('created_at', $startDate)->count();
                $rowData = array(
                    $startDate->format('Y-m-d'), $stocked_assets, $handovered_assets, $returned_assets
                );
                $assets->addRow($rowData);
                $startDate = $startDate->addDays(1);
            }

        \Lava::LineChart('Temps', $assets, [
            'title' => 'Assets Which Stocked, Handovered and Returned during this Month'
        ]);
//////////////////
        
        $porducts_type = DB::table('product')->count();
        $products_in_stock = DB::table('stock')->where('deleted_at', '=', null)->count();
        $users = DB::table('users')->count();
        $employees = DB::table('employee')->count();

        $stock_products = DB::table('stock')->where([
            [DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y')]
            ])
    		->get();
        $chart_stock = Charts::database($stock_products, 'bar', 'highcharts')
			      ->title("Monthly Registered Products to Stock")
			      ->elementLabel("Total Products")
			      ->dimensions(1000, 500)
			      ->responsive(true)
                  ->groupByMonth(date('Y'), true);

        $handovers = DB::table('handover')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                  ->get();
        $chart_handover = Charts::database($handovers, 'bar', 'highcharts')
                ->title("Monthly Handovers to Employees")
                ->elementLabel("Total Handovers")
                ->dimensions(1000, 500)
                ->responsive(true)
                ->groupByMonth(date('Y'), true);
        
        $returns = DB::table('returns')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->get();
        $chart_return = Charts::database($returns, 'bar', 'highcharts')
              ->title("Monthly Returns from Employees")
              ->elementLabel("Total Returns from Employees")
              ->dimensions(1000, 500)
              ->responsive(true)
              ->groupByMonth(date('Y'), true);
            //   ==============================================================

            $group_values->addDateColumn('Month')
                            ->addNumberColumn('Stocked')
                            ->addNumberColumn('Handovered')
                            ->addNumberColumn('Returned');
            $fDate = Carbon::parse(Carbon::now())->year;
            $dDate = Carbon::parse(Carbon::now());

            for($i=1; $i<=12; $i++){
                $newDate = $fDate.'-'.$i;
                $stocked_assets = \DB::table('stock')->whereYear('created_at', $fDate)->whereMonth('created_at', $i)->count();
                $handovered_assets = \DB::table('handover')->whereYear('created_at', $fDate)->whereMonth('created_at', $i)->count();
                $returned_assets = \DB::table('returns')->whereYear('created_at', $fDate)->whereMonth('created_at', $i)->count();
                $rowData = array(
                    $newDate, intVal($stocked_assets), intVal($handovered_assets), intVal($returned_assets)
                );
                $group_values->addRow($rowData);
            }
            
   \Lava::ComboChart('Finances', $group_values, [
       'title' => 'Stocked, Handovers and Returns Balancing per Month',
       'legend' => [
           'position' => 'out'
       ],
       'seriesType' => 'bars',
       'series' => [
           3 => ['type' => 'line']
       ]
   ]);
        
////////////////
        $products_stock = \DB::table('stock')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where('deleted_at', '=', null)
            ->groupBy('product_id')
            ->orderBy('quantity', 'desc')
            ->get();

        $pro = Product::all();
        $lbs[]=0;
        $quantites[]=0;
        $total_items_in_stock->addStringColumn('Product')
        ->addNumberColumn('Percent');
            foreach($products_stock as $ps){
                foreach($pro as $p){
                    if($ps->product_id == $p->id){
                    // $lbs[] = $p->product; //$ps->product_id == $p->id ? "$p->product" ;
                    // $quantites[] =$ps->quantity; //[$ps->quantity];
                    $rowData = array(
                        $p->product, intVal($ps->quantity)
                    );
                    $total_items_in_stock->addRow($rowData);
                    }
                }
            }
        // $pie  =	 Charts::create('pie', 'highcharts')
        //       ->title('Handoverable Products in Stock')
        //       ->labels($lbs)
        //       ->values($quantites)
        //       ->dimensions(1000,500)
        //       ->responsive(true);

            \Lava::DonutChart('STOCK', $total_items_in_stock, [
            'title' => 'Handoverable Products in Stock'
            ]);
////////////////////////////
            $new_total_items_in_stock->addStringColumn('Product')
                    ->addNumberColumn('Percent');
            $newproducts_stock = \DB::table('stock')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where([['deleted_at', '=', null],['status_id', '=', 1]])
            ->groupBy('product_id')
            ->orderBy('quantity', 'asc')
            ->get();

            $newpro = Product::all();
            $newlbs[]=0;
            $newquantites[]=0;
            foreach($newproducts_stock as $newps){
                foreach($newpro as $newp){
                    if($newps->product_id == $newp->id){
                    // $newlbs[] = $newp->product; //$ps->product_id == $p->id ? "$p->product" ;
                    // $newquantites[] =$newps->quantity; //[$ps->quantity];
                    $rowData = array(
                        $newp->product, intVal($newps->quantity)
                    );
                    $new_total_items_in_stock->addRow($rowData);
                    }
                }
            }

            // $newpie  =	 Charts::create('pie', 'highcharts')
            // ->title('New Products in Stock')
            // ->labels($newlbs)
            // ->values($newquantites)
            // ->dimensions(1000,500)
            // ->responsive(true);

            \Lava::DonutChart('NEW', $new_total_items_in_stock, [
                'title' => 'New Products in Stock'
                ]);
/////////////////////////////////////////////////
            $used_total_items_in_stock->addStringColumn('Product')
            ->addNumberColumn('Percent');

            $usedproducts_stock = \DB::table('stock')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where([['deleted_at', '=', null],['status_id', '=', 2]])
            ->groupBy('product_id')
            ->orderBy('quantity', 'asc')
            ->get();

            $usedpro = Product::all();
            $usedlbs[]=0;
            $usedquantites[]=0;
            foreach($usedproducts_stock as $usedps){
                foreach($usedpro as $usedp){
                    if($usedps->product_id == $usedp->id){
                    // $usedlbs[] = $usedp->product; //$ps->product_id == $p->id ? "$p->product" ;
                    // $usedquantites[] =$usedps->quantity; //[$ps->quantity];
                    $rowData = array(
                        $usedp->product, intVal($usedps->quantity)
                    );
                    $used_total_items_in_stock->addRow($rowData);
                    }
                }
            }

            // $usedpie  =	 Charts::create('pie', 'highcharts')
            // ->title('Used Products in Stock')
            // ->labels($usedlbs)
            // ->values($usedquantites)
            // ->dimensions(1000,500)
            // ->responsive(true);

            \Lava::DonutChart('USED', $used_total_items_in_stock, [
                'title' => 'Used Products in Stock'
                ]);
            ////////////////////////////////////////
            $damaged_total_items_in_stock->addStringColumn('Product')
                ->addNumberColumn('Percent');

            $dmgproducts_stock = \DB::table('returns')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where([['status_id', '=', 3]])
            ->groupBy('product_id')
            ->orderBy('quantity', 'asc')
            ->get();

            $dmgpro = Product::all();
            $dmglbs[]=0;
            $dmgquantites[]=0;
            foreach($dmgproducts_stock as $dmgps){
                foreach($dmgpro as $dmgp){
                    if($dmgps->product_id == $dmgp->id){
                    // $dmglbs[] = $dmgp->product; //$ps->product_id == $p->id ? "$p->product" ;
                    // $dmgquantites[] =$dmgps->quantity; //[$ps->quantity];
                    $rowData = array(
                        $dmgp->product, intVal($dmgps->quantity)
                    );
                    $damaged_total_items_in_stock->addRow($rowData);
                    }
                }
            }

            // $dmgpie  =	 Charts::create('pie', 'highcharts')
            // ->title('Damaged Products in Stock')
            // ->labels($dmglbs)
            // ->values($dmgquantites)
            // ->dimensions(1000,500)
            // ->responsive(true);

            \Lava::DonutChart('DAMAGED', $damaged_total_items_in_stock, [
                'title' => 'Damaged Products in Stock'
                ]);


        return view('admin.dashboard', [
            'products_type' => $porducts_type,
            'products_in_stock' => $products_in_stock,
            'users' => $users,
            'employees' => $employees,
            'chart_stock' => $chart_stock,
            'chart_handover' => $chart_handover,
            'chart_return' => $chart_return,
            // 'pie' => $pie,
            // 'newpie' => $newpie,
            // 'usedpie' => $usedpie,
            // 'dmgpie' => $dmgpie
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Category::class, ['category'])
            ->registerModel(Clas::class, ['class'])
            ->registerModel(Department::class, ['department'])
            ->registerModel(Donar::class, ['name'])
            ->registerModel(Employee::class, ['full_name', 'ref_no', 'job_title', 'email'])
            ->registerModel(Handover::class, ['request_ref'])
            ->registerModel(Location::class, ['name'])
            ->registerModel(Product::class, ['product', 'manufacturer', 'model', 'brand'])
            ->registerModel(Project::class, ['name'])
            ->registerModel(Status::class, ['status'])
            ->registerModel(Stock::class, ['serial_no', 'tag_no'])
            ->registerModel(Unit::class, ['unit'])
            ->perform($request->input('query')); 

        return view('admin.search', compact('searchResults'));
    }
}
