<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CardManagerController extends Controller
{
    //
    public function show_card_manager()
    {
        $total_cards = CreditCard::count();
        return view('card_manager', [
            'total_cards' => $total_cards
        ]);

    }

    public function display_cards(Request $request)
    {
        $data = CreditCard::select('id', 'name', 'type', 'limit', 'due_day')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('cc_name', function ($row) {
                return '<b>' . $row->name . '</b>';
            })
            ->addColumn('cc_type', function ($row) {
                // return $row->type;
                return '<small class="text-primary">' . $row->type . '</small>';
            })
            ->addColumn('cc_limit', function ($row) {
                $limit_amt = number_format($row->limit);
                return "₱ " . $limit_amt;
            })
            ->addColumn('due_day', function ($row) {
                return $row->due_day;
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-primary btn-sm btn_update" id="" 
                                data-id="' . $row->id . '" 
                                data-name="' . $row->name . '"  
                                data-type="' . $row->type . '"  
                                data-limit="' . $row->limit . '"   
                                data-due_day="' . $row->due_day . '"   
                >Update</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" id="" data-id="' . $row->id . '">Delete</button>
            ';
            })
            ->rawColumns(['action', 'cc_name', 'cc_type'])
            ->addIndexColumn()
            ->make(true);
    }


    public function add_card(Request $request)
    {
        CreditCard::create([
            'name' => $request->card_name,
            'type' => $request->card_type,
            'limit' => $request->card_limit,
            'due_day' => $request->due_day
        ]);

        // Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function update_card(Request $request)
    {
        $id = $request->id;
        CreditCard::where('id', $id)->update([
            'name' => $request->card_name,
            'type' => $request->card_type,
            'limit' => $request->card_limit,
            'due_day' => $request->due_day
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function delete_card(Request $request)
    {
        $id = $request->id;
        CreditCard::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
