// Hamburger menu toggle functionality
const hamburger = document.getElementById("hamburger");
const navLinks = document.getElementById("nav-links");
const overlay = document.createElement("div"); // Sukuriame overlay elementą
overlay.classList.add("overlay");
document.body.appendChild(overlay);

// Gauti visus meniu punktus
const menuItems = document.querySelectorAll(".nav-links li a");

// Funkcija uždaryti hamburger meniu
function closeMenu() {
  navLinks.classList.remove("active");
  overlay.classList.remove("active");
  document.body.classList.remove("menu-active");
}

// Atidarome/uždarome hamburger meniu
hamburger.addEventListener("click", () => {
  navLinks.classList.toggle("active");
  overlay.classList.toggle("active");
  document.body.classList.toggle("menu-active");
});

// Uždaryti meniu paspaudus overlay
overlay.addEventListener("click", closeMenu);

// Uždaryti meniu paspaudus ant bet kurio meniu punkto
menuItems.forEach((item) => {
  item.addEventListener("click", closeMenu);
});

// Iš karto paslėpti modalą
document.getElementById("contact-modal").style.display = "none";

// Gaukime modalą ir mygtukus
const modal = document.getElementById("contact-modal");
const modalBtn = document.getElementById("contact-modal-btn"); // Mygtukas "Susisiekti dabar"
const closeBtn = document.querySelector(".close-btn");

const submitBtn = document.querySelector(".cta-btn");

// Nukreipia į kontaktų sekciją paspaudus mygtuką
submitBtn.addEventListener("click", () => {
  modal.style.display = "none"; // Pirmiausia paslėpkime modalą
  document.getElementById("contact").scrollIntoView({ behavior: "smooth" }); // Perkelia į kontaktų sekciją
});

// Kalbos perjungiklis dideliems ekranams
const languageLinks = document.querySelectorAll(".language-switcher a");

languageLinks.forEach((link) => {
  link.addEventListener("click", () => {
    const selectedLang = link.getAttribute("href");
    window.location.href = selectedLang; // Atlik peradresavimą
  });
});

// Mobilus kalbos perjungiklis
const mobileLanguageLinks = document.querySelectorAll(
  ".language-switcher-mobile a"
);

mobileLanguageLinks.forEach((link) => {
  link.addEventListener("click", (event) => {
    event.preventDefault(); // Neleisk iš karto nukreipti
    const selectedLang = link.getAttribute("href");
    closeMenu(); // Uždaro hamburger meniu
    window.location.href = selectedLang; // Atlik peradresavimą mobiliajame meniu
  });
});

// Gauti visas korteles su klase "project"
const projects = document.querySelectorAll(".project");

// Pridėti paspaudimo įvykį kiekvienai kortelei
projects.forEach((project) => {
  project.addEventListener("click", () => {
    // Jei kortelė jau aktyvi (su aprašymu), uždarome ją
    if (project.classList.contains("active")) {
      project.classList.remove("active");
    } else {
      // Uždaryti kitas korteles
      projects.forEach((p) => p.classList.remove("active"));
      // Atidaryti dabartinę kortelę
      project.classList.add("active");
    }
  });
});

document
  .getElementById("contact-form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Neleidžia puslapiui persikrauti

    const formData = new FormData(this); // const naudojamas, nes formData reikšmė nekinta

    fetch("send_email.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        document.getElementById("form-result").innerHTML = result; // Rodo rezultatą toje pačioje formoje
      })
      .catch((error) => {
        document.getElementById("form-result").innerHTML =
          "Error sending message, please try again.";
      });
  });
