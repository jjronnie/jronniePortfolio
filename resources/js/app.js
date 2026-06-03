import './bootstrap';
import '@fontsource/ubuntu/300.css';
import '@fontsource/ubuntu/400.css';
import '@fontsource/ubuntu/500.css';
import '@fontsource/ubuntu/700.css';
import 'highlight.js/styles/atom-one-dark.css';
import hljs from 'highlight.js';
import Alpine from 'alpinejs';
import { createIcons, Check, Clipboard, Database, FileType, Globe, Layout, Palette, Search, Server, Shield, Smartphone, Zap } from 'lucide';

window.Alpine = Alpine;
Alpine.start();

window.md = function (text) {
    if (!text) return '';
    let html = text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

    html = html.replace(/^(\|.+\|)\n(\|[-| :]+\|)\n((?:\|.+\|\n?)+)/gm, function (_, header, sep, body) {
        const ths = header.split('|').filter(c => c.trim()).map(c => '<th>' + c.trim() + '</th>').join('');
        const rows = body.trim().split('\n').map(row => {
            const tds = row.split('|').filter(c => c.trim()).map(c => '<td>' + c.trim() + '</td>').join('');
            return '<tr>' + tds + '</tr>';
        }).join('');
        return '<table><thead><tr>' + ths + '</tr></thead><tbody>' + rows + '</tbody></table>';
    });

    html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    html = html.replace(/(?<!\*)\*([^*]+?)\*(?!\*)/g, '<em>$1</em>');
    html = html.replace(/`(.+?)`/g, '<code>$1</code>');

    html = html.replace(/^(\d+)\.\s+(.+)$/gm, '<li>$2</li>');
    html = html.replace(/((?:<li>.*<\/li>\n?)+)/g, '<ol>$1</ol>');

    html = html.replace(/^[-*]\s+(.+)$/gm, '<li>$1</li>');
    html = html.replace(/((?:<li>.*<\/li>\n?)+)/g, function (match) {
        if (match.startsWith('<ol>')) return match;
        return '<ul>' + match + '</ul>';
    });

    html = html.split(/\n{2,}/).map(block => {
        if (block.match(/^<(ul|ol|table|li|tr|thead|tbody)/)) return block;
        return '<p>' + block.replace(/\n/g, '<br>') + '</p>';
    }).join('');

    return html;
};

window.chatWidget = function () {
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
            return fetch('/chat', {
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
};

document.addEventListener('DOMContentLoaded', () => {
    const mobileBtn = document.getElementById('mobile-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            const open = mobileMenu.classList.contains('open');
            mobileMenu.classList.toggle('open');
            mobileBtn.classList.toggle('active');
            mobileBtn.setAttribute('aria-expanded', !open);
        });
    }

    const navBar = document.getElementById('nav-bar');
    if (navBar) {
        window.addEventListener('scroll', () => {
            navBar.classList.toggle('scrolled', window.scrollY > 10);
        });
    }

    const navLinksContainer = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-link');
    let navPill = document.querySelector('.nav-pill');

    if (!navPill && navLinksContainer) {
        navPill = document.createElement('span');
        navPill.className = 'nav-pill';
        navPill.style.display = 'none';
        navLinksContainer.appendChild(navPill);
    }

    function positionPill(link) {
        if (!navPill || !link) { if (navPill) navPill.style.display = 'none'; return; }
        const parentRect = navLinksContainer.getBoundingClientRect();
        const linkRect = link.getBoundingClientRect();
        navPill.style.display = 'block';
        navPill.style.left = (linkRect.left - parentRect.left) + 'px';
        navPill.style.top = (linkRect.top - parentRect.top) + 'px';
        navPill.style.width = linkRect.width + 'px';
        navPill.style.height = linkRect.height + 'px';
    }

    function setActiveLink(activeEl) {
        navLinks.forEach(a => a.classList.remove('active'));
        if (activeEl) {
            activeEl.classList.add('active');
            positionPill(activeEl);
        } else {
            if (navPill) navPill.style.display = 'none';
        }
    }

    const sections = [];
    document.querySelectorAll('section[id]').forEach(s => sections.push(s));

    function updateActiveLink() {
        const path = window.location.pathname;
        let current = '';
        sections.forEach(s => {
            const top = s.getBoundingClientRect().top;
            if (top <= 150) current = s.id;
        });
        if (!current && sections.length > 0) current = sections[0].id;

        navLinks.forEach(a => {
            const href = a.getAttribute('href') || '';
            const isActive = href === '#' + current;
            a.classList.toggle('active', isActive);
        });

        let activeLink = null;
        navLinks.forEach(a => {
            const href = a.getAttribute('href') || '';
            if (href === '#' + current) activeLink = a;
        });
        if (activeLink) {
            positionPill(activeLink);
        } else if (navPill) {
            navPill.style.display = 'none';
        }
    }

    if (navLinks.length && sections.length) {
        window.addEventListener('scroll', updateActiveLink, { passive: true });
        updateActiveLink();

        navLinks.forEach(a => {
            a.addEventListener('click', e => {
                const href = a.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    document.querySelector(href)?.scrollIntoView({ behavior: 'smooth' });
                    if (mobileMenu) {
                        mobileMenu.classList.remove('open');
                        mobileBtn?.classList.remove('active');
                        if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    }

    const currentPath = window.location.pathname;
    navLinks.forEach(a => {
        const href = a.getAttribute('href') || '';
        if (href === currentPath || href === currentPath.replace(/\/$/, '')) {
            setActiveLink(a);
        }
    });
    document.querySelectorAll('.nav-mobile-link').forEach(a => {
        const href = a.getAttribute('href') || '';
        if (href === currentPath || href === currentPath.replace(/\/$/, '')) {
            a.classList.add('active');
        }
    });

    document.querySelectorAll('.nav-mobile-link').forEach(a => {
        a.addEventListener('click', e => {
            const href = a.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                document.querySelector(href)?.scrollIntoView({ behavior: 'smooth' });
                if (mobileMenu) {
                    mobileMenu.classList.remove('open');
                    mobileBtn?.classList.remove('active');
                    if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });

    const animEls = document.querySelectorAll('.fade-in, .fade-in-scale, .stagger');
    if (animEls.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
        animEls.forEach(el => observer.observe(el));
    }

    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const pct = bar.getAttribute('data-pct');
                if (pct) {
                    setTimeout(() => { bar.style.width = pct + '%'; }, 200);
                }
                skillObserver.unobserve(bar);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.skill-bar').forEach(bar => skillObserver.observe(bar));

    const expTabs = document.querySelectorAll('.exp-tab');
    const expLists = document.querySelectorAll('.exp-list');

    function switchExpTab(tab) {
        const value = tab.getAttribute('data-value');
        expTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        expLists.forEach(list => {
            list.style.display = list.getAttribute('data-type') === value ? 'flex' : 'none';
        });
    }

    expTabs.forEach(tab => {
        tab.addEventListener('click', () => switchExpTab(tab));
    });

    const firstTab = document.querySelector('.exp-tab');
    if (firstTab) switchExpTab(firstTab);

});

function initCodeHighlighting() {
    document.querySelectorAll('article.prose-custom code').forEach((codeBlock) => {
        if (codeBlock.closest('.code-block-wrapper')) return;

        const pre = codeBlock.closest('pre');
        const wrapper = pre || codeBlock.parentElement;
        const isBlock = pre || codeBlock.textContent.includes('\n');

        if (!isBlock) return;

        hljs.highlightElement(codeBlock);

        const copyBtn = document.createElement('button');
        copyBtn.className = 'code-copy-btn';
        copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>';
        copyBtn.title = 'Copy code';

        copyBtn.addEventListener('click', () => {
            const text = codeBlock.textContent;
            navigator.clipboard.writeText(text).then(() => {
                copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
                copyBtn.title = 'Copied!';
                setTimeout(() => {
                    copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>';
                    copyBtn.title = 'Copy code';
                }, 2000);
            });
        });

        wrapper.style.position = 'relative';
        wrapper.appendChild(copyBtn);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initCodeHighlighting();
    createIcons({ icons: { Check, Clipboard, Database, FileType, Globe, Layout, Palette, Search, Server, Shield, Smartphone, Zap } });
});
