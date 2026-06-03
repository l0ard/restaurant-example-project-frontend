import { Component, inject } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { CurrencyPipe, NgOptimizedImage } from '@angular/common';
import { StarRating} from '../../partials/star-rating/star-rating';

import { FoodService } from '../../../services/food/food-service';
import { Search } from '../../partials/search/search';
import { Tags } from '../../partials/tags/tags';
import { NotFound } from '../../partials/not-found/not-found';

@Component({
  selector: 'app-home',
  imports: [NgOptimizedImage, RouterLink, StarRating, CurrencyPipe, Search, Tags, NotFound],
  templateUrl: './home.html',
  styleUrl: './home.scss',
})
export class Home {
  private activatedRoute = inject(ActivatedRoute);
  private foodService = inject(FoodService);

  foods = this.foodService.getAll();

  ngOnInit() {
    this.activatedRoute.params.subscribe((params) => {
      if (params['searchTerm']) {
        this.foods = this.foodService.getAllFoodsBySearchTerm(params['searchTerm']);
        return;
      }
      if (params['tag']) {
        this.foods = this.foodService.getAllFoodsByTag(params['tag']);
        return;
      }
      this.foods = this.foodService.getAll();
    });
  }
}
