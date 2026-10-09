@extends('layouts.admin')

@section('title', 'Portfolio Manager')
@section('header_title', 'Portfolio Manager')

@section('header_actions')
<button class="btn-primary" id="openModalBtn">
    <span class="material-symbols-outlined">add</span> New Project
</button>
@endsection

@section('content')
<div class="table-container">
    <div class="table-header">
        <h2>Active Portfolios</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Category</th>
                <th>Client</th>
                <th>Year</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>
                    <strong>{{ $project->title }}</strong>
                </td>
                <td><span class="badge {{ strtolower(str_replace(' ', '-', $project->category)) }}">{{ $project->category }}</span></td>
                <td>{{ $project->client ?? 'N/A' }}</td>
                <td>{{ $project->year }}</td>
                <td><span class="status live"><span class="dot"></span> Live</span></td>
                <td>
                    <button class="action-btn" 
                            onclick="editProject({{ json_encode($project) }})"
                            aria-label="Edit">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    
                    <form action="{{ route('admin.portfolio.delete', $project->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project?')">
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
<!-- ─── Project Modal ─── -->
<div id="projectModal" class="modal-overlay">
    <div class="modal-container" style="max-width: 680px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h2 id="modalTitle">Add New Project</h2>
            <button class="close-btn" id="closeModalBtn" type="button">&times;</button>
        </div>
        <form id="projectForm" action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>

            {{-- Image Upload Zone --}}
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Project Cover Image</label>
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
                        <option value="Brand & Web">Brand &amp; Web</option>
                        <option value="Enterprise Cloud">Enterprise Cloud</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Year</label>
                    <input type="number" name="year" id="projYear" value="{{ date('Y') }}" min="2000" max="2100" required>
                </div>

                <div class="form-group">
                    <label>Client</label>
                    <input type="text" name="client" id="projClient" placeholder="e.g. Puls Technologies Inc.">
                </div>

                <div class="form-group">
                    <label>Technologies &amp; Services</label>
                    <input type="text" name="technologies" id="projTechnologies" placeholder="e.g. Flutter, Firebase, Node.js">
                </div>
            </div>

            <div class="form-group" style="margin-top: 16px;">
                <label>Brief Description</label>
                <textarea name="description" id="projDescription" rows="2" placeholder="Brief project summary..." required></textarea>
            </div>

            {{-- Detailed Case Study Fields --}}
            <div style="margin-top: 20px; padding-top: 16px; border-t: 1px solid var(--border-color, rgba(255,255,255,0.1));">
                <h4 style="font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--accent-color, #ec5b13); margin-bottom: 12px;">Case Study Breakdown</h4>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label>01. Problem / Challenge</label>
                    <textarea name="problem" id="projProblem" rows="2" placeholder="What challenge did the client face?"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label>02. Solution / Approach</label>
                    <textarea name="solution" id="projSolution" rows="2" placeholder="What solution did Xynera engineer?"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label>03. Result / Measurable Outcome</label>
                    <textarea name="result" id="projResult" rows="2" placeholder="What results or metrics were achieved?"></textarea>
                </div>
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

    const projTitle        = document.getElementById('projTitle');
    const projCategory     = document.getElementById('projCategory');
    const projYear         = document.getElementById('projYear');
    const projClient       = document.getElementById('projClient');
    const projTechnologies = document.getElementById('projTechnologies');
    const projDescription  = document.getElementById('projDescription');
    const projProblem      = document.getElementById('projProblem');
    const projSolution     = document.getElementById('projSolution');
    const projResult       = document.getElementById('projResult');

    const imagePreview     = document.getElementById('imagePreview');
    const uploadLabel      = document.getElementById('uploadLabel');

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

    function openModal() {
        projectModal.classList.add('active');
        setTimeout(() => projTitle.focus(), 150);
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

        projTitle.value        = project.title || '';
        projCategory.value     = project.category || '';
        projYear.value         = project.year || {{ date('Y') }};
        projClient.value       = project.client || '';
        projTechnologies.value = project.technologies || '';
        projDescription.value  = project.description || '';
        projProblem.value      = project.problem || '';
        projSolution.value     = project.solution || '';
        projResult.value       = project.result || '';

        if (project.image_path) {
            imagePreview.src = `/storage/${project.image_path}`;
            imagePreview.style.display = 'block';
            if (uploadLabel) uploadLabel.textContent = 'Current image shown above';
        }

        openModal();
    }

    document.getElementById('openModalBtn').addEventListener('click', () => {
        modalTitle.textContent = 'Add New Project';
        saveBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save Project';
        projectForm.action = "{{ route('admin.portfolio.store') }}";
        methodField.innerHTML = '';
        projectForm.reset();
        closeModal();
        projectModal.classList.add('active');
        setTimeout(() => projTitle.focus(), 150);
    });

    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('cancelModalBtn').addEventListener('click', closeModal);

    projectModal.addEventListener('click', e => {
        if (e.target === projectModal) closeModal();
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && projectModal.classList.contains('active')) closeModal();
    });
</script>
@endpush
