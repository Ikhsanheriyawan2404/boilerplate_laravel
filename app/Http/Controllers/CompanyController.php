<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDataTable;

class CompanyController extends Controller
{
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('companies.index');
    }
}
