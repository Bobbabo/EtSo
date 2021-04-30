<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Message;
use App\Events\NewMessage; 
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = $user->posts->count();

        $followersCount = $user->profile->followers->count();
       

        $followingCount = $user->following->count();
            

        $posts = Post::where('user_id', $user->id)->with('user')->where('post_id','=',0)->latest()->paginate(5);

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount','posts'));
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }


    // Chat logic


    public function getContacts(){

        //Gets all users that follow the authenticated user

        $contacts = auth()->user()->profile->followers;
        
        //User::where('id',auth()->user()->profile->followers)->get();

        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from') //[["sender_id" => 4, "messages_count" => 15]]
            ->get();


        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact ->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });
        return response()->json($contacts);
    }

    public function getConversation($id){

        // Mark as read
        Message::where('from', $id)->where('to',auth()->id())->update(['read' => true]);

        $messages = Message::where(function($q) use ($id){
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id){
            $q->where('from', $id);
            $q->where('to',auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function send(Request $request){
        $message=Message::create([
            'from' =>  auth()->user()->id,
            'to' => $request->contact_id,
            'message' => $request->text
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
