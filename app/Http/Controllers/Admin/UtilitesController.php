<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\SendingPurpose;
use App\Models\Service;
use App\Models\SourceFund;
use App\Rules\FileTypeValidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class UtilitesController extends Controller
{


    public function service()
    {
        $data['page_title'] = 'Service List';
        return view('admin.country.serviceList', $data);
    }
    public function getService()
    {
        $items = Service::orderBy('name')->get();
        return $items;
    }

    public function storeService(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = new Service();
        $result->name = $excp['name'];
        $result->status = (int)$excp['status'];
        $result->save();
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'failed!!!',
                'data' => []
            ];
        }
    }

    public function updateService(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'id' => 'required|numeric',
            'name' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $result = Service::findOrFail($request['id']);
        $result->name = $excp['name'];
        $result->status = (int)$excp['status'];
        $result->save();

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Update Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Updating Failed',
                'data' => []
            ];
        }
    }

    public function destroyService(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = Service::destroy($excp['id']);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Delete Successfully',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed!!',
                'data' => []
            ];
        }
    }




    public function continent()
    {
        $data['page_title'] = 'Continent List';
        return view('admin.country.continent', $data);
    }
    public function getContinent()
    {
        $items = Continent::orderBy('name')->get();
        return $items;
    }

    public function storeContinent(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = new Continent();
        $result->name = $excp['name'];
        $result->status = (int)$excp['status'];
        $result->save();
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'failed!!!',
                'data' => []
            ];
        }
    }

    public function updateContinent(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'id' => 'required|numeric',
            'name' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $result = Continent::findOrFail($request['id']);
        $result->name = $excp['name'];
        $result->status = (int)$excp['status'];
        $result->save();

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Update Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Updating Failed',
                'data' => []
            ];
        }
    }

    public function destroyContinent(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = Continent::destroy($excp['id']);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Delete Successfully',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed!!',
                'data' => []
            ];
        }
    }


    public function purpose()
    {
        $data['page_title'] = 'Purpose List';
        return view('admin.utility.purpose', $data);
    }

    public function getPurpose()
    {
        $items = SendingPurpose::orderBy('id', 'desc')->get();
        return $items;
    }

    public function storePurpose(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'title' => 'sometimes|required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = SendingPurpose::create($excp);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'failed!!!',
                'data' => []
            ];
        }
    }

    public function updatePurpose(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'id' => 'required|numeric',
            'title' => 'required|max:191',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $in['title'] = $excp['title'];
        $result = SendingPurpose::findOrFail($request['id'])->update($in);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Update Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Updating Failed',
                'data' => []
            ];
        }
    }

    public function destroyPurpose(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = SendingPurpose::destroy($excp['id']);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Delete Successfully',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed!!',
                'data' => []
            ];
        }
    }


    public function sourceOfFund()
    {
        $data['page_title'] = 'Source Of Fund';
        return view('admin.utility.sourceOfFund', $data);
    }

    public function getSF()
    {
        $items = SourceFund::orderBy('id', 'desc')->get();
        return $items;
    }

    public function storeSF(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'title' => 'sometimes|required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = SourceFund::create($excp);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'failed!!!',
                'data' => []
            ];
        }
    }

    public function updateSF(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'id' => 'required|numeric',
            'title' => 'required|max:191',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $in['title'] = $excp['title'];
        $result = SourceFund::findOrFail($request['id'])->update($in);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Update Successfully',
                'data' => $result
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Updating Failed',
                'data' => []
            ];
        }
    }

    public function destroySF(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $result = SourceFund::destroy($excp['id']);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Delete Successfully',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed!!',
                'data' => []
            ];
        }
    }

}
