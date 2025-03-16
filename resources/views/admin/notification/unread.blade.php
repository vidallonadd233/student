@extends('layouts.app')

@section('title', 'Unread Notifications')

@section('content')
<div class="container">
    <h1 class="fw-normal justify-content fs-3">Unread Notifications</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($unreadNotifications->isEmpty())
        <p>You have no unread notifications.</p>
    @else
        <ul class="list-group">
            @foreach($unreadNotifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $notification->data['message'] }} <!-- Customize this based on your notification structure -->
                    <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary">Mark as read</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

<!-- Notifications Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">Unread Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($unreadNotifications->isEmpty())
                    <p>You have no unread notifications.</p>
                @else
                    <ul class="list-group">
                        @foreach($unreadNotifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $notification->data['message'] }} <!-- Customize this based on your notification structure -->
                                <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary">Mark as read</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
