<div class="space-y-6">
    <!-- Debug Info (Temporary) -->
    <div class="bg-blue-50 p-2 text-xs text-blue-800 rounded mb-2">
        Debug: Found {{ $discussions->count() }} discussions. 
        Jadwal ID: {{ $this->jadwal->id }}, Kelas: {{ $this->jadwal->kelas_id }}, Mapel: {{ $this->jadwal->mapel_id }}
    </div>

    <!-- Create Post Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Mulai Diskusi Baru</h3>
        <form wire:submit.prevent="createPost" class="space-y-4">
            <div>
                <input wire:model="judulBaru" type="text" placeholder="Judul Diskusi" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                @error('judulBaru') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <textarea wire:model="kontenBaru" rows="3" placeholder="Apa yang ingin anda diskusikan?" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
                @error('kontenBaru') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg transition duration-200">
                    Posting
                </button>
            </div>
        </form>
    </div>

    <!-- Feed -->
    @forelse($discussions as $discussion)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="p-6 pb-0 flex items-start space-x-4">
            <div class="flex-shrink-0">
                @if($discussion->author->profile_photo_path)
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($discussion->author->profile_photo_path) }}" alt="{{ $discussion->author->name }}">
                @else
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                        {{ substr($discussion->author->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">
                    <span class="font-bold text-blue-900">{{ $discussion->author->name }}</span>
                    <span class="text-gray-500 font-normal">memposting informasi</span>
                    <span class="text-gray-400 mx-1">&gt;</span>
                    <span class="font-bold text-teal-600">{{ $discussion->jadwal->mapel->nama_mapel }}</span>
                </p>
                <p class="text-xs text-gray-500">
                    {{ $discussion->created_at->diffForHumans() }}
                </p>
            </div>
            <!-- Options (Three dots) - Optional -->
            <!-- <button class="text-gray-400 hover:text-gray-600"><svg ...></svg></button> -->
        </div>

        <!-- Body -->
        <div class="px-6 py-4" x-data="{ expanded: false }">
            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $discussion->judul }}</h4>
            <div class="text-gray-600 leading-relaxed overflow-hidden" 
                 :class="{'max-h-24': !expanded, 'max-h-full': expanded}">
                {{ $discussion->konten }}
            </div>
            @if(strlen($discussion->konten) > 150)
                <button @click="expanded = !expanded" class="text-teal-600 text-sm font-medium mt-2 hover:underline focus:outline-none">
                    <span x-show="!expanded">Baca Selengkapnya...</span>
                    <span x-show="expanded">Tutup</span>
                </button>
            @endif
        </div>

        <!-- Actions Bar -->
        <div class="px-6 py-3 bg-gray-50 flex items-center justify-between border-t border-gray-100">
            <div class="flex space-x-6">
                <!-- Like -->
                <button wire:click="toggleLike({{ $discussion->id }})" class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition duration-150 group">
                    <svg class="w-5 h-5 {{ $discussion->isLikedBy(auth()->user()) ? 'text-red-500 fill-current' : 'group-hover:text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="text-sm font-medium {{ $discussion->isLikedBy(auth()->user()) ? 'text-red-500' : '' }}">{{ $discussion->likes->count() }}</span>
                </button>
                
                <!-- Comment Icon (Just visual counter or scroll to input) -->
                <button class="flex items-center space-x-2 text-gray-500 hover:text-teal-600 transition duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ $discussion->comments->count() }}</span>
                </button>
                
                <!-- Share (Dummy) -->
                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
            <!-- List Comments -->
            @if($discussion->comments->count() > 0)
            <div class="space-y-3 mb-4 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                @foreach($discussion->comments as $comment)
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                         @if($comment->author->profile_photo_path)
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Storage::url($comment->author->profile_photo_path) }}">
                        @else
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500 font-bold">
                                {{ substr($comment->author->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start">
                            <span class="text-sm font-bold text-gray-800">{{ $comment->author->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ $comment->konten }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Comment Input -->
            <form wire:submit.prevent="postComment({{ $discussion->id }})" class="relative">
                <input 
                    type="text" 
                    wire:model="komentarBaru.{{ $discussion->id }}" 
                    placeholder="Tambahkan komentar..." 
                    class="w-full pl-4 pr-12 py-2.5 rounded-full border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm bg-white"
                >
                <button 
                    type="submit" 
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1.5 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition duration-200 disabled:opacity-50"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-12 text-gray-500">
        Belum ada diskusi di kelas ini. Jadilah yang pertama memulai!
    </div>
    @endforelse
</div>
