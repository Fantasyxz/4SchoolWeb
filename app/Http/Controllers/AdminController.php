<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
// use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{

    public function index()
    {
        $data['lantai'] = [1, 2];
        $data['blok'] = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $data['tipe'] = ['Labolatorium', 'Kelas'];
        $data['status'] = ['Kosong', 'Digunakan'];

        $dataA1 = Ruangan::where('blok', 'A')->where('lantai', '2')->take(2)->get();

        $dataA2 = Ruangan::where('blok', 'A')->where('lantai', '2')->skip(2)->take(1)->get();

        $dataA3 = Ruangan::where('blok', 'A')->where('lantai', '2')->skip(3)->take(1)->get();

        $dataA4 = Ruangan::where('blok', 'A')->where('lantai', '2')->where('nama', 'A 2.6')->get();

        $dataA5 = Ruangan::where('blok', 'A')->where('lantai', '2')->where('nama', 'A 2.7')->get();

        $dataA6 = Ruangan::where('blok', 'A')->where('lantai', '2')->where('nama', 'A 2.8')->get();

        $dataB1 = Ruangan::where('blok', 'B')->where('lantai', '1')->skip(2)->take(4)->orderBy('nama', 'desc')->get();

        $dataB2 = Ruangan::where('blok', 'B')->where('lantai', '1')->skip(4)->take(2)->get();

        $dataB3 = Ruangan::where('blok', 'B')->where('lantai', '2')->get();

        $dataC1 = Ruangan::where('blok', 'C')->where('lantai', '1')->where('nama', 'C 1.1')->get();

        $dataC2 = Ruangan::where('blok', 'C')->where('lantai', '1')->where('nama', 'C 1.2')->get();

        $dataC3 = Ruangan::where('blok', 'C')->where('lantai', '1')->where('nama', 'C 1.3')->get();

        $dataC4 = Ruangan::where('blok', 'C')->where('lantai', '2')->get();

        $dataD1 = Ruangan::where('blok', 'D')->where('lantai', '1')->get();

        $dataD2 = Ruangan::where('blok', 'D')->where('lantai', '2')->take(5)->get();

        $dataD3 = Ruangan::where('blok', 'D')->where('lantai', '2')->where('nama', 'D 2.6')->get();

        $dataE1 = Ruangan::where('blok', 'E')->where('lantai', '1')->get();

        $dataE2 = Ruangan::where('blok', 'E')->where('lantai', '2')->get();

        $dataF1 = Ruangan::where('blok', 'F')->where('lantai', '1')->where('nama', 'F 1.1')->get();

        $dataF2 = Ruangan::where('blok', 'F')->where('lantai', '1')->skip(1)->take(3)->get();

        $dataF3 = Ruangan::where('blok', 'F')->where('lantai', '2')->where('nama', 'F 2.1')->get();

        $dataF4 = Ruangan::where('blok', 'F')->where('lantai', '2')->where('nama', 'F 2.3')->get();

        $dataF5 = Ruangan::where('blok', 'F')->where('lantai', '2')->skip(2)->take(3)->get();

        $dataG1 = Ruangan::where('blok', 'G')->where('lantai', '1')->get();

        $dataG2 = Ruangan::where('blok', 'G')->where('lantai', '2')->get();

        $dataH1 = Ruangan::where('blok', 'H')->where('lantai', '1')->where('nama', 'H 1')->get();

        $dataH2 = Ruangan::where('blok', 'H')->where('lantai', '1')->where('nama', 'H 2')->get();

        $dataH3 = Ruangan::where('blok', 'H')->where('lantai', '1')->where('nama', 'H 3')->get();

        $dataH4 = Ruangan::where('blok', 'H')->where('lantai', '1')->where('nama', 'H 4')->get();

        $dataH5 = Ruangan::where('blok', 'H')->where('lantai', '1')->skip(4)->take(3)->get();

        return view('maps.index', compact('dataH1', 'dataA1', 'dataA2', 'dataA3', 'dataA4', 'dataA5', 'dataA6', 'dataB1', 'dataB2', 'dataB3', 'dataC1', 'dataC2', 'dataC3', 'dataC4', 'dataD1', 'dataD2', 'dataD3', 'dataE1', 'dataE2', 'dataF1', 'dataF2', 'dataF3', 'dataF4', 'dataF5', 'dataG1', 'dataG2', 'dataH2', 'dataH3', 'dataH4', 'dataH5', 'data'));

        //dd($dataD);

    }

    public function showFormLogin()
    {
        return view('admin.login');
        // if (Auth::check()) { // true
        //     //Login Success
        //     return redirect()->route('home');
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/home');
        }
        return redirect('/')->with('message', 'Email atau Password salah');

        // $rules = [
        //     'email' => 'required|email',
        //     'password' => 'required|string',
        // ];
        // $messages = [
        //     'email.required' => 'Email wajib diisi',
        //     'email.email' => 'Email tidak valid',
        //     'password.required' => 'Password wajib diisi',
        //     'password.string' => 'Password harus berupa string',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect()->back()->with('message', 'Email atau Password salah')->withErrors($validator)->withInput($request->all);
        // }
        // $data = [
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ];
        // Auth::attempt($data);
        // if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
        //     //Login Success
        //     return redirect()->route('home');
        // } else { // false
        //     //Login Fail
        //     return redirect('login')->with('message', 'Email atau Password salah');
        // }

    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register()
    {
        $registStatus = Session::select('value')->where('type', 'registration')->pluck('value');
        return view('layouts.adminOpenRegis', compact('registStatus'));
    }

    public function home()
    {
        return view('layout.admin');
    }

    public function tambahUser()
    {
        return view('tambahUser.addUser');
    }

    public function tambahMatpel()
    {
        return view('tambahMatpel.addMatpel');
    }
}
