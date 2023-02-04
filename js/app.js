const btn = document.querySelector('.talk');
const content = document.querySelector('.content');

function speak(sentence) {
    const text_speak = new SpeechSynthesisUtterance(sentence);

    text_speak.volume = 1;
    text_speak.rate = 0.9;
    text_speak.pitch = 1;
    text_speak.voice = window.speechSynthesis.getVoices()[17];

    window.speechSynthesis.speak(text_speak);
}

function wishMe() {
    var day = new Date();
    var hr = day.getHours();

    if(hr >= 0 && hr < 12) {
        speak("Good Morning Boss");
    }

    else if(hr == 12) {
        speak("Good noon Boss");
    }

    else if(hr > 12 && hr <= 17) {
        speak("Good Afternoon Boss");
    }

    else {
        speak("Good Evening Boss");
    }
}

window.addEventListener('load', ()=>{
    speak("Activating Tamasha");
    speak("Taste matters");
    wishMe();
})

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

recognition.onresult = (event) => {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    content.textContent = transcript;
    speakThis(transcript.toLowerCase());
}

btn.addEventListener('click', ()=>{
    recognition.start();
})

function speakThis(message) {
    const speech = new SpeechSynthesisUtterance();

    speech.text = "I did not understand what you said please try again";

    if(message.includes('hi') || message.includes('namaskar') || message.includes('are you there') || message.includes('hello')) {
        const finalText = "yes sirr.myself tamasha.How can i help you";
        speech.text = finalText;
    }

    else if(message.includes('how are you') || message.includes('tamasha how are you')) {
        const finalText = "I am fine. Sir tell me about your test today";
        speech.text = finalText;
    }

    else if(message.includes('tamasha Are You There')) {
        const finalText = "At your service sirr";
        speech.text = finalText;
    }

    else if(message.includes('tamasha open menu')) {
        window.open("http://localhost/tamasha_restaurant/menu.php");
        const finalText = "Opening Today's menu";
        speech.text = finalText;
    }
    else if(message.includes('back to home')) {
        window.open("http://localhost/tamasha_restaurant/index.php");
        const finalText = "Going Back to the Home page";
        speech.text = finalText;
    }
    else if(message.includes('tamasha book a table for us')) {
        window.open("http://localhost/tamasha_restaurant/book.php");
        const finalText = "ok boss....redirecting to that page";
        speech.text = finalText;
    }
    else if(message.includes('tamasha what is your location')) {
        window.open("https://goo.gl/maps/LjswcL94Nd7nmVRq5");
        const finalText = "boss we are located at naihati.redirecting you to google";
        speech.text = finalText;
    }


    // else if(message.includes('open instagram')) {
    //     window.open("https://instagram.com", "_blank");
    //     const finalText = "Opening instagram";
    //     speech.text = finalText;
    // }

    // else if(message.includes('what is') || message.includes('who is') || message.includes('what are')) {
    //     window.open(`https://www.google.com/search?q=${message.replace(" ", "+")}`, "_blank");
    //     const finalText = "This is what i found on internet regarding " + message;
    //     speech.text = finalText;
    // }

    // else if(message.includes('wikipedia')) {
    //     window.open(`https://en.wikipedia.org/wiki/${message.replace("wikipedia", "")}`, "_blank");
    //     const finalText = "This is what i found on wikipedia regarding " + message;
    //     speech.text = finalText;
    // }

    // else if(message.includes('time')) {
    //     const time = new Date().toLocaleString(undefined, {hour: "numeric", minute: "numeric"})
    //     const finalText = time;
    //     speech.text = finalText;
    // }

    // else if(message.includes('date')) {
    //     const date = new Date().toLocaleString(undefined, {month: "short", day: "numeric"})
    //     const finalText = date;
    //     speech.text = finalText;
    // }

    // else if(message.includes('calculator')) {
    //     window.open('Calculator:///')
    //     const finalText = "Opening Calculator";
    //     speech.text = finalText;
    // }

    // else {
    //     window.open(`https://www.google.com/search?q=${message.replace(" ", "+")}`, "_blank");
    //     const finalText = "I found some information for " + message + " on google";
    //     speech.text = finalText;
    // }
    else {
        window.open("http://localhost/tamasha_restaurant/index.php");
        const finalText = "I cannot catch up,redirecting u to home page";
        speech.text = finalText;
    }

    speech.volume = 1;
    speech.pitch = 1;
    speech.rate = 1;

    window.speechSynthesis.speak(speech);
}