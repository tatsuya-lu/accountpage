<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Config;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Post::paginate(10);
        return view('adminInquirylist', ['inquiries' => $inquiries]);
    }

    public function edit(Post $inquiry)
    {
        return view('adminEditInquiry', ['inquiry' => $inquiry]);
    }

    public function __construct()
    {
        $this->statuses = array_keys(Config::get('const.status'));
    }

    public function update(Request $request, Post $inquiry)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(config('const.status'))),
            'comment' => 'nullable|string',
        ]);

        $inquiry->update($request->only(['status', 'comment']));

        return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせ情報が更新されました。');
    }
}
