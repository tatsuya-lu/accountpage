<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Post::all();
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
            // 'company' => 'required|max:20',
            // 'name' => 'required',
            // 'tel' => 'required|regex:/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/',
            // 'email' => 'required|email',
            // 'birthday' => 'required',
            // 'gender' => 'required|in:男,女',
            // 'profession' => 'required|in:公務員,会社員,エンジニア',
            // 'body' => 'required',
        ]);

        // $inquiry->update($request->all());
        $inquiry->update($request->only(['status', 'comment']));

        return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせ情報が更新されました。');
    }

    // public function destroy(Post $inquiry)
    // {
    //     $inquiry->delete();

    //     return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせ情報が削除されました。');
    // }
}
