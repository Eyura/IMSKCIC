var sideBarIsOpen = true;

toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();

    if(sideBarIsOpen){
        dashboard_sidebar.style.transition = '0.9s all';
        dashboard_sidebar.style.width = '10%';
        dashboard_content_container.style.width = '90%';
        dashboard_logo.style.fontSize= '50px';
        userImage.style.width = '20px';
                
        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i < menuIcons.length;i++){
            menuIcons[i].style.display = 'none';
        }

        document.getElementsByClassName('dashboard_menu_lists') [0].style.textAlign = 'center';
        sideBarIsOpen = false;
    } else {
        dashboard_sidebar.style.width = '20%';
        dashboard_content_container.style.width = '80%';
        dashboard_logo.style.fontSize= '80px';
        userImage.style.width = '20px';             

        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i < menuIcons.length;i++){
            menuIcons[i].style.display = 'inline';
        }

        document.getElementsByClassName('dashboard_menu_lists') [0].style.textAlign = 'left';
        sideBarIsOpen = true;
    }  
});

// submenu show / hide function
// function toggleSubMenu(element) {
//     var parentLi = element.closest('.liMainMenu');
//     var subMenu = parentLi.querySelector('.subMenus');
//     subMenu.classList.toggle('show');
// }

// Close the submenu if the user clicks outside of it
// window.onclick = function(e) {
//     if (!e.target.closest('.liMainMenu')) {
//         var subMenus = document.querySelectorAll('.subMenus');
//         subMenus.forEach(function(subMenu) {
//             if (subMenu.classList.contains('show')) {
//                 subMenu.classList.remove('show');
//             }
//         });
//     }
// };

// Submenu Show/Hide function
document.addEventListener('click', function(e){
    let clickedEl = e.target;

    if(clickedEl.classList.contains('showHideSubMenu')){
        let subMenu = clickedEl.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedEl.closest('li').querySelector('.iconArrow');

        // Close open submenus
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if(subMenu !== sub) sub.style.display = 'none';
        });

        // Call function to hide/show submenu
        showHideSubMenu(subMenu, mainMenuIcon);
    }
});

// Function - to show/hide submenu
function showHideSubMenu(subMenu, mainMenuIcon){
    //Check if there is submenu
    if(subMenu !=  null){
        if(subMenu.style.display === 'block'){
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-left');
        } else {
            subMenu.style.display = 'block';
            mainMenuIcon.classList.remove('fa-angle-left');
            mainMenuIcon.classList.add('fa-angle-down');
        }
    }
}

// Add/Hide active class to menu 
// Get the current page
// Use selector to get the current menu or submenu
// Add the active class

let pathArray = window.location.pathname.split('/');
let curFile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="./'+ curFile+'"]');
curNav.classList.add('subMenuActive');

let mainNav = curNav.closest('li.liMainMenu');
mainNav.style.background = '#660000';

let subMenu = curNav.closest('.subMenus');
let mainMenuIcon = mainNav.querySelector('i.iconArrow');

// Call function to hide/show submenu
showHideSubMenu(subMenu, mainMenuIcon);
