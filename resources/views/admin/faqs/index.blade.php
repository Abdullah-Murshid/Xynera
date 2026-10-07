@extends('layouts.admin')

@section('title', 'FAQ Manager')
@section('header_title', 'FAQ Manager')

@section('header_actions')
<button class="btn-primary" id="openFaqModalBtn">
    <span class="material-symbols-outlined">add</span> Add FAQ
</button>
@endsection

@section('content')
<div class="service-grid">
    @foreach($faqs as $faq)
    <div class="service-card">
        <div class="service-header">
            <div class="service-icon" style="border-radius: 50%;"><span class="material-symbols-outlined">help</span></div>
            <span class="status {{ $faq->is_published ? 'live' : '' }}"><span class="dot"></span> {{ $faq->is_published ? 'Published' : 'Draft' }}</span>
        </div>
        <div class="service-body">
            <h3 style="font-size: 1rem;">{{ $faq->question }}</h3>
            <p style="font-size: 0.85rem; max-height: 80px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ $faq->answer }}</p>
            <div style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-muted);">
                <strong>Order:</strong> {{ $faq->order }}
            </div>
        </div>
        <div class="service-footer">
            <button class="action-btn" 
                    onclick="editFaq({{ json_encode($faq) }})"
                    aria-label="Edit">
                <span class="material-symbols-outlined">edit</span>
            </button>
            
            <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
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
<!-- ─── FAQ Modal ─── -->
<div id="faqModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h2 id="faqModalTitle">Add New FAQ</h2>
            <button class="close-btn" id="closeFaqModalBtn" type="button">&times;</button>
        </div>
        <form id="faqForm" action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div id="faqMethodField"></div>
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Question</label>
                    <input type="text" name="question" id="faqQuestion" placeholder="e.g. How long does a project take?" required>
                </div>
                <div class="form-group" style="margin-top: 1rem;">
                    <label>Display Order</label>
                    <input type="number" name="order" id="faqOrder" value="0" required>
                </div>
                <div class="form-group" style="margin-top: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_published" id="faqIsPublished" value="1" checked style="width: auto; margin: 0;">
                    <label for="faqIsPublished" style="margin: 0;">Is Published?</label>
                </div>
            </div>
            
            <div class="form-group full-width" style="margin-top: 1rem;">
                <label>Answer</label>
                <textarea name="answer" id="faqAnswer" rows="5" placeholder="Provide a clear, detailed answer..." required></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="cancelFaqModalBtn">Cancel</button>
                <button type="submit" class="btn-primary" id="saveFaqBtn">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const faqModal = document.getElementById('faqModal');
    const faqForm  = document.getElementById('faqForm');
    const faqModalTitle = document.getElementById('faqModalTitle');
    const faqMethodField = document.getElementById('faqMethodField');
    const saveFaqBtn = document.getElementById('saveFaqBtn');

    function closeModal() {
        faqModal.classList.remove('active');
    }

    function editFaq(faq) {
        faqModalTitle.textContent = 'Edit FAQ';
        saveFaqBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Update FAQ';
        faqForm.action = `/admin/faqs/${faq.id}`;
        faqMethodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        document.getElementById('faqQuestion').value = faq.question;
        document.getElementById('faqAnswer').value = faq.answer;
        document.getElementById('faqOrder').value = faq.order;
        document.getElementById('faqIsPublished').checked = faq.is_published == 1;

        faqModal.classList.add('active');
    }

    document.getElementById('openFaqModalBtn').addEventListener('click', () => {
        faqModalTitle.textContent = 'Add New FAQ';
        saveFaqBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:1rem;">save</span> Save FAQ';
        faqForm.action = "{{ route('admin.faqs.store') }}";
        faqMethodField.innerHTML = '';
        faqForm.reset();
        document.getElementById('faqIsPublished').checked = true;
        faqModal.classList.add('active');
    });

    document.getElementById('closeFaqModalBtn').addEventListener('click', closeModal);
    document.getElementById('cancelFaqModalBtn').addEventListener('click', closeModal);
    faqModal.addEventListener('click', e => { if (e.target === faqModal) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endpush
