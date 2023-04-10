<?php

namespace App\Http\Controllers;
use App\Models\Request as RequestModel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;


class RequestController extends Controller
{
    public function requestForm(): View
    {
        $data['Types'] = Type::all();
        return view('requestForm',$data);
    }

    public function requestCreate(Request $request)
    {
        $service_code = Str::random(6);
        
        $data = $request -> validate([
            'owner_name' => 'required',
            'product_name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'type_id' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'problem' => 'required',
           
           ]);

           $data['service_code'] = $service_code;

        //    dd($data);

        RequestModel::create($data);
        return redirect()->route('home');
        
    }
    
    public function allRequests(){
        $user = Auth::guard('staff')->user();
        $data['allRequests'] = RequestModel::where('type_id',$user->type_id)->where('technician_id',$user->id)->get();
        $data['title'] = "All Request";
        return view("staff.requests",$data);
    }

    public function newRequests(){
        $user = Auth::guard('staff')->user();
        $data['allRequests'] = RequestModel::where('type_id',$user->type_id)
                                        ->where('technician_id',NULL)->get();
        $data['title'] = "New Request";
        return view("staff.requests",$data);
    }

    public function confirmRequest(Request $req, $id){
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('type_id',$user->type_id)
                                ->where('technician_id',NULL)
                                ->where('id',$id)->first();

        $request->technician_id = $user->id;
        $request->save();
        return redirect()->back();
    }

    public function pandingRequests(){
        $user = Auth::guard('staff')->user();
        $data['allRequests'] = RequestModel::where('type_id',$user->type_id)
                                    ->where('technician_id',$user->id)
                                    ->where('status','panding')->get();

        $data['title'] = "Total PandingRequests";
        return view("staff.requests",$data);
       
    }
    public function rejectedRequests(){
        $user = Auth::guard('staff')->user();
        $data['allRequests'] = RequestModel::where('type_id',$user->type_id)
                                    ->where('technician_id',$user->id)
                                    ->where('status','rejected')->get();
        $data['title'] = "Total RejectedRequests";
        return view("staff.requests",$data);
       
    }

   public function rejected( Request $req){
        $data=RequestModel::where('id',$req->id)->first();
        $data->status= "rejected";
        $data->save();   
        return redirect()->back();
   }
    public function panding( Request $req){
        $data=RequestModel::where('id',$req->id)->first();
        $data->status= "panding";
        $data->save();   
        return redirect()->back();
    }

    public function requestEdit(Request $req, $id){
        $data=RequestModel::where('id',$id)->first();
        return view("staff.requestEdit",compact('data'));
    }

    public function requestUpdate(Request $req)
    {
        $data = $req->validate([
            'owner_name' => 'required',
            'product_name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'color' => 'required',
            'brand' => 'required',
            'problem' => 'required',
        ]);

        $id=$req->id;
        RequestModel::where('id',$id)->update($data);
        return redirect()->route('request.all');
    }
}