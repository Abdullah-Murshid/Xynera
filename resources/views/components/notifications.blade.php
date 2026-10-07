@if(session('notify'))
    <div id="notification-toast" 
         class="fixed top-24 right-8 z-[9999] transform transition-all duration-500 ease-out translate-x-full"
         style="min-width: 320px;">
        <div class="flex items-center p-4 rounded-xl shadow-2xl backdrop-blur-xl border border-white/10 {{ session('notify')['type'] === 'success' ? 'bg-emerald-500/10' : (session('notify')['type'] === 'error' ? 'bg-red-500/10' : 'bg-blue-500/10') }}">
            
            <div class="flex-shrink-0 mr-3">
                @if(session('notify')['type'] === 'success')
                    <span class="material-symbols-outlined text-emerald-400">check_circle</span>
                @elseif(session('notify')['type'] === 'error')
                    <span class="material-symbols-outlined text-red-400">error</span>
                @else
                    <span class="material-symbols-outlined text-blue-400">info</span>
                @endif
            </div>

            <div class="flex-1 mr-4">
                <p class="text-sm font-medium text-white">
                    {{ session('notify')['message'] }}
                </p>
            </div>

            <button onclick="dismissNotification()" class="flex-shrink-0 text-white/40 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        
        <!-- Progress Bar -->
        <div class="absolute bottom-0 left-0 h-0.5 rounded-full {{ session('notify')['type'] === 'success' ? 'bg-emerald-500' : (session('notify')['type'] === 'error' ? 'bg-red-500' : 'bg-blue-500') }} transition-all duration-[3000ms] ease-linear w-full" id="notify-progress"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('notification-toast');
            const progress = document.getElementById('notify-progress');
            
            // Show
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);

            // Progress bar animation
            setTimeout(() => {
                progress.style.width = '0%';
            }, 100);

            // Hide after 3s
            setTimeout(() => {
                dismissNotification();
            }, 4000);
        });

        function dismissNotification() {
            const toast = document.getElementById('notification-toast');
            if (toast) {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }
        }
    </script>
@endif
