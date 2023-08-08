const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');
if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add("active");
    })
}
if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove("active");
    })
}
// ================ active page =========================
  // Get the current page URL
  var currentURL = window.location.href;
  
  // Get all anchor tags inside the #navbar element
  var navLinks = document.querySelectorAll('#navbar a');
  
  // Loop through the links and add the 'active' class to the current page link
  navLinks.forEach(function(link) {
    if (link.href === currentURL) {
      link.classList.add('active');
    }
  });

//============================= signin/signup form =====================
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

// signUpButton.addEventListener('click', () => {
// 	container.classList.add("right-panel-active");
// });

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });

  