const showLoader = () => {
    const loader = document.getElementById('loader');
    const contents = document.querySelectorAll('.content');
    loader.classList.remove('hidden');
    contents.forEach(content => content.classList.add('opacity-0'));
};

const hideLoader = () => {
    const loader = document.getElementById('loader');
    const contents = document.querySelectorAll('.content');
    loader.classList.add('hidden');
    contents.forEach(content => content.classList.remove('opacity-0'));
};

const initializeLoader = () => {
    showLoader();
    setTimeout(hideLoader, 2000);
};

window.onload = function () {
    initializeLoader();
};

document.addEventListener('DOMContentLoaded', () => {
    if(window.Livewire) {
        Livewire.on('fetching::developer', () => {
            showLoader();
            Livewire.dispatch('fetch::developer');
        });

        Livewire.on('fetched::developer', hideLoader);
    }
});
