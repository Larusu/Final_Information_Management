// // Dark Mode Toggle
// document.getElementById('darkModeToggle').addEventListener('click', function() {
//     document.body.classList.toggle('.dark-mode');
//     document.querySelector('.header').classList.toggle('dark-mode');
//     document.querySelectorAll('.toy').forEach(toy => {
//         toy.classList.toggle('dark-mode');
//     });
// });

navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

// Scroll-to-Top Button
window.onscroll = function() {
    scrollFunction();
};


document.querySelectorAll('input[type="number"]').forEach(numberInput => {
   numberInput.oninput = () =>{
      if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
   };
});
// function scrollFunction() {
//     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//         document.getElementById('scrollToTopBtn').style.display = 'block';
//     } else {
//         document.getElementById('scrollToTopBtn').style.display = 'none';
//     }
// }

// document.getElementById('scrollToTopBtn').addEventListener('click', function() {
//     document.body.scrollTop = 0; // For Safari
//     document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
// });