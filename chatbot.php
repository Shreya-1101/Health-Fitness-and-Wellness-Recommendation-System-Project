<!-- CHAT BUTTON -->
<div class="chat-wrapper">

    <div class="chat-label">Need Help?</div>

    <div class="chat-btn" onclick="toggleChat()">
        <i class="fas fa-comment-dots"></i>

    </div>

</div>

<!-- CHATBOX -->
<div class="chatbox" id="chatbox">

    <div class="chat-header">
        BeWell Assistant
        <span onclick="toggleChat()">✖</span>
    </div>

    <div class="chat-body" id="chatBody">
        <div class="bot-msg">Hi 👋 How can I help you?</div>
    </div>

    <div class="chat-input">
        <input type="text" id="userInput" placeholder="Type message...">
        <button onclick="sendMessage()">➤</button>
    </div>

</div>

<script src="js/script.js"></script>

<script>
function toggleChat(){
    const chat = document.getElementById("chatbox");
    chat.style.display = (chat.style.display === "block") ? "none" : "block";
}

function sendMessage(){
    let input = document.getElementById("userInput");
    let msg = input.value.trim();

    if(msg === "") return;

    let chatBody = document.getElementById("chatBody");

    // USER MESSAGE
    chatBody.innerHTML += `<div class="user-msg">${msg}</div>`;

    input.value = "";

    // TYPING EFFECT
    chatBody.innerHTML += `<div class="bot-msg" id="typing">Typing...</div>`;

    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(() => {
        document.getElementById("typing").remove();

        let reply = getBotReply(msg);

        chatBody.innerHTML += `<div class="bot-msg">${reply}</div>`;
        chatBody.scrollTop = chatBody.scrollHeight;
    }, 1000);
}
document.getElementById("userInput").addEventListener("keydown", function(e){
    if(e.key === "Enter"){
        e.preventDefault();
        sendMessage();
    }
});

function getBotReply(msg){

    // 🔥 CLEAN INPUT (handles ?, !, . etc)
    msg = msg.toLowerCase().replace(/[^a-zA-Z0-9 ]/g, "");

    let words = msg.split(" ");

    /* ======================
       TRUST & SAFETY
    ====================== */
    if(msg.includes("is this website trusted") || msg.includes("is bewell safe"))
        return "Yes 👍 BeWell is safe and reliable.";

    if(msg.includes("is my data safe") || msg.includes("privacy"))
        return "Your data is secure 🔒 and used only to improve your experience.";

    if(msg.includes("is this accurate"))
        return "Plans are based on general health guidelines, but for medical conditions consult a doctor 👨‍⚕️";

    /* ======================
       ABOUT WEBSITE
    ====================== */
    if(msg.includes("how can this website help") || msg.includes("what does this website do"))
        return "BeWell helps you track your fitness, diet, water intake, and overall health progress 📊";

    if(msg.includes("why should i use this website") || msg.includes("benefit") || msg.includes("why use bewell"))
        return "BeWell provides personalized diet plans, exercise routines, and progress tracking 🌿";

    if(msg.includes("how does this work"))
        return "BeWell analyzes your details and gives personalized diet and exercise plans.";

    if(msg.includes("what is bewell"))
        return "BeWell is a wellness platform to track fitness, diet, and daily habits.";

    /* ======================
       DIET
    ====================== */
    if(msg.includes("diet"))
        return "You can check your personalized diet plan in the Diet section 🥗";

    if(msg.includes("what should i eat"))
        return "Eat a balanced diet with fruits, vegetables, protein, and healthy fats 🥗";

    if(msg.includes("are diet plans good") || msg.includes("is diet plan effective"))
        return "Yes 🥗 diet plans are balanced and designed for your goals.";

    /* ======================
       EXERCISE
    ====================== */
    if(msg.includes("exercise") || msg.includes("workout"))
        return "Visit the Exercise section to see your recommended workouts 💪";

    if(msg.includes("are exercise plans good") || msg.includes("is workout safe"))
        return "Yes 💪 workouts are beginner-friendly and safe.";

    /* ======================
       WEIGHT GOALS
    ====================== */
    if(msg.includes("weight loss"))
        return "For weight loss, follow a calorie deficit diet and regular exercise 🏃";

    if(msg.includes("weight gain"))
        return "For weight gain, eat protein-rich food and do strength training 💪";

    if(msg.includes("how long will it take"))
        return "Results depend on consistency, but you can see changes in a few weeks ⏳";

    /* ======================
       BMI & HEALTH
    ====================== */
    if(msg.includes("bmi"))
        return "You can calculate and update your BMI in the dashboard 📊";

    if(msg.includes("water"))
        return "Drink at least 2-3 liters of water daily 💧";

    /* ======================
       PROGRESS
    ====================== */
    if(msg.includes("progress"))
        return "Track your weight, steps, and water intake in Progress section 📈";

    /* ======================
       ACCOUNT
    ====================== */
    if(msg.includes("register"))
        return "You can create an account using the Register page ✨";

    if(msg.includes("login"))
        return "Login using your email and password 🔐";

    if(msg.includes("is it free"))
        return "Yes 🎉 basic features are free.";

    /* ======================
       PLAN
    ====================== */
    if(msg.includes("plan"))
        return "You can start your personalized plan from the dashboard 🚀";

    if(msg.includes("do i need gym"))
        return "No ❌ workouts are home-friendly.";

    if(msg.includes("is this for beginners"))
        return "Yes 👍 perfect for beginners.";

    /* ======================
       EXTRA
    ====================== */
    if(msg.includes("who created this"))
        return "This website is developed as a fitness management system project 💻";

    /* ======================
       GREETING (LAST)
    ====================== */
    if(words.includes("hi") || words.includes("hello"))
        return "Hello 👋 Welcome to BeWell! How can I help you?";

    /* ======================
       FALLBACK
    ====================== */
    return "🤖Hello! How can i help you?";
}

document.getElementById("userInput").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        e.preventDefault();  // prevents page reload
        sendMessage();       // call your function
    }
});

</script>