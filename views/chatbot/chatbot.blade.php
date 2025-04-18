<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Add Anime.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trợ lý Agile Homestay</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Chatbot Container -->
<div class="chatbot-container" id="chatbot-container">
  <div class="chatbot-header">
    <h3 class="chatbot-title">Trợ lý Agile Homestay</h3>
    <button class="chatbot-toggle" id="chatbot-toggle">
      <i class="fas fa-minus" id="toggle-icon"></i>
    </button>
  </div>
  <div class="chatbot-body">
    <div class="chat-messages" id="chat-messages">
      <div class="message bot-message message-appear">
        Xin chào! Tôi là trợ lý ảo của Agile Homestay. Tôi có thể giúp gì cho bạn?
      </div>
      <div class="suggestion-chips">
        <div class="suggestion-chip" onclick="sendSuggestion('Làm sao để đặt phòng?')">Làm sao để đặt phòng?</div>
        <div class="suggestion-chip" onclick="sendSuggestion('Chính sách hủy phòng')">Chính sách hủy phòng</div>
        <div class="suggestion-chip" onclick="sendSuggestion('Tôi cần hỗ trợ')">Tôi cần hỗ trợ</div>
      </div>
    </div>
  </div>
  <div class="chatbot-footer">
    <input type="text" class="chatbot-input" id="chatbot-input" placeholder="Nhập tin nhắn..." onkeypress="handleKeyPress(event)">
    <button class="chatbot-send" onclick="sendMessage()">
      <i class="fas fa-paper-plane"></i>
    </button>
  </div>
</div>

<div class="chatbot-button" id="chatbot-button">
  <i class="fas fa-comment"></i>
</div>

<style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    
    /* Chatbot Container */
    .chatbot-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 350px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      max-height: 500px;
      transition: all 0.3s ease;
      display: none;
    }
    
    .chatbot-header {
      background-color: #0770cd;
      color: white;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .chatbot-title {
      font-weight: 600;
      font-size: 16px;
      margin: 0;
    }
    
    .chatbot-toggle {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      font-size: 18px;
    }
    
    .chatbot-body {
      padding: 15px;
      flex-grow: 1;
      overflow-y: auto;
      max-height: 300px;
    }
    
    .chat-messages {
      display: flex;
      flex-direction: column;
    }
    
    .message {
      margin-bottom: 10px;
      max-width: 80%;
      padding: 10px 15px;
      border-radius: 18px;
      line-height: 1.4;
      font-size: 14px;
    }
    
    .bot-message {
      background-color: #f0f2f5;
      color: #333;
      align-self: flex-start;
      border-bottom-left-radius: 5px;
    }
    
    .user-message {
      background-color: #0770cd;
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 5px;
    }
    
    .suggestion-chips {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 10px;
    }
    
    .suggestion-chip {
      background-color: #e9f5ff;
      color: #0770cd;
      border: 1px solid #0770cd;
      border-radius: 18px;
      padding: 6px 12px;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .suggestion-chip:hover {
      background-color: #0770cd;
      color: white;
    }
    
    .chatbot-footer {
      padding: 10px 15px;
      border-top: 1px solid #eee;
      display: flex;
    }
    
    .chatbot-input {
      flex-grow: 1;
      border: 1px solid #ddd;
      border-radius: 20px;
      padding: 8px 15px;
      outline: none;
      font-size: 14px;
    }
    
    .chatbot-send {
      background-color: #0770cd;
      color: white;
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      margin-left: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .chatbot-send:hover {
      background-color: #0559a9;
    }
    
    /* Chatbot Button */
    .chatbot-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background-color: #0770cd;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 999;
      transition: all 0.3s;
    }
    
    .chatbot-button i {
      color: white;
      font-size: 24px;
    }
    
    .chatbot-minimized {
      height: 60px;
      overflow: hidden;
    }
    
    @media (max-width: 768px) {
      .chatbot-container {
        width: 90%;
        right: 5%;
        left: 5%;
      }
    }
    
    @keyframes slideIn {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeInUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes pulseGlow {
      0% { box-shadow: 0 0 0 0 rgba(7, 112, 205, 0.4); }
      70% { box-shadow: 0 0 0 10px rgba(7, 112, 205, 0); }
      100% { box-shadow: 0 0 0 0 rgba(7, 112, 205, 0); }
    }

    .chatbot-container {
      transform-origin: bottom right;
      animation: slideIn 0.5s ease-out;
    }

    .message {
      opacity: 0;
      transform: translateY(20px);
    }

    .message-appear {
      animation: fadeInUp 0.5s ease forwards;
    }

    .bot-message {
      border-left: 4px solid #0770cd;
      transition: all 0.3s ease;
    }

    .bot-message:hover {
      transform: translateX(5px);
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .user-message {
      border-right: 4px solid #0559a9;
      transition: all 0.3s ease;
    }

    .user-message:hover {
      transform: translateX(-5px);
      box-shadow: -2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .suggestion-chip {
      transform: scale(0);
      animation: popIn 0.4s ease forwards;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .suggestion-chip:hover {
      transform: scale(1.05);
      box-shadow: 0 2px 8px rgba(7, 112, 205, 0.2);
    }

    .chatbot-button {
      animation: pulseGlow 2s infinite;
    }

    .chatbot-button:hover {
      transform: scale(1.1);
      box-shadow: 0 0 15px rgba(7, 112, 205, 0.5);
    }

    .chatbot-send {
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .chatbot-send:hover {
      transform: scale(1.1) rotate(15deg);
    }

    .loading-dots {
      display: flex;
      gap: 4px;
      padding-left: 8px;
    }

    .loading-dots span {
      width: 8px;
      height: 8px;
      background: #0770cd;
      border-radius: 50%;
      display: inline-block;
      animation: bounce 0.6s infinite alternate;
    }

    .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
    .loading-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes bounce {
      to { transform: translateY(-8px); }
    }

    @keyframes popIn {
      from { transform: scale(0); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    ss
    @media (max-width: 768px) {
      .chatbot-container {
        width: 90%;
        right: 5%;
        left: 5%;
        max-height: 80vh;
      }
    }
</style>

<!-- Update the script section to use Anime.js -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const chatbotButton = document.getElementById('chatbot-button');
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const toggleIcon = document.getElementById('toggle-icon');
    const chatMessages = document.getElementById('chat-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    
    // OpenRouter API configuration
    
    
    // Show chatbot with animation when button is clicked
    chatbotButton.addEventListener('click', function() {
      chatbotContainer.style.display = 'flex';
      chatbotButton.style.display = 'none';
      void chatbotContainer.offsetWidth;
      chatbotContainer.classList.add('message-appear');

      setTimeout(() => {
        chatbotInput.focus();
      }, 300);
    });
  
    chatbotToggle.addEventListener('click', function() {
      if (chatbotContainer.classList.contains('chatbot-minimized')) {
        chatbotContainer.classList.remove('chatbot-minimized');
        toggleIcon.classList.remove('fa-plus');
        toggleIcon.classList.add('fa-minus');
        chatbotContainer.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
      } else {
        chatbotContainer.classList.add('chatbot-minimized');
        toggleIcon.classList.remove('fa-minus');
        toggleIcon.classList.add('fa-plus');
        chatbotContainer.style.transition = 'all 0.3s cubic-bezier(0.6, -0.28, 0.735, 0.045)';
      }
    });
    
    window.sendMessage = function() {
      const message = chatbotInput.value.trim();
      if (message === '') return;
  
      addMessage(message, 'user', true);
      
 
      chatbotInput.value = '';
      
      
      processMessage(message);
    }
    
    // Handle Enter key press
    window.handleKeyPress = function(event) {
      if (event.key === 'Enter') {
        sendMessage();
      }
    }
    
    // Send suggestion function with animation
    window.sendSuggestion = function(suggestion) {
      addMessage(suggestion, 'user', true);
      processMessage(suggestion);
    }
    
    // Add message to chat with animation option
    function addMessage(text, sender, animate = false) {
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('message');
      messageDiv.classList.add(sender + '-message');
      
      // Add animation class if requested
      if (animate) {
        messageDiv.classList.add('message-appear');
      }
      
      messageDiv.textContent = text;
      
      chatMessages.appendChild(messageDiv);
      
      // Scroll to bottom with smooth animation
      chatMessages.scrollTo({
        top: chatMessages.scrollHeight,
        behavior: 'smooth'
      });
      
      return messageDiv;
    }
    
    // Add loading message with animated dots
    function addLoadingMessage() {
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('message', 'bot-message', 'loading-message');
      messageDiv.innerHTML = 'Đang xử lý<div class="loading-dots"><span></span><span></span><span></span></div>';
      
      chatMessages.appendChild(messageDiv);
      chatMessages.scrollTo({
        top: chatMessages.scrollHeight,
        behavior: 'smooth'
      });
      
      return messageDiv;
    }
    
    // Add suggestion chips with staggered animation
    function addSuggestions(suggestions) {
      const suggestionsDiv = document.createElement('div');
      suggestionsDiv.classList.add('suggestion-chips');
      
      suggestions.forEach((suggestion, index) => {
        const chip = document.createElement('div');
        chip.classList.add('suggestion-chip');
        chip.textContent = suggestion;
        chip.style.animationDelay = `${index * 0.1}s`;
        
        chip.onclick = function() {
  
          this.style.transform = 'scale(0.95)';
          setTimeout(() => {
            sendSuggestion(suggestion);
          }, 150);
        };
        
        suggestionsDiv.appendChild(chip);
      });
      
      chatMessages.appendChild(suggestionsDiv);
      chatMessages.scrollTo({
        top: chatMessages.scrollHeight,
        behavior: 'smooth'
      });
    }
    
    // Process message with AI and animations
    async function processMessage(message) {
      // Show animated loading indicator
      const loadingMessage = addLoadingMessage();
      
      try {
        // Create request payload for OpenRouter API
        const payload = {
          model: modelId,
          messages: [
            {
              role: 'system',
              content: 'Bạn là trợ lý ảo của Agile Homestay, một nền tảng đặt phòng homestay. Hãy trả lời bằng tiếng Việt, ngắn gọn, thân thiện và hữu ích. Tập trung vào thông tin về đặt phòng, hủy phòng, chính sách và dịch vụ của Agile Homestay.'
            },
            {
              role: 'user',
              content: message
            }
          ],
          temperature: 0.7,
          max_tokens: 250
        };
        
        // Call OpenRouter API
        const response = await fetch(apiUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${apiKey}`
          },
          body: JSON.stringify(payload)
        });
        
        // Remove loading message
        if (loadingMessage && loadingMessage.parentNode) {
          chatMessages.removeChild(loadingMessage);
        }
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error('API Error:', errorText);
          throw new Error(`API request failed: ${response.status}`);
        }
        
        const data = await response.json();
        
        // Process API response with animation
        if (data && data.choices && data.choices.length > 0 && data.choices[0].message) {
          const botResponse = data.choices[0].message.content;
          
          // Add bot message with animation
          addMessage(botResponse, 'bot', true);
          
          // Add relevant suggestions based on the message context with delay for better UX
          setTimeout(() => {
            addContextualSuggestions(message);
          }, 500);
        } else {
          throw new Error('Invalid API response format');
        }
      } catch (error) {
        console.error('Error:', error);
        
        // Remove loading message if it's still there
        if (loadingMessage && loadingMessage.parentNode) {
          chatMessages.removeChild(loadingMessage);
        }
        
        // Use fallback responses with animation
        useFallbackResponse(message);
      }
    }
    
  
    function addContextualSuggestions(message) {
      let suggestions = [];
      const lowerMessage = message.toLowerCase();
      
      if (lowerMessage.includes('đặt phòng') || lowerMessage.includes('book')) {
        suggestions = ['Xem homestay', 'Chính sách giá', 'Thanh toán như thế nào?'];
      } 
      else if (lowerMessage.includes('hủy phòng') || lowerMessage.includes('cancel')) {
        suggestions = ['Làm sao để hủy?', 'Hoàn tiền mất bao lâu?', 'Liên hệ hỗ trợ'];
      }
      else if (lowerMessage.includes('thanh toán') || lowerMessage.includes('payment')) {
        suggestions = ['Phương thức thanh toán', 'Hoàn tiền', 'Xuất hóa đơn'];
      }
      else if (lowerMessage.includes('dịch vụ') || lowerMessage.includes('service')) {
        suggestions = ['Dịch vụ đưa đón', 'Dịch vụ ăn uống', 'Dịch vụ giặt ủi'];
      }
      else if (lowerMessage.includes('hỗ trợ') || lowerMessage.includes('support') || lowerMessage.includes('help')) {
        suggestions = ['Vấn đề đặt phòng', 'Vấn đề thanh toán', 'Khiếu nại dịch vụ'];
      }
      else {
        suggestions = ['Đặt phòng', 'Hủy phòng', 'Liên hệ hỗ trợ'];
      }
      
      addSuggestions(suggestions);
    }
  
    function useFallbackResponse(message) {
      let response = '';
      const lowerMessage = message.toLowerCase();
      
      if (lowerMessage.includes('đặt phòng') || lowerMessage.includes('book')) {
        response = 'Để đặt phòng, bạn có thể truy cập trang chủ, chọn homestay và phòng mong muốn, sau đó nhấn nút "Đặt phòng". Bạn sẽ cần điền thông tin cá nhân và phương thức thanh toán để hoàn tất đặt phòng.';
      } 
      else if (lowerMessage.includes('hủy phòng') || lowerMessage.includes('cancel')) {
        response = 'Bạn có thể hủy đặt phòng miễn phí trước 24 giờ so với thời gian check-in. Sau thời gian này, bạn sẽ bị tính phí 50% tổng giá trị đơn đặt phòng. Để hủy, vui lòng vào mục "Đơn đặt phòng" trong tài khoản của bạn.';
      }
      else if (lowerMessage.includes('thanh toán') || lowerMessage.includes('payment')) {
        response = 'Agile Homestay chấp nhận nhiều phương thức thanh toán bao gồm thẻ tín dụng/ghi nợ, chuyển khoản ngân hàng và ví điện tử như Momo, ZaloPay. Bạn có thể thanh toán khi đặt phòng hoặc tại homestay tùy theo chính sách của từng chỗ nghỉ.';
      }
      else if (lowerMessage.includes('dịch vụ') || lowerMessage.includes('service')) {
        response = 'Agile Homestay cung cấp nhiều dịch vụ như đưa đón sân bay, giặt ủi, dọn phòng hàng ngày, và các dịch vụ ăn uống. Các dịch vụ có thể khác nhau tùy theo từng homestay, bạn có thể xem chi tiết trong phần mô tả của mỗi homestay.';
      }
      else if (lowerMessage.includes('hỗ trợ') || lowerMessage.includes('support') || lowerMessage.includes('help')) {
        response = 'Bạn cần hỗ trợ gì? Bạn có thể liên hệ với chúng tôi qua số điện thoại 1900-1234 hoặc email support@agilehomestay.com. Đội ngũ hỗ trợ của chúng tôi sẵn sàng phục vụ 24/7.';
      }
      else if (lowerMessage.includes('giá') || lowerMessage.includes('price')) {
        response = 'Giá phòng tại Agile Homestay dao động tùy theo loại phòng, vị trí và thời điểm đặt. Chúng tôi thường xuyên có các chương trình khuyến mãi và giảm giá cho khách hàng thân thiết. Bạn có thể xem giá chi tiết khi tìm kiếm và chọn phòng.';
      }
      else if (lowerMessage.includes('check-in') || lowerMessage.includes('check-out')) {
        response = 'Thời gian check-in tiêu chuẩn là từ 14:00 và check-out là trước 12:00 trưa. Nếu bạn cần check-in sớm hoặc check-out muộn, vui lòng liên hệ trước với homestay để được hỗ trợ, có thể phát sinh phí phụ thu.';
      }
      else {
        response = 'Xin lỗi, tôi không hiểu câu hỏi của bạn. Bạn có thể hỏi về cách đặt phòng, chính sách hủy phòng, thanh toán hoặc các dịch vụ khác của Agile Homestay.';
      }
      addMessage(response, 'bot', true);
      setTimeout(() => {
        addContextualSuggestions(message);
      }, 500);
    }
  });
</script>

</body>
</html>