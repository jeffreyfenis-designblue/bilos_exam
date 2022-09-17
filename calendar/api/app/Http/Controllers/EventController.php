<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
  /**
   * Showing all the events in the calendar
   *
   * @return void
   */
  public function index(Request $request)
  {
    $datetime = Carbon::create($request->year, $request->month, 1, 0, 0, 0, 'Asia/Manila');
    $request->merge([
      'first_of_month' => $datetime->firstOfMonth(),
      'last_of_month' => $datetime->lastOfMonth()
    ]);
    $events = Event::select('*')
      ->where('event_from', '>=', $request->first_of_month)
      ->where('event_to', '<=', $request->last_of_month)
      ->get();
    return response()->json([
      'response' => [
        'params' => $request->all(),
        'return' => $events
      ]
    ]);
  }

  /**
   * Showing single event in the calendar
   *
   * @param [type] $id
   * @return void
   */
  public function show($id)
  {
    $event = Event::find($id);
    return response()->json([
      'response' => [
        'params' => $id,
        'return' => $event
      ]
    ]);
  }

  /**
   * Creating a new event in the calendar
   *
   * @param Request $request
   * @return void
   */
  public function store(Request $request)
  {
    $event = Event::create($request->all());
    return response()->json([
      'response' => [
        'params' => $request->all(),
        'return' => $event
      ]
    ]);
  }

  /**
   * Updating existing event in the calendar
   *
   * @param Request $request
   * @param [type] $id
   * @return void
   */
  public function update(Request $request, $id)
  {
    $request->merge(['id' => $id]);
    $event = Event::findOrFail($id);
    $event->update($request->all());
    return response()->json([
      'response' => [
        'params' => $request->all(),
        'return' => $event
      ]
    ]);
  }

  /**
   * Deleting an event in the calendar
   *
   * @param [type] $id
   * @return void
   */
  public function destroy($id)
  {
    $event = Event::find($id)->delete();
    return response()->json([
      'response' => [
        'params' => $id,
        'return' => $event
      ]
    ], 204);
  }
}
