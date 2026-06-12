import { Component, inject } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { CurrencyPipe, NgOptimizedImage } from '@angular/common';
import { toSignal } from '@angular/core/rxjs-interop';
import { switchMap } from 'rxjs';

import { StarRating } from '../../partials/star-rating/star-rating';
import { FoodService } from '../../../services/food/food-service';
import { Tags } from '../../partials/tags/tags';
import { NotFound } from '../../partials/not-found/not-found';


@Component({
  selector: 'app-home',
  imports: [
    NgOptimizedImage,
    RouterLink,
    StarRating,
    CurrencyPipe,
    Tags,
    NotFound,
  ],
  templateUrl: './home.html',
  styleUrl: './home.scss',
})
export class Home {
  private activatedRoute = inject(ActivatedRoute);
  private foodService = inject(FoodService);

  foods = toSignal(
    this.activatedRoute.params.pipe(
      switchMap((params) => {
        if (params['searchTerm']) {
          return this.foodService.getAllFoodsBySearchTerm(params['searchTerm']);
        }
        if (params['tagId']) {
          return this.foodService.getAllFoodsByTag(Number(params['tagId']));
        }

        return this.foodService.getAll();
      }),
    ),
    {
      initialValue: [],
    },
  );
}
