<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaryEntry;
use Illuminate\Support\Facades\Auth;
use App\Models\Emotion;
use Illuminate\Support\Facades\DB;

class DiaryEntryController extends Controller
{
    public function index()
    {
        // Get the paginated diary entries with their associated emotions
        $diaryEntries = Auth::user()->diaryEntries()->with('emotions')->paginate(5);
        // Get the logged-in user ID
        $userId = Auth::id();
        // Count how many diaries are related to each emotion
        $emotionCounts = DB::table('diary_entry_emotions as dee')
            ->join('diary_entries as de', 'dee.diary_entry_id', '=', 'de.id')
            ->select('dee.emotion_id', DB::raw('count(dee.diary_entry_id) as diary_count'))
            ->where('de.user_id', $userId)
            ->whereIn('dee.emotion_id', [1, 2, 3, 4, 5])
            ->groupBy('dee.emotion_id')
            ->get();
        // Convert the data into a format suitable for display
        $summary = [];
        foreach ($emotionCounts as $count) {
            $summary[$count->emotion_id] = $count->diary_count;
        }
        // Return the view with both diary entries and summary data
        return view('diary.index', compact('diaryEntries', 'summary'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'date' => 'required|date',
            'content' => 'required|string',
            'emotions' => 'array', // Validate emotions as an array
            'intensity' => 'array', // Validate intensity as an array
        ]);

        // Create the diary entry
        $diaryEntry = Auth::user()->diaryEntries()->create([
            'date' => $validated['date'],
            'content' => $validated['content'],
        ]);

        // Handle emotions and intensities
        if (!empty($validated['emotions']) && !empty($validated['intensity'])) {
            foreach ($validated['emotions'] as $emotionId) {
                // Ensure intensity is provided and not null
                if (isset($validated['intensity'][$emotionId])) {
                    $intensity = $validated['intensity'][$emotionId];
                    // Attach emotions and intensities to the diary entry
                    $diaryEntry->emotions()->attach($emotionId, [
                        'intensity' => $intensity,
                    ]);
                }
            }
        }

        return redirect()->route('diary.index')->with('status', 'Diary entry added successfully!');
    }

    public function show(string $id)
    {
        $diaryEntry = Auth::user()->diaryEntries()->findOrFail($id);
        return view('diary.show', compact('diaryEntry'));
    }

    public function edit(string $id)
    {
        $diaryEntry = Auth::user()->diaryEntries()->with('emotions')->findOrFail($id);
        $emotions = Emotion::all(); // you must have a model called Emotionto fetch all emotions
        return view('diary.edit', compact('diaryEntry', 'emotions'));
    }

    public function update(Request $request, string $id)
    {
        // Validate the request
        $validated = $request->validate([
            'date' => 'required|date',
            'content' => 'required|string',
            'emotions' => 'array', // Validate emotions as an array
            'intensity' => 'array', // Validate intensity as an array
        ]);
        // Find and update the diary entry
        $diaryEntry = Auth::user()->diaryEntries()->findOrFail($id);
        $diaryEntry->update([
            'date' => $validated['date'],
            'content' => $validated['content'],
        ]);
        // Sync emotions and intensities
        if (!empty($validated['emotions'])) {
            $emotions = [];
            foreach ($validated['emotions'] as $emotionId) {
                $intensity = $validated['intensity'][$emotionId] ?? null;
                $emotions[$emotionId] = ['intensity' => $intensity];
            }
            $diaryEntry->emotions()->sync($emotions);
        } else {
            // If no emotions are selected, clear all associated emotions
            $diaryEntry->emotions()->sync([]);
        }
        return redirect()->route('diary.index')->with('status', 'Diary
entry updated successfully!');
    }

    public function destroy(string $id)
    {
        // Retrieve the diary entry by its ID
        $diaryEntry = DiaryEntry::findOrFail($id);
        // Delete the retrieved diary entry
        $diaryEntry->delete();
        // Redirect back to the diary index with a success message
        return redirect()->route('diary.index')->with(
            'status',
            'Diary entry deleted successfully!'
        );
    }

    public function display_diary()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
// Fetch all diary entries for the authenticated user
        $diaryEntries = DB::table('diary_entries')
            ->where('user_id', $userId)
            ->get();
        return view('diary.display_diary', compact('diaryEntries'));
    }

    public function diary_count()
    {
        $userId = Auth::id();
        $diary_count = DB::table('diary_entries')
            ->select('date', DB::raw('count(*) as count'))
            ->where('user_id', $userId)
            ->groupBy('date')
            ->having('count', '>=', 2)
            ->get();
        return response()->json(['diary_count' => $diary_count]);
    }


    // SELECT diary_entries.*
    //         FROM diary_entries
    //         JOIN diary_entry_emotions ON diary_entries.id = diary_entry_emotions.diary_entry_id
    //         WHERE diary_entry_emotions.emotion_id = 2
    //         AND diary_entries.content LIKE '%happy%'
    public function mockup()
    {

        // Raw SQL query to find conflicting ee
        $entries = DB::table('diary_entries')
            ->join('diary_entry_emotions', 'diary_entries.id', '=', 'diary_entry_emotions.diary_entry_id')
            ->join('emotions', 'emotions.id', '=', 'diary_entry_emotions.emotion_id')
            ->where('diary_entry_emotions.emotion_id', 2)
            ->where('diary_entries.content', 'LIKE', '%happy%')
            ->get();

        // return response()->json(['mockup' => $entries]);
        return view('mockup', compact('entries'));

    }

}