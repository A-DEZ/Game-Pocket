const card = document.getElementsByClassName("card"); //grabs all the elements with .card class
const container = document.getElementsByClassName("hs")[0]; //grabs the div with .second-container class

function isInViewport(el) {
  let result = [];
  for (var i = 0; i < el.length; i++) {
    const rect = el[i].getBoundingClientRect();
    // console.log(i, el.length);
    result.push(
      rect.left >= 0 &&
        rect.right <=
          (window.innerWidth || document.documentElement.clientWidth)
    ); // checks whether a div with the .card class is out of the viewport and stores the value in result[]
  }
  return result; // returns an array of boolean values for each element with .card class
}

container.addEventListener("scroll", function () {
  //listens to scroll event inside second-container
  const result = isInViewport(card);
  for (var i = 0; i < result.length; i++) {
    // Below code adds/removes .card-inactive class
    if (!result[i]) {
      card[i].classList.add("card-inactive");
    } else card[i].classList.remove("card-inactive");
  }
});

const card1 = document.getElementsByClassName("card1"); //grabs all the elements with .card class
const container1 = document.getElementsByClassName("hs1")[0]; //grabs the div with .second-container class


container1.addEventListener("scroll", function () {
  //listens to scroll event inside second-container
  const result = isInViewport(card1);
  for (var i = 0; i < result.length; i++) {
    // Below code adds/removes .card-inactive class
    if (!result[i]) {
      card1[i].classList.add("card-inactive");
    } else card1[i].classList.remove("card-inactive");
  }
});

const card2 = document.getElementsByClassName("card2"); //grabs all the elements with .card class
const container2 = document.getElementsByClassName("hs2")[0]; //grabs the div with .second-container class


container2.addEventListener("scroll", function () {
  //listens to scroll event inside second-container
  const result = isInViewport(card2);
  for (var i = 0; i < result.length; i++) {
    // Below code adds/removes .card-inactive class
    if (!result[i]) {
      card2[i].classList.add("card-inactive");
    } else card2[i].classList.remove("card-inactive");
  }
});

const card3 = document.getElementsByClassName("card3"); //grabs all the elements with .card class
const container3 = document.getElementsByClassName("hs3")[0]; //grabs the div with .second-container class

container3.addEventListener("scroll", function () {
  //listens to scroll event inside second-container
  const result = isInViewport(card3);
  for (var i = 0; i < result.length; i++) {
    // Below code adds/removes .card-inactive class
    if (!result[i]) {
      card3[i].classList.add("card-inactive");
    } else card3[i].classList.remove("card-inactive");
  }
});



$('.carousel').carousel({

  pause: "null"

})