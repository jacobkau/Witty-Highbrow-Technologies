document.addEventListener("DOMContentLoaded", function () {
  emailjs.init("fd8AssW6J5To9EUF0"); // Your EmailJS public key

  document.getElementById("contact-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevents default form submission behavior

    // Get form values
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;

    // Validate form
    if (!name || !email || !message) {
      alert("Please fill in all fields.");
      return;
    }

    // EmailJS parameters
    let templateParams = {
      from_name: name,
      from_email: email,
      message: message,
    };

  emailjs.sendForm('service_a67fvms', 'template_l6g3xm2', this)
  .then(function (response) {
    alert("Message sent successfully!");
    document.getElementById("contact-form").reset(); // Clear form
  }, function (error) {
    alert("Failed to send message. Error: " + error.text);
  });
});
});


document.addEventListener("DOMContentLoaded", () => {
  showSlide(currentSlide);
});

// Back to top button
const backToTopButton = document.getElementById("back-to-top");

window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    backToTopButton.style.display = "block";
  } else {
    backToTopButton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

