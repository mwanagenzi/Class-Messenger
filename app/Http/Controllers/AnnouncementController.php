<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::with('user')->latest()->get();
        return view('announcements.index',
            ['announcements' => $announcements]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_announcement = $request->validate([
            'message' => 'required|string|max:255'
        ]);
        $request->user()->announcements()->create($validated_announcement);
        //todo: set create policy here.
        return redirect(secure_url(route('announcements.index')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', ['announcement' => $announcement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);
        $validated_message = $request->validate([
            'message' => 'required|string|max:255'
        ]);
        $announcement->update($validated_message);
        return redirect(secure_url(route('announcements.index')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);
        $announcement->delete();
        return redirect(secure_url(route('announcements.index')));
    }
}
