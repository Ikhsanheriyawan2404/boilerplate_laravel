<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDatatable;

class EmployeeController extends Controller
{
    public function index(EmployeesDatatable $datatables)
    {
        return $datatables->render('employees.index');
    }
}
