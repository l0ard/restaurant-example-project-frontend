import { Routes } from '@angular/router';
import { Home } from './components/pages/home/home';
import { FoodPage } from './components/pages/food-page/food-page';
import { CartPage } from './components/pages/cart-page/cart-page';

export const routes: Routes = [
  {
    path: '',
    component: Home,
  },
  {
    path: 'search/:searchTerm',
    component: Home,
  },
  {
    path: 'tag/:tag',
    component: Home,
  },
  {
    path: 'food/:id',
    component: FoodPage,
  },
  {
    path: 'cart-page',
    component: CartPage,
  },
];
