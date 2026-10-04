<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Langflow via Controller</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px; }
        .chat-container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 20px; }
        .chat-box { height: 350px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 6px; padding: 15px; background: #fafafa; margin-bottom: 15px; }
        .message { margin-bottom: 12px; }
        .message.user { text-align: right; }
        .message.user .text { background: #007bff; color: white; display: inline-block; padding: 8px 12px; border-radius: 12px 12px 0 12px; }
        .message.bot { text-align: left; }
        .message.bot .text { background: #e9ecef; color: #333; display: inline-block; padding: 8px 12px; border-radius: 12px 12px 12px 0; }
        .input-group { display: flex; gap: 10px; }
        .input-group input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 6px; }
        .input-group button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .input-group button:disabled { background: #aaa; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="chat-container">
    <h3>Asisten AI (Langflow via Laravel)</h3>
    <div id="chat-box" class="chat-box"></div>

    <div class="input-group">
        <input type="text" id="user-input" placeholder="Ketik pesan Anda di sini..." onkeypress="handleKeyPress(event)">
        <button id="send-btn" onclick="kirimPesan()">Kirim</button>
    </div>
</div>

<script>
async function kirimPesan() {
    const input = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');
    const chatBox = document.getElementById('chat-box');
    const message = input.value.trim();

    if (!message) return;

    // 1. Tampilkan pesan pengguna di layar
    chatBox.innerHTML += `
        <div class="message user">
            <div class="text">${escapeHtml(message)}</div>
        </div>
    `;
    input.value = '';
    input.disabled = true;
    sendBtn.disabled = true;
    chatBox.scrollTop = chatBox.scrollHeight;

    // 2. Tampilkan indikator loading
    const loadingId = 'loading-' + Date.now();
    chatBox.innerHTML += `
        <div class="message bot" id="${loadingId}">
            <div class="text"><em>Sedang mengetik...</em></div>
        </div>
    `;
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        // 3. Kirim pesan ke route Laravel (/kirim-pesan)
        const response = await fetch("{{ url('kirim-pesan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        });

        const data = await response.json();
        document.getElementById(loadingId).remove();

        if (response.ok && data.status === 'success') {
            chatBox.innerHTML += `
                <div class="message bot">
                    <div class="text">${escapeHtml(data.reply)}</div>
                </div>
            `;
        } else {
            chatBox.innerHTML += `
                <div class="message bot">
                    <div class="text" style="color: red;">Error: ${escapeHtml(data.message || 'Gagal memproses pesan')}</div>
                </div>
            `;
        }
    } catch (error) {
        document.getElementById(loadingId).remove();
        chatBox.innerHTML += `
            <div class="message bot">
                <div class="text" style="color: red;">Error koneksi ke server Laravel.</div>
            </div>
        `;
    } finally {
        input.disabled = false;
        sendBtn.disabled = false;
        input.focus();
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        kirimPesan();
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
}
</script>

</body>
</html>