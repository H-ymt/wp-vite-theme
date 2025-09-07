// Page detection helper (reads body.dataset.page and mirrors to class)
document.addEventListener("DOMContentLoaded", function () {
  try {
    var page = document.body.dataset.page;
    if (page) {
      // add class like page--front-page for CSS hooks if needed
      document.body.classList.add("page--" + page);
    }
  } catch {
    null;
  }
});
