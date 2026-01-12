<div wire:ignore>
    {{-- Header Bar --}}
    <div class="min-h-screen flex flex-col -m-6 lg:-m-10">
        <div class="bg-white shadow-md px-4 py-3 flex items-center justify-between border-b border-gray-200">
            <a href="{{ route('tutor.kelas.detail', $jadwal) }}" 
               class="flex items-center text-gray-600 hover:text-teal-600 transition font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            
            <h1 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Papan Tulis Digital
                @if($sessionActive)
                    <span class="ml-3 px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Sesi Aktif: {{ $sessionCode }}
                    </span>
                @endif
            </h1>
            
            <div class="flex items-center gap-3">
                @if(!$sessionActive)
                    <button wire:click="startSession"
                            class="flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg shadow-md transition">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Mulai Sesi Kolaborasi
                    </button>
                @else
                    <button wire:click="endSession"
                            class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-md transition">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Akhiri Sesi
                    </button>
                @endif
                
                <button onclick="whiteboardApp.saveImage()" 
                        class="flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Sebagai Materi
                </button>
            </div>
        </div>
        
        {{-- Toolbar --}}
        <div class="bg-gradient-to-r from-gray-100 to-gray-50 px-4 py-3 flex flex-wrap items-center justify-center gap-4 border-b border-gray-200 shadow-sm">
            {{-- Color Picker --}}
            <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                <span class="text-sm font-semibold text-gray-600 mr-2">Warna:</span>
                <button onclick="whiteboardApp.setColor('#e53e3e')" id="color-red"
                        class="w-8 h-8 bg-red-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"
                        title="Merah"></button>
                <button onclick="whiteboardApp.setColor('#3182ce')" id="color-blue"
                        class="w-8 h-8 bg-blue-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"
                        title="Biru"></button>
                <button onclick="whiteboardApp.setColor('#1a202c')" id="color-black"
                        class="w-8 h-8 bg-gray-800 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white ring-2 ring-offset-2 ring-gray-800"
                        title="Hitam"></button>
                <button onclick="whiteboardApp.setColor('#38a169')" id="color-green"
                        class="w-8 h-8 bg-green-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"
                        title="Hijau"></button>
            </div>
            
            {{-- Brush Size --}}
            <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                <span class="text-sm font-semibold text-gray-600 mr-2">Ukuran:</span>
                <button onclick="whiteboardApp.setBrushWidth(3)" id="size-thin"
                        class="px-3 py-1.5 rounded-lg border font-bold text-sm transition border-gray-300 text-gray-600 hover:bg-gray-100">Tipis</button>
                <button onclick="whiteboardApp.setBrushWidth(8)" id="size-medium"
                        class="px-3 py-1.5 rounded-lg border font-bold text-sm transition bg-teal-100 border-teal-500 text-teal-700">Sedang</button>
                <button onclick="whiteboardApp.setBrushWidth(15)" id="size-thick"
                        class="px-3 py-1.5 rounded-lg border font-bold text-sm transition border-gray-300 text-gray-600 hover:bg-gray-100">Tebal</button>
            </div>
            
            {{-- Mode Toggle --}}
            <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                <span class="text-sm font-semibold text-gray-600 mr-2">Mode:</span>
                <button onclick="whiteboardApp.setMode('draw')" id="mode-draw"
                        class="flex items-center px-3 py-1.5 rounded-lg font-bold text-sm transition bg-teal-500 text-white shadow-md">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Gambar
                </button>
                <button onclick="whiteboardApp.setMode('erase')" id="mode-erase"
                        class="flex items-center px-3 py-1.5 rounded-lg font-bold text-sm transition bg-gray-100 text-gray-600 hover:bg-gray-200">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Hapus
                </button>
            </div>
            
            {{-- Clear Button --}}
            <button onclick="whiteboardApp.clearCanvas()" 
                    class="flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl shadow-md transition transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Bersihkan Layar
            </button>
            
            {{-- Participants indicator --}}
            @if($sessionActive)
                <div id="participants-list" class="flex items-center gap-2 bg-purple-100 rounded-xl px-4 py-2 shadow-sm border border-purple-200">
                    <span class="text-sm font-semibold text-purple-700">
                        <span id="participant-count">1</span> Peserta
                    </span>
                </div>
            @endif
        </div>
        
        {{-- Canvas Area --}}
        <div class="flex-1 bg-gray-200 p-4 flex items-center justify-center overflow-auto">
            <div class="bg-white rounded-lg shadow-2xl border-4 border-gray-300 overflow-hidden">
                <canvas id="whiteboard-canvas" width="1200" height="700" class="block"></canvas>
            </div>
        </div>
        
        {{-- Info Footer --}}
        <div class="bg-gray-100 px-4 py-2 text-center text-sm text-gray-500 border-t border-gray-200">
            <span class="font-medium">{{ $jadwal->mapel->nama_mapel }}</span> - 
            <span>{{ $jadwal->kelas->nama_kelas }}</span> |
            <span class="text-teal-600 font-medium">Gunakan mouse/stylus untuk menggambar</span>
            @if($sessionActive)
                | <span class="text-purple-600 font-bold">Kode Sesi: {{ $sessionCode }}</span>
            @endif
        </div>
    </div>
</div>

{{-- Fabric.js CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>

{{-- Laravel Echo (loaded via Vite in app.js) --}}
@vite(['resources/js/app.js'])

<script>
// Singleton pattern for whiteboard
window.whiteboardApp = (function() {
    let canvas = null;
    let currentColor = '#1a202c';
    let brushWidth = 8;
    let mode = 'draw';
    let initialized = false;
    let sessionCode = '{{ $sessionCode }}';
    let sessionActive = {{ $sessionActive ? 'true' : 'false' }};
    let echoChannel = null;
    
    function init() {
        if (initialized) return;
        
        console.log('Whiteboard initializing...');
        
        const canvasEl = document.getElementById('whiteboard-canvas');
        if (!canvasEl) return;
        
        canvas = new fabric.Canvas('whiteboard-canvas', {
            isDrawingMode: true,
            backgroundColor: '#ffffff'
        });
        
        applyBrushSettings();
        
        // Listen for path created event to broadcast
        canvas.on('path:created', function(e) {
            if (sessionActive && sessionCode) {
                const pathData = e.path.toJSON();
                @this.call('broadcastDraw', pathData);
            }
        });
        
        // Setup Echo listener if session is active
        if (sessionActive && sessionCode) {
            setupEchoListener();
        }
        
        initialized = true;
        console.log('Whiteboard initialized!');
    }
    
    function setupEchoListener() {
        if (typeof window.Echo === 'undefined') {
            console.log('Echo not ready, retrying in 1s...');
            setTimeout(setupEchoListener, 1000);
            return;
        }
        
        console.log('Setting up Echo listener for session:', sessionCode);
        
        echoChannel = window.Echo.join('whiteboard.' + sessionCode)
            .here((users) => {
                console.log('Users in channel:', users);
                updateParticipantCount(users.length);
            })
            .joining((user) => {
                console.log('User joining:', user);
                showToast(user.name + ' bergabung');
            })
            .leaving((user) => {
                console.log('User leaving:', user);
                showToast(user.name + ' keluar');
            })
            .listen('.drawing', (e) => {
                console.log('Received drawing from:', e.userName);
                addPathToCanvas(e.drawingData);
            })
            .listen('.clear', (e) => {
                console.log('Canvas cleared by:', e.userName);
                clearCanvasLocal();
                showToast(e.userName + ' membersihkan layar');
            });
    }
    
    function addPathToCanvas(pathData) {
        fabric.util.enlivenObjects([pathData], function(objects) {
            objects.forEach(function(obj) {
                canvas.add(obj);
            });
            canvas.renderAll();
        });
    }
    
    function updateParticipantCount(count) {
        const el = document.getElementById('participant-count');
        if (el) el.textContent = count;
    }
    
    function showToast(message) {
        // Simple toast notification
        console.log('Toast:', message);
    }
    
    function applyBrushSettings() {
        if (!canvas) return;
        
        canvas.freeDrawingBrush = new fabric.PencilBrush(canvas);
        
        if (mode === 'draw') {
            canvas.freeDrawingBrush.color = currentColor;
            canvas.freeDrawingBrush.width = brushWidth;
        } else {
            canvas.freeDrawingBrush.color = '#ffffff';
            canvas.freeDrawingBrush.width = brushWidth * 3;
        }
    }
    
    function updateColorButtons(selectedColor) {
        const colors = {
            '#e53e3e': 'color-red',
            '#3182ce': 'color-blue', 
            '#1a202c': 'color-black',
            '#38a169': 'color-green'
        };
        
        Object.entries(colors).forEach(([color, id]) => {
            const btn = document.getElementById(id);
            if (btn) {
                btn.classList.remove('ring-2', 'ring-offset-2', 'ring-red-500', 'ring-blue-500', 'ring-gray-800', 'ring-green-500');
                if (color === selectedColor) {
                    btn.classList.add('ring-2', 'ring-offset-2');
                    btn.classList.add(color === '#e53e3e' ? 'ring-red-500' : 
                                      color === '#3182ce' ? 'ring-blue-500' : 
                                      color === '#1a202c' ? 'ring-gray-800' : 'ring-green-500');
                }
            }
        });
    }
    
    function updateSizeButtons(selectedWidth) {
        const sizes = { 3: 'size-thin', 8: 'size-medium', 15: 'size-thick' };
        
        Object.entries(sizes).forEach(([width, id]) => {
            const btn = document.getElementById(id);
            if (btn) {
                if (parseInt(width) === selectedWidth) {
                    btn.classList.add('bg-teal-100', 'border-teal-500', 'text-teal-700');
                    btn.classList.remove('border-gray-300', 'text-gray-600');
                } else {
                    btn.classList.remove('bg-teal-100', 'border-teal-500', 'text-teal-700');
                    btn.classList.add('border-gray-300', 'text-gray-600');
                }
            }
        });
    }
    
    function updateModeButtons(selectedMode) {
        const drawBtn = document.getElementById('mode-draw');
        const eraseBtn = document.getElementById('mode-erase');
        
        if (drawBtn && eraseBtn) {
            if (selectedMode === 'draw') {
                drawBtn.classList.add('bg-teal-500', 'text-white', 'shadow-md');
                drawBtn.classList.remove('bg-gray-100', 'text-gray-600');
                eraseBtn.classList.remove('bg-orange-500', 'text-white', 'shadow-md');
                eraseBtn.classList.add('bg-gray-100', 'text-gray-600');
            } else {
                eraseBtn.classList.add('bg-orange-500', 'text-white', 'shadow-md');
                eraseBtn.classList.remove('bg-gray-100', 'text-gray-600');
                drawBtn.classList.remove('bg-teal-500', 'text-white', 'shadow-md');
                drawBtn.classList.add('bg-gray-100', 'text-gray-600');
            }
        }
    }
    
    function clearCanvasLocal() {
        if (canvas) {
            canvas.getObjects().slice().forEach(obj => canvas.remove(obj));
            canvas.backgroundColor = '#ffffff';
            canvas.renderAll();
        }
    }
    
    return {
        setColor: function(color) {
            currentColor = color;
            updateColorButtons(color);
            if (mode === 'draw') applyBrushSettings();
        },
        
        setBrushWidth: function(width) {
            brushWidth = width;
            updateSizeButtons(width);
            applyBrushSettings();
        },
        
        setMode: function(newMode) {
            mode = newMode;
            updateModeButtons(newMode);
            applyBrushSettings();
        },
        
        clearCanvas: function() {
            if (!confirm('Apakah Anda yakin ingin menghapus semua gambar?')) return;
            
            clearCanvasLocal();
            
            if (sessionActive) {
                @this.call('broadcastClear');
            }
        },
        
        saveImage: function() {
            if (!canvas) return;
            
            const dataUrl = canvas.toDataURL({ format: 'png', quality: 1 });
            @this.call('saveWhiteboard', dataUrl);
        },
        
        init: init
    };
})();

document.addEventListener('DOMContentLoaded', function() {
    whiteboardApp.init();
});

if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(function() { whiteboardApp.init(); }, 100);
}
</script>