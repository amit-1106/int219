<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chatbot</title>
    <style>
        .tech{
            margin-top: 5rem;
        }

        /* Chatbot Styles */
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index:2;
        }

        .chat-icon i {
            color: white;
            font-size: 24px;
        }

        .chat-container {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .chat-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-messages {
            height: 380px;
            padding: 15px;
            overflow-y: auto;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
        }

        .user-message {
            background-color: #e3f2fd;
            margin-left: auto;
        }

        .bot-message {
            background-color: #f5f5f5;
        }

        .chat-input {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .chat-input button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Chatbot UI -->
    <div class="chat-icon" id="chatIcon">
        <i class="fas fa-comments"></i>
    </div>
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <h3>AgriTech Assistant</h3>
            <i class="fas fa-times" id="closeChat"></i>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="message bot-message">
                Hello! I'm your AgriTech assistant. How can I help you today?
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="Type your message...">
            <button id="sendMessage">Send</button>
        </div>
    </div>

    <script>
        // Chatbot functionality
        const chatIcon = document.getElementById('chatIcon');
        const chatContainer = document.getElementById('chatContainer');
        const closeChat = document.getElementById('closeChat');
        const chatMessages = document.getElementById('chatMessages');
        const userInput = document.getElementById('userInput');
        const sendMessage = document.getElementById('sendMessage');

        // Replace with your actual Gemini API key
        const API_KEY = 'AIzaSyCH0wILSl_XOWjfFdZzSBpbkAJw0Pe0veA';

        chatIcon.addEventListener('click', () => {
            chatContainer.style.display = 'block';
        });

        closeChat.addEventListener('click', () => {
            chatContainer.style.display = 'none';
        });

        function addMessage(message, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
            messageDiv.textContent = message;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        async function sendToGemini(message) {
            try {
                const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=${API_KEY}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        contents: [{
                            parts: [{
                                text: `You are an agricultural assistant. Provide a concise answer to this question in exactly 50 words or less: ${message}. Do not use asterisks, bullet points, or formatting. Give only the direct answer without any introduction or conclusion.`
                            }]
                        }],
                        generationConfig: {
                            temperature: 0.2,
                            topK: 10,
                            topP: 0.7,
                            maxOutputTokens: 100,
                        },
                        safetySettings: [
                            {
                                category: "HARM_CATEGORY_HARASSMENT",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            },
                            {
                                category: "HARM_CATEGORY_HATE_SPEECH",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            },
                            {
                                category: "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            },
                            {
                                category: "HARM_CATEGORY_DANGEROUS_CONTENT",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            }
                        ]
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    console.error('API Error:', errorData);
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('API Response:', data); // For debugging

                if (data.candidates && data.candidates[0] && data.candidates[0].content) {
                    return data.candidates[0].content.parts[0].text;
                } else {
                    throw new Error('Invalid response format from Gemini API');
                }
            } catch (error) {
                console.error('Error:', error);
                return 'I apologize, but I encountered an error. Please try again or rephrase your question.';
            }
        }

        sendMessage.addEventListener('click', async () => {
            const message = userInput.value.trim();
            if (message) {
                addMessage(message, true);
                userInput.value = '';
                
                // Show loading state
                const loadingMessage = document.createElement('div');
                loadingMessage.className = 'message bot-message';
                loadingMessage.textContent = 'Thinking...';
                chatMessages.appendChild(loadingMessage);
                
                const response = await sendToGemini(message);
                
                // Remove loading message
                chatMessages.removeChild(loadingMessage);
                
                addMessage(response);
            }
        });

        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage.click();
            }
        });
    </script>
</body>
</html>