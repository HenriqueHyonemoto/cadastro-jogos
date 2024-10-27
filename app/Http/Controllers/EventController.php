<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
//use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    public function index(){

        $search = request('search');
        if($search){
            $events = Event::where([
                ['title','like','%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }

        
        return view('welcome',['events'=>$events, 'search'=>$search]);

    }
    
    public function create(){
        return view('events.create');
    }
    public function store(Request $request){
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->genero = $request->genero;
        $event->plataforma = $request->plataforma;
        $event->description = $request->description;
        $event->preco = $request->preco;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg',$event->title.' Enviado com Sucesso!');

    }

    public function show($id){
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id']==$id){
                    $hasUserJoined = true;
                }
            }

        }

        $eventOwner = User::where('id',$event->user_id)->first()->toArray();


        return view('events.show',['event'=>$event, 'eventOwner' => $eventOwner,'hasUserJoined'=>$hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view ('events.dashboard',['events'=>$events, 'eventsasparticipant'=>$eventsAsParticipant]);
    }

    public function library(){
        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view ('events.library',['events'=>$events, 'eventsasparticipant'=>$eventsAsParticipant]);
    }

    public function destroy($id){
        $event = Event::findOrFail($id); 
        $event->delete(); 
    
        return redirect('/dashboard')->with('msg', $event->title . ' Excluído com sucesso!');
    }

    public function edit($id){
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user->id){
            return redirect('/dashboard');
        }

        return view('events.edit',['event'=>$event]);
        
    }
    
    public function update(Request $request){
        //certo
        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }
    
        $event = Event::findOrFail($request->id); 
    
        $event->update($data); 
    
        return redirect('/dashboard')->with('msg', $event->title . ' Editado com sucesso!');
    }

    public function joinEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);
        return redirect('/library')->with('msg',$event->title .' foi adicionado a sua Biblioteca!');
    }

    public function leaveEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/library')->with('msg',$event->title . ' foi removido da sua Biblioteca!');
    }

}
