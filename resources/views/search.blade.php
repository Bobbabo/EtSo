@extends('layouts.app')
@section('content')

@if($users->isNotEmpty())
    @foreach ($users as $user)
    <div style="display: flex; align-items:center; padding: 8px">
        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" 
            style="max-width: 40px; margin-right:16px">
        <div class="font-weight-bold">
            <a href="/profile/{{ $user->id }}">
                <span class="text-dark">{{ $user->username }}</span>
                <span class="text-dark">{{ $user->name }}</span>
            </a>
        </div>

        <follow-button user-id="{{ $user->id }}" 
            follows="{{ (auth()->user()) ? auth()->user()->following->contains($user->id) : false }}">
        </follow-button>
    </div>

    @endforeach
@else 
    <div>
        <h2>No users found</h2>
    </div>
@endif

@endsection