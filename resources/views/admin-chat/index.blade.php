<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Assistant — Kclich</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .admin-scrollbar::-webkit-scrollbar { display: none; }
        .admin-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .msg-content p { margin: 0 0 0.5em; }
        .msg-content p:last-child { margin-bottom: 0; }
        .msg-content strong { font-weight: 600; }
        .msg-content em { font-style: italic; }
        .msg-content ul, .msg-content ol { margin: 0.5em 0; padding-left: 1.5em; }
        .msg-content li { margin: 0.15em 0; }
        .msg-content table { width: 100%; border-collapse: collapse; margin: 0.5em 0; font-size: 0.8rem; }
        .msg-content th { background: #f9fafb; padding: 0.35rem 0.6rem; text-align: left; font-weight: 600; border: 1px solid #e5e7eb; }
        .msg-content td { padding: 0.35rem 0.6rem; border: 1px solid #e5e7eb; }
        .msg-content code { background: #f3f4f6; padding: 0.1em 0.3em; border-radius: 0.25em; font-size: 0.9em; }
        .msg-content a { color: #f05517; text-decoration: underline; }
    </style>
</head>
<body class="bg-gray-50 font-['Ubuntu',sans-serif]">
    <div
        x-data="adminChat()"
        class="flex h-screen"
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
            class="w-[280px] border-r border-gray-200 bg-white flex flex-col shrink-0"
        >
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
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
            <div class="flex-1 overflow-y-auto admin-scrollbar py-2">
                <template x-for="chat in chats" :key="chat.id">
                    <button
                        @click="loadChat(chat.id); sidebar = false"
                        :class="chat.id === activeChatId ? 'bg-[#f05517]/10 text-[#f05517]' : 'text-gray-700 hover:bg-gray-50'"
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

        {{-- Main --}}
        <div class="flex flex-1 flex-col min-w-0">
            {{-- Header --}}
            <div class="flex items-center gap-4 border-b border-gray-200 bg-white px-6 py-4">
                <a href="{{ route('dashboard') }}" class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-500 transition hover:bg-gray-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <button
                    @click="sidebar = !sidebar"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-500 transition hover:bg-gray-200"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#f05517]/10">
                    <svg class="h-5 w-5 text-[#f05517]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-sm font-semibold text-gray-900">Admin Assistant</h1>
                    <p class="text-xs text-gray-500">Ask about chats, leads, stats, and knowledge</p>
                </div>
                <div class="ml-auto flex items-center gap-3">
                    <span class="text-xs text-gray-400">{{ Auth::user()->name }}</span>
                    <button
                        @click="newChat()"
                        class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-600 transition hover:bg-gray-50"
                    >
                        New Chat
                    </button>
                </div>
            </div>

            {{-- Messages --}}
            <div
                x-ref="messages"
                class="flex-1 overflow-y-auto admin-scrollbar"
            >
                <div class="mx-auto max-w-3xl px-6 py-8 space-y-6">
                    <template x-if="messages.length === 0 && !loading">
                        <div class="py-16 text-center">
                            <h2 class="text-lg font-semibold text-gray-800">Admin Assistant</h2>
                            <p class="mt-2 text-sm text-gray-500">Ask me anything about your portfolio's chat data, leads, or stats.</p>
                            <div class="mt-8 flex flex-wrap justify-center gap-2">
                                <button @click="input = 'Summarize today\'s conversations'" class="rounded-full border border-gray-200 bg-white px-4 py-2 text-xs text-gray-600 transition hover:border-[#f05517]/30 hover:text-[#f05517]">
                                    Summarize today's chats
                                </button>
                                <button @click="input = 'How many leads this week?'" class="rounded-full border border-gray-200 bg-white px-4 py-2 text-xs text-gray-600 transition hover:border-[#f05517]/30 hover:text-[#f05517]">
                                    Leads this week
                                </button>
                                <button @click="input = 'What are visitors asking about most?'" class="rounded-full border border-gray-200 bg-white px-4 py-2 text-xs text-gray-600 transition hover:border-[#f05517]/30 hover:text-[#f05517]">
                                    Top questions
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-for="(msg, index) in messages" :key="index">
                        <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                            <div
                                :class="msg.role === 'user'
                                    ? 'bg-[#f05517] text-white rounded-2xl rounded-br-md px-5 py-3 max-w-[75%]'
                                    : 'bg-white border border-gray-200 text-gray-800 rounded-2xl rounded-bl-md px-5 py-3 max-w-[75%]'"
                            >
                                <div
                                    class="text-sm leading-relaxed msg-content"
                                    x-html="renderMarkdown(msg.content)"
                                ></div>
                            </div>
                        </div>
                    </template>

                    <template x-if="loading">
                        <div class="flex justify-start">
                            <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-5 py-3">
                                <div class="flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0ms"></span>
                                    <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 150ms"></span>
                                    <span class="h-2 w-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 300ms"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Input --}}
            <div class="border-t border-gray-200 bg-white px-6 py-4">
                <div class="mx-auto max-w-3xl">
                    <form @submit.prevent="send()" class="flex items-center gap-3">
                        <input
                            x-model="input"
                            x-ref="input"
                            type="text"
                            placeholder="Ask about chats, leads, stats..."
                            :disabled="loading"
                            class="flex-1 rounded-xl border border-gray-200 bg-gray-50 px-5 py-3 text-sm text-gray-800 placeholder-gray-400 outline-none transition focus:border-[#f05517]/40 focus:bg-white focus:ring-2 focus:ring-[#f05517]/10 disabled:opacity-50"
                        >
                        <button
                            type="submit"
                            :disabled="loading || !input.trim()"
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#f05517] text-white transition hover:bg-[#d64a13] disabled:opacity-40 disabled:cursor-not-allowed"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    function adminChat() {
        const CHATS_KEY = 'kclich_admin_chats';

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
            sidebar: true,
            chats: state.chats,
            activeChatId: state.activeChatId,
            messages: [],
            conversationId: null,
            input: '',
            loading: false,

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

            renderMarkdown(content) {
                return md(content);
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

            newChat() {
                this.persist();
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
                saveAll({ chats: this.chats, activeChatId: this.activeChatId });
            },

            loadChat(id) {
                this.persist();
                const chat = this.chats.find(c => c.id === id);
                if (!chat) return;
                this.activeChatId = id;
                this.messages = chat.messages;
                this.conversationId = chat.conversationId;
                this.input = '';
                this.$nextTick(() => this.scrollMessages());
            },

            async send() {
                const prompt = this.input.trim();
                if (!prompt || this.loading) return;

                this.ensureChat();

                this.messages.push({ role: 'user', content: prompt });
                this.input = '';
                this.loading = true;
                this.persist();
                this.$nextTick(() => this.scrollMessages());

                const assistantIndex = this.messages.length;
                this.messages.push({ role: 'assistant', content: '' });

                try {
                    const response = await fetch('{{ route("admin-chat.stream") }}', {
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

                    if (!response.ok) throw new Error('Request failed');

                    await this.readStream(response, assistantIndex);
                } catch {
                    this.messages[assistantIndex].content = 'Something went wrong. Please try again.';
                } finally {
                    this.loading = false;
                    this.persist();
                    this.$nextTick(() => {
                        this.scrollMessages();
                        this.$refs.input?.focus();
                    });
                }
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

            scrollMessages() {
                const el = this.$refs.messages;
                if (el) el.scrollTop = el.scrollHeight;
            },
        };
    }
    </script>
</body>
</html>
