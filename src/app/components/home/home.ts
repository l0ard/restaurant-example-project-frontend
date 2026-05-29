import { Component, inject } from '@angular/core';
import { NgOptimizedImage } from '@angular/common';

import { Food } from '../../services/food/food';

@Component({
  selector: 'app-home',
  imports: [NgOptimizedImage],
  templateUrl: './home.html',
  styleUrl: './home.scss',
})
export class Home {
  private foodService = inject(Food);
  foods = this.foodService.getAll();
}
