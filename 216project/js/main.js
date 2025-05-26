// Selects navigation and toggle buttons
const navItems = document.querySelector('.nav__items');
const openNavBtn = document.querySelector('#open__nav-btn');
const closeNavBtn = document.querySelector('#close__nav-btn');

// Opens the navigation dropdown
const openNav = () => {
    navItems.style.display = 'flex'; // show nav items
    openNavBtn.style.display = 'none'; // hide open button
    closeNavBtn.style.display = 'inline-block'; // show close button
}

// Closes the navigation dropdown
const closeNav = () => {
    navItems.style.display = 'none'; // hide nav items
    openNavBtn.style.display = 'inline-block'; // show open button
    closeNavBtn.style.display = 'none'; // hide close button
}

// Event listeners for nav buttons
openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);

// Sidebar toggle elements
const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide__sidebar-btn');

// Shows sidebar for small screens
const showSidebar = () => {
    sidebar.style.left = '0'; // moves sidebar into view
    showSidebarBtn.style.display = 'none'; // hides show button
    hideSidebarBtn.style.display = 'inline-block'; // shows hide button
}

// Hides sidebar for small screens
const hideSidebar = () => {
    sidebar.style.left = '-100%'; // moves sidebar out of view
    showSidebarBtn.style.display = 'inline-block'; // shows show button
    hideSidebarBtn.style.display = 'none'; // hides hide button
}

// Event listeners for sidebar buttons
showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);
