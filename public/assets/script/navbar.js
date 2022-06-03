document.getElementById("searchToggler").onclick = function diplayMore() {
    document.getElementById("mobileSearchBar").classList.remove('d-none');
    document.getElementById("logo").classList.add('d-none');
    document.getElementById("listMobile").classList.add('d-none');
    document.getElementById("closeSearch").classList.remove('d-none');
    document.getElementById("searchToggler").classList.add('d-none');
  }

document.getElementById("closeSearch").onclick = function diplayMore() {
    document.getElementById("mobileSearchBar").classList.add('d-none');
    document.getElementById("logo").classList.remove('d-none');
    document.getElementById("listMobile").classList.remove('d-none');
    document.getElementById("searchToggler").classList.remove('d-none');
    document.getElementById("closeSearch").classList.add('d-none');
  }
