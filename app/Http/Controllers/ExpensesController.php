<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpensesController extends Controller
{
    //
    public function show_expenses()
    {
        $data = CreditCard::select('Name')->get();
        return view('expenses', [
            'credit_cards' => $data
        ]);
    }

    public function display_expenses(Request $request)
    {
        $data = Expenses::select('id', 'date', 'card', 'merchant', 'category', 'amount')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('card', function ($row) {
                return $row->card;
            })
            ->addColumn('date', function ($row) {
                return $row->date;
            })
            ->addColumn('merchant', function ($row) {
                // return $row->type;
                return '<i>' . $row->merchant . '</i>';
            })
            ->addColumn('category', function ($row) {
                return $row->category;
            })
            ->addColumn('amount', function ($row) {
                $amt = number_format($row->amount, 2);
                return "₱ " . $amt;
                ;
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-primary btn-sm btn_update" id="" 
                                data-id="' . $row->id . '"  
                                data-card="' . $row->card . '"   
                                data-date="' . $row->date . '"  
                                data-merchant="' . $row->merchant . '"  
                                data-category="' . $row->category . '"    
                                data-amount="' . $row->amount . '"              
                >Update</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" id="" data-id="' . $row->id . '">Delete</button>';
            })
            ->rawColumns(['action', 'amount', 'merchant'])
            ->addIndexColumn()
            ->make(true);
    }

    public function add_expenses(Request $request)
    {
        Expenses::create([
            'card' => $request->card,
            'date' => $request->date,
            'amount' => $request->amount,
            'category' => $request->category,
            'merchant' => $request->merchant,
        ]);

        // Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function update_expenses(Request $request)
    {
        $id = $request->update_id;
        Expenses::where('id', $id)->update([
            'card' => $request->update_card,
            'date' => $request->update_date,
            'merchant' => $request->update_merchant,
            'category' => $request->update_category,
            'amount' => $request->update_amount
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function delete_expenses(Request $request)
    {
        $id = $request->delete_id;
        Expenses::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
