<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use App\Mail\Email;
use App\Mail\EmailToAdmin;
use Illuminate\Http\Request;
use App\Http\Requests\BookingInput;

class BookingInputController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? Carbon::now()->format('d M Y');
        return view('booking_input', compact('date'));
    }

    //入力画面でのバリデーションと確認、戻るボタン押下時
    public function post(BookingInput $request)
    {
        $input = $request->validated(); //$requestデータ全てを$inputへ代入

        if ($request['submit'] === 'confirm') {
            return view('booking_confirm', compact('input'));
        }
    }

    //確認画面で送信か戻るボタン押下時
    public function send(Request $request)
    {
        $action = $request->input('action', 'back');
        $admin  = 'sanae.kawasaka@gmail.com';
        $input  = $request->all();

        //submitボタン押下でDBに保存
        if ($action === 'submit') {

            DB::table('bookings')->insert(
                [
                    'created_at'       => now(),
                    'date'             => $request->input('date'),
                    'time'             => $request->input('time'),
                    'people'           => $request->input('people'),
                    'first_name'       => $request->input('first_name'),
                    'last_name'        => $request->input('last_name'),
                    'tel'              => $request->input('tel'),
                    'email'            => $request->input('email'),
                    'comment'          => $request->input('comment'),
                ]
            );

            Mail::to($request->input('email'))->send(new Email($input));
            Mail::to($admin)->send(new EmailToAdmin($input));

            //多重送信を防止のためトークンを再発行
            $request->session()->regenerateToken();
            return view('booking_thanks');
        } else {
            return redirect()->action('BookingInputController@back')->withInput(); //データ保持したまま確認画面で戻るボタン押下でbooking_inputに遷移
        }
    }

    //確認画面で戻るボタン押下時
    public function back()
    {
        return view('booking_input');
    }

    //直だたきで完了画面遷移時
    public function thanks()
    {
        return view('booking_thanks');
    }

    public function error()
    {
        return view('error');
    }

    public function vacancy(Request $request)
    {
        $full = 50;
        //クリックした日付を取得
        $date   = $request->date ?? Carbon::now()->format('d M Y');
        //DBのdateカラムがクリックした日付と合致するものを取得し、その中のpeopleカラムの合計を取得
        $vacancy = DB::table('bookings')->where('date', $date)->select('people')->sum('people');
        if ($vacancy == 0) {
            $vacancy = $full . " ";
        } elseif ($vacancy >= 50) {
            $vacancy = 0 . " ";
            return view('not_available', [
                'date'    => $date,
                'vacancy' => $vacancy,
            ]);
        } elseif ($vacancy >= 40) {
            $vacancy = "Few ";
            return view('table_few', [
                'date'    => $date,
                'vacancy' => $vacancy,
            ]);
        } else {
            $vacancy = $full - $vacancy . " ";
        }

        return view('booking_input', [
            'date'    => $date,
            'vacancy' => $vacancy,
        ]);
    }
}
