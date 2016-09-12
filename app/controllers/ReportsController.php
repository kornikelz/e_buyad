<?php

class ReportsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function sales()
    {
        return View::make('reports/salesreport');
	}

	/*public function salesreport(){
        $pdf = App::make('dompdf');

        $pdf->loadHTML('
                        <html>
                            <head>
                                 <style>
                                    #imgheader{
                                    height: 5%; 
                                    width:5%}
                                 </style>
                            </head>
                            <body>
                                <div id="header1">
                                    <center> 
                                        <div id="imgheader">
                                        <img src="{{('/images/logo.png')}}">
                                        </div>
                                        <h4>E-BUYad<br>SALES SUMMARY REPORT</h4>
                                    </center>
                                    <br>
                                    <p style="font-size: 18px">&nbsp&nbsp&nbsp Created by:<br>&nbsp&nbsp&nbsp Date:</p>
                                    <br>
                                    <p style="font-size: 18px"><b>&nbsp&nbsp&nbsp TOTAL SALES:<b></p>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table id="example" class="table table-bordered table-hover">
                                        <thead>
                                          <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending">Date and Time</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending">Transaction ID From</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Transaction ID To</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Gross Amount</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">12% VAT</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="OSCA ID: activate to sort column ascending">VATable</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Home Number: activate to sort column ascending">VAT Exempt</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Contact Number: activate to sort column ascending">VAT Sales</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Email Address: activate to sort column ascending">Subtotal</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Discount</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Total Sales</th>
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </body>
                        </html>');
        return $pdf->stream();
    }*/

    public function product()
    {
        return View::make('reports/productreport');
    }
    /*public function productreport(){
        $pdf = App::make('dompdf');

        $pdf->loadHTML('
                        <html>
                            <head>
                                 <style>
                                    #imgheader{
                                    height: 5%; 
                                    width:5%}
                                 </style>
                            </head>
                            <body>
                                <div id="header1">
                                    <center> 
                                        <div id="imgheader">
                                        <img src="{{('/images/logo.png')}}">
                                        </div>
                                        <h4>E-BUYad<br>PRODUCT SALES REPORT</h4>
                                    </center>
                                    <br>
                                    <p style="font-size: 18px">&nbsp&nbsp&nbsp Created by:<br>&nbsp&nbsp&nbsp Date:</p>
                                    <br>
                                    <p style="font-size: 18px"><b>&nbsp&nbsp&nbsp TOTAL SALES:<b></p>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table id="example" class="table table-bordered table-hover">
                                        <thead>
                                          <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending">Product ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">VAT Sales (12%)</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">VAT Exempt</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Discount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Total Sales</th>
                                           </tr>
                                        </thead>

                                        <tbody>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </body>
                        </html>');
        return $pdf->stream();
    }*/

    public function credit()
    {
        return View::make('reports/creditreport');
    }
    /*public function creditreport(){
        $pdf = App::make('dompdf');

        $pdf->loadHTML('
                        <html>
                            <head>
                                 <style>
                                    #imgheader{
                                    height: 5%; 
                                    width:5%}
                                 </style>
                            </head>
                            <body>
                                <div id="header1">
                                    <center> 
                                        <div id="imgheader">
                                        <img src="{{('/images/logo.png')}}">
                                        </div>
                                        <h4>E-BUYad<br>CREDIT LOAD SALES REPORT</h4>
                                    </center>
                                    <br>
                                    <p style="font-size: 18px">&nbsp&nbsp&nbsp Created by:<br>&nbsp&nbsp&nbsp Date:</p>
                                    <br>
                                    <p style="font-size: 18px"><b>&nbsp&nbsp&nbsp TOTAL SALES:<b></p>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table id="example" class="table table-bordered table-hover">
                                        <thead>
                                          <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending">Date and Time</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Email Address: activate to sort column ascending">Credit from Cash</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Credit from Points</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Total Credit Load Sales</th>
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </body>
                        </html>');
        return $pdf->stream();
    }*/

    public function egc()
    {
        return View::make('reports/egcreport');
    }
    /*public function egcreport(){
        $pdf = App::make('dompdf');

        $pdf->loadHTML('
                        <html>
                            <head>
                                 <style>
                                    #imgheader{
                                    height: 5%; 
                                    width:5%}
                                 </style>
                            </head>
                            <body>
                                <div id="header1">
                                    <center> 
                                        <div id="imgheader">
                                        <img src="{{('/images/logo.png')}}">
                                        </div>
                                        <h4>E-BUYad<br>ELECTRONIC GIFT CARD SALES REPORT</h4>
                                    </center>
                                    <br>
                                    <p style="font-size: 18px">&nbsp&nbsp&nbsp Created by:<br>&nbsp&nbsp&nbsp Date:</p>
                                    <br>
                                    <p style="font-size: 18px"><b>&nbsp&nbsp&nbsp TOTAL SALES:<b></p>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table id="example" class="table table-bordered table-hover">
                                        <thead>
                                          <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending">Date and Time</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending">EGC ID From</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">EGC ID To</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Cash Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Product Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Total Sales</th>
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </body>
                        </html>');
        return $pdf->stream();
    }*/
}

 