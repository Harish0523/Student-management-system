document.addEventListener("DOMContentLoaded", function () {
 /* =========================
 DELETE CONFIRMATION
 ========================= */
 const deleteButtons =
 document.querySelectorAll(".delete-btn");
 deleteButtons.forEach(function (button) {
 button.addEventListener("click", function (event) {
 const confirmed = confirm(
 "Are you sure you want to delete this student?"
 );
 if (!confirmed) {
 event.preventDefault();
 }
 });
 });
 /* =========================
 AUTO HIDE ALERTS
 ========================= */
 const alerts =
 document.querySelectorAll(
 ".success-message, .error-message"
 );
 alerts.forEach(function (alert) {
 setTimeout(function () {
 alert.style.opacity = "0";
 setTimeout(function () {
 alert.remove();
 }, 500);
 }, 3000);
 });
 /* =========================
 PASSWORD SHOW / HIDE
 ========================= */
 const passwordInput =
 document.querySelector("#password");
 const passwordToggle =
 document.querySelector("#password-toggle");
 if (passwordInput && passwordToggle) {
 passwordToggle.addEventListener(
 "click",
 function () {
 if (
 passwordInput.type === "password"
 ) {
 passwordInput.type = "text";
 passwordToggle.textContent =
 "Hide";
 } else {
 passwordInput.type = "password";
 passwordToggle.textContent =
 "Show";
 }
 }
 );
 }
});
