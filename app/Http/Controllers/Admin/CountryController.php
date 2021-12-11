<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Continent;
use App\Models\Country;
use App\Models\CountryService;
use App\Models\CountryServiceCharge;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class CountryController extends Controller
{
    use Upload;

    public function index()
    {
        $countries = Country::select('id','continent_id','name','image','rate','code','facilities','status')->orderBy('name')->with(['continent:id,name'])->paginate(config('basic.paginate'));
        return view('admin.country.index', compact('countries'));
    }

    public function add()
    {
        $data['page_title'] = "Add Country";
        $data['continents'] = Continent::select('id','name')->where('status', 1)->orderBy('name')->get();
        $data['services'] = Service::select('id','name')->where('status', 1)->orderBy('name')->get();
        return view('admin.country.add', $data);
    }

    public function store(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $validate = Validator::make($request->all(), [
            'continent_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'minimum_amount' => 'required|numeric',
            'rate' => 'required',
            'status' => 'required',
            'send_from' => 'required',
            'send_to' => 'required',
            "facilities" => "required|array",
            "facilities.*" => "required|string|distinct",
            "details" => 'nullable'
        ], [
            'continent_id.required' => "Select a continent"
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $service = Service::select('id', 'name')->whereIn('id', $excp['facilities'])->get()->toArray();

        $data = new Country();

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->uploadImage($request->image, config('location.country.path'), config('location.country.size'));
            }
            $data->name = $excp['name'];
            $data->slug = slug($excp['name']);
            $data->code = $excp['code'];
            $data->continent_id = $excp['continent_id'];
            $data->facilities = $service;
            $data->minimum_amount = $excp['minimum_amount'];
            $data->rate = $excp['rate'];
            $data->status = (int) $excp['status'];
            $data->send_from = (int) $excp['send_from'];
            $data->send_to = (int) $excp['send_to'];
            $data->details = $excp['details'];
            $data->save();

            session()->flash('success', 'Saved Successfully');
            return back();
        } catch (\Exception $exp) {
            return back()->with('error', $exp)->withInput();
        }

    }

    public function edit(Country $country)
    {
        $data['page_title'] = "Update Country";
        $data['continents'] = Continent::select('id','name')->where('status', 1)->orderBy('name')->get();
        $data['services'] = Service::select('id','name')->where('status', 1)->orderBy('name')->get();
        $data['country'] = $country;
        return view('admin.country.edit', $data);
    }

    public function update(Request $request, Country $country)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $validate = Validator::make($request->all(), [
            'continent_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'minimum_amount' => 'required|numeric',
            'rate' => 'required',
            'status' => 'required',
            'send_from' => 'required',
            'send_to' => 'required',
            "facilities" => "required|array",
            "facilities.*" => "required|string|distinct",
            "details" => 'nullable'
        ], [
            'continent_id.required' => "Select a continent"
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $service = Service::select('id', 'name')->whereIn('id', $excp['facilities'])->get()->toArray();

        try {
            if ($request->hasFile('image')) {
                $old = $country->image ?: null;
                $country->image = $this->uploadImage($request->image, config('location.country.path'), config('location.country.size'), $old);
            }
            $country->name = $excp['name'];
            $country->slug = slug($excp['name']);
            $country->code = $excp['code'];
            $country->continent_id = $excp['continent_id'];
            $country->facilities = $service;
            $country->rate = $excp['rate'];
            $country->minimum_amount = $excp['minimum_amount'];
            $country->status = (int) $excp['status'];
            $country->send_from = (int) $excp['send_from'];
            $country->send_to = (int) $excp['send_to'];
            $country->details = $excp['details'];
            $country->save();

            session()->flash('success', 'Update Successfully');
            return back();
        } catch (\Exception $exp) {
            return back()->with('error', $exp)->withInput();
        }
    }


    public function activeMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You did not select any country.');
            return response()->json(['error' => 1]);
        } else {
            Country::whereIn('id', $request->strIds)->update([
                'status' => 1,
            ]);
            session()->flash('success', 'Country Status Has Been Active');
            return response()->json(['success' => 1]);
        }
    }

    public function inActiveMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You did not select any country.');
            return response()->json(['error' => 1]);
        } else {
            Country::whereIn('id', $request->strIds)->update([
                'status' => 0,
            ]);
            session()->flash('success', 'Country Status Has Been Deactive');
            return response()->json(['success' => 1]);
        }
    }

    public function countryService(Country $country)
    {
        $data['page_title'] = "Service In " . $country->name;
        $data['serviceList'] =  Service::select('id','name')->where('status',1)->get();
        $data['countryServices'] = CountryService::where('country_id', $country->id)->whereIn('service_id',collect($country->facilities)->pluck('id'))->get()->groupBy(['service_id',]);
        $data['country'] = $country;
        return view('admin.country.services', $data);
    }

    public function serviceStore(Request $request, Country $country)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'service_id' => 'required',
            'status' => 'required',
        ], [
            'service_id.required' => "Select a service category"
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
        try {
            $data = new CountryService();
            $data->name =  $excp['name'];
            $data->country_id = $country->id;
            $data->service_id = $excp['service_id'];
            $data->status = (int) $excp['status'];
            $input_form = [];
            if ($request->has('field_name')) {
                for ($a = 0; $a < count($request->field_name); $a++) {
                    $arr = array();
                    $arr['field_name'] = clean( $request->field_name[$a]);
                    $arr['field_level'] = ucwords($request->field_name[$a]);
                    $arr['type'] = $request->type[$a];
                    $arr['field_length'] = $request->field_length[$a];
                    $arr['length_type'] = $request->length_type[$a];
                    $arr['validation'] = $request->validation[$a];
                    $input_form[$arr['field_name']] = $arr;
                }
            }
            $data->services_form = $input_form;
            $data->save();
            session()->flash('success', 'Update Successfully');
            return back();
        } catch (\Exception $exp) {
            return back()->with('error', $exp)->withInput();
        }
    }


    public function serviceUpdate(Request $request, Country $country)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $validate = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'service_id' => 'required',
            'status' => 'required',
        ], [
            'service_id.required' => "Select a service category"
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }


        try {
            $data = CountryService::find($excp['id']);
            $data->name =  $excp['name'];
            $data->country_id = $country->id;
            $data->service_id = $excp['service_id'];
            $data->status = (int) $excp['status'];
            $input_form = [];
            if ($request->has('field_name')) {
                for ($a = 0; $a < count($request->field_name); $a++) {
                    $arr = array();
                    $arr['field_name'] = clean( $request->field_name[$a]);
                    $arr['field_level'] = ucwords($request->field_name[$a]);
                    $arr['type'] = $request->type[$a];
                    $arr['field_length'] = $request->field_length[$a];
                    $arr['length_type'] = $request->length_type[$a];
                    $arr['validation'] = $request->validation[$a];
                    $input_form[$arr['field_name']] = $arr;
                }
            }
            $data->services_form = $input_form;
            $data->save();
            session()->flash('success', 'Update Successfully');
            return back();
        } catch (\Exception $exp) {
            return back()->with('error', $exp)->withInput();
        }
    }


    public function serviceCharge(Country $country, Service $service)
    {
        $data['page_title'] = 'Charge : '.$service->name.' in  '.$country->name;
        $data['country'] = $country;
        $data['service'] = $service;
        $data['countryServiceCharge'] = CountryServiceCharge::where('country_id',$country->id)->where('service_id',$service->id)->get();
        return view('admin.country.service-charge', $data);
    }

    public function serviceChargeStore(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $validate = Validator::make($request->all(), [
            'country_id' => 'required',
            'service_id' => 'required',
            'amount' => 'required',
            'charge' => 'required',
            'type' => 'required'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        CountryServiceCharge::where('country_id',$excp['country_id'])->where('service_id',$excp['service_id'])->delete();


        for ($a = 0; $a < count($request->type); $a++) {
            $data = new CountryServiceCharge();
            $data->country_id = $excp['country_id'];
            $data->service_id = $excp['service_id'];
            $data->type = $request->type[$a];
            $data->amount = $request->amount[$a];
            $data->charge = $request->charge[$a];
            $data->save();
        }

        session()->flash('success', 'Saved Successfully');
        return back();



    }

}
