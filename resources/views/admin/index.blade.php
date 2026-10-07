@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Overview')

@section('header_actions')
<button class="btn-primary" id="openModalBtn">
    <span class="material-symbols-outlined">add</span> New Project
</button>
@endsection

@section('content')
<!-- ── KPI Stats Row ── -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            Active Projects
            <span class="trend up"><span class="material-symbols-outlined" style="font-size: 1rem;">trending_up</span></span>
        </div>
        <div class="stat-value">{{ $stats['projects'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            Conversion Rate
            <span class="trend up"><span class="material-symbols-outlined" style="font-size: 1rem;">trending_up</span></span>
        </div>
        <div class="stat-value">{{ $stats['conversion'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            Active Services
            <span class="trend up"><span class="material-symbols-outlined" style="font-size: 1rem;">trending_up</span></span>
        </div>
        <div class="stat-value">{{ $stats['services'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            Inquiry Count
            <span class="trend {{ $stats['messages'] > 0 ? 'up' : 'down' }}">
                <span class="material-symbols-outlined" style="font-size: 1rem;">
                    {{ $stats['messages'] > 0 ? 'trending_up' : 'trending_down' }}
                </span>
            </span>
        </div>
        <div class="stat-value">{{ $stats['messages'] }}</div>
    </div>
</div>

<!-- ── Project Table ── -->
<div class="table-container">
    <div class="table-header">
        <h2>Recent Portfolios</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentProjects as $project)
            <tr>
                <td>
                    <strong>{{ $project->title }}</strong>
                </td>
                <td><span class="badge {{ strtolower(str_replace(' ', '-', $project->category)) }}">{{ $project->category }}</span></td>
                <td><span class="status live"><span class="dot"></span> Live</span></td>
                <td>
                    <button class="action-btn" onclick="editProject({{ json_encode($project) }})" aria-label="Edit">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <form action="{{ route('admin.portfolio.delete', $project->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" aria-label="Delete">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('modals')
<!-- ══ PROJECT MODAL ══ -->
<div id="projectModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h2 id="modalTitle">Add New Project</h2>
            <button class="close-btn" id="closeModalBtn" type="button">&times;</button>
        </div>
        <form id="projectForm" action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Project Image</label>
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="image" id="projImage" accept="image/*" onchange="previewImage(this)">
                    <span class="material-symbols-outlined">cloud_upload</span>
                    <span class="label" id="uploadLabel">Click or drag to upload image</span>
                    <p>PNG, JPG, WEBP — Max 5MB</p>
                </div>
                <img id="imagePreview" src="" alt="Preview" style="display:none; width:100%; max-height:180px; object-fit:cover; border-radius:8px; margin-top:10px;">
            </div>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Project Title</label>
                    <input type="text" name="title" id="projTitle" placeholder="e.g. Orbit Dashboard" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" id="projCategory" required>
                        <option value="">Select category...</option>
                        <option value="Web Application">Web Application</option>
                        <option value="Mobile App">Mobile App</option>
                        <option value="Branding">Branding</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="E-Commerce">E-Commerce</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input type="number" name="year" id="projYear" value="{{ date('Y') }}" min="2000" max="2100" required>
                </div>
            </div>

            <div class="form-group" style="margin-top: 16px;">
                <label>Description</label>
                <textarea name="description" id="projDescription" rows="3" placeholder="Brief project summary..." required></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="cancelModalBtn">Cancel</button>
                <button type="submit" class="btn-primary" id="saveBtn">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const projectModal = document.getElementById('projectModal');
    const projectForm  = document.getElementById('projectForm');
    const modalTitle   = document.getElementById('modalTitle');
    const methodField  = document.getElementById('methodField');
    const saveBtn      = document.getElementById('saveBtn');
    const imagePreview = document.getElementById('imagePreview');
    const uploadLabel  = document.getElementById('uploadLabel');

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                uploadLabel.textContent = input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function closeModal() {
        projectModal.classList.remove('active');
        imagePreview.style.display = 'none';
        imagePreview.src = '';
        if (uploadLabel) uploadLabel.textContent = 'Click or drag to upload image';
    }

    function editProject(project) {
        modalTitle.textContent = 'Edit Project';
        saveBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Update Project';
        projectForm.action = `/admin/portfolio/${project.id}`;
        methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('projTitle').value       = project.title;
        document.getElementById('projCategory').value    = project.category;
        document.getElementById('projYear').value        = project.year;
        document.getElementById('projDescription').value = project.description;

        if (project.image_path) {
            imagePreview.src = `/storage/${project.image_path}`;
            imagePreview.style.display = 'block';
            if (uploadLabel) uploadLabel.textContent = 'Current image shown above';
        }

        projectModal.classList.add('active');
    }

    document.getElementById('openModalBtn').addEventListener('click', () => {
        modalTitle.textContent = 'Add New Project';
        saveBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save Project';
        projectForm.action = "{{ route('admin.portfolio.store') }}";
        methodField.innerHTML = '';
        projectForm.reset();
        closeModal();
        projectModal.classList.add('active');
    });

    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('cancelModalBtn').addEventListener('click', closeModal);
    projectModal.addEventListener('click', e => { if (e.target === projectModal) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && projectModal.classList.contains('active')) closeModal(); });
</script>
@endpush
