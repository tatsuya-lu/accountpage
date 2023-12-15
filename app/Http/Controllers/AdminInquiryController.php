<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\InquiryRequest;

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

    public function update(InquiryRequest $request, Post $inquiry)
    {
        $inquiry->update($request->only(['status', 'comment']));

        return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせ情報が更新されました。');
    }
}
