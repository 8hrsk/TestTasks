document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('.form-control');

  input.addEventListener('input', function() {
    const label = this.nextElementSibling;
    if (this.value !== '') {
      label.classList.add('active');
      
    } else {
      label.classList.remove('active');
    }
  });

  const mobileNavImg = document.getElementById('mobileNavImg');

  const mobileNav = document.getElementById('mobileNav');

  // mobileNav.addEventListener('click', () => {
  //   console.log('mobileNav');
  //   const mobileNavHover = document.querySelector('.mobileNavHover');
  //   mobileNavHover.style.display = 'flex';

  //   mobileNavImg.src="src/img/navbarClose.svg";
  //   mobileNavImg.style.zIndex = '100';

  //   mobileNav.addEventListener('click', () => {
  //     mobileNavHover.style.display = 'none';
  //     mobileNavImg.src="src/img/navbar.svg";
  //     mobileNavImg.style.zIndex = '0';
  //   })
  // });

  const mobileNavHover = document.querySelector('.mobileNavHover');

  const openNav = (nav) => {
    nav.style.display = 'flex';
  }

  const closeNav = (nav) => {
    nav.style.display = 'none';
  }

  mobileNav.addEventListener('click', () => {
    if (mobileNavHover.style.display === 'flex') {
      closeNav(mobileNavHover);
      mobileNavImg.src="src/img/navbar.svg";
      mobileNavImg.style.zIndex = '0';
    } else {
      openNav(mobileNavHover);
      mobileNavImg.src="src/img/navbarClose.svg";
      mobileNavImg.style.zIndex = '100';
    }
  })

})