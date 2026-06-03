<div
    x-data="chatWidget()"
    x-cloak
    class="fixed bottom-6 right-6 z-[60] font-['Ubuntu',sans-serif]"
>
    {{-- Chat Window --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="mb-4 w-[420px] h-[620px] rounded-2xl border border-gray-200/60 bg-white/80 backdrop-blur-xl shadow-[0_8px_40px_rgba(0,0,0,0.12)] flex overflow-hidden sm:w-[420px] sm:h-[620px] sm:rounded-2xl sm:mb-4 max-sm:fixed max-sm:inset-0 max-sm:w-full max-sm:h-full max-sm:rounded-none max-sm:mb-0 max-sm:border-0"
    >
        {{-- Sidebar --}}
        <div
            x-show="sidebar"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="absolute inset-y-0 left-0 z-10 w-[260px] bg-white/95 backdrop-blur-xl border-r border-gray-200/60 flex flex-col max-sm:w-[85%]"
        >
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200/60">
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">History</span>
                <button
                    @click="sidebar = false"
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-100 transition hover:bg-gray-200"
                >
                    <svg class="h-3.5 w-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto kclich-scrollbar py-2">
                <template x-for="chat in chats" :key="chat.id">
                    <button
                        @click="loadChat(chat.id); sidebar = false"
                        :class="chat.id === activeChatId ? 'bg-[#4F6EF5]/10 text-[#4F6EF5]' : 'text-gray-700 hover:bg-gray-50'"
                        class="w-full text-left px-4 py-3 transition"
                    >
                        <p class="text-[0.78rem] font-medium truncate" x-text="chat.title || 'New conversation'"></p>
                        <p class="mt-0.5 text-[0.65rem] text-gray-400" x-text="timeAgo(chat.updatedAt)"></p>
                    </button>
                </template>
                <template x-if="chats.length === 0">
                    <p class="px-4 py-6 text-center text-xs text-gray-400">No conversations yet</p>
                </template>
            </div>
        </div>

        {{-- Sidebar overlay --}}
        <div
            x-show="sidebar"
            @click="sidebar = false"
            class="absolute inset-0 z-[5] bg-black/20 sm:hidden"
        ></div>

        {{-- Main Chat --}}
        <div class="relative flex flex-1 flex-col min-w-0">
            {{-- Header --}}
            <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-[#4F6EF5] to-[#6B8AFF] text-white shrink-0">
                <button
                    @click="sidebar = !sidebar"
                    title="Chat history"
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 transition hover:bg-white/25"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-semibold tracking-tight">Kclich</h3>
                    <p class="text-[0.68rem] text-white/80">Ronnie's AI assistant</p>
                </div>
                <button
                    @click="newChat()"
                    title="New chat"
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 transition hover:bg-white/25"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
                <button
                    @click="open = false"
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 transition hover:bg-white/25"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Messages --}}
            <div
                x-ref="messages"
                class="flex-1 overflow-y-auto px-4 py-4 space-y-4 scroll-smooth kclich-scrollbar"
            >
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div
                            :class="msg.role === 'user'
                                ? 'bg-[#4F6EF5] text-white rounded-2xl rounded-br-md px-4 py-2.5 max-w-[85%]'
                                : 'bg-gray-100/80 backdrop-blur-sm text-gray-800 rounded-2xl rounded-bl-md px-4 py-2.5 max-w-[85%]'"
                        >
                            <div
                                class="text-[0.82rem] leading-relaxed msg-content"
                                x-html="renderMarkdown(msg.content)"
                            ></div>
                        </div>
                    </div>
                </template>

                <template x-if="loading">
                    <div class="flex justify-start">
                        <div class="bg-gray-100/80 backdrop-blur-sm rounded-2xl rounded-bl-md px-4 py-3">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0ms"></span>
                                <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 150ms"></span>
                                <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 300ms"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Input --}}
            <div class="border-t border-gray-200/60 px-4 py-3 bg-white/50 shrink-0">
                <form @submit.prevent="send()" class="flex items-center gap-2">
                    <input
                        x-model="input"
                        x-ref="input"
                        type="text"
                        placeholder="Type a message..."
                        :disabled="loading"
                        class="flex-1 rounded-xl border border-gray-200 bg-white/80 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 backdrop-blur-sm outline-none transition focus:border-[#4F6EF5]/40 focus:ring-2 focus:ring-[#4F6EF5]/10 disabled:opacity-50"
                    >
                    <button
                        type="submit"
                        :disabled="loading || !input.trim()"
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#4F6EF5] text-white transition hover:bg-[#3A54D6] disabled:opacity-40 disabled:cursor-not-allowed"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Toggle Button --}}
    <button
        @click="open = !open; if (open) triggerGreeting()"
        aria-label="Toggle chat"
        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#4F6EF5] text-white shadow-[0_4px_20px_rgba(79,110,245,0.4)] transition hover:scale-105 hover:shadow-[0_6px_28px_rgba(79,110,245,0.5)] active:scale-95 ml-auto"
    >
        <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

@once
<style>
    .kclich-scrollbar::-webkit-scrollbar { display: none; }
    .kclich-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .msg-content p { margin: 0 0 0.5em; }
    .msg-content p:last-child { margin-bottom: 0; }
    .msg-content strong { font-weight: 600; }
    .msg-content em { font-style: italic; }
    .msg-content ul, .msg-content ol { margin: 0.5em 0; padding-left: 1.5em; }
    .msg-content li { margin: 0.15em 0; }
    .msg-content table { width: 100%; border-collapse: collapse; margin: 0.5em 0; font-size: 0.75rem; }
    .msg-content th { background: #f9fafb; padding: 0.25rem 0.5rem; text-align: left; font-weight: 600; border: 1px solid #e5e7eb; }
    .msg-content td { padding: 0.25rem 0.5rem; border: 1px solid #e5e7eb; }
    .msg-content code { background: #f3f4f6; padding: 0.1em 0.3em; border-radius: 0.25em; font-size: 0.9em; }
    .msg-content a { color: #4F6EF5; text-decoration: underline; }
</style>
<script>
function md(text) {
    if (!text) return '';
    let html = text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

    // Tables
    html = html.replace(/^(\|.+\|)\n(\|[-| :]+\|)\n((?:\|.+\|\n?)+)/gm, function (_, header, sep, body) {
        const ths = header.split('|').filter(c => c.trim()).map(c => '<th>' + c.trim() + '</th>').join('');
        const rows = body.trim().split('\n').map(row => {
            const tds = row.split('|').filter(c => c.trim()).map(c => '<td>' + c.trim() + '</td>').join('');
            return '<tr>' + tds + '</tr>';
        }).join('');
        return '<table><thead><tr>' + ths + '</tr></thead><tbody>' + rows + '</tbody></table>';
    });

    // Bold
    html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    // Italic
    html = html.replace(/(?<!\*)\*([^*]+?)\*(?!\*)/g, '<em>$1</em>');
    // Inline code
    html = html.replace(/`(.+?)`/g, '<code>$1</code>');

    // Numbered lists
    html = html.replace(/^(\d+)\.\s+(.+)$/gm, '<li>$2</li>');
    html = html.replace(/((?:<li>.*<\/li>\n?)+)/g, '<ol>$1</ol>');

    // Bullet lists
    html = html.replace(/^[-*]\s+(.+)$/gm, '<li>$1</li>');
    html = html.replace(/((?:<li>.*<\/li>\n?)+)/g, function (match) {
        if (match.startsWith('<ol>')) return match;
        return '<ul>' + match + '</ul>';
    });

    // Paragraphs
    html = html.split(/\n{2,}/).map(block => {
        if (block.match(/^<(ul|ol|table|li|tr|thead|tbody)/)) return block;
        return '<p>' + block.replace(/\n/g, '<br>') + '</p>';
    }).join('');

    return html;
}

function chatWidget() {
    const CHATS_KEY = 'kclich_chats';

    function generateId() {
        return Date.now().toString(36) + Math.random().toString(36).slice(2, 8);
    }

    function loadAll() {
        try {
            const saved = localStorage.getItem(CHATS_KEY);
            if (saved) return JSON.parse(saved);
        } catch { /* ignore */ }
        return { chats: [], activeChatId: null };
    }

    function saveAll(data) {
        try {
            localStorage.setItem(CHATS_KEY, JSON.stringify(data));
        } catch { /* ignore */ }
    }

    const state = loadAll();

    return {
        open: false,
        sidebar: false,
        chats: state.chats,
        activeChatId: state.activeChatId,
        messages: [],
        conversationId: null,
        input: '',
        loading: false,
        greeted: false,

        init() {
            if (this.activeChatId) {
                this.loadChat(this.activeChatId);
            }
        },

        persist() {
            const chat = this.chats.find(c => c.id === this.activeChatId);
            if (chat) {
                chat.messages = this.messages;
                chat.conversationId = this.conversationId;
                chat.updatedAt = Date.now();
                if (chat.title === 'New chat' && this.messages.length > 0) {
                    const first = this.messages.find(m => m.role === 'user');
                    chat.title = first ? first.content.slice(0, 60) : 'New chat';
                }
            }
            saveAll({ chats: this.chats, activeChatId: this.activeChatId });
        },

        ensureChat() {
            if (!this.activeChatId) {
                const id = generateId();
                this.chats.unshift({
                    id,
                    title: 'New chat',
                    messages: [],
                    conversationId: null,
                    updatedAt: Date.now(),
                });
                this.activeChatId = id;
            }
        },

        async triggerGreeting() {
            if (this.greeted || this.messages.length > 0) return;
            this.greeted = true;

            this.ensureChat();
            this.loading = true;

            const greetingPrompt = 'Hello! 👋';
            this.messages.push({ role: 'user', content: greetingPrompt });
            this.persist();
            this.$nextTick(() => this.scrollMessages());

            const assistantIndex = this.messages.length;
            this.messages.push({ role: 'assistant', content: '' });

            try {
                const response = await this.streamChat(greetingPrompt);

                if (!response.ok) throw new Error('Request failed');

                await this.readStream(response, assistantIndex);
            } catch {
                this.messages[assistantIndex].content = "Hi! I'm Kclich, Ronnie's AI assistant. How can I help you today?";
            } finally {
                this.loading = false;
                this.persist();
                this.$nextTick(() => {
                    this.scrollMessages();
                    this.$refs.input?.focus();
                });
            }
        },

        newChat() {
            this.persist();
            this.greeted = false;
            const id = generateId();
            this.chats.unshift({
                id,
                title: 'New chat',
                messages: [],
                conversationId: null,
                updatedAt: Date.now(),
            });
            this.activeChatId = id;
            this.messages = [];
            this.conversationId = null;
            this.input = '';
            this.sidebar = false;
            saveAll({ chats: this.chats, activeChatId: this.activeChatId });
            this.triggerGreeting();
        },

        loadChat(id) {
            this.persist();
            const chat = this.chats.find(c => c.id === id);
            if (!chat) return;
            this.activeChatId = id;
            this.messages = chat.messages;
            this.conversationId = chat.conversationId;
            this.input = '';
            this.greeted = true;
            this.$nextTick(() => this.scrollMessages());
        },

        async send() {
            const prompt = this.input.trim();
            if (!prompt || this.loading) return;

            if (!this.activeChatId) {
                this.ensureChat();
            }

            this.messages.push({ role: 'user', content: prompt });
            this.input = '';
            this.loading = true;
            this.persist();
            this.$nextTick(() => this.scrollMessages());

            const assistantIndex = this.messages.length;
            this.messages.push({ role: 'assistant', content: '' });

            try {
                const response = await this.streamChat(prompt);

                if (!response.ok) {
                    const error = await response.json().catch(() => ({}));
                    throw new Error(error.message || 'Something went wrong.');
                }

                await this.readStream(response, assistantIndex);
            } catch {
                this.messages[assistantIndex].content = 'Sorry, I ran into an issue. Please try again later.';
            } finally {
                this.loading = false;
                this.persist();
                this.$nextTick(() => {
                    this.scrollMessages();
                    this.$refs.input?.focus();
                });
            }
        },

        async streamChat(prompt) {
            return fetch('{{ route("chat.stream") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'text/event-stream',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    prompt: prompt,
                    conversation_id: this.conversationId,
                }),
            });
        },

        async readStream(response, assistantIndex) {
            const reader = response.body.getReader();
            const decoder = new TextDecoder();
            let buffer = '';

            while (true) {
                const { done, value } = await reader.read();
                if (done) break;

                buffer += decoder.decode(value, { stream: true });
                const lines = buffer.split('\n');
                buffer = lines.pop() || '';

                for (const line of lines) {
                    const trimmed = line.trim();
                    if (!trimmed || !trimmed.startsWith('data: ')) continue;

                    const data = trimmed.slice(6);
                    if (data === '[DONE]') break;

                    try {
                        const parsed = JSON.parse(data);

                        if (parsed.type === 'text-delta' && parsed.delta) {
                            this.messages[assistantIndex].content += parsed.delta;
                            this.$nextTick(() => this.scrollMessages());
                        }

                        if (parsed.type === 'message-annotations' && Array.isArray(parsed.annotations)) {
                            for (const annotation of parsed.annotations) {
                                if (annotation.conversationId) {
                                    this.conversationId = annotation.conversationId;
                                }
                            }
                        }
                    } catch { /* skip */ }
                }
            }
        },

        timeAgo(ts) {
            if (!ts) return '';
            const diff = Date.now() - ts;
            const mins = Math.floor(diff / 60000);
            if (mins < 1) return 'Just now';
            if (mins < 60) return mins + 'm ago';
            const hours = Math.floor(mins / 60);
            if (hours < 24) return hours + 'h ago';
            const days = Math.floor(hours / 24);
            if (days < 7) return days + 'd ago';
            return new Date(ts).toLocaleDateString();
        },

        renderMarkdown(content) {
            return md(content);
        },

        scrollMessages() {
            const el = this.$refs.messages;
            if (el) el.scrollTop = el.scrollHeight;
        },
    };
}
</script>
@endonce
