<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query();

        if ($request->filled('keyword')) {
            $query->where('message', 'like', '%' . $request->keyword . '%')
                  ->orWhere('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('created_at_start')) {
            $query->where('created_at', '>=', $request->created_at_start);
        }

        if ($request->filled('created_at_end')) {
            $query->where('created_at', '<=', $request->created_at_end);
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.inquiry.index', compact('inquiries'));
    }

    public function show($inquiry_id)
    {
        $inquiry = Inquiry::find($inquiry_id);
        return view('admin.inquiry.show', compact('inquiry'));
    }

    public function delete($inquiry_id)
    {
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->delete();
        return redirect()->route('admin.inquiry.index')->with('success', 'お問い合わせを削除しました。');
    }
}
