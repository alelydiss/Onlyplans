<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminTicketController extends Controller
{
public function index()
{
    $tickets = Order::with('user')->get(); // eager loading por si usas relaciones
    return view('admin.tickets', compact('tickets'));
}

}