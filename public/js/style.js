// Confirm before delete a post
function deleteDialog() {
  return confirm("Voulez-vous vraiment supprimer ce billet?");
}

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    $(".fixed-top").css("background-color", "#2c5a63");
    $(".fixed-top").css("transition", "background-color 1s ease 0s;");
  } else {
    $(".fixed-top").css("background-color", "transparent");
  }
}
