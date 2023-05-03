<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function list()
    {
        $events = array();
        $bookings = Event::all();
        foreach($bookings as $booking) {

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
            ];
        }
        return view('pages.calendar', ['events' => $events]);
    }
    public function index()
    {
        $events = array();
        $bookings = Event::all();
        foreach($bookings as $booking) {
            // $color = null;
            // if($booking->title == 'Test') {
            //     $color = '#924ACE';
            // }
            // if($booking->title == 'Test 1') {
            //     $color = '#68B01A';
            // }

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                // 'color' => $color
            ];
        }
        return view('admin.calendar.index', ['events' => $events]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = Event::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $color = null;

        // if($booking->title == 'Test') {
        //     $color = '#924ACE';
        // }

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $color ? $color: '',

        ]);
    }
    public function edit(Request $request ,$id)
    {
        // dd($request->all());
        $booking = Event::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'title' => $request->title,
            // 'start_date' => $request->start_date,
            // 'end_date' => $request->end_date,
        ]);
        return response()->json('Event edit');
    }
    public function update(Request $request ,$id)
    {
        $booking = Event::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroy($id)
    {
        $booking = Event::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
