<div class="ai-chat-widget" data-ai-chat-widget>
    <button
        class="ai-chat-trigger"
        type="button"
        data-ai-chat-open
        aria-label="Buka Asisten AI"
        aria-expanded="false">
        <svg aria-hidden="true" viewBox="0 0 24 24">
            <path
                d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8.7 8.7 0 0 1-3.1-.6L4 20l1.6-3.8A7.3 7.3 0 0 1 4 11.5 7.5 7.5 0 0 1 12 4a7.5 7.5 0 0 1 8 7.5Z" />
            <path d="M8.5 12h.01M12 12h.01M15.5 12h.01" />
        </svg>
    </button>

    <section
        class="ai-chat-popup"
        data-ai-chat-panel
        aria-label="Asisten AI"
        aria-hidden="true"
        hidden>
        <header class="ai-chat-header">
            <div>
                <span class="ai-chat-status"></span>
                <h2>Asisten AI</h2>
                <p>Siap membantu Anda</p>
            </div>
            <button
                class="ai-chat-close"
                type="button"
                data-ai-chat-close
                aria-label="Tutup Asisten AI">
                &times;
            </button>
        </header>
        <div class="ai-chat-messages" data-ai-chat-messages aria-live="polite">
            <div class="ai-chat-message ai-chat-message--bot">
                <div class="ai-chat-avatar">AI</div>
                <div class="ai-chat-bubble">
                    Halo! Ada yang bisa saya bantu hari ini?
                </div>
            </div>
        </div>
        <form
            class="ai-chat-form"
            data-ai-chat-form
            data-endpoint="{{ url('kirim-pesan') }}">
            <input
                data-ai-chat-input
                type="text"
                placeholder="Tulis pesan Anda..."
                autocomplete="off"
                aria-label="Pesan untuk Asisten AI" />
            <button type="submit" data-ai-chat-send aria-label="Kirim pesan">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="m21 3-7.7 18-3.7-7.6L2 9.7 21 3Z" />
                    <path d="M9.6 13.4 21 3" />
                </svg>
            </button>
        </form>
    </section>
</div>