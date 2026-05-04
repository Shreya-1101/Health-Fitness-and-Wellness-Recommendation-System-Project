// FAQ Accordion Toggle
const questions = document.querySelectorAll(".faq-question");

questions.forEach(q => {
    q.addEventListener("click", () => {
        const answer = q.nextElementSibling;

        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            q.querySelector("span").textContent = "+";
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            q.querySelector("span").textContent = "-";
        }
    });
});