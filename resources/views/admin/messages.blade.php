@extends('layouts.admin')

@section('title', 'Inbox')
@section('header_title', 'Inbox')

@section('content')
<div class="messages-layout">
    <!-- Inbox List -->
    <div class="messages-list">
        <div class="messages-search">
            <div class="search-input" style="width: 100%;">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Search leads...">
            </div>
        </div>
        <div class="messages-scroll">
            @forelse($messages as $index => $message)
            <div class="message-snippet {{ $index == 0 ? 'active' : '' }}" onclick="selectMessage({{ $message->id }})">
                <div class="msg-snip-header">
                    <h4>{{ $message->first_name }} {{ $message->last_name }}</h4>
                    <span class="msg-date">{{ $message->created_at->format('M d') }}</span>
                </div>
                <div class="msg-subject">{{ $message->project_type }}</div>
                <div class="msg-preview">{{ Str::limit($message->details, 40) }}</div>
            </div>
            @empty
            <div style="padding: 2rem; text-align: center; color: var(--text-muted);">No messages yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Inbox Detail View -->
    <div class="messages-view">
        <div id="message-detail-placeholder" style="{{ $messages->count() > 0 ? 'display:none;' : 'display:flex;' }} align-items: center; justify-content: center; height: 100%; color: var(--text-muted);">
            <p>Select a message to view details</p>
        </div>

        <div id="message-detail" style="{{ $messages->count() == 0 ? 'display:none;' : '' }}">
            @if($messages->count() > 0)
                @php $current = $messages->first(); @endphp
                <div class="msg-view-header">
                    <div class="msg-view-header-left">
                        <div class="msg-avatar" id="detail-avatar" style="background-color: var(--accent); color: white;">
                            {{ substr($current->first_name, 0, 1) }}{{ substr($current->last_name, 0, 1) }}
                        </div>
                        <div>
                            <h2 id="detail-name">{{ $current->first_name }} {{ $current->last_name }}</h2>
                            <p><span id="detail-type">{{ $current->project_type }}</span> &bull; <span id="detail-email">{{ $current->email }}</span></p>
                        </div>
                    </div>
                    <div class="msg-view-header-right">
                        <button type="button" class="btn-icon-danger" onclick="confirmDelete()" title="Delete Message">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </div>

                <div class="msg-view-content">
                    <p><strong>Lead Details:</strong></p>
                    <p>Project Type: <span id="detail-project-type">{{ $current->project_type }}</span></p>
                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid var(--border);">
                    <p id="detail-content">{{ $current->details ?? 'No additional details provided.' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="delete-message-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
const messages = @json($messages);

function selectMessage(id) {
    const msg = messages.find(m => m.id === id);
    if (!msg) return;

    // Update UI
    document.getElementById('message-detail-placeholder').style.display = 'none';
    document.getElementById('message-detail').style.display = 'block';

    document.getElementById('detail-name').textContent = `${msg.first_name} ${msg.last_name}`;
    document.getElementById('detail-avatar').textContent = `${msg.first_name[0]}${msg.last_name[0]}`;
    document.getElementById('detail-type').textContent = msg.project_type;
    document.getElementById('detail-email').textContent = msg.email;

    document.getElementById('detail-project-type').textContent = msg.project_type;
    document.getElementById('detail-content').textContent = msg.details || 'No additional details provided.';
    
    // Update delete form action
    const deleteForm = document.getElementById('delete-message-form');
    deleteForm.action = `/admin/messages/${msg.id}`;

    // Manage active state in list
    document.querySelectorAll('.message-snippet').forEach(el => {
        el.classList.remove('active');
        if (el.getAttribute('onclick').includes(id)) {
            el.classList.add('active');
        }
    });
}

function confirmDelete() {
    if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
        document.getElementById('delete-message-form').submit();
    }
}
</script>
@endsection
