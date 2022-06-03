document.getElementById("seeMore").onclick = function diplayMore() {
    document.getElementById("seeMore").classList.add('d-none');
    document.getElementById("visible-comments").classList.add('d-none');
    document.getElementById("seeLess").classList.remove('d-none');
    document.getElementById("hidden-comments").classList.remove('d-none');
  }

document.getElementById("seeLess").onclick = function displayLess() {
    document.getElementById("seeMore").classList.remove('d-none');
    document.getElementById("hidden-comments").classList.add('d-none');
    document.getElementById("seeLess").classList.add('d-none');
    document.getElementById("visible-comments").classList.remove('d-none');
  }