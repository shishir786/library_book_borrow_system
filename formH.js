document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".edit-btn");
  const editForm = document.getElementById("edit-form");

  // Function to show the form and populate it
  const showForm = (bookData) => {
    document.getElementById("BookId").value = bookData.BookId;
    document.getElementById("Tittle").value = bookData.Tittle;
    document.getElementById("Author").value = bookData.Author;
    document.getElementById("ISBN").value = bookData.ISBN;
    document.getElementById("Category").value = bookData.Category;
    document.getElementById("Quantity").value = bookData.Quantity;

    editForm.style.display = "grid";
    editHeading.style.display = "block";
  };

  window.hideForm = () => {
    editForm.style.display = "none";
    editHeading.style.display = "none";
  };

  editButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const bookData = {
        BookId: button.getAttribute("data-bookid"),
        Tittle: button.getAttribute("data-tittle"),
        Author: button.getAttribute("data-author"),
        ISBN: button.getAttribute("data-isbn"),
        Category: button.getAttribute("data-category"),
        Quantity: button.getAttribute("data-quantity"),
      };
      showForm(bookData);
    });
  });
});
