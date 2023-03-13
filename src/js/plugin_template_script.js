window.addEventListener('load', function () {
    // store tabs variables
    let tabs = document.querySelectorAll('ul.nav-tabs > li');
    tabs.forEach(tab => {
        tab.addEventListener('click', switchTab);
    });
});

function switchTab(e) {
    e.preventDefault();
    document.querySelector('ul.nav-tabs li.active').classList.remove('active');
    document.querySelector('.tab-pane.active').classList.remove('active');

    let clickedTab = e.currentTarget,
        anchor = e.target,
        activePaneID = anchor.getAttribute("href");

    clickedTab.classList.add('active');
    document.querySelector(activePaneID).classList.add('active');
}