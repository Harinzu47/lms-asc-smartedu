<div>
    @if(!$isConnected)
        {{-- Join Session Form --}}
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-50 to-teal-50 -m-6 lg:-m-10">
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Papan Tulis Digital</h1>
                    <p class="text-gray-500 mt-2">Masukkan kode sesi dari tutor untuk bergabung</p>
                </div>
                
                <form wire:submit.prevent="joinSession" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Sesi</label>
                        <input type="text" wire:model="sessionCode" placeholder="Contoh: ABC123"
                            class="w-full text-center text-2xl font-bold tracking-widest uppercase rounded-xl border-2 border-gray-300 focus:border-purple-500 focus:ring-purple-500 py-4"
                            maxlength="6">
                    </div>
                    
                    @if($errorMessage)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-red-700 text-sm">
                            {{ $errorMessage }}
                        </div>
                    @endif
                    
                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-purple-600 to-teal-600 hover:from-purple-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg transition transform hover:-translate-y-1">
                        Gabung Sesi
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('student.dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- Load Scripts First --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
        
        {{-- Whiteboard Canvas --}}
        <div wire:ignore id="whiteboard-container" class="min-h-screen flex flex-col -m-6 lg:-m-10">
            {{-- Header Bar --}}
            <div class="bg-white shadow-md px-4 py-3 flex items-center justify-between border-b border-gray-200">
                <a href="{{ route('student.dashboard') }}"
                    class="flex items-center text-gray-600 hover:text-teal-600 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Keluar Sesi
                </a>
                
                <h1 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Papan Tulis Digital
                    <span class="ml-3 px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Sesi: {{ $sessionCode }}
                    </span>
                </h1>
                
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full">
                        <span id="participant-count">1</span> Peserta
                    </span>
                </div>
            </div>
            
            {{-- Toolbar --}}
            <div class="bg-gradient-to-r from-gray-100 to-gray-50 px-4 py-3 flex flex-wrap items-center justify-center gap-4 border-b border-gray-200 shadow-sm">
                {{-- Color Picker --}}
                <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                    <span class="text-sm font-semibold text-gray-600 mr-2">Warna:</span>
                    <button id="color-red" class="w-8 h-8 bg-red-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"></button>
                    <button id="color-blue" class="w-8 h-8 bg-blue-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"></button>
                    <button id="color-black" class="w-8 h-8 bg-gray-800 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white ring-2 ring-offset-2 ring-gray-800"></button>
                    <button id="color-green" class="w-8 h-8 bg-green-500 rounded-full hover:scale-110 transition transform shadow-md border-2 border-white"></button>
                </div>
                
                {{-- Brush Size --}}
                <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                    <span class="text-sm font-semibold text-gray-600 mr-2">Ukuran:</span>
                    <button id="size-thin" class="px-3 py-1.5 rounded-lg border font-bold text-sm transition border-gray-300 text-gray-600 hover:bg-gray-100">Tipis</button>
                    <button id="size-medium" class="px-3 py-1.5 rounded-lg border font-bold text-sm transition bg-teal-100 border-teal-500 text-teal-700">Sedang</button>
                    <button id="size-thick" class="px-3 py-1.5 rounded-lg border font-bold text-sm transition border-gray-300 text-gray-600 hover:bg-gray-100">Tebal</button>
                </div>
                
                {{-- Mode Toggle --}}
                <div class="flex items-center gap-2 bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200">
                    <span class="text-sm font-semibold text-gray-600 mr-2">Mode:</span>
                    <button id="mode-draw" class="flex items-center px-3 py-1.5 rounded-lg font-bold text-sm transition bg-teal-500 text-white shadow-md">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Gambar
                    </button>
                    <button id="mode-erase" class="flex items-center px-3 py-1.5 rounded-lg font-bold text-sm transition bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
            
            {{-- Canvas Area --}}
            <div class="flex-1 bg-gray-200 p-4 flex items-center justify-center overflow-auto">
                <div class="bg-white rounded-lg shadow-2xl border-4 border-gray-300 overflow-hidden">
                    <canvas id="whiteboard-canvas" width="1200" height="700" class="block"></canvas>
                </div>
            </div>
            
            {{-- Info Footer --}}
            <div class="bg-gray-100 px-4 py-2 text-center text-sm text-gray-500 border-t border-gray-200">
                <span class="font-medium">{{ $session->jadwal->mapel->nama_mapel ?? 'Mata Pelajaran' }}</span> - 
                <span>{{ $session->jadwal->kelas->nama_kelas ?? 'Kelas' }}</span> |
                <span class="text-purple-600 font-bold">Sesi: {{ $sessionCode }}</span>
            </div>
        </div>
        
        @vite(['resources/js/app.js'])
        
        <script>
        (function() {
            let canvas = null;
            let currentColor = '#1a202c';
            let brushWidth = 8;
            let mode = 'draw';
            const sessionCode = '{{ $sessionCode }}';
            
            function init() {
                console.log('Student whiteboard init...');
                
                const canvasEl = document.getElementById('whiteboard-canvas');
                if (!canvasEl) {
                    console.error('Canvas not found');
                    return;
                }
                
                if (typeof fabric === 'undefined') {
                    console.log('Fabric not ready, retrying...');
                    setTimeout(init, 200);
                    return;
                }
                
                canvas = new fabric.Canvas('whiteboard-canvas', {
                    isDrawingMode: true,
                    backgroundColor: '#ffffff'
                });
                
                applyBrushSettings();
                
                // Broadcast drawing
                canvas.on('path:created', function(e) {
                    const pathData = e.path.toJSON();
                    @this.call('broadcastDraw', pathData);
                });
                
                // Setup event listeners for buttons
                document.getElementById('color-red').addEventListener('click', () => setColor('#e53e3e'));
                document.getElementById('color-blue').addEventListener('click', () => setColor('#3182ce'));
                document.getElementById('color-black').addEventListener('click', () => setColor('#1a202c'));
                document.getElementById('color-green').addEventListener('click', () => setColor('#38a169'));
                
                document.getElementById('size-thin').addEventListener('click', () => setBrushWidth(3));
                document.getElementById('size-medium').addEventListener('click', () => setBrushWidth(8));
                document.getElementById('size-thick').addEventListener('click', () => setBrushWidth(15));
                
                document.getElementById('mode-draw').addEventListener('click', () => setMode('draw'));
                document.getElementById('mode-erase').addEventListener('click', () => setMode('erase'));
                
                setupEchoListener();
                console.log('Student whiteboard initialized!');
            }
            
            function setupEchoListener() {
                if (typeof window.Echo === 'undefined') {
                    console.log('Echo not ready, retrying...');
                    setTimeout(setupEchoListener, 1000);
                    return;
                }
                
                console.log('Joining channel:', 'whiteboard.' + sessionCode);
                
                window.Echo.join('whiteboard.' + sessionCode)
                    .here((users) => {
                        console.log('Users here:', users.length);
                        updateParticipantCount(users.length);
                    })
                    .joining((user) => {
                        console.log(user.name + ' joined');
                    })
                    .leaving((user) => {
                        console.log(user.name + ' left');
                    })
                    .listen('.drawing', (e) => {
                        console.log('Drawing received');
                        addPathToCanvas(e.drawingData);
                    })
                    .listen('.clear', (e) => {
                        console.log('Clear received');
                        clearCanvasLocal();
                    });
            }
            
            function addPathToCanvas(pathData) {
                fabric.util.enlivenObjects([pathData], function(objects) {
                    objects.forEach(obj => canvas.add(obj));
                    canvas.renderAll();
                });
            }
            
            function updateParticipantCount(count) {
                const el = document.getElementById('participant-count');
                if (el) el.textContent = count;
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
            
            function clearCanvasLocal() {
                if (canvas) {
                    canvas.getObjects().slice().forEach(obj => canvas.remove(obj));
                    canvas.backgroundColor = '#ffffff';
                    canvas.renderAll();
                }
            }
            
            function setColor(color) {
                console.log('Setting color:', color);
                currentColor = color;
                updateColorButtons(color);
                if (mode === 'draw') applyBrushSettings();
            }
            
            function setBrushWidth(width) {
                console.log('Setting width:', width);
                brushWidth = width;
                updateSizeButtons(width);
                applyBrushSettings();
            }
            
            function setMode(newMode) {
                console.log('Setting mode:', newMode);
                mode = newMode;
                updateModeButtons(newMode);
                applyBrushSettings();
            }
            
            function updateColorButtons(selectedColor) {
                const colors = {'#e53e3e': 'color-red', '#3182ce': 'color-blue', '#1a202c': 'color-black', '#38a169': 'color-green'};
                Object.entries(colors).forEach(([color, id]) => {
                    const btn = document.getElementById(id);
                    if (btn) {
                        btn.classList.remove('ring-2', 'ring-offset-2', 'ring-red-500', 'ring-blue-500', 'ring-gray-800', 'ring-green-500');
                        if (color === selectedColor) {
                            btn.classList.add('ring-2', 'ring-offset-2');
                            btn.classList.add(color === '#e53e3e' ? 'ring-red-500' : color === '#3182ce' ? 'ring-blue-500' : color === '#1a202c' ? 'ring-gray-800' : 'ring-green-500');
                        }
                    }
                });
            }
            
            function updateSizeButtons(selectedWidth) {
                const sizes = {3: 'size-thin', 8: 'size-medium', 15: 'size-thick'};
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
            
            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                setTimeout(init, 100);
            }
        })();
        </script>
    @endif
</div>