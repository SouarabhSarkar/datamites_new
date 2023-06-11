<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_Item;
use DB;

class ContactItemController extends Controller
{

    public function show_searched_contact(Request $request)
    {
        $request->validate([
            'contact_item_type' => 'required',
            'value' => 'required'
            
        ]);

        $contact_item_type = $request->contact_item_type;
        $value = $request->value;

       $data = Contact_Item::where([
           ['value','=',$value],
            ['contact_item_type','=',$contact_item_type]
       ])->get();

       return redirect('showsearchedcontact',['data' => $data]);

       
    }

    // public function action(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $quer = $request->get('query');
    //         if($quer != '')
    //         {
    //             $data = DB::table('contact_item')
    //                     ->where('contact_item_type', 'LIKE', '%'.query.'%')->get();
    //         }
    //         else
    //         {
    //             $data = DB::table('contact_item')
    //                     ->orderBy('id','desc')
    //                     ->get();
    //         }
    //         $total_row = $data->count();
    //         if($total_row > 0)
    //         {
    //             foreach($data as $row)
    //             {
    //                 $output .= '
    //                 <tr>
    //                     <td>'.$row->id.'</td>
    //                     <td>'.$row->contact_item_type.'</td>
    //                     <td>'.$row->value.'</td>
    //                     <td>'.$row->status.'</td>
    //                     <td>'.$row->verified_on.'</td>
    //                     <td>'.$row->verification_status.'</td>
    //                     <td>'.$row->created_by.'</td>
    //                 </tr>
    //                 ';
    //             }
    //         }
    //         else
    //         {
    //             $output = '
    //                 <tr>
    //                     <td align="center" colspan="5">No data 
    //                     found</td>
    //                 </tr>
    //             ';
    //         }
    //         $data = array(
    //             'table_data'   =>  $output,
    //             'table_data'   =>  $tota_data
    //         );

    //         echo json_encode($data);
    //     }
    //     else
    //     {

    //     }
    // }
}
