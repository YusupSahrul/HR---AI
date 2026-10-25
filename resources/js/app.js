import "./bootstrap";

// Keep landing-page interactions progressive: navigation remains usable without JS.
document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector("header");

    if (header) {
        const updateHeader = () => {
            header.classList.toggle("shadow-sm", window.scrollY > 12);
        };

        updateHeader();
        window.addEventListener("scroll", updateHeader, { passive: true });
    }

    document.querySelectorAll("[data-password-toggle]").forEach((toggle) => {
        toggle.addEventListener("click", () => {
            const input = document.querySelector(toggle.dataset.passwordToggle);
            const icon = toggle.querySelector("[data-password-icon]");
            if (!input) return;

            const isVisible = input.type === "password";
            input.type = isVisible ? "text" : "password";
            toggle.setAttribute(
                "aria-label",
                isVisible ? "Sembunyikan password" : "Tampilkan password",
            );

            if (icon) {
                icon.src = isVisible
                    ? "/assets/eye-slash-solid-full.svg"
                    : "/assets/eye-solid-full.svg";
            }
        });
    });

    const widget = document.querySelector("[data-ai-chat-widget]");
    if (widget) {
        const panel = widget.querySelector("[data-ai-chat-panel]");
        const openButton = widget.querySelector("[data-ai-chat-open]");
        const closeButton = widget.querySelector("[data-ai-chat-close]");
        const form = widget.querySelector("[data-ai-chat-form]");
        const input = widget.querySelector("[data-ai-chat-input]");
        const messages = widget.querySelector("[data-ai-chat-messages]");
        const sendButton = widget.querySelector("[data-ai-chat-send]");

        const setOpen = (isOpen) => {
            panel.hidden = !isOpen;
            panel.classList.toggle("active", isOpen);
            widget.classList.toggle("is-open", isOpen);
            openButton.setAttribute("aria-expanded", String(isOpen));
            openButton.setAttribute(
                "aria-label",
                isOpen ? "Asisten AI terbuka" : "Buka Asisten AI",
            );
            panel.setAttribute("aria-hidden", String(!isOpen));
            if (isOpen) {
                input.focus();
            }
        };

        const addMessage = (message, type, isError = false) => {
            const item = document.createElement("div");
            item.className = `ai-chat-message ai-chat-message--${type}`;

            if (type === "bot") {
                const avatar = document.createElement("div");
                avatar.className = "ai-chat-avatar";
                avatar.textContent = "AI";
                item.appendChild(avatar);
            }

            const bubble = document.createElement("div");
            bubble.className = `ai-chat-bubble${isError ? " ai-chat-bubble--error" : ""
                }`;
            bubble.textContent = message;
            item.appendChild(bubble);
            messages.appendChild(item);
            messages.scrollTop = messages.scrollHeight;
        };

        setOpen(false);
        openButton.addEventListener("click", () =>
            setOpen(!widget.classList.contains("is-open")),
        );
        closeButton.addEventListener("click", () => setOpen(false));
        form.addEventListener("submit", async (event) => {
            event.preventDefault();
            const message = input.value.trim();
            if (!message) {
                return;
            }

            addMessage(message, "user");
            input.value = "";
            input.disabled = true;
            sendButton.disabled = true;
            addMessage("Sedang mengetik...", "bot");
            const loading = messages.lastElementChild;
            try {
                const response = await fetch(form.dataset.endpoint, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]',
                        )?.content || "",
                    },
                    body: JSON.stringify({ message }),
                });

                const data = await response.json();
                loading.remove();
                if (!response.ok || data.status !== "success") {
                    throw new Error(data.message || "Gagal memproses pesan");
                }

                addMessage(data.reply, "bot");
            } catch (error) {
                loading.remove();
                addMessage(
                    error.message || "Error koneksi ke server Laravel.",
                    "bot",
                    true,
                );
            } finally {
                input.disabled = false;
                sendButton.disabled = false;
                input.focus();
            }
        });
    }
});
