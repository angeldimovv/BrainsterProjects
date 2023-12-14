// se inicializira objekt po ime filters vo koj ima 3 promenlivi so vrednosti koj posochuvaat do svojte DOM elementi
const filters = {
  marketing: document.querySelector("#marketingFilter"),
  coding: document.querySelector("#codingFilter"),
  design: document.querySelector("#designFilter"),
};

// ova e selektor za kartichkite koj gi selektira site elementi so (.col) classa i gi vrachja vo lista
const elementList = document.querySelectorAll(".col");

// funkcija koja ja dodava klasata .d-none (display:none) na kartichkite
function hideCards() {
  elementList.forEach((card) => {
    card.classList.add("d-none");
  });
}

// obratno od gornata funkcija, ovaa ja odstranuva klasata .d-none
function showCards() {
  elementList.forEach((card) => {
    card.classList.remove("d-none");
  });
}

// funkcija koja odi vo ciklus niz site filteri i ja odstranuva klasata .active (klasa koja vizuelno go oznachuva filterot koj e selektiran)
function removeActive() {
  for (const filterType in filters) {
    document
      .querySelector(`.${filterType}-Selector`)
      .classList.remove("active");
  }
}

// funkcija koja im dodava EventListener-i na site filteri koj chekaat da se sluchi nekoj tip na nastan
function addEventListeners(filter, filterType) {
  // toj tip na nastan tuka e "change" koj gi gleda "input, select i textarea" elementite za bilo kakva promena od strana na
  // tuka taa promena e na input (checkbox) elementi
  filter.addEventListener("change", () => {
    // standardni if izrazi koj proveruvaat ako nekoj od filterite e odbran da se izvrshat slednite funkcii
    if (filter.checked) {
      // se krijat site kartichki
      hideCards();
      // potoa se selektiraat site momentalni kartichki so istiot filter i im se odstranuva klasata .d-none
      document.querySelectorAll(`.${filterType}`).forEach((card) => {
        card.classList.remove("d-none");
      });
      // istiot ciklus od dve 'funkcii' se pravi i so klasata .active
      removeActive();
      document.querySelector(`.${filterType}-Selector`).classList.add("active");
      uncheckOtherFilters(filterType);
    } else {
      // ako nieden filter ne e chekiran se odstranuva .active i se pokazhuvaat site kartichki
      removeActive();
      showCards();
    }
  });
}

// funkcija koja e zadolzhena za promena na 'checked' sostojbata na filterite koj ne se momentalno chekirani
function uncheckOtherFilters(currentFilter) {
  for (const filterType in filters) {
    if (filterType !== currentFilter) {
      filters[filterType].checked = false;
      // console.log("checked = false on", filterType);  /// --- debug
    }
  }
}

// for - ciklus koj ja povikuva funkcijata addEventListeners na sekoj od filterite vo navedeniot objekt
for (const filterType in filters) {
  addEventListeners(filters[filterType], filterType);
}
