// selectors
// console.log(document.getElementById("main-title"));
// console.log(document.getElementsByTagName("p"));
// console.log(document.getElementsByClassName("btn"));

// console.log(document.querySelector("#main-title"));
// console.log(document.querySelector("h1"));
// console.log(document.querySelectorAll(".btn"));

// element properties
// const title = document.querySelector("h1");

// console.log(title.id);
// console.log(title.className);

// innerHTML / innerText / textContent
const firstSubHeader = document.querySelectorAll("h2")[0];
const secondSubHeader = document.querySelectorAll("h2")[1];
const thirdSubHeader = document.querySelectorAll("h2")[2];

firstSubHeader.innerHTML =
  'Hello World! <small class="text-muted">with subtitle</small>';
secondSubHeader.innerText = "Hello World!";
thirdSubHeader.textContent = "  Hello  ";

// style
const mainTitle = document.querySelector("#main-title");
mainTitle.style.background = "#333";
mainTitle.style.color = "#fff";
mainTitle.style.padding = "2rem";
// mainTitle.style.display = "none";
