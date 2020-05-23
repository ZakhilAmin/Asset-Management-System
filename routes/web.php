<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/admin', 'HomeController@index')->name('admin');
/*
Route::get('/', function(){
    return view('admin.dashboard');
})->name('admin');

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
*/
Route::group(['middleware' => 'web'], function(){
        
        Route::get('/admin/employees/users', 'Auth\RegisterController@index')->name('users.index');
        
        Auth::routes();

        //For Stock Select Menu to fill according to product id in Handover
        Route::get('admin/handovers/create/getstock/{id}', 'HandoverController@getstockitems');
        
        //For fetching quantity of product from stok
        Route::get('admin/handovers/create/getquantity/{id}', 'HandoverController@getitemquantity');
        
        Route::get('admin/general/report/print/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byDept/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byCategory/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byClass/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byDonar/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byEmployee/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byHandover/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byLocation/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byProduct/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byProject/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byStatus/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byStock/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        Route::get('admin/general/report/search/print/byUnit/employee/getemployee/{id}', 'GeneralReportController@getEmpInfo');
        
        Route::get('admin/employees/report/print/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byDept/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byCategory/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byClass/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byDonar/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byEmployee/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byHandover/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byLocation/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byProduct/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byProject/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byStatus/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byStock/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');
        Route::get('admin/employees/report/search/print/byUnit/employee/getemployee/{id}', 'EmployeeReportController@getEmployeeInfo');

        Route::get('admin/stock/report/print/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byDept/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byCategory/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byClass/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byDonar/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byEmployee/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byHandover/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byLocation/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byProduct/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byProject/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byStatus/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byStock/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        Route::get('admin/stock/report/search/print/byUnit/employee/getemployee/{id}', 'StockReportController@getEmpInfo');
        
        Route::get('admin/returns/report/print/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byDept/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byCategory/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byClass/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byDonar/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byEmployee/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byHandover/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byLocation/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byProduct/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byProject/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byStatus/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byStock/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        Route::get('admin/returns/report/search/print/byUnit/employee/getemployee/{id}', 'ReturnsReportController@getEmpInfo');
        
        
        Route::group(['prefix' => '/admin'], function(){ // All Admin routes goes here...

            Route::get('/', [
                'uses' => 'DashboardController@index',
                'as' => 'admin'
            ]);

            Route::get('/dashboard', [
                'uses' => 'DashboardController@index',
                'as' => 'admin.dashboard'
            ]);

            Route::post('/search', [
                'uses' => 'DashboardController@search',
                'as' => 'search'
            ]);

            Route::get('/unauthorized', function(){
                return view('admin.unauthorized');
            });

            // For Reports...
            Route::get('/employees/report/print/all', [
                'uses' => 'EmployeeReportController@printAll',
                'as' => 'employees.index.print.all'
            ]);

            Route::get('/employees/report/search/print/byDept/{id}', [
                'uses' => 'EmployeeReportController@search_result_dept',
                'as' => 'employees.index.print.search'
            ]);

            Route::get('/employees/report/search/print/byCategory/{id}', [
                'uses' => 'EmployeeReportController@search_result_category',
                'as' => 'employees.index.search.category'
            ]);

            Route::get('/employees/report/search/print/byClass/{id}', [
                'uses' => 'EmployeeReportController@search_result_class',
                'as' => 'employees.index.search.class'
            ]);

            Route::get('/employees/report/search/print/byDonar/{id}', [
                'uses' => 'EmployeeReportController@search_result_donar',
                'as' => 'employees.index.search.donar'
            ]);

            Route::get('/employees/report/search/print/byEmployee/{id}', [
                'uses' => 'EmployeeReportController@search_result_employee',
                'as' => 'employees.index.search.employee'
            ]);

            Route::get('/employees/report/search/print/byHandover/{id}', [
                'uses' => 'EmployeeReportController@search_result_handover',
                'as' => 'employees.index.search.handover'
            ]);

            Route::get('/employees/report/search/print/byLocation/{id}', [
                'uses' => 'EmployeeReportController@search_result_location',
                'as' => 'employees.index.search.location'
            ]);

            Route::get('/employees/report/search/print/byProduct/{id}', [
                'uses' => 'EmployeeReportController@search_result_product',
                'as' => 'employees.index.search.product'
            ]);

            Route::get('/employees/report/search/print/byProject/{id}', [
                'uses' => 'EmployeeReportController@search_result_project',
                'as' => 'employees.index.search.project'
            ]);

            Route::get('/employees/report/search/print/byStatus/{id}', [
                'uses' => 'EmployeeReportController@search_result_status',
                'as' => 'employees.index.search.status'
            ]);

            Route::get('/employees/report/search/print/byStock/{id}', [
                'uses' => 'EmployeeReportController@search_result_stock',
                'as' => 'employees.index.search.stock'
            ]);

            Route::get('/employees/report/search/print/byUnit/{id}', [
                'uses' => 'EmployeeReportController@search_result_unit',
                'as' => 'employees.index.search.unit'
            ]);
 
            Route::get('/employees/report/print/{id}', [
                'uses' => 'EmployeeReportController@indexPrint',
                'as' => 'employees.index.print'
            ]);

            Route::get('/stock/report/print/all', [
                'uses' => 'StockReportController@indexPrint',
                'as' => 'stock.index.print'
            ]);

            Route::get('/stock/report/search/print/byDept/{id}', [
                'uses' => 'StockReportController@search_result_dept',
                'as' => 'stock.index.search'
            ]);

            Route::get('/stock/report/search/print/byCategory/{id}', [
                'uses' => 'StockReportController@search_result_category',
                'as' => 'stock.index.search.category'
            ]);

            Route::get('/stock/report/search/print/byClass/{id}', [
                'uses' => 'StockReportController@search_result_class',
                'as' => 'stock.index.search.class'
            ]);

            Route::get('/stock/report/search/print/byDonar/{id}', [
                'uses' => 'StockReportController@search_result_donar',
                'as' => 'stock.index.search.donar'
            ]);

            Route::get('/stock/report/search/print/byEmployee/{id}', [
                'uses' => 'StockReportController@search_result_employee',
                'as' => 'stock.index.search.employee'
            ]);

            Route::get('/stock/report/search/print/byHandover/{id}', [
                'uses' => 'StockReportController@search_result_handover',
                'as' => 'stock.index.search.handover'
            ]);

            Route::get('/stock/report/search/print/byLocation/{id}', [
                'uses' => 'StockReportController@search_result_location',
                'as' => 'stock.index.search.location'
            ]);

            Route::get('/stock/report/search/print/byProduct/{id}', [
                'uses' => 'StockReportController@search_result_product',
                'as' => 'stock.index.search.product'
            ]);

            Route::get('/stock/report/search/print/byProject/{id}', [
                'uses' => 'StockReportController@search_result_project',
                'as' => 'stock.index.search.project'
            ]);

            Route::get('/stock/report/search/print/byStatus/{id}', [
                'uses' => 'StockReportController@search_result_status',
                'as' => 'stock.index.search.status'
            ]);

            Route::get('/stock/report/search/print/byStock/{id}', [
                'uses' => 'StockReportController@search_result_stock',
                'as' => 'stock.index.search.stock'
            ]);

            Route::get('/stock/report/search/print/byUnit/{id}', [
                'uses' => 'StockReportController@search_result_unit',
                'as' => 'stock.index.search.unit'
            ]);

            Route::get('/general/report/print/all', [
                'uses' => 'GeneralReportController@indexPrint',
                'as' => 'general.index.print'
            ]);

            Route::get('/general/report/print/bydate', [
                'uses' => 'GeneralReportController@byDateReport',
                'as' => 'general.index.bydate'
            ]);

            Route::get('/general/report/search/print/byDept/{id}', [
                'uses' => 'GeneralReportController@search_result_dept',
                'as' => 'general.index.search'
            ]);

            Route::get('/general/report/search/print/byCategory/{id}', [
                'uses' => 'GeneralReportController@search_result_category',
                'as' => 'general.index.search.category'
            ]);

            Route::get('/general/report/search/print/byClass/{id}', [
                'uses' => 'GeneralReportController@search_result_class',
                'as' => 'general.index.search.class'
            ]);

            Route::get('/general/report/search/print/byDonar/{id}', [
                'uses' => 'GeneralReportController@search_result_donar',
                'as' => 'general.index.search.donar'
            ]);

            Route::get('/general/report/search/print/byEmployee/{id}', [
                'uses' => 'GeneralReportController@search_result_employee',
                'as' => 'general.index.search.employee'
            ]);

            Route::get('/general/report/search/print/byHandover/{id}', [
                'uses' => 'GeneralReportController@search_result_handover',
                'as' => 'general.index.search.handover'
            ]);

            Route::get('/general/report/search/print/byLocation/{id}', [
                'uses' => 'GeneralReportController@search_result_location',
                'as' => 'general.index.search.location'
            ]);

            Route::get('/general/report/search/print/byProduct/{id}', [
                'uses' => 'GeneralReportController@search_result_product',
                'as' => 'general.index.search.product'
            ]);

            Route::get('/general/report/search/print/byProject/{id}', [
                'uses' => 'GeneralReportController@search_result_project',
                'as' => 'general.index.search.project'
            ]);

            Route::get('/general/report/search/print/byStatus/{id}', [
                'uses' => 'GeneralReportController@search_result_status',
                'as' => 'general.index.search.status'
            ]);

            Route::get('/general/report/search/print/byStock/{id}', [
                'uses' => 'GeneralReportController@search_result_stock',
                'as' => 'general.index.search.stock'
            ]);

            Route::get('/general/report/search/print/byUnit/{id}', [
                'uses' => 'GeneralReportController@search_result_unit',
                'as' => 'general.index.search.unit'
            ]);

            Route::get('/returns/report/print/bydate', [
                'uses' => 'ReturnsReportController@byDateReport',
                'as' => 'returns.index.bydate'
            ]);

            Route::get('/returns/report/print/all', [
                'uses' => 'ReturnsReportController@indexPrint',
                'as' => 'returns.index.print'
            ]);

            Route::get('/returns/report/search/print/byDept/{id}', [
                'uses' => 'ReturnsReportController@search_result_dept',
                'as' => 'returns.index.search'
            ]);

            Route::get('/returns/report/search/print/byCategory/{id}', [
                'uses' => 'ReturnsReportController@search_result_category',
                'as' => 'returns.index.search.category'
            ]);

            Route::get('/returns/report/search/print/byClass/{id}', [
                'uses' => 'ReturnsReportController@search_result_class',
                'as' => 'returns.index.search.class'
            ]);

            Route::get('/returns/report/search/print/byDonar/{id}', [
                'uses' => 'ReturnsReportController@search_result_donar',
                'as' => 'returns.index.search.donar'
            ]);

            Route::get('/returns/report/search/print/byEmployee/{id}', [
                'uses' => 'ReturnsReportController@search_result_employee',
                'as' => 'returns.index.search.employee'
            ]);

            Route::get('/returns/report/search/print/byHandover/{id}', [
                'uses' => 'ReturnsReportController@search_result_handover',
                'as' => 'returns.index.search.handover'
            ]);

            Route::get('/returns/report/search/print/byLocation/{id}', [
                'uses' => 'ReturnsReportController@search_result_location',
                'as' => 'returns.index.search.location'
            ]);

            Route::get('/returns/report/search/print/byProduct/{id}', [
                'uses' => 'ReturnsReportController@search_result_product',
                'as' => 'returns.index.search.product'
            ]);

            Route::get('/returns/report/search/print/byProject/{id}', [
                'uses' => 'ReturnsReportController@search_result_project',
                'as' => 'returns.index.search.project'
            ]);

            Route::get('/returns/report/search/print/byStatus/{id}', [
                'uses' => 'ReturnsReportController@search_result_status',
                'as' => 'returns.index.search.status'
            ]);

            Route::get('/returns/report/search/print/byStock/{id}', [
                'uses' => 'ReturnsReportController@search_result_stock',
                'as' => 'returns.index.search.stock'
            ]);

            Route::get('/returns/report/search/print/byUnit/{id}', [
                'uses' => 'ReturnsReportController@search_result_unit',
                'as' => 'returns.index.search.unit'
            ]);

            // For download
            Route::get('/handovers/requested_form/view/{file_path}', [
                'uses' => 'HandoverController@viewFile',
                'as' => 'file.view'
            ]);

            Route::get('/handover/handover_details/{id}', [
                'uses' => 'HandoverDetailsController@view',
                'as' => 'handover.detail.view'
            ]);

            // Search Routes
            Route::get('/categories/search/{id}', [
                'uses' => 'CategoriesController@search',
                'as' => 'categories.search'
            ]); 

            Route::get('/department/search/{id}', [
                'uses' => 'DepartmentController@search',
                'as' => 'department.search'
            ]);
            
            Route::get('/donar/search/{id}', [
                'uses' => 'DonarController@search',
                'as' => 'donar.search'
            ]);

            Route::get('/location/search/{id}', [
                'uses' => 'LocationController@search',
                'as' => 'location.search'
            ]);

            Route::get('/employees/search/{id}', [
                'uses' => 'EmployeeController@search',
                'as' => 'employees.search'
            ]);

            Route::get('/handovers/search/{id}', [
                'uses' => 'HandoverController@search',
                'as' => 'handovers.search'
            ]);

            Route::get('/products/search/{id}', [
                'uses' => 'ProductController@search',
                'as' => 'products.search'
            ]);

            Route::get('/projects/search/{id}', [
                'uses' => 'ProjectController@search',
                'as' => 'projects.search'
            ]);

            Route::get('/status/search/{id}', [
                'uses' => 'StatusController@search',
                'as' => 'status.search'
            ]);

            Route::get('/stock/search/{id}', [
                'uses' => 'StockController@search',
                'as' => 'stock.search'
            ]);

            Route::get('/units/search/{id}', [
                'uses' => 'UnitsController@search',
                'as' => 'units.search'
            ]);

            Route::get('/class/search/{id}', [
                'uses' => 'ClasController@search',
                'as' => 'class.search'
            ]);
            
            // Single Record Search
            Route::get('/categories/search_result/record/{id}', [
                'uses' => 'CategoriesController@index_search',
                'as' => 'categories.index_search'
            ]);

            Route::get('/classes/search_result/record/{id}', [
                'uses' => 'ClasController@index_search',
                'as' => 'classes.index_search'
            ]);

            Route::get('/department/search_result/record/{id}', [
                'uses' => 'DepartmentController@index_search',
                'as' => 'departments.index_search'
            ]);
            
            Route::get('/donar/search_result/record/{id}', [
                'uses' => 'DonarController@index_search',
                'as' => 'donars.index_search'
            ]);

            Route::get('/location/search_result/record/{id}', [
                'uses' => 'LocationController@index_search',
                'as' => 'locations.index_search'
            ]);

            Route::get('/employees/search_result/record/{id}', [
                'uses' => 'EmployeeController@index_search',
                'as' => 'employees.index_search'
            ]);

            Route::get('/handovers/search_result/record/{id}', [
                'uses' => 'HandoverController@index_search',
                'as' => 'handovers.index_search'
            ]);

            Route::get('/products/search_result/record/{id}', [
                'uses' => 'ProductController@index_search',
                'as' => 'products.index_search'
            ]);

            Route::get('/projects/search_result/record/{id}', [
                'uses' => 'ProjectController@index_search',
                'as' => 'projects.index_search'
            ]);

            Route::get('/status/search_result/record/{id}', [
                'uses' => 'StatusController@index_search',
                'as' => 'status.index_search'
            ]);

            Route::get('/stock/search_result/record/{id}', [
                'uses' => 'StockController@index_search',
                'as' => 'stock.index_search'
            ]);

            Route::get('/units/search_result/record/{id}', [
                'uses' => 'UnitsController@index_search',
                'as' => 'units.index_search'
            ]);

            Route::get('/class/search_result/record/{id}', [
                'uses' => 'ClasController@index_search',
                'as' => 'class.index_search'
            ]);


            Route::resource('categories', 'CategoriesController');
            Route::resource('department', 'DepartmentController');
            Route::resource('donar', 'DonarController');
            Route::resource('location', 'LocationController');
            Route::resource('employees', 'EmployeeController');
            Route::resource('handovers', 'HandoverController');
            Route::resource('handover_details', 'HandoverDetailsController');
            Route::resource('products', 'ProductController');
            Route::resource('projects', 'ProjectController');
            Route::resource('status', 'StatusController');
            Route::resource('logins', 'LoginController');
            Route::resource('stock', 'StockController');
            Route::resource('units', 'UnitsController');
            Route::resource('class', 'ClasController');
            Route::resource('returns', 'ReturnsController');
            Route::resource('users', 'UserController');
            Route::resource('stocklogs', 'StockLogController');
            Route::resource('handoverlogs', 'HandoverLogController');
            Route::resource('returnlogs', 'ReturnsLogController');
            Route::resource('employee_report', 'EmployeeReportController');
            Route::resource('stock_report', 'StockReportController');
            Route::resource('handover_report', 'HandoverReportController');
            Route::resource('returns_report', 'ReturnsReportController');
            Route::resource('general_report', 'GeneralReportController');
        });
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/home', function () {
    return redirect()->route('login');
});

