<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
   
    public function __construct() {

        $this->middleware('auth', ['only' => ['create', 'store', 'supprimer']]);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = "";
        $events = Event::whereDate('starts_at', '>=', now()->tz('America/Martinique'))
        ->with(['user', 'tags'])
        ->orderBy('starts_at', 'asc')
        ->get();

        return view ('events.index', compact('events','user'));

    }


    // Evenement en cours
    public function indexCours()
    {
        $user = "";
        $events = Event::whereDate('starts_at', '<=', now())
        ->whereDate('ends_at', '>=', now())
        ->with(['user', 'tags'])
        ->orderBy('starts_at', 'asc')
        ->get();
     
        return view ('events.index', compact('events','user'));

    }

     // Evenement en cours de l'utilisateur
     public function user_indexCours(User $user)
     {
        $events = $user->events;
         $events = $events->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->sortBy('starts_at');
      
         return view ('events.index', compact(['events', 'user']));
 
     }



    //Evenement terminé
    public function indexTermine()
    {
        $user = "";
        $events = Event::whereDate('ends_at', '<', now())
        ->with(['user', 'tags'])
        ->orderBy('starts_at', 'asc')
        ->get();
        
        return view ('events.index', compact('events','user'));

    }

    //Evenement terminé de l'utilisateur
    public function user_indexTermine(User $user)
    {
        $events = $user->events;
        $events = $events->where('ends_at', '<', now())
        ->sortBy('starts_at');
        
        return view ('events.index', compact('events','user'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authed_user = auth()->user();
        $amount = 1000;

        if($request->filled('premium')) $amount += 500;


        if (!empty($request->payment_method)) {

     
            $authed_user->charge($amount, 
            $request->payment_method);


            $event = $authed_user->events()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'premium' => $request->filled('premium'),
                'starts_at' => $request->starts_at . '20:00:00',
                'ends_at' => $request->ends_at . '20:00:00',
            ]);

            $tags = explode(',', $request->tags);

            foreach ($tags as $inputTag) {
                $inputTag = trim($inputTag);

                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug($inputTag)],
                    [
                    'name' => $inputTag
                ]);

                $event->tags()->attach($tag->id);

            }
        }

        return redirect()->route('event.index');
    }


    // List des evenements de l'utilisateur
    public function user_events(User $user) {
        
        $events = $user->events;
        $events = $events->where('starts_at', '>=', now())
        ->SortBy('starts_at');

        return view('events.index', compact('events', 'user'));

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {

    }


    public function supprimer(Event $event)
    {

        // dd($event);
        $event->delete();
    
        return back();
    }

}
