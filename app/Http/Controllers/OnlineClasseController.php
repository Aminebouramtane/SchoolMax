<?php

namespace App\Http\Controllers;

use App\Models\Online_classe;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\Section;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Http\Request;

class OnlineClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes = online_classe::all();
        $grades = Grade::all();
        $User = auth()->user()->name;
        return view('pages.online_classes.index', compact('online_classes','grades','User'));
    }

    public function createMeeting($request)
    {

        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone')
          // 'timezone' => 'Africa/Cairo'
        ];
        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);

        return  $user->meetings()->save($meeting);

    }

    public function store(Request $request)
    {
        try {
            online_classe::create([
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Online_classe $online_classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Online_classe $online_classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $meeting = Zoom::meeting()->find($id);
            $meeting->delete();
            Online_classe::where('meeting_id', $id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
        //Get Sections
        public function ssections($id){
            $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
            return $list_sections;
        }
        public function ssectionsar($id){
            $list_sections = Section::where("classe_id", $id)->pluck("section_name_ar", "id");
            return $list_sections;
        }

}
