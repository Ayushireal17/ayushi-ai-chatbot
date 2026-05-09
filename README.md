# 🤖 Ayushi AI | Chatbot

A sleek, dark-themed AI chatbot built with PHP and powered by the **Google Gemini API**. Features a gold & amber aesthetic, a custom octo-scanner cursor, and a smooth typewriter response effect.

---

## ✨ Features

- 🧠 Powered by Google Gemini 2.5 Flash Lite
- 🎨 Gold & amber dark UI with metallic gradients
- ⌨️ Typewriter effect for AI responses
- 🔭 Custom animated octo-scanner cursor
- 💬 Clean chat bubble interface
- 📡 Real-time AJAX messaging (no page reload)
- 🧹 Auto-strips Markdown from AI responses for clean output

---

## 🗂️ Project Structure

```
ayushi-ai-chatbot/
├── index.php       # Frontend — UI, chat interface, AJAX logic
├── style.css       # All styles, animations, cursor, theme
└── process.php     # Backend — sends message to Gemini API, returns response
```

---

## ⚙️ Setup & Installation

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or any PHP local server)
- A Google Gemini API key from [Google AI Studio](https://aistudio.google.com)
- PHP 7.4 or higher
- cURL enabled in PHP

### Steps

**1. Clone or download this repository**
```bash
git clone https://github.com/your-username/ayushi-ai-chatbot.git
```
Or click **Code → Download ZIP** and extract it.

**2. Move the folder into your htdocs directory**
```
C:\xampp\htdocs\ayushi-ai-chatbot\
```

**3. Add your Gemini API key**

Open `process.php` and replace the placeholder with your real key:
```php
$apiKey = "YOUR_GEMINI_API_KEY_HERE";
```
Get your free key at [aistudio.google.com](https://aistudio.google.com).

**4. Start Apache in XAMPP**

Open the XAMPP Control Panel and click **Start** next to Apache.

**5. Open in your browser**
```
http://localhost/ayushi-ai-chatbot/index.php
```

---

## 🔑 Getting a Gemini API Key

1. Go to [aistudio.google.com](https://aistudio.google.com)
2. Sign in with your Google account
3. Click **Get API Key** → **Create API Key**
4. Copy the key and paste it into `process.php`

> **Free tier limit:** Gemini 2.5 Flash Lite gives you **1,000 requests/day** at no cost.

---

## ⚠️ Important — Keep Your API Key Safe

- **Never** commit your real API key to a public repository
- The `process.php` in this repo uses a placeholder — add your key locally only
- If you accidentally expose a key, revoke it immediately at [aistudio.google.com](https://aistudio.google.com) and generate a new one

---

## 🛠️ Built With

| Technology | Purpose |
|---|---|
| PHP | Backend & Gemini API communication |
| cURL | HTTP requests to Gemini |
| jQuery | AJAX, DOM manipulation, animations |
| HTML & CSS | UI layout and styling |
| Google Gemini API | AI response generation |



---

##  Author

**Ayushi** — built with 💛 from Kolkata
