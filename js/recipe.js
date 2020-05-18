import SimpleBar from 'simplebar';
import 'simplebar/dist/simplebar.css';
import { getAbsoluteHeight } from './helpers';

class Recipe {
    constructor(container) {
        this.recipe = container;
        this.sidebar = this.recipe.querySelector('.sidebar');
        this.sidebarInner = this.recipe.querySelector('.inner');
        this.toggleButton = this.recipe.querySelector('.toggle-button');
        this.sidebarLabel = this.recipe.querySelector('.mobile-label span');
        this.ingredientsContainer = this.recipe.querySelector('.ingredients');
        this.method = this.recipe.querySelector('.method');
        this.pageContainer = document.querySelector('#content');

        this.sidebarOpen = false;
        this.init();
    }

    init() {

        const scroller = new SimpleBar(this.ingredientsContainer, {
            autoHide: false,
        })

        this.pageContainer.style.overflow = 'visible'; // Allows for scrolling ingredients list - doesn't work if hidden

        this.toggleButton.addEventListener('click', () => {
            this.toggleSidebar();
        });

        this.sidebarLabel.addEventListener('click', () => {
            this.toggleSidebar();
        });

        this.resize();
    }

    toggleSidebar() {
        if (this.sidebarOpen) {
            this.ingredientsContainer.style.opacity = '';
            this.ingredientsContainer.style.left = '';
            setTimeout(() => {
                this.recipe.classList.remove('open');
                this.sidebarOpen = false;
            }, 100);
        } else {
            this.recipe.classList.add('open');
            this.sidebarOpen = true;
            setTimeout(() => {
                this.ingredientsContainer.style.opacity = 1;
                this.ingredientsContainer.style.left = 0;
            }, 200);
        }
    }

    resize() {
        this.setSidebarHeight();
    }

    setSidebarHeight() {
        const methodHeight = getAbsoluteHeight(this.method);
        const ingredientsHeight = getAbsoluteHeight(this.ingredientsContainer);
        if (ingredientsHeight < methodHeight && window.innerWidth >= 1024 ) { // Method longer than ingredients, desktop/wide size
            this.sidebar.style.height = methodHeight + 'px';
        } else if (ingredientsHeight >= methodHeight && window.innerWidth >= 1024) { // Ingredients longer than method, desktop/wide size
            this.sidebar.style.height = '';
        } else if (window.innerWidth < 1024) {
            const padding  = parseInt(getComputedStyle(this.recipe).paddingBottom.slice(0, -2));
            this.sidebar.style.height = methodHeight + padding + 10 + 'px'; // top offset
        }

        // TODO - make function
        if (window.innerWidth < 1024) {
            const ingredientStyle = getComputedStyle(this.ingredientsContainer);
            const top = ingredientStyle.getPropertyValue('top').split('px')[0];
            const headerHeight = getAbsoluteHeight(document.querySelector('.site-header'))
            this.ingredientsContainer.style.height = window.innerHeight - top - headerHeight + 'px';
        } else {
            this.ingredientsContainer.style.height = '';
        }
    }
}

export default Recipe;