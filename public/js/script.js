const collection = document.getElementsByClassName("switch-mode");

const mode = document.getElementsByClassName("mode");
const main = document.getElementsByClassName("landing-page");
const cipher = document.getElementById("cipher");
const plain = document.getElementById("plain");
const title = document.getElementById("main-title");
const select = document.getElementById("hash");

const radioDecrypt = document.getElementById("de");
const radioEncrypt = document.getElementById("en");

radioDecrypt.addEventListener("change", function () {
  console.log("change Radio Decrypt");
  if (this.checked) {
    // plain.style.display = "none";
    // cipher.style.display = "block";
    mode[1].classList.add("active");
    mode[0].classList.remove("active");
  }
});

radioEncrypt.addEventListener("change", function () {
  console.log("change Radio Encrypt");
  console.log(this.checked);
  if (this.checked) {
    // cipher.style.display = "none";
    // plain.style.display = "block";
    mode[1].classList.remove("active");
    mode[0].classList.add("active");
  }
});


select.addEventListener("change", function () {
  console.log("change Selected hash");
  console.log(this.selected);
  if(this.value != 0) {
    this.form.submit();
  }
});

// const decryptBtn = document.getElementsByClassName("decrypt-btn");

// encryptBtn[0].addEventListener("click", (e) => {
//   const classEncryptBtn = encryptBtn[0].classList;

//   if (classEncryptBtn.contains("active")) {
//     decryptBtn[0].classList.add("active");
//   } else {
//     decryptBtn[0].classList.remove("active");
//   }
// });

// decryptBtn[0].addEventListener("click", (e) => {
//   const classDecryptBtn = decryptBtn[0].classList;

//   if (classDecryptBtn.contains("active")) {
//     encryptBtn[0].classList.add("active");
//   } else {
//     encryptBtn[0].classList.remove("active");
//   }
// });

// if (document.getElementById("en").checked) {
//   classList.add("active");
// } else if (document.getElementById("de").checked) {
//   //Female radio button is checked
// }
