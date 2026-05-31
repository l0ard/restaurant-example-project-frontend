import { Component, inject } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { CurrencyPipe, NgOptimizedImage } from '@angular/common';
import { StarRating} from '../../partials/star-rating/star-rating';

import { FoodService } from '../../../services/food/food-service';
import { Search } from '../../partials/search/search';

@Component({
  selector: 'app-home',
  imports: [NgOptimizedImage, RouterLink, StarRating, CurrencyPipe, Search],
  templateUrl: './home.html',
  styleUrl: './home.scss',
})
export class Home {
  private activatedRoute = inject(ActivatedRoute);
  private foodService = inject(FoodService);
  foods = this.foodService.getAll();

  constructor() {
    this.activatedRoute.params.subscribe((params) => {
      const searchTerm = params['searchTerm'];
      if (params['searchTerm']) {
        this.foods = this.foodService.getAllFoodsBySearchTerm(searchTerm);
      } else {
        this.foods = this.foodService.getAll();
      }
    });
  }
}
