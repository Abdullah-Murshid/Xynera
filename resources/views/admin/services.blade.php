@extends('layouts.admin')

@section('title', 'Services Manager')
@section('header_title', 'Services Manager')

@section('header_actions')
<button class="btn-primary" id="openServiceModalBtn">
    <span class="material-symbols-outlined">add</span> Add Service
</button>
@endsection

@section('content')
<div class="service-grid">
    @foreach($services as $service)
    <div class="service-card">
        <div class="service-header">
            <div class="service-icon"><span class="material-symbols-outlined">{{ $service->icon }}</span></div>
            <span class="status live"><span class="dot"></span> Active</span>
        </div>
        <div class="service-body">
            <h3>{{ $service->title }}</h3>
            <p>{{ $service->description }}</p>
            <div style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-muted);">
                <strong>Tags:</strong> {{ $service->tags ?? 'N/A' }} | <strong>#{{ $service->number }}</strong>
            </div>
        </div>
        <div class="service-footer">
            <button class="action-btn" 
                    onclick="editService({{ json_encode($service) }})"
                    aria-label="Edit">
                <span class="material-symbols-outlined">edit</span>
            </button>
            
            <form action="{{ route('admin.services.delete', $service->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this service?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" aria-label="Delete">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<style>
/* Service-specific grid that might not be in template's admin.css or needs tweak */
.service-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}
.service-card {
    background: var(--surface);
    border: 1px solid var(--stroke);
    border-radius: 1rem;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.service-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.service-icon {
    width: 42px;
    height: 42px;
    background: rgba(100, 255, 218, 0.1);
    color: var(--primary);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.service-body h3 {
    margin: 0 0 0.5rem;
    font-size: 1.15rem;
}
.service-body p {
    color: var(--text-muted);
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}
.service-footer {
    padding-top: 1rem;
    border-top: 1px solid var(--stroke);
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
}
</style>
@endsection

@section('modals')
<!-- ─── Service Modal ─── -->
<div id="serviceModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h2 id="serviceModalTitle">Add New Service</h2>
            <button class="close-btn" id="closeServiceModalBtn" type="button">&times;</button>
        </div>
        <form id="serviceForm" action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            <div id="serviceMethodField"></div>
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Service Title</label>
                    <input type="text" name="title" id="servTitle" placeholder="e.g. Web Development" required>
                </div>
                <div class="form-group">
                    <label>Service Number</label>
                    <input type="text" name="number" id="servNumber" placeholder="e.g. 01" required>
                </div>
                <div class="form-group">
                    <label>Icon (Material Symbol)</label>
                    <input type="text" name="icon" id="servIcon" placeholder="e.g. terminal" required>
                </div>
                <div class="form-group full-width">
                    <label>Tags (Comma separated)</label>
                    <input type="text" name="tags" id="servTags" placeholder="e.g. PHP, Laravel, Vue">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 1rem;">
                <label>Description</label>
                <textarea name="description" id="servDescription" rows="3" placeholder="Brief service summary..." required></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="cancelServiceModalBtn">Cancel</button>
                <button type="submit" class="btn-primary" id="saveServiceBtn">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const serviceModal = document.getElementById('serviceModal');
    const serviceForm  = document.getElementById('serviceForm');
    const serviceModalTitle = document.getElementById('serviceModalTitle');
    const serviceMethodField = document.getElementById('serviceMethodField');
    const saveServiceBtn = document.getElementById('saveServiceBtn');

    function closeModal() {
        serviceModal.classList.remove('active');
    }

    function editService(service) {
        serviceModalTitle.textContent = 'Edit Service';
        saveServiceBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Update Service';
        serviceForm.action = `/admin/services/${service.id}`;
        serviceMethodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        document.getElementById('servTitle').value       = service.title;
        document.getElementById('servNumber').value      = service.number;
        document.getElementById('servIcon').value        = service.icon;
        document.getElementById('servTags').value        = service.tags || '';
        document.getElementById('servDescription').value = service.description;

        serviceModal.classList.add('active');
    }

    document.getElementById('openServiceModalBtn').addEventListener('click', () => {
        serviceModalTitle.textContent = 'Add New Service';
        saveServiceBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save Service';
        serviceForm.action = "{{ route('admin.services.store') }}";
        serviceMethodField.innerHTML = '';
        serviceForm.reset();
        serviceModal.classList.add('active');
    });

    document.getElementById('closeServiceModalBtn').addEventListener('click', closeModal);
    document.getElementById('cancelServiceModalBtn').addEventListener('click', closeModal);
    serviceModal.addEventListener('click', e => { if (e.target === serviceModal) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endpush
