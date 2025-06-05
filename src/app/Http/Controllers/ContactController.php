<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function post(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        $contact['tel'] = $contact['tel1'] . '-' . $contact['tel2'] . '-' . $contact['tel3'];

        session(['contact' => $contact]);

        return redirect()->route('form.confirm');
    }

    public function confirm()
    {
        $contact = session('contact');

        if (!$contact) {
            return redirect()->route('form.index');
        }

        $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
        $contact['gender_label'] = $genderLabels[$contact['gender']] ?? '不明';

        return view('confirm', compact('contact'));
    }

    public function send(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('form.index')->withInput(session('contact'));
        }

        $contact = session('contact');

        if (!$contact) {
            return redirect()->route('form.index');
        }

        Contact::create([
            'first_name'   => $contact['first_name'],
            'last_name'    => $contact['last_name'],
            'gender'       => $contact['gender'],
            'email'        => $contact['email'],
            'tel'          => $contact['tel'],
            'address'      => $contact['address'],
            'building'     => $contact['building'] ?? '',
            'category_id'  => $contact['category_id'],
            'detail'       => $contact['detail'],
        ]);

        session()->forget('contact');

        return redirect()->route('form.thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
