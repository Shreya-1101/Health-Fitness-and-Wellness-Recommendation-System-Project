
//I am not using jQuery for this project, but I will write vanilla JS for all interactions to keep it lightweight and efficient.

/* ===============================
   TAB SWITCHING FUNCTION
=============================== */
function openTab(tabName, btn){

    // Hide all tab contents
    document.querySelectorAll(".tab-content").forEach(tab => {
        tab.style.display = "none";
    });

    // Remove active class from all buttons
    document.querySelectorAll(".tab-btn").forEach(button => {
        button.classList.remove("active");
    });

    // Show selected tab safely
    let selectedTab = document.getElementById(tabName);
    if(selectedTab){
        selectedTab.style.display = "block";
    }

    // Highlight active button
    if(btn){
        btn.classList.add("active");
    }
}


/* ===============================
   OPEN MODAL FUNCTION
=============================== */
function openModal(type){

    let modal = document.getElementById("modal");
    let title = document.getElementById("modalTitle");
    let inputType = document.getElementById("entryType");

    if(modal && title && inputType){

        modal.style.display = "flex";

        // Set hidden input value
        inputType.value = type;

        // Dynamic titles
        let titles = {
            weight: "Add Weight Entry",
            bmi: "Add BMI Entry",
            water: "Add Water Intake",
            steps: "Add Steps Count"
        };

        title.innerText = titles[type] || "Add Entry";
    }
}


/* ===============================
   CLOSE MODAL FUNCTION
=============================== */
function closeModal(){

    let modal = document.getElementById("modal");

    if(modal){
        modal.style.display = "none";
    }
}


/* ===============================
   CLOSE MODAL ON OUTSIDE CLICK
   (Professional UX)
=============================== */
window.onclick = function(event){

    let modal = document.getElementById("modal");

    if(event.target === modal){
        modal.style.display = "none";
    }
};