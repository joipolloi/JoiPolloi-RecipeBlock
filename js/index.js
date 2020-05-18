import { debounce } from './helpers';
import Recipe from './recipe.js'

const recipeHTML = document.querySelector('.recipe');
const recipeInstance = new Recipe(recipeHTML);

window.addEventListener('resize', debounce(recipeInstance.resize()));