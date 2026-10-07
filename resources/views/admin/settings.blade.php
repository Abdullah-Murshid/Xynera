@extends('layouts.admin')

@section('title', 'Configuration')
@section('header_title', 'Configuration')

@section('content')
<div class="settings-layout">
    <div class="settings-nav">
        <a href="#" class="set-nav-item active"><span class="material-symbols-outlined">person</span> Profile</a>
        <a href="#" class="set-nav-item"><span class="material-symbols-outlined">security</span> Security</a>
        <a href="#" class="set-nav-item"><span class="material-symbols-outlined">notifications</span> Notifications</a>
        <a href="#" class="set-nav-item"><span class="material-symbols-outlined">api</span> API Settings</a>
    </div>

    <div class="settings-content">
        <h2 class="settings-section-title">Admin Profile</h2>
        <div class="settings-form">
            <div class="avatar-upload">
                <div class="avatar-preview">AU</div>
                <button class="btn-secondary">Change Avatar</button>
            </div>
            
            <div class="form-group">
                <label>Admin Name</label>
                <input type="text" value="{{ auth()->user()->name }}" placeholder="e.g. Admin User">
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="{{ auth()->user()->email }}" placeholder="admin@xynera.com">
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                <button class="btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
