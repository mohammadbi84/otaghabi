<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::all();
        return view('dashboard.social_links.index', compact('links'));
    }

    public function create()
    {
        return view('dashboard.social_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        SocialLink::create($request->only(['platform', 'url']));

        return redirect()->route('social-links.index')->with('success', 'لینک با موفقیت افزوده شد.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('dashboard.social_links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        $socialLink->update($request->only(['platform', 'url']));

        return redirect()->route('social-links.index')->with('success', 'لینک با موفقیت ویرایش شد.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->back()->with('success', 'لینک حذف شد.');
    }
    public function bulkUpdate(Request $request)
    {
        // حذف لینک‌های حذف‌شده
        if ($request->deleted_ids) {
            $idsToDelete = explode(',', $request->deleted_ids);
            SocialLink::whereIn('id', $idsToDelete)->delete();
        }

        // ذخیره یا به‌روزرسانی بقیه
        foreach ($request->links as $link) {
            if (isset($link['id'])) {
                // به‌روزرسانی
                $social = SocialLink::find($link['id']);
                if ($social) {
                    $social->update([
                        'platform' => $link['platform'],
                        'url' => $link['url']
                    ]);
                }
            } else {
                // ایجاد جدید
                SocialLink::create([
                    'platform' => $link['platform'],
                    'url' => $link['url']
                ]);
            }
        }

        return back()->with('success', 'شبکه‌های اجتماعی با موفقیت ذخیره شدند.');
    }
}
