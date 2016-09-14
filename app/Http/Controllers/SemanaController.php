<?php

namespace Theater\Http\Controllers;


use Validator;
use Illuminate\Http\Request;

use Theater\Entities\Production;
use Theater\Entities\Propietor;
use Theater\Entities\Award;
use Theater\Entities\File;

class SemanaController extends Controller
{
    private function validator($inputs, $rules){
        return Validator::make($inputs, $rules);
    }

    public function index(){
        $awards = auth()->user()->organization->awards;

        foreach ($awards as $award){
            if($award['award_type_id'] == 2)
                return redirect()->route('choose');
        }

        return view('front.semana');
    }

    public function create(Request $request){
        $inputs = $request->all();
        $validate = $this->validator($inputs, $this->getColonRules());

        if($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput();

        $this->sendSemana($inputs);
        return redirect()->route('choose')->with(['Success' => 'Se ha inscrito al PREMIO SEMANA con exito.']);
    }

    private function sendSemana($inputs){

        $org = auth()->user()->organization;
        $org->update([
            'name' => $inputs['org_name'],
            'city' => $inputs['org_city'],
            'address' => $inputs['org_address'],
            'phone' => $inputs['org_phone'],
            'mobile' => $inputs['org_mobile'],
            'email' => $inputs['org_email'],
            'website' => $inputs['org_website'],
        ]);

        $prd = Production::create([
            'name' => $inputs['prd_name'],
            'genre' => $inputs['prd_genre'],
        ]);

        Propietor::create([
            'name' => $inputs['rep_name'],
            'last_name' => $inputs['rep_last_name'],
            'document_type_id' => $inputs['rep_doc_typ'],
            'document_number' => $inputs['rep_doc_number'],
            'mobile' => $inputs['rep_mobile'],
            'email1' => $inputs['rep_email'],
            'email2' => $inputs['rep_email2'],
        ]);

        $awd = Award::create([
            'award_type_id' => 2,
            'production_id' => $prd->id
        ]);

        $org->awards()->attach($awd->id);

        foreach ($inputs as $key => $file){
            if(strpos($key, 'type') !== false){
                $fileName = explode('/temp/', $file)[1];
                rename(base_path('public' . $file), base_path('public/uploads/semana/' . $fileName));
                $type = explode('type', $key)[1];

                File::create([
                    'name' => $fileName,
                    'file_type_id' => $type,
                    'award_id' => $awd->id
                ]);
            }
        }

    }

    private function getColonRules(){
        return [
            'org_name' => 'required',
            'org_city' => 'required',
            'org_address' => 'required',
            'org_phone' => 'required|numeric',
            'org_mobile' => 'required|numeric',
            'org_email' => 'required|email',

            'prd_name' => 'required',
            'prd_genre' => 'required',

            'rep_name' => 'required',
            'rep_last_name' => 'required',
            'rep_doc_typ' => 'required',
            'rep_doc_number' => 'required',
            'rep_mobile' => 'required',
            'rep_email' => 'required',

            'type1' => 'required',
            'type2' => 'required',
            'type3' => 'required',
            'type5' => 'required',
            'type7' => 'required',
            'type8' => 'required',
            'type9' => 'required',
            'type10' => 'required',
            'type11' => 'required',
            'type12' => 'required',
            'type13' => 'required',
            'type14' => 'required',
            'type15' => 'required',
            'type16' => 'required',
            'type17' => 'required',
            'type18' => 'required',
            'type19' => 'required',
        ];
    }
}