<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\SendMoney;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;

class TransferLogController extends Controller
{
    use Notify;
    public function index()
    {
        $page_title = "Money Transfer";
        $sendMoneys = SendMoney::where('payment_status', '!=', 0)->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.transfer.index', compact('sendMoneys', 'page_title'));
    }

    public function complete()
    {
        $page_title = "Complete Transfer";
        $sendMoneys = SendMoney::where(['payment_status'=> 1, 'status'=> 1])->orderBy('received_at', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.transfer.index', compact('sendMoneys', 'page_title'));
    }

    public function pending()
    {
        $page_title = "Pending Transfer";
        $sendMoneys = SendMoney::whereIn('payment_status', [1,3])->where(['status'=> 2])->orderBy('paid_at', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.transfer.index', compact('sendMoneys', 'page_title'));
    }

    public function cancelled()
    {
        $page_title = "Cancelled Transfer";
        $sendMoneys = SendMoney::where(['status'=> 3])->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.transfer.index', compact('sendMoneys', 'page_title'));
    }


    public function search(Request $request)
    {
        $search = $request->all();


        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $sendMoneys = SendMoney::when(isset($search['name']), function ($query) use ($search) {
            return $query->where('invoice', 'LIKE', $search['name'])
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('email', 'LIKE', "%{$search['name']}%")
                    ->orWhere('username', 'LIKE', "%{$search['name']}%");
                });
        })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when($search['status'] != -1, function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->where('status', '!=', 0)
            ->where('payment_status', '!=', 0)
            ->with('user:id,username')
            ->paginate(config('basic.paginate'));
        $sendMoneys->appends($search);


        $page_title = "Search Transfer";
        return view('admin.transfer.index', compact('sendMoneys', 'page_title'));
    }

    public function details(SendMoney $sendMoney)
    {
        $page_title = "Transfer #".$sendMoney->invoice;


        return view('admin.transfer.details', compact('sendMoney', 'page_title'));
    }

    public function download($file)
    {
        $full_path = join(explode('|',decrypt($file)));
        $title = last(explode('|',decrypt($file)));
        $ext = pathinfo($title, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);
        header('Content-Disposition: attachment; filename="' . $title . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

    public function action(SendMoney $sendMoney, Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'admin_reply' => 'required',
        ]);

        $req = Purify::clean($request->all());
        $req = (object)$req;


        if($sendMoney->status != 2){
            session()->flash('error', 'Not eligible to action this');
            return back()->withInput();
        }

        if($sendMoney->payment_status == 0){
            session()->flash('error', 'this user not yet payment');
            return back()->withInput();
        }
        if($sendMoney->payment_status == 3){
            session()->flash('error', 'Please take a action for this payment request');
            return back()->withInput();
        }

        $user = $sendMoney->user;

        if($req->status == 1){
            //complete
            $sendMoney->admin_id = auth()->guard('admin')->id();
            $sendMoney->admin_reply = $req->admin_reply;
            $sendMoney->status = $req->status;
            $sendMoney->received_at = Carbon::now();
            $sendMoney->save();

            $this->sendMailSms($user, 'MONEY_TRANSFER_COMPLETE', [
                'amount' => getAmount($sendMoney->totalPay, config('basic.fraction_number')),
                'currency' => $sendMoney->send_curr,
                'invoice' => $sendMoney->invoice,
                'admin_reply' => $sendMoney->admin_reply,
            ]);

            $msg = [
                'amount' => getAmount($sendMoney->totalPay, config('basic.fraction_number')),
                'currency' => $sendMoney->send_curr
            ];
            $action = [
                "link" => '#',
                "icon" => "fas fa-money-bill-alt"
            ];

            $this->userPushNotification($user, 'MONEY_TRANSFER_COMPLETE', $msg, $action);

            session()->flash('success', 'Your transfer has been completed');
        }
        if($req->status == 3){
            //Cancelled
            $sendMoney->admin_id = auth()->guard('admin')->id();
            $sendMoney->admin_reply = $req->admin_reply;
            $sendMoney->status = $req->status;
            $sendMoney->save();


            $this->sendMailSms($user, 'MONEY_TRANSFER_REJECTED', [
                'amount' => getAmount($sendMoney->totalPay, config('basic.fraction_number')),
                'currency' => $sendMoney->send_curr,
                'invoice' => $sendMoney->invoice,
                'admin_reply' => $sendMoney->admin_reply,
            ]);


            $msg = [
                'amount' => getAmount($sendMoney->totalPay, config('basic.fraction_number')),
                'currency' => $sendMoney->send_curr
            ];
            $action = [
                "link" => '#',
                "icon" => "fas fa-money-bill-alt"
            ];

            $this->userPushNotification($user, 'MONEY_TRANSFER_REJECTED', $msg, $action);

            session()->flash('success', 'This transfer has been rejected');
        }



        return back();
    }
}
