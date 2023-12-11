<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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

    public function update(Request $request, Post $inquiry)
    {
        $request->validate([
            'status' => 'required|in:未対応,対応中,対応済み',
            'comment' => 'nullable|string',
        ]);

        $inquiry->update($request->only(['status', 'comment']));

        return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせ情報が更新されました。');
    }
}
