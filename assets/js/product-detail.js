var mainImg = document.getElementById("main-img");
var smallImg = document.querySelectorAll(".small-img");

for (let i = 0; i < smallImg.length; i++) {
  smallImg[i].onclick = function () {
    mainImg.src = smallImg[i].src;
    mainImg.setAttribute("xoriginal", smallImg[i].src);
    smallImg.forEach((e) => {
      e.classList.remove("active");
    });
    smallImg[i].classList.add("active");
  };
}
