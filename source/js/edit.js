document.addEventListener("DOMContentLoaded", function () {
  const modals = document.querySelectorAll(".modal");
  modals.forEach((modal) => {
    document.body.appendChild(modal);
  });
});
