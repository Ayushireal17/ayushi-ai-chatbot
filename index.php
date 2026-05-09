<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYUSHI AI | CHAT BOT</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="cursor-dot" id="cursorDot"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <circle cx="18" cy="18" r="7" fill="none" stroke="#d97706" stroke-width="1.2" />
            <circle cx="18" cy="18" r="2.2" fill="#fbbf24" />
        </svg></div>
    <div class="cursor-outline" id="cursorOutline"><svg viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
            <polygon points="27,2 43,2 52,11 52,27 52,43 43,52 27,52 11,52 2,43 2,27 2,11 11,2" fill="none" stroke="#f59e0b" stroke-width="1.2" opacity="0.85" />
            <rect x="23" y="2" width="8" height="3.5" rx="1" fill="#f59e0b" opacity="0.55" />
            <rect x="23" y="48.5" width="8" height="3.5" rx="1" fill="#f59e0b" opacity="0.55" />
            <rect x="2" y="23" width="3.5" height="8" rx="1" fill="#f59e0b" opacity="0.55" />
            <rect x="48.5" y="23" width="3.5" height="8" rx="1" fill="#f59e0b" opacity="0.55" />
        </svg></div>
    <div class="shimmer-surface"></div>

    <div class="app-shell">
        <header class="app-header">
            <div class="title-group">
                <div class="status-orb"></div>
                <h1>AYUSHI AI | <span class="metal-text">CHAT BOT</span></h1>
            </div>
            <div class="node-badge">KOLKATA.EXE</div>
        </header>

        <main class="chat-viewport" id="chatBox">
            <div class="message ai animate-in">System online.</div>
        </main>

        <footer class="dock">
            <div class="input-hub" id="inputWrapper">
                <input type="text" id="userInput" placeholder="Send a command..." autocomplete="off">
                <button id="sendBtn" type="button">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="white" stroke-width="3" style="pointer-events:none;">
                        <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            const dot = $('#cursorDot');
            const outline = $('#cursorOutline');
            const input = $('#userInput');
            const chatBox = $('#chatBox');

            $(window).on('mousemove', function(e) {
                dot.css({
                    left: e.clientX,
                    top: e.clientY
                });
                outline.stop().animate({
                    left: e.clientX,
                    top: e.clientY
                }, 200, 'linear');
            });

            function escapeHtml(text) {
                return $('<div>').text(text).html();
            }

            function typeText(element, text) {
                let i = 0;
                element.html('');
                const timer = setInterval(() => {
                    if (i < text.length) {
                        element.text(element.text() + text.charAt(i));
                        i++;
                        chatBox.scrollTop(chatBox[0].scrollHeight);
                    } else {
                        clearInterval(timer);
                    }
                }, 20);
            }

            // 3. SEND MESSAGE
            function sendMessage() {
                const msg = input.val().trim();
                if (!msg) return;

                chatBox.append(`<div class="message user animate-in">${escapeHtml(msg)}</div>`);
                input.val('');

                const loader = $("<div class='message ai loading'>" +
                    "<span class='p' style='animation-delay:0s'></span>" +
                    "<span class='p' style='animation-delay:0.2s'></span>" +
                    "<span class='p' style='animation-delay:0.4s'></span>" +
                    "</div>");
                chatBox.append(loader);
                chatBox.scrollTop(chatBox[0].scrollHeight);

                $.ajax({
                    url: 'process.php',
                    method: 'POST',
                    data: {
                        message: msg
                    },
                    dataType: 'text',
                    success: function(res) {
                        loader.remove();
                        const aiMsg = $("<div class='message ai animate-in'></div>");
                        chatBox.append(aiMsg);
                        typeText(aiMsg, res.trim());
                    },
                    error: function(xhr) {
                        loader.remove();
                        const errMsg = $("<div class='message ai animate-in' style='color:#f87171;'></div>");
                        chatBox.append(errMsg);
                        typeText(errMsg, 'Connection error. Is process.php reachable?');
                        chatBox.scrollTop(chatBox[0].scrollHeight);
                    }
                });
            }

            $('#sendBtn').on('click', sendMessage);
            input.on('keypress', function(e) {
                if (e.which === 13) sendMessage();
            });
            $('#inputWrapper').on('click', function(e) {
                if (!$(e.target).is('#sendBtn')) input.focus();
            });
        });
    </script>
</body>

</html>